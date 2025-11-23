<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::with('team')->orderBy('last_name')->paginate(30);
        return view('admin.players.index', compact('players'));
    }

    public function create()
    {
        $teams = Team::orderBy('name')->get();
        return view('admin.players.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'team_id' => 'nullable|exists:teams,id',
            'position' => 'nullable|string|max:100',
            'number' => 'nullable|integer',
        ]);

        Player::create($data);
        return redirect()->route('admin.players.index')->with('success', 'Player added.');
    }

    public function edit(Player $player)
    {
        $teams = Team::orderBy('name')->get();
        return view('admin.players.edit', compact('player', 'teams'));
    }

    public function update(Request $request, Player $player)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'team_id' => 'nullable|exists:teams,id',
            'position' => 'nullable|string|max:100',
            'number' => 'nullable|integer',
        ]);

        $player->update($data);
        return redirect()->route('admin.players.index')->with('success', 'Player updated.');
    }

    public function destroy(Player $player)
    {
        $player->delete();
        return redirect()->route('admin.players.index')->with('success', 'Player removed.');
    }
}
