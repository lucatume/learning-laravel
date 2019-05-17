<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Socialite;

class LoginController extends Controller {

    public function redirectToProvider() {
        return Socialite::driver( 'google' )
                        ->with( [ 'hd' => 'tri.be' ] )
                        ->redirect();
    }

    public function handleProviderCallback() {
        /** @var \Laravel\Socialite\Two\GoogleProvider $driver */
        $driver = Socialite::driver( 'google' );
        /** @var \Laravel\Socialite\Two\User $someone */
        $user          = $driver->user();
        $now           = date( 'Y-m-d H:i:s' );
        $updatePayload = [
            'name'           => $user->getName(),
            'remember_token' => $user->token,
            'updated_at'     => $now,
        ];

        $dbUser = User::query()->where( 'email', $user->getEmail() )->first();

        if ( $dbUser instanceof User ) {
            $dbUser->update( $updatePayload );
        } else {
            User::query()->insert(
                array_merge( $updatePayload, [
                    'email'      => $user->getEmail(),
                    'name'       => $user->getName(),
                    'password'   => '',
                    'created_at' => $now,
                ] ) );

            $dbUser = User::query()->where( 'email', $user->getEmail() )->first();
        }

        Auth::login( $dbUser, true );

        return redirect( '/' );
    }

    public function logout() {
        Auth::logout();

        return redirect( '/' );
    }
}
