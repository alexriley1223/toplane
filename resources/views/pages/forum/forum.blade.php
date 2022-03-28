@extends('layout.base.app', ['title' => 'Forum'])

@section('content')

{{-- Forum Section --}}
<section class="forum">

  <div class="forum__container">
    <h1>Forums</h1>
    @foreach ($categories as $category)
      <h2>{{ $category->name }}</h2>
      <hr>
      @foreach ($category->forums as $forum)
        <div class="forum__row">
          <a href="/forum/{{ $forum->slug }}"><p style="margin-bottom: 0"><b>{{ $forum->name }}</b></p></a>
          <p style="margin-top: 0"><small>{{ $forum->description }}</small></p>
        </div>
      @endforeach
    @endforeach
  </div>

</section>

@endsection

@push('script')

@endpush
