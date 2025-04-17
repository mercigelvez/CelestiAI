<?php

namespace App\Policies;

use App\Models\Reading;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReadingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the reading.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Reading  $reading
     * @return bool
     */
    public function view(User $user, Reading $reading)
    {
        return $user->id === $reading->user_id;
    }

    /**
     * Determine whether the user can create readings.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the reading.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Reading  $reading
     * @return bool
     */
    public function delete(User $user, Reading $reading)
    {
        return $user->id === $reading->user_id;
    }
}
