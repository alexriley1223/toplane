@extends('layout.base.app', ['title' => 'Post'])

@section('content')

{{-- Default Section --}}
<section>

  <div class="container mx-auto p-6">
    <a class="block my-5" href="/forum/{{ $post->forum->slug }}"><- Go Back to {{ $post->forum->name }}</a>

    <div class="flex flex-row justify-between items-center">
      <div>
        <h1 class="font-bold text-3xl mb-1">{{ $post->title }} @if($post->deleted_at) **ARCHIVED** @endif @if($post->sticky) !!STICKIED!! @endif</h1>
        @if($post->locked)<p><i> This post is locked. </i></p>@endif
        <p>By <small><a class="hover:text-red-600 font-semibold" href="/profile/{{ $post->user->name }}">{{ $post->user->name }}</a> on {{ date('F d Y g:s a', strtotime($post->created_at)) }} EST</small></p>
      </div>
      <div>
        @mod
          <div class="flex flex-row">
            @if($post->sticky)
              <a class="block w-fit p-3 mx-5 px-6 pt-2 text-white bg-red-600 rounded-full baseline hover:bg-red-200" href="/admin/post/unsticky/{{ $post->id }}">Unsticky Post</a>
            @else
              <a class="block w-fit p-3 mx-5 px-6 pt-2 text-white bg-red-600 rounded-full baseline hover:bg-red-200" href="/admin/post/sticky/{{ $post->id }}">Sticky Post</a>
            @endif

            @if($post->locked)
              <a class="block w-fit p-3 mx-5 px-6 pt-2 text-white bg-red-600 rounded-full baseline hover:bg-red-200" href="/admin/post/unlock/{{ $post->id }}">Unlock Post</a>
            @else
              <a class="block w-fit p-3 mx-5 px-6 pt-2 text-white bg-red-600 rounded-full baseline hover:bg-red-200" href="/admin/post/lock/{{ $post->id }}">Lock Post</a>
            @endif

            @if($post->deleted_at)
              <a class="block w-fit p-3 mx-5 px-6 pt-2 text-white bg-red-600 rounded-full baseline hover:bg-red-200" href="/admin/post/unarchive/{{ $post->id }}">UnArchive Post</a>
            @else
              <a class="block w-fit p-3 mx-5 px-6 pt-2 text-white bg-red-600 rounded-full baseline hover:bg-red-200" href="/admin/post/archive/{{ $post->id }}">Archive Post</a>
            @endif
          </div>
        @endmod
      </div>
    </div>

    <pre class="my-10"><code>{{ $post->content }}</code></pre>
    @if(!$post->locked && !$post->trashed())
      <a class="block text-center p-3 mx-5 px-6 mb-5 pt-2 text-white bg-red-600 rounded-full baseline hover:bg-red-200" href="/new-reply/{{ $post->slug }}">Create New Reply</a>

      @guest
        <p><small>You must be <a href="{{ route('auth.login')}}">logged in</a> to reply.</small></p>
      @endguest
    @endif

    <hr>
    @foreach($post->replies as $reply)
      <div class="flex justify-between items-center">
        <div class="my-5">
          <p>{{ $reply->content }}</p>
          <p><small>By <a class="hover:text-red-600 font-semibold" href="/profile/{{ $post->user->name }}">{{ $reply->user->name }}</a> on {{ date('F d Y g:s a', strtotime($post->created_at)) }} EST</small></p>
        </div>

        @mod
          <a class="block right-0 w-fit h-fit p-3 mx-5 px-6 pt-2 text-white bg-red-600 rounded-full baseline hover:bg-red-200" href="/admin/reply/delete/{{ $reply->id }}">Delete Reply</a>
        @endmod
        {{--
        @if($reply->user_id == auth()->user()->id && auth()->user()->role == 0)
          <a class="block right-0 w-fit h-fit p-3 mx-5 px-6 pt-2 text-white bg-red-600 rounded-full baseline hover:bg-red-200" href="/admin/reply/delete/{{ $reply->id }}">Delete Reply</a>
        @endif
        --}}
      </div>
    @endforeach
  </div>

</section>

@endsection

@push('script')

@endpush
