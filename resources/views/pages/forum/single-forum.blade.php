@extends('layout.base.app', ['title' => 'Single Forum'])

@section('content')

{{-- Default Section --}}
<section class="home">
  <h1>{{ $forum->name }}</h1>
  <a href="/category/{{ $forum->category->slug }}">Back to {{ $forum->category->name }}</a>
  @auth
      <a href="/new-post/{{ $forum->slug }}">New Post +</a>
  @endauth
  <hr>
  @foreach ($forum->posts as $post)
    <p style="margin-bottom: 0">{{ $post->title }} (<a href="/post/{{ $post->slug }}">View</a>)</p>
    <p><strong>{{ $post->created_at }}</strong></p>
    <p style="margin-top: 0"><small>{{ $post->content }}</small></p>
  @endforeach
</section>

@endsection

@push('script')

@endpush
