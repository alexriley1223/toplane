@extends('layout.base.app', ['title' => 'Post'])

@section('content')

{{-- Default Section --}}
<section class="home">
  <p><a href="/forum/{{ $post->forum->slug }}">Go Back to {{ $post->forum->name }}</a></p>
  <h1>Single Post</h1>

  <h2 style="margin-bottom: 0;">{{ $post->title }}</h2>
  <p><strong>{{ $post->created_at }}</strong></p>
  <p><small>Posted by <a href="/profile/{{ $post->user->name }}">{{ $post->user->name }}</a></small></p>

  <pre><code>{{ $post->content }}</code></pre>
  <p><a href="/new-reply/{{ $post->slug }}">Create New Reply</a></p>
  <hr>
  @foreach($post->replies as $reply)
    <p><strong>{{ $reply->created_at }}</strong></p>
    <p><small>Posted by {{ $reply->user->name }}</small></p>
    <p>{{ $reply->content }}</p>
  @endforeach
</section>

@endsection

@push('script')

@endpush
