<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {

        request()->validate([
            'key' => ['nullable', 'string', 'min:3']
        ]);

        if (request()->key) {
            $projects = Project::where('title', 'LIKE', '%' . request()->key . '%')->with('type', 'technologies', 'status')->paginate(6);
        } else {
            $projects = Project::with('type', 'technologies', 'status')->paginate(6);
        }

        if (!$projects) {
            return response()->json([
                'status' => false,
                'message' => 'Progetto non trovato'
            ]);
        }

        return response()->json([
            'status' => true,
            'result' => $projects
        ]);
    }

    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)
            ->with('type', 'technologies', 'status')
            ->first();

        if (!$project) {
            return response()->json([
                'status' => false,
                'message' => 'Progetto non trovato'
            ]);
        }

        return response()->json([
            'status' => true,
            'result' => $project
        ]);
    }
}
