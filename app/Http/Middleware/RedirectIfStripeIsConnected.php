<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfStripeIsConnected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->stripe_id) {
            return redirect()->route('account.index')
                ->with('error', 'You have already connected a Stripe account.');
        }

        return $next($request);
    }
}
