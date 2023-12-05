<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
<<<<<<< HEAD
        'api/global/*',
=======
        'api/*',
>>>>>>> 3126c1cb7291b969b408e8be6a78fb5da74cf0bc
    ];
}
