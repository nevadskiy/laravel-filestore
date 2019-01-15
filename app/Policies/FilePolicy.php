<?php

namespace App\Policies;

use App\File;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    public function touch(User $user, File $file): bool
    {
        return $file->user_id === $user->id;
    }
}
