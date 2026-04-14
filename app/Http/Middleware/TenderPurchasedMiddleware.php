<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenderPurchasedMiddleware
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tender = $request->route('tender');
        $user = $request->user();

        if ($user->company()->hasPurchasedTender($tender)) {
            return $next($request);
        }

        return $this->unauthorizedResponse(message: api_trans('tender.not_purchased'));
    }
}
