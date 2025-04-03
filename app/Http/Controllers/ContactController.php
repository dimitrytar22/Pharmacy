<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Jobs\ContactEmailNotificationJob;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function submit(ContactFormRequest $request)
    {
        $data = $request->validated();
        ContactEmailNotificationJob::dispatch($data);

        return redirect()->route('contact.create')->with('submit_success', true);
    }
}
