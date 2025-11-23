<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
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
        $path = $student->photo_path ?? $student->image_path ?? null;
        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $full = Storage::disk('public')->path($path);
        $mime = Storage::disk('public')->mimeType($path) ?: 'application/octet-stream';

        return response()->file($full, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }
}
