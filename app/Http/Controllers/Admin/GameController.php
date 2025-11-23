<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Team;
use App\Http\Requests\GameRequest;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with(['homeTeam','awayTeam'])->orderBy('scheduled_at','desc')->paginate(20);
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        $teams = Team::orderBy('name')->get();
        return view('admin.games.create', compact('teams'));
    }

    public function store(GameRequest $request)
    {
        $data = $request->validated();
        Game::create($data);
        return redirect()->route('admin.games.index')->with('success','Game scheduled.');
    }

    public function edit(Game $game)
    {
        $teams = Team::orderBy('name')->get();
        return view('admin.games.edit', compact('game','teams'));
    }

    public function update(GameRequest $request, Game $game)
    {
        $game->update($request->validated());
        return redirect()->route('admin.games.index')->with('success','Game updated.');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('admin.games.index')->with('success','Game removed.');
    }
}
