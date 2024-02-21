<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();

        $tabJours = array(1,2,3,4,5,6,0);
        if ($user->weekdays != ""){
            $tabJours = json_decode($user->weekdays);
        }

        $tabLignes = [];
        if ($user->prefs != ""){
            $tabLignes = json_decode($user->prefs);
        }


        return view('profile.edit', [
            'user' => $request->user(),
            'tabLignes' => $tabLignes,
            'tabJours' => $tabJours,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if (null != $request->input("ligne_bus")){
            $request->user()->prefs = json_encode($request->input("ligne_bus"));
        }
        if (null != $request->input("jours")){
            $request->user()->weekdays = json_encode($request->input("jours"));
        }

        $request->user()->save();

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
