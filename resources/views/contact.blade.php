@extends('layouts.main')

@section('title')
    Contact Form
@endsection

@section('content')
    <section id="contact" class="bg-light py-5">
        <div class="container">
            <h2 class="h3 font-weight-bold text-center">Contact Us</h2>
            <form action="{{route('contact.submit')}}" method="POST" class="mt-4 mx-auto bg-white shadow rounded p-4" style="max-width: 600px;">
                @csrf

                <div class="form-group">
                    <label for="name" class="font-weight-semibold">Name</label>
                    <input type="text" id="name" name="name" required class="form-control">
                </div>

                <div class="form-group mt-4">
                    <label for="email" class="font-weight-semibold">Email</label>
                    <input type="email" id="email" name="email" required class="form-control">
                </div>

                <div class="form-group mt-4">
                    <label for="message" class="font-weight-semibold">Message</label>
                    <textarea id="message" name="message" rows="4" required class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-4">Send Message</button>

                @if(session()->has('submit_success'))
                    <div class="alert alert-success mt-3">
                        <strong>Success!</strong> Your message has been sent. We will get back to you shortly.
                    </div>
                @endif
            </form>
        </div>
    </section>
@endsection
