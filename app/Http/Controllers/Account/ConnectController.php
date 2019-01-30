<?php

namespace App\Http\Controllers\Account;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConnectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'has.stripe']);
    }

    public function index()
    {
        session()->put('stripe_token', str_random(60));

        return view('account.connect.index');
    }

    public function complete(Request $request, Guzzle $guzzle)
    {
        // Check csrf token from stripe state
        if (!$request->get('state') !== session()->pull('stripe_token')) {
            return redirect()->route('account.connect');
        }

        // Check if code exists
        if (!$request->get('code')) {
            return redirect()->route('account.connect');
        }

        // TODO: wrap into try catch for checking if code is already been used
        $stripeRequest = $guzzle->request('POST', 'https://connect.stripe.com/oauth/token', [
            'form_params' => [
                'client_secret' => config('services.stripe.secret'),
                'code' => $request->get('code'),
                'grant_type' => 'authorization_code',
            ]
        ]);

        $stripeResponse = json_decode($stripeRequest->getBody());

        auth()->user()->update([
            'stripe_id' => $stripeResponse->stripe_user_id,
            'stripe_key' => $stripeResponse->stripe_publishable_key,
        ]);

        return redirect()->route('account.index')
            ->with('success', 'You have connected your Stripe account.');
    }
}
