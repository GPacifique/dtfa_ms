<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Return recent messages for the authenticated user's branch.
     * Supports ?after=<id> for polling only new messages.
     */
    public function messages(Request $request)
    {
        $user     = Auth::user();
        $branchId = $user->branch_id;

        $query = ChatMessage::with(['sender:id,name'])
            ->where(function ($q) use ($branchId) {
                // Messages in the user's branch OR global messages (branch_id IS NULL)
                $q->where('branch_id', $branchId)
                  ->orWhereNull('branch_id');
            })
            ->orderBy('id', 'desc');

        if ($request->filled('after')) {
            $query->where('id', '>', (int) $request->after);
        }

        $messages = $query->limit(50)->get()->reverse()->values();

        return response()->json([
            'messages' => $messages->map(fn ($m) => [
                'id'         => $m->id,
                'body'       => $m->body,
                'sender_id'  => $m->sender_id,
                'sender'     => $m->sender->name ?? 'Unknown',
                'is_mine'    => $m->sender_id === $user->id,
                'created_at' => $m->created_at->format('H:i'),
                'date'       => $m->created_at->format('M j, Y'),
            ]),
        ]);
    }

    /**
     * Store a new chat message.
     */
    public function send(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        $message = ChatMessage::create([
            'sender_id' => $user->id,
            'branch_id' => $user->branch_id,
            'body'      => $request->body,
        ]);

        $message->load('sender:id,name');

        return response()->json([
            'message' => [
                'id'         => $message->id,
                'body'       => $message->body,
                'sender_id'  => $message->sender_id,
                'sender'     => $message->sender->name ?? 'Unknown',
                'is_mine'    => true,
                'created_at' => $message->created_at->format('H:i'),
                'date'       => $message->created_at->format('M j, Y'),
            ],
        ], 201);
    }
}
