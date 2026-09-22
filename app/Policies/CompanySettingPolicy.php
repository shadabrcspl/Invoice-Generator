<?php

namespace App\Policies;

use App\Models\CompanySetting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanySettingPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CompanySetting $companySetting): bool
    {
        return $user->id === $companySetting->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CompanySetting $companySetting): bool
    {
        return $user->id === $companySetting->user_id;
    }
}
