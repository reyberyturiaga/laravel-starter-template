<?php

namespace App\Services;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountManager
{
    /**
     * User model instance.
     *
     * @var \App\Models\User
     */
    private $user;

    /**
     * SocialAccount model instance.
     *
     * @var \App\Models\SocialAccount
     */
    private $account;

    /**
     * Create a new SocialAccountManager instance.
     *
     * @param \App\Models\User          $user
     * @param \App\Models\SocialAccount $account
     */
    public function __construct(User $user, SocialAccount $account)
    {
        $this->user = $user;
        $this->account = $account;
    }

    /**
     * Retrieve user account from database, otherwise create it.
     *
     * @param \Laravel\Socialite\Contracts\User $providerUser
     * @param string                            $provider
     *
     * @return \Illuminate\Foundation\Auth\User
     */
    public function findOrCreateUserAccount(ProviderUser $providerUser, $provider): AuthUser
    {
        $account = $this->account->where('provider_user_id', $providerUser->getId())->first();

        if ($account) {
            return $account->user;
        }

        $user = $this->user->create([
            'name' => $providerUser->getName(),
            'email' => $providerUser->getEmail(),
        ]);

        $this->account->create([
            'user_id' => $user->id,
            'provider_user_id' => $providerUser->getId(),
            'provider' => $provider,
        ]);

        $user->activated = true;

        $user->save();

        return $user;
    }
}
