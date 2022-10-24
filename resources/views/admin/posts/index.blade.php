@extends('layouts.app')

@section('content')

<div class="container">
  <div class="index__header">
    <h1>Elenco posts:</h1>

    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">Nuovo Post</a>
  </div>
</div>

<div class="container">
      <table class="index__table">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Created at</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
          <tr>
            <th>{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->created_at }}</td>
            <td>
              <a href="{{ route('admin.posts.show', $post) }}" type="button" class="btn btn-secondary btn-sm">vedi</a>
            </td>
            <td>
              <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">

                @csrf
                @method('DELETE')

                <input type="submit" value="Elimina" class="btn btn-danger btn-sm">
              </form>
            </td>
          </tr>

          @endforeach

        </tbody>
      </table>

</div>

@endsection