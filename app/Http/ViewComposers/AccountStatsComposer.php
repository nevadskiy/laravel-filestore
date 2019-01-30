<?php

namespace App\Http\ViewComposers;

use App\User;
use Illuminate\View\View;

class AccountStatsComposer
{
    public function compose(View $view)
    {
        $user = $this->getUser();

        $view->with([
            'fileCount' => $this->getFileCount($user),
            'saleCount' => $this->getSaleCount($user),
            'thisMonthEarned' => $user->saleValueThisMonth(),
            'lifetimeEarned' => $user->saleValueOverLifetime(),
        ]);
    }

    /**
     * @return User
     */
    private function getUser(): User
    {
        return auth()->user();
    }

    /**
     * @param User $user
     * @return mixed
     */
    private function getFileCount(User $user)
    {
        return $user->files()->finished()->count();
    }

    /**
     * @param User $user
     * @return mixed
     */
    private function getSaleCount(User $user)
    {
        return $user->sales->count();
    }
}
