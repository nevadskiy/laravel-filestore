<?php

namespace App\Jobs\Checkout;

use App\Events\Checkout\SaleCreated;
use App\File;
use App\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateSale
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var File
     */
    public $file;

    /**
     * @var string
     */
    public $email;

    /**
     * Create a new job instance.
     *
     * @param File $file
     * @param string $email
     */
    public function __construct(File $file, string $email)
    {
        $this->file = $file;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sale = new Sale();

        $sale->fill([
            'identifier' => uniqid('', true),
            'buyer_email' => $this->email,
            'sale_price' => $this->file->price,
            'sale_commission' => $this->file->calculateCommission(),
        ]);

        $sale->file()->associate($this->file);
        $sale->user()->associate($this->file->user);

        $sale->save();

        event(new SaleCreated($sale));
    }
}
