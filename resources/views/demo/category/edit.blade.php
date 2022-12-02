<div class="create">
    <form action="{{ route ('trainee.update', $category) }}" method="post" class="createForm">
        @csrf

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Category Name"  value="{{ $category->name }}" required>
            <span class="errorMessage">
                @error('name')
                 {{ $message }}      
                @enderror
            </span>
        </div>

        <div class="saveButtons">
            <button type="submit" value="Update" name="create" class="btn btn-secondary">Save</button>
    </form>
            <a href=" {{  route('trainee.index')  }} " class="btn btn-outline-secondary">Cancel</a>
        </div>
</div>