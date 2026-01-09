<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Communication;
use App\Models\User;
use App\Models\Staff;
use App\Mail\CommunicationSent;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendCommunicationChunk;

class CommunicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Accessible to all logged-in users
    }

    public function index()
    {
        $items = Communication::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.communications.index', compact('items'));
    }

    public function create()
    {
        return view('admin.communications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'minutes' => 'nullable|string',
            'activity_type' => 'nullable|string',
            'audience' => 'nullable|string',
        ]);

        $data['sender_id'] = auth()->id();
        $communication = Communication::create($data);

        // send emails to those in `staff` table (or to both users+staff if audience=all)
        // Default to 'all' so pressing Send without choosing still targets everyone.
        $audience = $communication->audience ?? 'all';
        $emails = collect();

        if ($audience === 'staff' || $audience === 'all') {
            $staffEmails = Staff::whereNotNull('email')->pluck('email')->filter()->unique();
            $emails = $emails->merge($staffEmails);
        }

        if ($audience === 'all') {
            $userEmails = User::whereNotNull('email')->pluck('email')->filter()->unique();
            $emails = $emails->merge($userEmails);
        }

        // Normalize to array and chunk for batched dispatch
        $emails = $emails->unique()->values()->all();

        $chunkSize = 100;
        $chunks = array_chunk($emails, $chunkSize);

        $dispatched = 0;

        // If 'Send now' is checked OR the app is running with a synchronous queue driver or running locally,
        // dispatch synchronously so pressing Send performs the send immediately.
        $forceSync = $request->boolean('send_now') || config('queue.default') === 'sync' || app()->environment('local') || env('COMMUNICATION_FORCE_SEND_SYNC', false);

        foreach ($chunks as $chunk) {
            if ($forceSync) {
                // dispatchSync ensures the job is executed immediately in the current process.
                SendCommunicationChunk::dispatchSync($communication, $chunk);
            } else {
                SendCommunicationChunk::dispatch($communication, $chunk);
            }
            $dispatched += count($chunk);
        }

        return redirect()->route('admin.communications.index')->with('success', "Communication queued for sending to {$dispatched} recipients.");
    }

    public function show(Communication $communication)
    {
        return view('admin.communications.show', compact('communication'));
    }

    public function destroy(Communication $communication)
    {
        $communication->delete();
        return redirect()->route('admin.communications.index')->with('success', 'Deleted.');
    }
}
