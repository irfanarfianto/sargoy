<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class SellerController extends Controller
{
    public function index()
    {
        return view('dashboard.seller.index');
    }

    public function edit(Request $request): View
    {
        return view('dashboard.seller.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            flash()->success('Profil berhasil diperbarui.');

            return Redirect::route('dashboard.seller.edit')->with('status', 'profile-updated');
        } catch (\Exception $e) {
            flash()->error('Gagal memperbarui profil: ' . $e->getMessage());

            return Redirect::back()->withInput();
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        try {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            $user = $request->user();

            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            flash()->success('Akun berhasil dihapus.');

            return Redirect::to('/');
        } catch (\Exception $e) {
            flash()->error('Gagal menghapus akun: ' . $e->getMessage());

            return Redirect::back();
        }
    }
}
