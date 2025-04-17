<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('pages.contact');
    }

    /**
     * Store a newly created contact form submission.
     *
     * @param  \App\Http\Requests\ContactFormRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactFormRequest $request)
    {
        try {
            // Get validated data
            $validated = $request->validated();

            Log::info('Contact form submitted', $validated);

            // Send email (you'll need to configure your mail settings)
            Mail::send('emails.contact', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message']
            ], function($message) use ($validated) {
                $message->from($validated['email'], $validated['name'])
                       ->to('your-email@example.com') // Replace with your email
                       ->subject($validated['subject']);
            });

            Log::info('Email sent successfully');

            return redirect()->route('contact')
                ->with('success', 'Thank you for your message. We will get back to you soon!');
        } catch (\Exception $e) {
            Log::error('Error sending contact form email: ' . $e->getMessage());

            return redirect()->route('contact')
                ->with('error', 'Sorry, there was an error sending your message. Please try again later.');
        }
    }

    public function adminIndex(): View
    {
        $messages = ContactMessage::latest()->paginate(10);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $message): View
    {
        $message->update(['is_read' => true]);

        return view('admin.contact-messages.show', compact('message'));
    }
}
