<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MessageController extends Controller
{
    /**
     * Display a listing of the messages.
     */
    public function index(): View
    {
        $messages = Message::latest()
            ->paginate(10);

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message): View
    {
        if (!$message->is_read) {
            $message->markAsRead();
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Mark message as read.
     */
    public function markAsRead(Message $message): RedirectResponse
    {
        $message->markAsRead();

        return back()->with('success', 'Message marked as read');
    }

    /**
     * Mark message as unread.
     */
    public function markAsUnread(Message $message): RedirectResponse
    {
        $message->markAsUnread();

        return back()->with('success', 'Message marked as unread');
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully');
    }
}
