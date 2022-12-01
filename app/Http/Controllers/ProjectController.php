<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    
    public function index() {

        return view ('projects.index', [
            'projects' => Project::get()
        ]);
    }

    public function view(Project $project) {

        return view ('projects.view', [
            'deployments' => $project->deployments
        ]);
    }
}
