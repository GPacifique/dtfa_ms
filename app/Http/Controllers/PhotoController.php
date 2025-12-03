<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Serve a student's photo from the public disk.
     *
     * This returns the file with correct MIME type and cache headers.
     * If the student has no photo or the file is missing, a 404 is returned.
     */
    public function showStudent(Student $student)
    {
        // Prefer configured default disk so controller works both locally and in cloud (S3)
        $disk = config('filesystems.default', 'public');
        $path = $student->photo_path ?? $student->image_path ?? null;

        if (!$path || !Storage::disk($disk)->exists($path)) {
            abort(404);
        }

        // If disk is local (public) we can return the file directly from disk path
        $adapter = Storage::disk($disk)->getDriver();

        // Quick check: local filesystems typically support ->path()
        try {
            $localPath = Storage::disk($disk)->path($path);
            if ($localPath && is_file($localPath)) {
                $mime = Storage::disk($disk)->mimeType($path) ?: 'application/octet-stream';
                return response()->file($localPath, [
                    'Content-Type' => $mime,
                    'Cache-Control' => 'public, max-age=31536000, immutable',
                ]);
            }
        } catch (\Exception $e) {
            // fall through to streaming/redirect for non-local disks
        }

        // For remote disks (S3-like) return a redirect to the storage URL if available
        // or stream the file via the Storage read stream as a fallback.
        try {
            $url = Storage::disk($disk)->url($path);
            if ($url) {
                return redirect()->away($url);
            }
        } catch (\Exception $e) {
            // ignore and fall back to stream
        }

        // Stream fallback
        $stream = Storage::disk($disk)->readStream($path);
        if ($stream === false) {
            abort(404);
        }

        $mime = Storage::disk($disk)->mimeType($path) ?? 'application/octet-stream';
        return response()->stream(
            function () use ($stream) {
                fpassthru($stream);
                if (is_resource($stream)) {
                    fclose($stream);
                }
            },
            200,
            [
                'Content-Type' => $mime,
                'Cache-Control' => 'public, max-age=31536000, immutable',
            ]
        );
    }

    /**
     * Serve a staff member's photo.
     */
    public function showStaff(Staff $staff)
    {
        return $this->servePhoto($staff->photo_path);
    }

    /**
     * Serve a user's profile picture.
     */
    public function showUser(User $user)
    {
        return $this->servePhoto($user->profile_picture_path);
    }

    /**
     * Generic method to serve photos from storage.
     *
     * @param string|null $path
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected function servePhoto(?string $path)
    {
        $disk = config('filesystems.default', 'public');

        if (!$path || !Storage::disk($disk)->exists($path)) {
            abort(404);
        }

        // Try to serve file directly for local disk
        try {
            $localPath = Storage::disk($disk)->path($path);
            if ($localPath && is_file($localPath)) {
                $mime = Storage::disk($disk)->mimeType($path) ?: 'application/octet-stream';
                return response()->file($localPath, [
                    'Content-Type' => $mime,
                    'Cache-Control' => 'public, max-age=31536000, immutable',
                ]);
            }
        } catch (\Exception $e) {
            // Fall through for remote disks
        }

        // For remote disks (S3), redirect to the URL
        try {
            $url = Storage::disk($disk)->url($path);
            if ($url) {
                return redirect()->away($url);
            }
        } catch (\Exception $e) {
            // Fall through to streaming
        }

        // Stream fallback
        $stream = Storage::disk($disk)->readStream($path);
        if ($stream === false) {
            abort(404);
        }

        $mime = Storage::disk($disk)->mimeType($path) ?? 'application/octet-stream';
        return response()->stream(function () use ($stream) {
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        }, 200, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }
}
