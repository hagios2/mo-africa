<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CustomLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.new_login');
    }


    public function authLogin(Request $request)
    {
        $request->validate(['username'=> 'required|email', 'password'=> 'required']);

        $headers =  array(
            "type: application/x-www-form-urlencoded",
            "Content-Type: text/plain"
        );

        $client = new Client(['headers' => $headers]);

        $body = $request->only(['username', 'password']);

        $body['grant_type'] = 'password';

        $response = $client->request('POST', 'https://orassvas.bog.gov.gh:7002/oauth2/token',[
            'form_params' => $body
        ]);

        $response_body = json_decode((string) $response->getBody(), false);

        session(['access_token' => $response_body->access_token, 'expires_in' => $response_body->expires_in]);

        return redirect()->route('home');
    }


    public function authLogout(Request $request)
    {
        $request->session()->flush();

        return redirect()->route('login');
    }
}
