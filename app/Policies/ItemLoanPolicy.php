<?php

namespace App\Policies;

use App\ItemLoan;
use App\User;
use Illuminate\Auth\Access\Response;

class ItemLoanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('lihat peminjaman');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ItemLoan $itemLoan): bool
    {
        return $user->can('lihat peminjaman');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('tambah peminjaman');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ItemLoan $itemLoan): bool
    {
        return $user->can('ubah peminjaman');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ItemLoan $itemLoan): bool
    {
        return $user->can('hapus peminjaman');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ItemLoan $itemLoan): bool
    {
        return $user->can('restore peminjaman');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ItemLoan $itemLoan): bool
    {
        return $user->can('force delete peminjaman');
    }
}
