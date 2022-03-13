@extends('layout.base.app', ['title' => 'Forum'])

@section('content')

{{-- Forum Section --}}
<section class="forum">

  <div class="forum__container">
    <h1>Forums</h1>
    @foreach ($categories as $category)
      <h2>{{ $category->name }} (<a href="/category/{{ $category->slug }}">View</a>)</h2>
      <hr>
      @foreach ($category->forums as $forum)
        <p style="margin-bottom: 0">{{ $forum->name }} (<a href="/forum/{{ $forum->slug }}">View</a>)</p>
        <p style="margin-top: 0"><small>{{ $forum->description }}</small></p>
      @endforeach
    @endforeach
  </div>
  
</section>

@endsection

@push('script')

@endpush
