<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of messages.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        
        $query = ContactSubmission::latest();
        
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('subject', 'like', '%' . $search . '%')
                  ->orWhere('message', 'like', '%' . $search . '%');
            });
        }
        
        $messages = $query->paginate($perPage)->appends($request->all());
        
        return view('admin.pages.messages.index', compact('messages'));
    }

    /**
     * Display the specified message and mark as read.
     */
    public function show(string $id)
    {
        $message = ContactSubmission::findOrFail($id);
        
        // Mark as read when opened
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        
        return view('admin.pages.messages.show', compact('message'));
    }

    /**
     * Remove the specified message.
     */
    public function destroy(string $id)
    {
        $message = ContactSubmission::findOrFail($id);
        $message->delete();
        
        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
