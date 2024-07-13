<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyFilter
{
    public function handle(Request $request, Closure $next) {
        $company = Auth::user()->company;
        $request->merge(['company' => $company]);
        return $next($request);
    }
}
