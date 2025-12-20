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
        // Use public disk for student photos
        $disk = 'public';
        $path = $student->photo_path ?? $student->image_path ?? null;

        if (!$path || !Storage::disk($disk)->exists($path)) {
            $initials = strtoupper(substr($student->first_name, 0, 1) . substr($student->second_name ?? '', 0, 1));
            return $this->serveSvgAvatar($initials);
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
        $path = $staff->photo_path;
        if (!$path || !Storage::disk('public')->exists($path)) {
            $initials = strtoupper(substr($staff->first_name, 0, 1) . substr($staff->last_name ?? '', 0, 1));
            return $this->serveSvgAvatar($initials);
        }
        return $this->servePhoto($path);
    }

    /**
     * Serve a user's profile picture.
     */
    public function showUser(User $user)
    {
        $path = $user->profile_picture_path;
        if (!$path || !Storage::disk('public')->exists($path)) {
            $initials = strtoupper(substr($user->name, 0, 1));
            return $this->serveSvgAvatar($initials);
        }
        return $this->servePhoto($path);
    }

    /**
     * Generate and serve an SVG avatar with initials.
     */
    protected function serveSvgAvatar(string $initials)
    {
        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
    <rect width="128" height="128" fill="#f1f5f9"/>
    <text x="50%" y="50%" font-family="ui-sans-serif, system-ui, sans-serif" font-size="52" font-weight="600" fill="#64748b" text-anchor="middle" dy=".35em">{$initials}</text>
</svg>
SVG;

        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml',
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }

    /**
     * Generic method to serve photos from storage.
     *
     * @param string|null $path
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected function servePhoto(?string $path)
    {
        // Use public disk for photos
        $disk = 'public';

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
