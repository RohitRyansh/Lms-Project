@extends('layouts.main')

@section('content')
<div class="allcontent">
    <div class="breadcrumbs-mine">
        <div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" ><a href="{{ route('courses') }}" style="text-decoration: none;">Course</a></li>
                <li class="breadcrumb-item" ><a href="{{ route('courses.view', $course) }}" style="text-decoration: none;width: 600px;">{{ $course->title }}</a></li>
            </ol>
        </div>
        <div>
            <a href=" {{ route('courses') }} " class="btn btn-primary" id="createbtn">Go to Course Content</a>
        </div>
    </div>
    @if (session('success'))
            <p class="succesmessage"> {{ session('success') }} </p>
        @endif
    <form action="{{ route('courses.units.update', [$course, $unit]) }}" class="create-form" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control form-control-sm"  placeholder="Enter Unit Name" value="{{ $unit->title }}" required>
            <span class="text-danger">
                @error('title')
                {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control form-control-sm" id="" cols="30" rows="5" placeholder="Description" required>{{ $unit->description }}</textarea>
            <span class="text-danger">
                @error('description')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <button type="submit" name="update" class="btn btn-secondary">Update</button>
        <a href="{{ route('courses.view', $course) }}" class="btn btn-outline-secondary">Cancel</a>
        <a href="{{ route('courses.units.tests.create', [$course, $unit]) }}" class="btn btn-outline-secondary">Add Test</a>

    </form>
    <div class="lessons">
        <h2>Lessons</h2>
        @foreach ($unit->tests as $test)
        <div class="unit-detail">
            <div>
                <div class="units">
                    <i class="bi bi-grip-vertical" style="font-size: 25px;color:grey;"></i>
                    <p>{{$test->name}}</p>
                </div>
                <p>{{ $test->questions()->count() }} Questions</p>  
            </div>
            <div class="editAndDelete"> 
                <a href=" {{ route('courses.units.tests.edit', [ $course, $unit, $test ]) }} " class="unit-edit"><i class="bi bi-pencil-square"></i> Edit </a>
                <form action=" {{ route('courses.units.tests.delete', [ $course, $unit, $test ]) }} " method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="delete" class="btn btn-outline-danger btn-sm">
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection