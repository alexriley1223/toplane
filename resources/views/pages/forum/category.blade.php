@extends('layout.base.app', ['title' => 'Forum'])

@section('content')

{{-- Default Section --}}
<section class="forum">
  <div class="forum__container">
    <h1>{{ $category->name }}</h1>
    <a href="{{ route('forum') }}">Back to Forums</a>
    <hr>
    @foreach ($category->forums as $forum)
      <div class="forum__row">
        <p style="margin-bottom: 0">{{ $forum->name }} (<a href="/forum/{{ $forum->slug }}">View</a>)</p>
        <p style="margin-top: 0"><small>{{ $forum->description }}</small></p>
      </div>
    @endforeach
  </div>

</section>

@endsection

@push('script')

@endpush
