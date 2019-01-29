<?php

namespace App\Http\Controllers\Checkout;

use App\File;
use App\Http\Requests\Checkout\FreeCheckoutRequest;
use App\Http\Controllers\Controller;
use App\Jobs\Checkout\CreateSale;

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
}
