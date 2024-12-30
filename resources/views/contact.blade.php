@extends('layouts.main')

@section('title')
    Contact Form
@endsection

@section('content')
    <section id="contact" class="bg-gray-100 py-20">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center">Contact Us</h2>
            <form action="{{route('contact.submit')}}" method="POST" class="mt-8 max-w-xl mx-auto bg-white shadow rounded p-6">
                @csrf

                <label for="name" class="block text-sm font-semibold">Name</label>
                <input type="text" id="name" name="name" required class="w-full mt-2 p-2 border rounded">

                <label for="email" class="block text-sm font-semibold mt-4">Email</label>
                <input type="email" id="email" name="email" required class="w-full mt-2 p-2 border rounded">

                <label for="message" class="block text-sm font-semibold mt-4">Message</label>
                <textarea id="message" name="message" rows="4" required
                          class="w-full mt-2 p-2 border rounded"></textarea>

                <button type="submit" class="mt-6 w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Send
                    Message
                </button>
                @if(session()->has('submit_success'))
                    <div class="mt-3 bg-green-100 text-green-700 border border-green-500 rounded-md p-4">
                        <strong>Success!</strong> Your message has been sent. We will get back to you shortly.
                    </div>
                @endif

            </form>
        </div>
    </section>

@endsection
