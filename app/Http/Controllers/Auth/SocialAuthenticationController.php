<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialAccountManager;
use Illuminate\Http\RedirectResponse as IlluminateRedirectResponse;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

class SocialAuthenticationController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Laravel Socialite class instance.
     *
     * @var \Laravel\Socialite\Facades\Socialite;
     */
    protected $socialite;

    /**
     * SocialAccountManager service class instance.
     *
     * @var \App\Services\SocialAccountManager;
     */
    protected $accountManager;

    /**
     * Create a new controller instance.
     *
     * @param \Laravel\Socialite\Contracts\Factory $socialite
     * @param \App\Services\SocialAccountManager   $accountManager
     */
    public function __construct(Socialite $socialite, SocialAccountManager $accountManager)
    {
        $this->middleware('guest');
        $this->socialite = $socialite;
        $this->accountManager = $accountManager;
    }

    /**
     * Redirect the user to the provider's authentication page.
     *
     * @param string $provider
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider): SymfonyRedirectResponse
    {
        return $this->socialite->driver($provider)->redirect();
    }

    /**
     * Define callback for handling provider authenticated user.
     *
     * @param string $provider
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider): IlluminateRedirectResponse
    {
        $user = $this->socialite->driver($provider)->user();

        $account = $this->accountManager->findOrCreateUserAccount($user, $provider);

        auth()->login($account, true);

        return redirect($this->redirectTo);
    }
}
