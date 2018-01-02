<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetRequest;
use App\Models\User;
use App\Services\UserActivation;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * UserActivation service class instance.
     *
     * @var \App\Services\UserActivation
     */
    private $activationService;

    /**
     * User model instance.
     *
     * @var \App\Models\User
     */
    private $user;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\UserActivation $activationService
     * @param \App\Models\User             $user
     */
    public function __construct(UserActivation $activationService, User $user)
    {
        $this->middleware('guest');
        $this->activationService = $activationService;
        $this->user = $user;
    }

    /**
     * Reset the given user's password.
     *
     * @param \App\Http\Requests\PasswordResetRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(PasswordResetRequest $request): RedirectResponse
    {
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        if ($response !== Password::PASSWORD_RESET) {
            return $this->sendResetFailedResponse($request, $response);
        }

        $user = $this->user->where('email', $request['email'])->first();

        if (! $user->activated) {
            $this->activationService->activateUserInstance($user);
        }

        return $this->sendResetResponse($response);
    }
}
