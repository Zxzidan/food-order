<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SingleCookieSession
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hapus XSRF-TOKEN cookie agar respons hanya mengirimkan 1 cookie session tunggal.
        // Di Vercel / serverless runtime, beberapa Set-Cookie digabungkan dengan koma
        // sehingga merusak cookie session di browser dan membuat login mental kembali ke login.
        if (isset($response->headers)) {
            $response->headers->removeCookie('XSRF-TOKEN');
        }

        return $response;
    }
}
