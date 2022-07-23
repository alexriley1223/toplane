@extends('layout.base.app', ['title' => 'Forum'])

@section('content')

{{-- Default Section --}}
<section>
  <div class="container mx-auto p-6">
    <a href="{{ route('forum') }}"><- Back to Forums</a>
    <h1 class="font-bold text-3xl mb-1">{{ $category->name }}</h1>
    <hr class="mb-5">
    @foreach ($category->forums as $forum)
      <div class="flex flex-row @if($loop->last) mb-5 @else mb-3 @endif">
        <img class="w-12 md:w-24 h-12 md:h-24 rounded-full" src="/storage/{{ $forum->image_url }}" alt="{{ $forum->name }}">
        <div class="flex flex-col justify-center ml-5">
          <a href="/forum/{{ $forum->slug }}"><p style="margin-bottom: 0"><b>{{ $forum->name }}</b></p></a>
          <p><small>{{ $forum->description }}</small></p>
        </div>
      </div>
    @endforeach
  </div>

</section>

@endsection

@push('script')

@endpush
