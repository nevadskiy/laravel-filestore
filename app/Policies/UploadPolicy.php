<?php

namespace App\Policies;

use App\Upload;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UploadPolicy
{
    use HandlesAuthorization;

    public function touch(User $user, Upload $file): bool
    {
        return $file->user_id === $user->id;
    }
}
