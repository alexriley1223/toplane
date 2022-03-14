@extends('layout.base.app', ['title' => 'Single Forum'])

@section('content')

{{-- Default Section --}}
<section class="forum">

  <div class="forum__container">
    <h1>{{ $forum->name }}</h1>
    <a href="/category/{{ $forum->category->slug }}">Back to {{ $forum->category->name }}</a>
    @auth
        <a href="/new-post/{{ $forum->slug }}">New Post +</a>
    @endauth
    <hr>
    @foreach ($forum->posts as $post)
      <div class="forum__row">
        <p style="margin-bottom: 0"><strong>{{ $post->title }} (<a href="/post/{{ $post->slug }}">View</a>)</strong></p>
        <p>By {{ $post->user->name }} >> {{ date('F d Y g:s a', strtotime($post->created_at)) }} EST</p>
      </div>
    @endforeach
  </div>

</section>

@endsection

@push('script')

@endpush
