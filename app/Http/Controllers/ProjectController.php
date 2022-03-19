<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(int $projectID)
    {
        $project = Project::with('entries')->find($projectID);
        return view('projects.show', ['project' => $project]);
    }

    public function add(Request $request)
    {
        Project::create([
            'name' => $request->get('name'),
            'details' => ''
        ]);

        return response()->json(['status' => 'success']);
    }

    public function update(Project $project, Request $request)
    {
        $project->name = $request->get('name', $project->name);
        $project->details = $request->get('details', $project->details);
        $project->save();

        return response()->json(['status' => 'success']);
    }

    public function entries(Project $project)
    {
        return response()->json([
           'entries' => $project->entries
        ]);
    }
}
