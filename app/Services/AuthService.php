<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use App\User;


class AuthService {
    private $user;
    private $guzzleHttpClient;
    private $request;
    private $db;

    const REFRESH_TOKEN = 'refreshToken';

    public function __construct(Application $app, User $user, Client $guzzleHttpClient)
    {
        $this->user = $user;
        $this->guzzleHttpClient = $guzzleHttpClient;

        $this->auth = $app->make('auth');
        $this->cookie = $app->make('cookie');
        $this->db = $app->make('db');
        $this->request = $app->make('request');
    }

    public function login($email, $password)
    {
        $user = $this->user;
        $user::where('email', $email)->get();
        if (!is_null($user)) {
            return $this->proxy('password', [
                'username' => $email,
                'password' => $password
            ]);
        }
    }

    public function refreshToken()
    {
        $refreshToken = $this->request->cookie(self::REFRESH_TOKEN);
        if($refreshToken === null) {
            return collect([
                ['access_token' => null, 'expires_in' => null]
            ]);
        }

        return
            $this->proxy('refresh_token', [
                'refresh_token' => $refreshToken
            ]);
    }

    public function logout()
    {
        $accessToken = $this->auth->user()->token();
        $this->db
            ->table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        $this->cookie->queue($this->cookie->forget(self::REFRESH_TOKEN));
        return collect([
            ['access_token' => 'null', 'expires_in' => 'null']
        ]);
    }

    public function user() {
      return collect([
            [
                'access_token' => $this->auth->user()->token()->id,
                'expires_in' => $this->auth->user()->token()->expires_at
            ]
        ]);
    }

    public function proxy($grantType, array $data = [])
    {
        $data = array_merge($data, [
            'client_id'     => '2',
            'client_secret' => 'Eb4Z1TrPSNl3Js9aYuvJ0G76uSl76aRMLLE2nzWO',
            'grant_type'    => $grantType
        ]);
        $data = ['form_params' => $data];
        $response = $this->guzzleHttpClient->post('http://laravelapi.local/oauth/token', $data);

        $data = json_decode((string) $response->getBody(), true);

        // Create a refresh token cookie
        $this->cookie->queue(
            self::REFRESH_TOKEN,
            $data['refresh_token'],
            864000, // 10 days
            null,
            null,
            false,
            false // HttpOnly
        );

        return [
            'access_token' => $data['access_token'],
            'expires_in' => $data['expires_in']
        ];
    }

}