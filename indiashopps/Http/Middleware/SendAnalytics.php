<?php namespace indiashopps\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\TerminableMiddleware;

class SendAnalytics implements TerminableMiddleware {

    protected $startTime;

    public function __construct() {
        $this->startTime = microtime(true);
    }

    public function handle($request, Closure $next) {
        return $next($request);
    }

    public function terminate($request, $response) {
        $responseTime = microtime(true) - $this->startTime;
        /* I send a request to Google here, using their Measurement Protocol */
        // Dying for debugging purposes
        dd($responseTime); // Always prints 0.0
    }
}