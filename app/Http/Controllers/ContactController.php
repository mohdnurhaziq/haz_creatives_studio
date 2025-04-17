<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function index(): View
    {
        return view('pages.contact');
    }

    /**
     * Store a newly created contact form submission.
     *
     * @param  \App\Http\Requests\ContactFormRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function store(ContactFormRequest $request)
    {
        try {
            // Get validated data
            $validated = $request->validated();

            // Create the message in the database
            Message::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'is_read' => false
            ]);

            Log::info('Contact form submitted and saved to database', $validated);

            $response = [
                'success' => true,
                'message' => 'Thank you for your message. We will get back to you soon!'
            ];

            // Check if request is AJAX
            if ($request->ajax()) {
                return response()->json($response);
            }

            return redirect()->route('contact')
                ->with('success', $response['message']);

        } catch (\Exception $e) {
            Log::error('Error saving contact form: ' . $e->getMessage());

            $response = [
                'success' => false,
                'message' => 'Sorry, there was an error sending your message. Please try again later.'
            ];

            // Check if request is AJAX
            if ($request->ajax()) {
                return response()->json($response, 500);
            }

            return redirect()->route('contact')
                ->with('error', $response['message']);
        }
    }
}
