@extends('layout.base.app', ['title' => 'Post'])

@section('content')

{{-- Default Section --}}
<section class="forum">

  <div class="forum__container">
    @mod
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

    @endmod
    <p><a href="/forum/{{ $post->forum->slug }}">Go Back to {{ $post->forum->name }}</a></p>
    <h1>{{ $post->title }} @if($post->deleted_at) **ARCHIVED** @endif @if($post->sticky) !!STICKIED!! @endif</h1>
    <p><i>@if($post->locked) This post is locked. @endif</i></p>

    <p><small>By <a href="/profile/{{ $post->user->name }}">{{ $post->user->name }}</a> >> {{ date('F d Y g:s a', strtotime($post->created_at)) }} EST</small></p>

    <pre><code>{{ $post->content }}</code></pre>
    @if(!$post->locked && !$post->trashed())
      <p><a href="/new-reply/{{ $post->slug }}">Create New Reply</a></p>

      @guest
        <p><small>You must be <a href="{{ route('auth.login')}}">logged in</a> to reply.</small></p>
      @endguest
    @endif

    <hr>
    @foreach($post->replies as $reply)
      <div class="forum__row">
        <p><small>By {{ $reply->user->name }} >> {{ date('F d Y g:s a', strtotime($post->created_at)) }} EST</small></p>
        <p>{{ $reply->content }}</p>
      </div>
    @endforeach
  </div>

</section>

@endsection

@push('script')

@endpush
