<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    public const APPROVAL_PROPERTIES = [
        'title',
        'overview_short',
        'overview',
    ];

    protected $fillable = [
        'title',
        'overview_short',
        'overview',
        'price',
        'live',
        'approved',
        'finished',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (File $file) {
            $file->identifier  = uniqid(true, false);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'identifier';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFinished(Builder $builder)
    {
        return $builder->where('finished', true);
    }

    public function isFree(): bool
    {
        return ((int) $this->price) === 0;
    }

    public function approvals()
    {
        return $this->hasMany(FileApproval::class);
    }

    public function needsApproval(array $approvalProperties): bool
    {
        if ($this->currentPropsDifferToGiven($approvalProperties)) {
            return true;
        }

        return false;
    }

    private function currentPropsDifferToGiven(array $properties): bool
    {
        return array_only($this->toArray(), self::APPROVAL_PROPERTIES) !== $properties;
    }
}
