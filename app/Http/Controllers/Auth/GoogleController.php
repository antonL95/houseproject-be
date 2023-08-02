<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ClientUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Config;
use Google\Service\Oauth2;
use Google_Client;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

final class GoogleController extends Controller
{
    /**
     * @throws \InvalidArgumentException
     */
    public function getClientAuthUrl(): RedirectResponse
    {
        return $this->getAuthUrl(true);
    }


    /**
     * @throws \InvalidArgumentException
     */
    public function loginClinet(Request $request): RedirectResponse
    {
        return $this->login($request, true);
    }


    /**
     * @throws \InvalidArgumentException
     */
    public function getAuthUrl(bool $useClientGuard = false): RedirectResponse
    {
        $client = $this->getClient($useClientGuard);
        $authUrl = $client->createAuthUrl();

        return redirect($authUrl);
    }


    /**
     * @throws \InvalidArgumentException
     */
    public function login(Request $request, bool $useClientGuard = false): RedirectResponse
    {
        $code = $request->get('code');

        $client = $this->getClient($useClientGuard);
        $accessToken = $client->fetchAccessTokenWithAuthCode($code);

        $client->setAccessToken($accessToken);
        $service = new Oauth2($client);
        $userFromGoogle = $service->userinfo->get();

        $user = $useClientGuard
            ? ClientUser::where('google_id', $userFromGoogle->id)->first()
            : User::where('google_id', $userFromGoogle->id)->first();

        if ($user === null) {
            $user = $useClientGuard
                ? ClientUser::where('email', $userFromGoogle->email)->first()
                : User::where('email', $userFromGoogle->email)->first();

            $user->update([
                'google_id' => $userFromGoogle->id,
            ]);
        }

        if ($user === null) {
            try {
                $user = $useClientGuard
                    ? ClientUser::create(
                        [
                            'google_id' => $userFromGoogle->id,
                            'email' => $userFromGoogle->email,
                            'email_verified_at' => Carbon::now(),
                            'first_name' => $userFromGoogle->givenName,
                            'last_name' => $userFromGoogle->familyName,
                            'avatar' => $userFromGoogle->picture,
                        ],
                    )
                    : User::create(
                        [
                            'google_id' => $userFromGoogle->id,
                            'email' => $userFromGoogle->email,
                            'email_verified_at' => Carbon::now(),
                            'first_name' => $userFromGoogle->givenName,
                            'last_name' => $userFromGoogle->familyName,
                            'avatar' => $userFromGoogle->picture,
                        ],
                    );
            } catch (QueryException) {
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed'),
                ]);
            }
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


    /**
     * @throws \InvalidArgumentException
     */
    private function getClient(bool $isClient = false): Google_Client
    {
        $configJson = Config::get('auth.google_client_credentials');

        $applicationName = 'houseproject';

        if (!\is_string($configJson) && !\is_array($configJson)) {
            throw new \InvalidArgumentException;
        }

        $client = new Google_Client;
        $client->setApplicationName($applicationName);
        $client->setAuthConfig($configJson);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->setScopes(
            [
                Oauth2::USERINFO_PROFILE,
                Oauth2::USERINFO_EMAIL,
                Oauth2::OPENID,
            ],
        );

        if ($isClient) {
            $client->setRedirectUri(route('google.login-clinet'));
        }

        $client->setIncludeGrantedScopes(true);

        return $client;
    }
}
