<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the student profile with photo upload option.
     */
    public function show(Student $student)
    {
        return view('student.profile.show', compact('student'));
    }

    /**
     * Update student profile including photo upload.
     */
    public function update(Request $request, Student $student)
    {
        // Allow students to only update their own profile
        if ($student->id !== auth()->id() && !auth()->user()->hasRole(['admin', 'super-admin'])) {
            abort(403, 'Unauthorized');
        }

        $data = $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'second_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Only update allowed fields
        if (!empty($data['first_name'])) {
            $student->first_name = $data['first_name'];
        }
        if (!empty($data['second_name'])) {
            $student->second_name = $data['second_name'];
        }
        if (!empty($data['email'])) {
            $student->email = $data['email'];
        }
        if (!empty($data['phone'])) {
            $student->phone = $data['phone'];
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($student->photo_path && Storage::disk('public')->exists($student->photo_path)) {
                Storage::disk('public')->delete($student->photo_path);
            }

            // Store new photo
            $path = $request->file('photo')->store('photos/students', 'public');
            $student->photo_path = $path;
        }

        $student->save();

        return back()->with('status', 'Profile updated successfully!');
    }

    /**
     * Delete the student's profile photo.
     */
    public function deletePhoto(Request $request, Student $student)
    {
        // Allow students to only delete their own photo
        if ($student->id !== auth()->id() && !auth()->user()->hasRole(['admin', 'super-admin'])) {
            abort(403, 'Unauthorized');
        }

        if ($student->photo_path && Storage::disk('public')->exists($student->photo_path)) {
            Storage::disk('public')->delete($student->photo_path);
            $student->photo_path = null;
            $student->save();

            return back()->with('status', 'Photo deleted successfully!');
        }

        return back()->with('error', 'No photo to delete.');
    }
}
