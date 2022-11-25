@extends('layouts.main')
@section('content')
<div class="allcontent">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route ('courses') }}">Course</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Course</li>
        </ol>
    </nav>
    <div class="courses1">
        <form action="{{ route ('courses.update', $course) }}" method="post">
            @csrf
            <label for="title">What Will Be The Course Name? </label>
            <input type="text" name="title" id=""  placeholder="Enter Course Name" value="{{$course->title}}" required>
            <span class="errorMessage">
                @error('title')
                {{$message}}     
                @enderror
            </span>

        <label for="description">Provide A Brief Description For What The Course Is About</label>
        <textarea name="description" id="" cols="30" rows="10" placeholder="Description" required>{{$course->description}}</textarea>
        <span class="errorMessage">
            @error('description')
            {{$message}}     
            @enderror
        </span>

        <label for="category">Which Category Should The Course Be In?</label>  
        <select name="category_id" id="">
            @foreach($categories as $category)
            <option value="{{$category['id']}}" @if($course->category_id == $category->id) Selected @endif>{{$category['slug']}}</option>
            @endforeach
        </select>

        <label for="level">What Is The Level Of The Course?</label>  
        <select name="level_id" id="">
            @foreach($levels as $level)
            <option value="{{$level['id']}}" @if($course->level_id == $level->id) Selected @endif>{{$level['name']}}</option>
            @endforeach
        </select>

        <input type="submit" value="EditCourse" class="btn btn-secondary">
    </form>
</div>
@endsection
