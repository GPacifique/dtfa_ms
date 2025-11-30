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
    $games = Game::latest()->paginate(10);
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

        return redirect()->route('admin.matches.index')->with('success', 'Match updated successfully.');
    }

    public function destroy(Game $game)
    {
        $match->delete();
        return redirect()->route('admin.games.index')->with('success', 'Match deleted successfully.');
    }

    public function show(Game $game)
    {
        return view('admin.games.show', compact('game'));
    }
}
