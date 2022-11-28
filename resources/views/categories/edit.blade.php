@extends('layouts.main')
@section('content')
<div class="allcontent">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=" {{  route ('categories')  }} ">Category</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
        </ol>
    </nav>
    <form action=" {{  route ('categories.update', $category)  }} " method="post">
        @csrf

        <label for="name">Name</label>
        <input type="text" name="name" id="" value=" {{ $category->name }} " required>
        <span class="errorMessage">
            @error('name')
             {{ $message }}      
            @enderror
        </span>
        
        <input type="submit" value="EditCategory">
    </form>
</div>
@endsection