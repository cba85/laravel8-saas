@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
        <div class="col-sm-8">
    <h1 class="text-center mb-4">Create a new article</h1>

    @if ($errors->any())
       <div class="alert alert-danger">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
   @endif

    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
      @csrf
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
  </div>

  <div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control" id="body" name="body" rows="5">{{ old('body') }}</textarea>
  </div>

    <div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control-file" id="image" name="img">
  </div>
  
  <button type="submit" class="btn btn-primary btn-lg mt-4">Create</button>
</form>

 </div>
</div>
</div>
@endsection
