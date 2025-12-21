<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageProxyController extends Controller
{
    /**
     * Proxy files from the public disk when symlink is not available.
     * Works for paths like /storage/photos/students/xxx.jpg
     */
    public function show(Request $request, string $path)
    {
        $disk = 'public';
        // Normalize incoming path (no leading slashes)
        $normalized = ltrim($path, '/');

        if (!Storage::disk($disk)->exists($normalized)) {
            abort(404);
        }

        // Try local file response first
        try {
            $localPath = Storage::disk($disk)->path($normalized);
            if ($localPath && is_file($localPath)) {
                $mime = Storage::disk($disk)->mimeType($normalized) ?: 'application/octet-stream';
                return response()->file($localPath, [
                    'Content-Type' => $mime,
                    'Cache-Control' => 'public, max-age=31536000, immutable',
                ]);
            }
        } catch (\Throwable $e) {
            // Fall through to streaming
        }

        // Stream fallback (S3-like adapters)
        $stream = Storage::disk($disk)->readStream($normalized);
        if ($stream === false) {
            abort(404);
        }

        $mime = Storage::disk($disk)->mimeType($normalized) ?? 'application/octet-stream';
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
