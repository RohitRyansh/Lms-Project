@extends('layouts.main')
@section('content')
<div class="allcontent">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=" {{  route ('courses')  }} ">Course</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Course</li>
        </ol>
    </nav>
    <div class="courses1">
        <form action=" {{  route ('courses.store')  }} " method="post" class="CourseCreate" enctype="multipart/form-data">
            @csrf

            <label for="exampleFormControlInput1" class="form-label">What Will Be The Course Name?</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Enter Course Name">
            <span class="errorMessage">
                @error('title')
                 {{ $message }}      
                @enderror
            </span>    

            <label for="exampleFormControlTextarea1" class="form-label">Provide A Brief Description For What The Course Is About</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
            <span class="errorMessage">
                @error('description')
                 {{ $message }}      
                @enderror
            </span>

            <label for="category" class="form-label">Which Category Should The Course Be In?</label> 
            <select class="form-select" name="category_id" aria-label="Default select example">
                @foreach($categories as $category)
                    <option value=" {{ $category['id'] }} "> {{ $category['slug'] }} </option>
                @endforeach
            </select> 

            <label for="level" class="form-label">What Is The Level Of The Course?</label> 
            <select class="form-select" name="level_id" aria-label="Default select example">
                @foreach($levels as $level)
                    <option value=" {{ $level['id'] }} "> {{ $level['name'] }} </option>
                @endforeach
            </select> 
            <input type="file" name="image_path">
            <input type="submit" value="CreateCourse" name="submit">
        </form>
    </div>
</div>
@endsection
