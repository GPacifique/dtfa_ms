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
        return view('admin.games.create', compact('staffs','players'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'discipline' => 'required',
            'home_team' => 'required',
            'away_team' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'category' => 'required',
            'venue' => 'required',
            'staff_ids' => 'array',
            'player_ids' => 'array',
        ]);

        $data['notify_staff'] = $request->has('notify_staff');
        $data['status'] = 'scheduled'; // New matches start as scheduled

        Game::create($data);

        return redirect()->route('admin.games.index')->with('success', 'Match created successfully.');
    }

    public function edit(Game $game)
    {
        $staffs = Staff::all();
        $players = Player::all();
        return view('admin.games.edit', compact('game', 'staffs', 'players'));
    }

    public function update(Request $request, Game $game)
    {
        $data = $request->validate([
            'discipline' => 'required',
            'home_team' => 'required',
            'away_team' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'category' => 'required',
            'venue' => 'required',
            'staff_ids' => 'array',
            'player_ids' => 'array',
        ]);

        $data['notify_staff'] = $request->has('notify_staff');

        $game->update($data);

        return redirect()->route('admin.games.index')->with('success', 'Match updated successfully.');
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
        if (!$game->isScheduled()) {
            return back()->with('error', 'Only scheduled matches can be started.');
        }

        $game->startMatch();

        return back()->with('success', 'Match started! You can now record events and results.');
    }

    /**
     * Complete a match (transition from in_progress to completed)
     */
    public function completeMatch(Game $game)
    {
        if ($game->isCompleted()) {
            return back()->with('error', 'This match is already completed.');
        }

        $game->completeMatch();

        return back()->with('success', 'Match marked as completed.');
    }
}
