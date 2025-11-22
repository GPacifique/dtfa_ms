<?php

namespace App\Policies;

use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainingSessionPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('super-admin') || $user->hasRole('admin')) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return $user->hasRole('coach') || $user->hasRole('admin') || $user->hasRole('super-admin');
    }

    public function view(User $user, TrainingSession $session)
    {
        return $this->isOwner($user, $session);
    }

    public function create(User $user)
    {
        // admins handled in before(); coaches may create sessions for themselves
        return $user->hasRole('coach');
    }

    public function update(User $user, TrainingSession $session)
    {
        return $this->isOwner($user, $session);
    }

    public function delete(User $user, TrainingSession $session)
    {
        return $this->isOwner($user, $session);
    }

    protected function isOwner(User $user, TrainingSession $session)
    {
        if ($user->hasRole('coach')) {
            return $session->coach_user_id == $user->id;
        }
        return false;
    }
}
