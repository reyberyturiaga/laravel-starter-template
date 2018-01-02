<?php

namespace App\Listeners;

use App\Events\Auth\UserRegistered;
use App\Notifications\EmailConfirmation;
use App\Repositories\ActivationTokenRepository;

class VerifyEmailAddress
{
    /**
     * ActivationTokenRepository instance.
     *
     * @var \App\Repositories\ActivationTokenRepository
     */
    private $activationTokenRepository;

    /**
     * Create the event listener.
     */
    public function __construct(ActivationTokenRepository $activationTokenRepository)
    {
        $this->activationTokenRepository = $activationTokenRepository;
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\Auth\UserRegistered $event
     */
    public function handle(UserRegistered $event)
    {
        $token = $this->activationTokenRepository->createActivationToken($event->user);

        $event->user->notify(new EmailConfirmation($token));
    }
}
