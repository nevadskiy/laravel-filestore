<?php

namespace App\Http\ViewComposers;

use App\File;
use App\Sale;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class AdminStatsComposer
{
    public function compose(View $view)
    {
        $view->with([
            'fileCount' => File::finished()->approved()->count(),
            'saleCount' => Sale::count(),
            'thisMonthCommission' => $this->monthCommission(),
            'lifetimeCommission' => $this->lifetimeCommission(),
        ]);
    }

    private function lifetimeCommission()
    {
        return Sale::sum('sale_commission');
    }

    private function monthCommission()
    {
        $startPoint = Carbon::now()->startOfMonth();
        $endPoint = (clone $startPoint)->endOfMonth();

        return Sale::whereBetween('created_at', [
            $startPoint, $endPoint
        ])
            ->sum('sale_price');
    }
}
