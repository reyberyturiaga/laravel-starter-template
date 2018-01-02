<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Connection;

class ActivationTokenRepository
{
    /**
     * The database Connection class instance.
     *
     * @var \Illuminate\Database\Connection;
     */
    private $db;

    /**
     * The table associated with the repository.
     *
     * @var string
     */
    private $table = 'activation_tokens';

    /**
     * Create an ActivationTokenRepository instance.
     *
     * @param \Illuminate\Database\Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * Generate token.
     *
     * @return string
     */
    private function generateToken(): string
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    /**
     * Create user's activation token.
     *
     * @param \App\Models\User $user
     *
     * @return string
     */
    public function createActivationToken(User $user): string
    {
        $activation_token = $this->getUserActivationToken($user);

        if (! $activation_token) {
            return $this->createToken($user);
        }

        return $this->regenerateActivationToken($user);
    }

    /**
     * Create token.
     *
     * @param \App\Models\User $user
     *
     * @return string
     */
    private function createToken(User $user): string
    {
        $token = $this->generateToken();

        $this->db->table($this->table)->insert([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => new Carbon(),
        ]);

        return $token;
    }

    /**
     * Regenerate user's activation token.
     *
     * @param \App\Models\User $user
     *
     * @return string
     */
    private function regenerateActivationToken(User $user): string
    {
        $token = $this->generateToken();

        $this->db->table($this->table)->where('user_id', $user->id)->update([
            'token' => $token,
            'created_at' => new Carbon(),
        ]);

        return $token;
    }

    /**
     * Retrieve an activation token.
     *
     * @param string $token
     *
     * @return mixed
     */
    public function retrieveActivationToken($token)
    {
        return $this->db->table($this->table)->where('token', $token)->first();
    }

    /**
     * Get user's activation token.
     *
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function getUserActivationToken(User $user)
    {
        return $this->db->table($this->table)->where('user_id', $user->id)->first();
    }

    /**
     * Delete an activation token.
     *
     * @param string $token
     */
    public function deleteActivationToken($token)
    {
        $this->db->table($this->table)->where('token', $token)->delete();
    }

    /**
     * Delete user's activation token.
     *
     * @param \App\Models\User $user
     */
    public function deleteUserActivationToken(User $user)
    {
        $this->db->table($this->table)->where('user_id', $user->id)->delete();
    }
}
