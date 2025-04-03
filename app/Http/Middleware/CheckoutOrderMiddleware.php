<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckoutOrderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $order = $request->route('order');
        $user = $order->user;
        $authenticatedUserId = auth()->user()->id ?? null;
        if (!$order || $user->id !== $authenticatedUserId) {
            abort(403);
        }
        if($order->finished_at !== null){
            return redirect()->route('home');
        }
        return $next($request);
    }
}
