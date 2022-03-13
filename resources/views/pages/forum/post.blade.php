@extends('layout.base.app', ['title' => 'Post'])

@section('content')

{{-- Default Section --}}
<section class="home">
  @admin
    @if($post->sticky)
      <a href="/admin/post/unsticky/{{ $post->slug }}">Unsticky Post</a>
    @else
      <a href="/admin/post/sticky/{{ $post->slug }}">Sticky Post</a>
    @endif

    @if($post->locked)
      <a href="/admin/post/unlock/{{ $post->slug }}">Unlock Post</a>
    @else
      <a href="/admin/post/lock/{{ $post->slug }}">Lock Post</a>
    @endif

    @if($post->deleted_at)
      <a href="/admin/post/unarchive/{{ $post->slug }}">UnArchive Post</a>
    @else
      <a href="/admin/post/archive/{{ $post->slug }}">Archive Post</a>
    @endif

  @endadmin
  <p><a href="/forum/{{ $post->forum->slug }}">Go Back to {{ $post->forum->name }}</a></p>
  <h1>Single Post @if($post->deleted_at) **ARCHIVED** @endif @if($post->sticky) !!STICKIED!! @endif</h1>
  <p><i>@if($post->locked) This post is locked. @endif</i></p>

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
