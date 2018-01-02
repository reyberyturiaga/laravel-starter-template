<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ActivationTokenRepository;

class UserActivation
{
    /**
     * ActivationTokenRepository instance.
     *
     * @var \App\Repositories\ActivationTokenRepository
     */
    private $activationTokenRepository;

    /**
     * User model instance.
     *
     * @var \App\Models\User
     */
    private $user;

    /**
     * Create a UserActivationService instance.
     *
     * @param \App\Repositories\ActivationTokenRepository $activationTokenRepository
     * @param \App\Models\User                            $user
     */
    public function __construct(ActivationTokenRepository $activationTokenRepository, User $user)
    {
        $this->activationTokenRepository = $activationTokenRepository;
        $this->user = $user;
    }

    /**
     * Activate user by token.
     *
     * @param string $token
     *
     * @return mixed
     */
    public function activateUserByToken($token)
    {
        $activation_token = $this->activationTokenRepository->retrieveActivationToken($token);

        if ($activation_token === null) {
            return null;
        }

        $user = $this->user->find($activation_token->user_id);

        $user->activated = true;

        $user->save();

        $this->activationTokenRepository->deleteActivationToken($token);

        return $user;
    }

    /**
     * Activate user instance.
     *
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function activateUserInstance(User $user)
    {
        $activation_token = $this->activationTokenRepository->getUserActivationToken($user);

        if ($activation_token === null) {
            return null;
        }

        $user->activated = true;

        $user->save();

        $this->activationTokenRepository->deleteUserActivationToken($user);

        return $user;
    }
}
