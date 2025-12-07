<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Staff;
use App\Models\Player;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $query = Game::latest();

        // Filter by status if requested
        if (request('status')) {
            $query->where('status', request('status'));
        }

        $games = $query->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        $staffs = Staff::all();
        $players = Player::all();
        return view('admin.games.prepare', compact('staffs','players'));
    }

    /**
     * Show match preparation form
     */
    public function prepare(Game $game = null)
    {
        $staffs = Staff::all();
        $players = Player::all();
        return view('admin.games.prepare', compact('game', 'staffs', 'players'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'discipline' => 'required',
            'home_team' => 'required',
            'home_color' => 'nullable|string',
            'away_team' => 'required',
            'away_color' => 'nullable|string',
            'objective' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required',
            'departure_time' => 'nullable',
            'expected_finish_time' => 'nullable',
            'category' => 'required',
            'transport' => 'nullable|string',
            'venue' => 'required',
            'age_group' => 'nullable|array',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'base' => 'nullable|string',
            'gender' => 'nullable|string',
            'staff_ids' => 'nullable|array',
            'player_ids' => 'nullable|array',
        ]);

        $data['notify_staff'] = $request->has('notify_staff');
        $data['status'] = 'scheduled'; // New matches start as scheduled

        $game = Game::create($data);

        return redirect()->route('admin.games.index')->with('success', 'Match created successfully.');
    }

    public function edit(Game $game)
    {
        $staffs = Staff::all();
        $players = Player::all();

        // If match is scheduled, show prepare view
        if ($game->status === 'scheduled') {
            return view('admin.games.prepare', compact('game', 'staffs', 'players'));
        }

        // If match is in progress or completed, show report view
        return view('admin.games.report', compact('game', 'staffs', 'players'));
    }

    /**
     * Show match report form
     */
    public function report(Game $game)
    {
        $staffs = Staff::all();
        $players = Player::all();
        return view('admin.games.report', compact('game', 'staffs', 'players'));
    }

    public function update(Request $request, Game $game)
    {
        // Determine validation rules based on what's being updated
        $rules = [
            'discipline' => 'nullable|string',
            'home_team' => 'nullable|string',
            'away_team' => 'nullable|string',
            'date' => 'nullable|date',
            'time' => 'nullable',
            'category' => 'nullable|string',
            'venue' => 'nullable|string',
            'staff_ids' => 'nullable|array',
            'player_ids' => 'nullable|array',
            'home_score' => 'nullable|integer|min:0',
            'away_score' => 'nullable|integer|min:0',
            'yellow_cards_players' => 'nullable|array',
            'red_cards_players' => 'nullable|array',
            'yellow_cards_staff' => 'nullable|array',
            'red_cards_staff' => 'nullable|array',
            'incidence' => 'nullable|string',
            'technical_feedback' => 'nullable|string',
        ];

        $data = $request->validate($rules);
        $data['notify_staff'] = $request->has('notify_staff');

        // Status transitions are automated; do not change status here

        $game->update($data);

        $message = $request->action === 'complete' ? 'Match completed successfully!' : 'Match updated successfully.';
        return redirect()->route('admin.games.index')->with('success', $message);
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('admin.games.index')->with('success', 'Match deleted successfully.');
    }

    public function show(Game $game)
    {
        return view('admin.games.show', compact('game'));
    }

    /**
     * Start a match (transition from scheduled to in_progress)
     */
    public function startMatch(Game $game)
    {
        // Manual start disabled; status handled automatically
        return back()->with('info', 'Match status is managed automatically.');
    }

    /**
     * Complete a match (transition from in_progress to completed)
     */
    public function completeMatch(Game $game)
    {
        // Manual complete disabled; status handled automatically
        return back()->with('info', 'Match status is managed automatically.');
    }
}
