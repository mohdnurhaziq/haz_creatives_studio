<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class MessageController extends BaseController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->is_admin) {
                abort(403, 'Unauthorized access. Admin privileges required.');
            }
            return $next($request);
        });
    }

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
        $message->update(['read_at' => now()]);
        return redirect()->route('admin.messages.show', $message)
            ->with('success', 'Message marked as read.');
    }

    /**
     * Mark message as unread.
     */
    public function markAsUnread(Message $message): RedirectResponse
    {
        $message->update(['read_at' => null]);
        return redirect()->route('admin.messages.show', $message)
            ->with('success', 'Message marked as unread.');
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
