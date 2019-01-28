<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasApprovals
{
    public function scopeApproved(Builder $query)
    {
        return $query->where('approved', true);
    }

    public function scopeUnapproved(Builder $query)
    {
        return $query->where('approved', false);
    }
}
