<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserActivation;

class ActivateUserController extends Controller
{
    /**
     * UserActivation service class instance.
     *
     * @var \App\Services\UserActivation;
     */
    private $activationService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\UserActivation $activationService
     */
    public function __construct(UserActivation $activationService)
    {
        $this->middleware('guest');
        $this->activationService = $activationService;
    }

    /**
     * Activate user using valid token.
     *
     * @param string $token
     *
     * @return mixed
     */
    public function activate($token)
    {
        $user = $this->activationService->activateUserByToken($token);

        abort_unless($user, 404);

        auth()->login($user);

        return redirect()->route('home')->with('status', 'You have successfully activated your account!');
    }
}
