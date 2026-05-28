<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TestDataPurger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestDataController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'confirmation' => ['required', 'string', 'in:PURGE TEST DATA'],
        ]);

        $count = TestDataPurger::purge();

        if ($count === 0) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'No test registrations matched. Nothing was deleted.');
        }

        return redirect()
            ->route('admin.dashboard')
            ->with('success', "Purged {$count} test registration(s) and their participants.");
    }
}
