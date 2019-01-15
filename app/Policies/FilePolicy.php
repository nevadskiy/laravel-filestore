<?php

namespace App\Policies;

use App\File;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    public function touch(File $file, User $user): bool
    {
        return $file->user_id === $user->id;
    }
}
