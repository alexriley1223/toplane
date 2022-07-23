@extends('layout.base.app', ['title' => 'Single Forum'])

@section('content')

{{-- Default Section --}}
<section>

  <div class="container mx-auto p-6">
    <a href="/category/{{ $forum->category->slug }}"><- Back to {{ $forum->category->name }}</a>

    <div class="flex justify-between">
      <h1 class="font-bold text-3xl mb-1">{{ $forum->name }}</h1>
      @auth
        <a class="block w-fit p-3 px-6 pt-2 mb-1 text-white bg-red-600 rounded-full baseline hover:bg-red-200" href="/new-post/{{ $forum->slug }}">New Post +</a>
      @endauth
    </div>
    <hr class="mb-5">

    @if(count($forum->posts->where('sticky', 1)) > 0)
      <h2 class="font-semibold mb-2">Stickied Posts</h2>
      <div class="flex justify-between mb-4">
        <p class="font-bold">Post</p>
        <p class="font-bold">Replies</p>
      </div>
    @endif

    @foreach ($forum->posts->where('sticky', 1)->sortByDesc('updated_at') as $post)
      <div class="flex flex-row justify-between items-center @if($loop->last) mb-10 @else mb-3 @endif">
        {{--
        <div class="hidden md:block w-12 h-12 rounded-full overflow-hidden cursor-pointer">
          <img class="object-cover" src="/storage/{{ $post->user->picture_url }}" alt="{{ $post->user->name }}">
        </div>
        --}}
        <div class="flex flex-col">
          <a class="block font-bold" href="/post/{{ $post->slug }}">{{ $post->title }}</a>
          <p>By <a class="hover:text-red-600 font-semibold" href="/profile/{{ $post->user->name }}">{{ $post->user->name }}</a> on {{ date('F d Y g:s a', strtotime($post->created_at)) }} EST</p>
        </div>
        <p>{{ count($post->replies) }}</p>
      </div>
    @endforeach

    <div class="flex justify-between mb-4">
      <p class="font-bold">Post</p>
      <p class="font-bold">Replies</p>
    </div>

    @foreach ($forum->posts->where('sticky', 0)->sortByDesc('updated_at') as $post)
      <div class="flex flex-row justify-between items-center mb-3">
        {{--
        <div class="hidden md:block w-12 h-12 rounded-full overflow-hidden cursor-pointer">
          <img class="object-cover" src="/storage/{{ $post->user->picture_url }}" alt="{{ $post->user->name }}">
        </div>
        --}}
        <div class="flex flex-col">
          <a class="block font-bold" href="/post/{{ $post->slug }}">{{ $post->title }}</a>
          <p>By <a class="hover:text-red-600 font-semibold" href="/profile/{{ $post->user->name }}">{{ $post->user->name }}</a> on {{ date('F d Y g:s a', strtotime($post->created_at)) }} EST</p>
        </div>
        <p>{{ count($post->replies) }}</p>
      </div>
    @endforeach
  </div>

</section>

@endsection

@push('script')

@endpush
