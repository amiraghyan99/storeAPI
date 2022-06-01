<?php

namespace App\Policies;

use App\Models\Store;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function viewAny(User $user): Response
    {
        return $this->allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Store $store
     * @return Response
     */
    public function view(User $user, Store $store): Response
    {
        return $this->allow();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param Store $store
     * @return Response
     */
    public function create(User $user, Store $store): Response
    {
        return ($user->isSeller() && $store->user_id == $user->id) ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Store $store
     * @return Response
     */
    public function update(User $user, Store $store): Response
    {
        return ($user->isSeller() && $store->user_id == $user->id) ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Store $store
     * @return Response
     */
    public function delete(User $user, Store $store): Response
    {
        return ($user->isSeller() && $store->user_id == $user->id) ? $this->allow() : $this->deny();
    }
}
