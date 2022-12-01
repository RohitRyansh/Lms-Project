    @foreach ($projects as $project)
        <li><a class="dropdown-item" href=" {{ route('projects.view', $project )}}">{{ $project->name }} </a></li>
    @endforeach
