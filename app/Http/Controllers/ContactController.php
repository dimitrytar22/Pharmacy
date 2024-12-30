<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Jobs\ContactEmailNotificationJob;
use App\Mail\ContactFormEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        return redirect()->route('contact.create')->with('submit_success',true);
    }
}
