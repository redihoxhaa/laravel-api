<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Status;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.list', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $statuses = Status::all();
        $technologies = Technology::all();

        return view('projects.create', compact('types', 'statuses', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        // Prendo i dati post
        $data = $request->validated();

        // Creo nuova istanza progetto
        $project = new Project();

        // Mappo i dati del form
        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->start_date = $data['start_date'];
        $project->end_date = $data['end_date'];
        $project->status_id = $data['status_id'];
        $project->type_id = $data['type_id'];
        $project->slug = Str::slug($data['title']);
        if (isset($data['thumb'])) {
            $project->thumb = Storage::put('uploads', $data['thumb']);
        }

        // Salvo l'istanza
        $project->save();

        if ($request->has('technologies')) {
            $project->technologies()->sync($data['technologies']);
        }

        // Redirect alla pagina del nuovo progetto (possiamo passare l'istanza in quanto la ricerca per id è automatica)
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)

    {

        $types = Type::all();
        $statuses = Status::all();
        $technologies = Technology::all();
        return view('projects.edit_page', compact('project', 'types', 'statuses', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        // Prendo i dati post
        $data = $request->validated();

        $project->update($data);
        $project->slug = Str::slug($data['title']);
        $project->save();

        if ($request->has('technologies')) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)

    {

        $project->technologies()->sync([]);

        if ($project->thumb) {
            Storage::delete($project->thumb);
        }
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
