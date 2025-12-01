<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Show the user's profile with photo upload option.
     */
    public function show(User $user)
    {
        // Allow users to only view their own profile or admins
        if ($user->id !== auth()->id() && !auth()->user()->hasRole(['admin', 'super-admin'])) {
            abort(403, 'Unauthorized');
        }

        return view('user.profile.show', compact('user'));
    }

    /**
     * Update user profile including photo upload.
     */
    public function update(Request $request, User $user)
    {
        // Allow users to only update their own profile or admins
        if ($user->id !== auth()->id() && !auth()->user()->hasRole(['admin', 'super-admin'])) {
            abort(403, 'Unauthorized');
        }

        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:50'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Only update allowed fields
        if (!empty($data['name'])) {
            $user->name = $data['name'];
        }
        if (!empty($data['email'])) {
            $user->email = $data['email'];
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old photo if exists
            if ($user->profile_picture_path && Storage::disk('public')->exists($user->profile_picture_path)) {
                Storage::disk('public')->delete($user->profile_picture_path);
            }

            // Store new photo
            $path = $request->file('profile_picture')->store('photos/users', 'public');
            $user->profile_picture_path = $path;
        }

        $user->save();

        return back()->with('status', 'Profile updated successfully!');
    }

    /**
     * Delete the user's profile picture.
     */
    public function deletePicture(Request $request, User $user)
    {
        // Allow users to only delete their own picture or admins
        if ($user->id !== auth()->id() && !auth()->user()->hasRole(['admin', 'super-admin'])) {
            abort(403, 'Unauthorized');
        }

        if ($user->profile_picture_path && Storage::disk('public')->exists($user->profile_picture_path)) {
            Storage::disk('public')->delete($user->profile_picture_path);
            $user->profile_picture_path = null;
            $user->save();

            return back()->with('status', 'Photo deleted successfully!');
        }

        return back()->with('error', 'No photo to delete.');
    }
}
