<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Http\Requests\TeamRequest;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        $teamscount = Team::count();
        $teams = Team::orderBy('name')->paginate(20);
        return view('admin.teams.index', compact('teamscount','teams'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(TeamRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        Team::create($data);
        return redirect()->route('admin.teams.index')->with('success', 'Team created.');
    }

    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function show(Team $team)
    {
        $team->load('players');
        return view('admin.teams.show', compact('team'));
    }

    public function update(TeamRequest $request, Team $team)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        $team->update($data);
        return redirect()->route('admin.teams.index')->with('success', 'Team updated.');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('admin.teams.index')->with('success', 'Team removed.');
    }
}
