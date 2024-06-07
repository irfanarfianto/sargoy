<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OauthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('gauth_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                flash()->success('Login berhasil.');

                return redirect(url('/'));
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => encrypt('')
                ]);

                $newUser->assignRole('visitor');

                Auth::login($newUser);

                flash()->success('Akun baru berhasil dibuat.');

                return redirect(url('/'));
            }
        } catch (Exception $e) {
            flash()->error('Gagal melakukan autentikasi: ' . $e->getMessage());

            return Redirect::back();
        }
    }
}
