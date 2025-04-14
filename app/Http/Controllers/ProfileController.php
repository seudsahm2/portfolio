<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            Log::info('Profile image upload initiated for user ID: ' . $user->id);

            // Delete the old image if it exists
            if ($user->profile_image) {
                \Storage::disk('public')->delete($user->profile_image);
                Log::info('Old profile image deleted for user ID: ' . $user->id);
            }
    
            // Store the new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;

            Log::info('New profile image uploaded for user ID: ' . $user->id . ', Path: ' . $imagePath);
        } else {
            Log::info('No profile image uploaded for user ID: ' . $user->id);
        }
    
        $user->fill($request->validated());
    
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        $user->save();

        Log::info('Profile updated successfully for user ID: ' . $user->id);
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
