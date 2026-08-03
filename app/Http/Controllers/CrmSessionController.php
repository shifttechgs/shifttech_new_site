<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * The CRM login redirect and logout used to be closures in routes/web.php.
 * Closures cannot be serialised, so a single one makes `route:cache` fail for
 * the entire application and every request pays to re-register all routes.
 * They live here so the route file stays cacheable.
 */
class CrmSessionController extends Controller
{
    public function login()
    {
        return auth()->check()
            ? redirect()->route('crm.dashboard')
            : redirect('/useluminii/login');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/useluminii/login');
    }
}
