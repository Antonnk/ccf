<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Project;
use Carbon\Carbon;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function start(Project $project)
    {
        Entry::create([
            'start' => Carbon::now(),
            'end' => null,
            'project_id' => $project->getKey()
        ]);

        return response()->json(['status' => 'success']);
    }

    public function stop(Project $project)
    {
        $running_entry = $project->entries()->where('end', null)->first();
        $running_entry->end = Carbon::now();
        $running_entry->save();

        return response()->json(['status' => 'success']);
    }
}
