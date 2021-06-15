@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
        <div class="col-sm-8">
    <h1 class="text-center mb-4">Articles</h1>

    <div class="text-center mb-5">
        <a href="{{ route('posts.create') }}" class="btn btn-link btn-lg">Create a new article</a>
    </div>

    @if ($posts->count())

    @foreach ($posts as $post)
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col-sm-6 p-4">
          <h3 class="mb-0">{{ $post->title }}</h3>
          <div class="mb-1 text-muted">{{ $post->created_at->diffForHumans() }}</div>
          <p class="card-text mb-auto">{{ $post->body }}</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
         <img class="col-sm-6" src="{{ asset($post->img_url) }}" alt="{{ $post->title }}">
         <form action="{{ route('posts.destroy', $post->id) }}" method="post">
            @csrf
            {{ method_field('DELETE') }}
             <button type="submit" class="btn btn-link">👋 Delete</a>
         </form>
      </div>
      @endforeach

      @else

      <p class="text-center"><em>No articles yet.</em></p>

      @endif

</div>
</div>
</div>
@endsection
