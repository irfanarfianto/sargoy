<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OauthController extends Controller
{
    /**
     * Redirect ke halaman autentikasi Google.
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback dari Google setelah autentikasi.
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Cari pengguna berdasarkan gauth_id
            $findUser = User::where('gauth_id', $user->id)->first();

            if ($findUser) {
                // Jika pengguna sudah ada, login dan redirect
                Auth::login($findUser);

                flash()->success('Login berhasil.');

                return redirect('/');
            } else {
                // Jika pengguna belum ada, buat pengguna baru
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => encrypt('') // Anda bisa mengabaikan password jika menggunakan OAuth
                ]);

                // Berikan role kepada pengguna baru jika diperlukan
                $newUser->assignRole('visitor');

                // Login pengguna baru
                Auth::login($newUser);

                flash()->success('Akun baru berhasil dibuat.');

                return redirect('/');
            }
        } catch (Exception $e) {
            // Tangani kesalahan autentikasi
            flash()->error('Gagal melakukan autentikasi: ' . $e->getMessage());

            return redirect()->back();
        }
    }
}
