<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

use function PHPUnit\Framework\returnSelf;

class UserSuspendPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function isSuspend(User $user)
    {
        return $user->status === 'suspend'
            ? Response::allow()
            : Response::deny('Akun Anda Terkena Suspend Harap Hubungi admin.');
    }
}
