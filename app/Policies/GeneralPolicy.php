<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class GeneralPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the campaign.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function view(User $user, Model $model)
    {
        return $user->id === $model->created_by;
    }

    /**
     * Determine whether the user can create campaigns.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the campaign.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function update(User $user, Model $model)
    {
        return $user->id === $model->created_by;
    }

    /**
     * Determine whether the user can delete the campaign.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function delete(User $user, Model $model)
    {
        return $user->id === $model->created_by;
    }

    /**
     * Determine whether the user can preview the campaign.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function preview(User $user, Model $model)
    {
        return $user->id === $model->created_by;
    }
}
