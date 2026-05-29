<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SentEmail;
use Illuminate\View\View;

class SentEmailController extends Controller
{
    public function index(): View
    {
        $emails = SentEmail::query()
            ->with('registration:id,reference')
            ->latest()
            ->paginate(20);

        return view('admin.sent-emails.index', [
            'emails' => $emails,
        ]);
    }
}
