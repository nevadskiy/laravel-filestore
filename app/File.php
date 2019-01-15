<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

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
}
