<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserOrdersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $userOrders = $user->orders->pluck('id');
        $order = $request->route('order');
        if (!in_array($order->id, $userOrders->toArray())) {
            abort(403);
        }
        return $next($request);
    }
}
