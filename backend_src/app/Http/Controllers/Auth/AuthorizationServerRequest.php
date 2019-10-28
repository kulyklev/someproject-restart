<?php


namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;

trait AuthorizationServerRequest
{
    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendAuthorizationServerRequest(Request $request)
    {
        $apiRequest = Request::create('/oauth/token', 'POST', [
            'grant_type' => 'password',
            'client_id' => config('services.laravel_passport.client_id'),
            'client_secret' => config('services.laravel_passport.client_secret'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]);
        //TODO Maybe I should remove refresh_token from response
        $response = app()->handle($apiRequest);

        return $response;
    }
}
