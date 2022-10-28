@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">

    @if (strpos($post->cover, 'https://') === 0)
      <img src="{{ $post->cover }}" width=350>

    @elseif($post->cover)
      <div class="col-12">
        <img src="{{ asset('storage/' . $post->cover) }}" width=350>
      </div>
    @endif

    <div class="col-8">
      <h1>{{ $post->title }}</h1>
      <p>{{ $post->slug }}</p>

      @if($post->category)
        <p>Categoria: {{ $post->category->name }}</p>
      @endif

      <ul class="d-flex">
          <li class="p-2">Tags:</li>
          @foreach ($post->tags as $tag)
            <li class="p-2">
              {{ $tag->name }}
            </li>
          @endforeach
      </ul>

      <ul class="d-flex">
        <li class="p-2">Created at: {{ $post->created_at }}</li>
        <li class="p-2">Updated at: {{ $post->updated_at }}</li>
      </ul>
    </div>
    <div class="col-4 text-left d-flex justify-content-end align-items-center">
      <a href="{{ route('admin.posts.edit',$post) }}" type="button" class="btn btn-primary btn-sm">Modifica</a>
      <form action="{{ route('admin.posts.destroy',$post) }}" method="POST">

        @csrf
        @method('DELETE')

        <input type="submit" value="Elimina" class="btn btn-danger btn-sm">
      </form>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-12">
      <p>
        {{ $post->content }}
      </p>
    </div>
  </div>
</div>



<div class="container">
  <div class="row">
    <ul class="col-12">
      @if($post->category && $post->category->posts)
        <p>Vedi altri post della stessa categoria:</p>
      @endif

      @if($post->category)
        @foreach($post->category->posts()->where('id','!=',$post->id)->get() as $relatedPost)
          <li>
            <a href="{{ route('admin.posts.show',$relatedPost) }}">
              {{ $relatedPost->title }}
            </a>
          </li>
        @endforeach
      @endif
    </ul>
  </div>
</div>

@endsection