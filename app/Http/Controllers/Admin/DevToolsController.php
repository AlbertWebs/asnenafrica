<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class DevToolsController extends Controller
{
    public function index(): View
    {
        return view('admin.dev-tools.index');
    }

    public function run(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'command' => ['required', 'in:migrate,cache_clear'],
        ]);

        try {
            if ($data['command'] === 'migrate') {
                Artisan::call('migrate', ['--force' => true]);

                return back()->with('success', 'Migrations ran successfully.'.($output = trim(Artisan::output())) ? "\n\n".$output : '');
            }

            Artisan::call('optimize:clear');

            return back()->with('success', 'Application cache cleared successfully.'.($output = trim(Artisan::output())) ? "\n\n".$output : '');
        } catch (\Throwable $e) {
            return back()->with('error', 'Command failed: '.$e->getMessage());
        }
    }
}
