<?php

namespace App\Http\Controllers\Checkout;

use App\File;
use App\Http\Requests\Checkout\FreeCheckoutRequest;
use App\Http\Controllers\Controller;
use App\Jobs\Checkout\CreateSale;
use Exception;
use Illuminate\Http\Request;
use Stripe\Charge;

class CheckoutController extends Controller
{
    public function free(FreeCheckoutRequest $request, File $file)
    {
        if (!$file->isFree()) {
            return back()->with('error', 'File is not free');
        }

        $this->dispatch(new CreateSale($file, $request->get('email')));

        return back()->with('success', 'We\'ve emailed your download link to you.');
    }

    public function payment(Request $request, File $file)
    {
        try {
            Charge::create([
                'amount' => $file->price * 100,
                'currency' => 'usd',
                'source' => $request->get('stripeToken'),
                'application_fee' => $file->calculateCommission() * 100
            ], [
                'stripe_account' => $file->user->stripe_id,
            ]);

            $this->dispatch(new CreateSale($file, $request->get('stripeEmail')));

            return back()->with('success', 'Payment Complete. We\'ve emailed your download link to you.');
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong while processing your payment.');
        }
    }
}
