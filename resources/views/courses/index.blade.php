@extends('layouts.main')
@section('content')
<div class="allcontent">
    <div class="nav">
        <div>
            <h2>Courses</h2>
        </div>
        <div class="nav1">
            <button type="button" class="btn btn-primary"><a href="{{route('courses.create')}}" class="createButtons">Create Course</a></button> 
        </div>
    </div>
    <div class="content2">
        <div class="courseNav">
            <ul>
                <li>All Courses</li>
                <li>Published</li>
                <li>Draft</li>
                <li>Archived</li>
            </ul>
        </div>
        <div class="all">
            <div class="all1">
                <form action="{{ route ('courses') }}?{{request()->getQueryString()}}" method="get">
                    <div class="d-flex1">
                        <input class="form-control" type="text" name="search" placeholder="Search by Name">
                        <i class="bi bi-search"></i>
                    </div>
                </form>
                <div>
                    <div class="dropdown">  
                        <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown">
                            Category
                        </button>
                        <ul class="dropdown-menu">
                            @foreach($categories as $category)
                                <li><a class="dropdown-item" href="{{ route('courses') }}?category={{$category->id}}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div> 
                </div>
                <div>   
                    <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown">
                        Level
                    </button>
                    <ul class="dropdown-menu">
                        @foreach($levels as $level)
                            <li><a class="dropdown-item" href="{{ route ('courses') }} ">{{ $level->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div>   
                <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown">
                    Sort By
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route ('courses') }}?newest=latest">Newest</a></li>
                    <li><a class="dropdown-item" href="{{ route ('courses') }}">Oldest</a></li>
                </ul>
            </div> 
        </div>
        @if (session('success'))
            <p class="succesmessage">{{session('success')}}</p>
        @endif
        @if ($courses->count()>0)
            @foreach ($courses as $course)
                <section class="course-list">
                    <div class="course-detail">
                        <div class="course-image">
                            <img src="https://img.freepik.com/free-vector/images-concept-illustration_114360-218.jpg?w=740&t=st=1669090866~exp=1669091466~hmac=086e2bd34fb211abbc01503852e809c7ea6d9ddf405b0e73ffa9f8d63ebdcb44" alt="">
                        </div>
                        <div>
                            <a href="{{ route('courses') }}?category={{ $course->category->id }}" class="category-badge">{{$course->category->name}}</a>
                            <a href="{{ route ('courses.view', $course) }}" class="course-head"><h3>{{ $course->title }}</h3></a>
                            <div class="course-created-details">
                                <p>Created By:<span>{{$course->user->name}}</span></p>
                                <p>Created On:<span>{{$course->created_at->format('F d,Y')}}</span></p>
                            </div>
                            <p>{{$course->description}}</p>
                            <div class="level-enrolled">
                                <p><i class="bi bi-bar-chart-fill"></i> {{$course->level->name}}</p>
                                <p><i class="bi bi-easel"></i> Enrolled</p>
                            </div>
                        </div>
                    </div>
                    <div class="course-options">
                        <p class="status-badge" @if($course->status->name=="Published")id="published" @elseif($course->status->name=="Archieved")id="archieved" @else id="draft" @endif>{{$course->status->name}}</p>
                        <div class="btn-group">
                            <button class="icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu"> 
                                <li class="drop-items">
                                    <div class="drop-items-icon">
                                        <i class="bi bi-wrench-adjustable"></i>
                                        <a href="{{ route('courses.edit', $course) }}">Edit Course</a>
                                    </div>
                                </li>
                            
                                <li class="drop-items">
                                    <div class="drop-items-icon">
                                        <i class="bi bi-people-fill"></i>
                                        @if($course->status->name=="Published")
                                        <a href="{{ route('enroll.index', $course) }}">Users</a>
                                        @else
                                        <a href="{{ route('courses') }}">Users</a>
                                        @endif
                                    </div>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li class="drop-items">
                                    
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            @endforeach 
        @else
            <h1 style="text-align: center;">No Course Exist</h1>      
        @endif
    </div>
</div>
@endsection