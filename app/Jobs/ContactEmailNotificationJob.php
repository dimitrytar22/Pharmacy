<?php

namespace App\Jobs;

use App\Mail\ContactFormEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ContactEmailNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $data)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('dmytro.tarasenko@lnu.edu.ua')->send(new ContactFormEmail($this->data));
    }
}
