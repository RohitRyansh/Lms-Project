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
        <form action=" {{ route ('courses.units.tests.store',[$course, $unit]) }} " method="post" class="CourseCreate" enctype="multipart/form-data">
            @csrf

            <label for="exampleFormControlInput1" class="form-label">Test Name</label>
            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Test Name">
            <span class="errorMessage">
                @error('name')
                 {{ $message }}      
                @enderror
            </span> 
            
            <label for="exampleFormControlInput1" class="form-label">Duration of Test</label>
            <input type="text" name="duration" class="form-control" id="exampleFormControlInput1" placeholder="In Minutes">
            <span class="errorMessage">
                @error('duration')
                 {{ $message }}      
                @enderror
            </span>

            <label for="exampleFormControlInput1" class="form-label">Pass Score</label>
            <input type="text" name="pass_score" class="form-control" id="exampleFormControlInput1" >
            <span class="errorMessage">
                @error('pass_score')
                 {{ $message }}      
                @enderror
            </span>
   
            <div class="saveButtons">
                <button type="submit" value="CreateTest" name="create" class="btn btn-secondary">Save</button>
                <button type="submit" value="CreateAnother" name="create" class="btn btn-secondary">Save & Add Another</button>
                <a href=" {{ route('courses.view')  }} " class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
