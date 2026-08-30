<?php

namespace App\Http\Controllers\Crm\Concerns;

use Illuminate\Http\Request;

trait HasPerPageSelector
{
    /**
     * Allowed page sizes for the "Show: 5 / 10 / 15 / 20" control shared
     * across every CRM table. Falls back to 10 for anything else (missing,
     * tampered, or an old bookmarked link from before this existed).
     */
    private const PER_PAGE_OPTIONS = [5, 10, 15, 20];

    private function perPage(Request $request): int
    {
        $value = (int) $request->get('per_page', 10);

        return in_array($value, self::PER_PAGE_OPTIONS, true) ? $value : 10;
    }
}
