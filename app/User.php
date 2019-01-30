<?php

namespace App;

use App\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'stripe_id',
        'stripe_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isTheSameAs(User $user): bool
    {
        return $user->id === $this->id;
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function saleValueOverLifetime()
    {
        return $this->sales->sum('sale_price');
    }

    public function saleValueThisMonth()
    {
        $startPoint = Carbon::now()->startOfMonth();
        $endPoint = (clone $startPoint)->endOfMonth();

        return $this->sales()
            ->whereBetween('created_at', [
                $startPoint, $endPoint
            ])
            ->sum('sale_price');
    }
}
