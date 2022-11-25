@extends('layouts.main')
@section('content')
<div class="allcontent">
    <div class="nav">
        <div>
            <h2>Categories</h2>
        </div>
        <div class="nav1">
            <button type="button" class="btn btn-primary"><a href="{{route('categories.create')}}" class="createButtons">Create Category</a></button> 
        </div>
    </div>
    <div class="allCategory">
        <div class="all">
            <form action="{{ route('categories') }}?{{ request()->getQueryString() }}" method="get">
                <div class="d-flex">
                    <input class="form-control" type="text" name="search" placeholder="Search by Name">
                    <i class="bi bi-search"></i>
                </div>
            </form>
            <div>   
                <div class="dropdown">   
                    <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown">
                        Latest Created Date
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('categories')}}?newest=latest">Newest</a></li>
                        <li><a class="dropdown-item" href="{{route('categories')}}">Oldest</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @if (session('success'))
            <p class="succesmessage">{{session('success')}}</p>
        @endif
        @if ($categories->count()>0)
        <table class="table">
            <tr class="table-heading">
                <th>Name</th>
                <th>Created By</th>
                <th>Courses</th>
                <th>Created date</th>
                <th>Status</th>
                <th></th>
            </tr>
            @foreach($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>{{$category->created_by}}</td>
                <td></td>
                <td></td>
                <td>
                    @if($category->status)
                        <form action="{{ route('categories.status', ['category'=> $category,'status'=> 0]) }}" method="POST">
                            @csrf
                            <span class="badge text-bg-success">
                                <input type="submit" name="Active" value="Active" class="active">
                            </span>
                        </form>
                    @else
                        <form action="{{ route('categories.status', ['category'=> $category,'status'=> 1]) }}" method="POST">
                            @csrf
                            <span class="badge text-bg-danger">
                                <input type="submit" name="Deactive" value="Deactive" class="active">
                            </span>
                        </form>
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <button class="icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu"> 
                            <li class="drop-items">
                                <div class="drop-items-icon">
                                    <i class="bi bi-wrench-adjustable"></i>
                                    <a href="{{ route('categories.edit', $category) }}">Edit Category</a>
                                </div>
                            </li>
                            <li class="drop-items">
                                <div class="drop-items-icon">
                                    <i class="bi bi-wrench-adjustable"></i>
                                    <form action="{{route('categories.delete', $category)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="delete" class="deletebuttons">
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <h1 style="text-align: center;">No Category Exist</h1>      
        @endif
    </div>
</div>
@endsection
