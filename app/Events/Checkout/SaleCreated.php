<?php

namespace App\Events\Checkout;

use App\Sale;
use Illuminate\Queue\SerializesModels;

class SaleCreated
{
    use SerializesModels;

    /**
     * @var Sale
     */
    public $sale;

    /**
     * Create a new event instance.
     *
     * @param Sale $sale
     */
    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }
}
