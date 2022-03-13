@extends('layout.base.app', ['title' => 'Forum'])

@section('content')

{{-- Default Section --}}
<section class="home">
  <h1>Forums</h1>
  <a href="{{ route('forum') }}">Back to Forums</a>
  <h2>{{ $category->name }}</h2>
  <hr>
  @foreach ($category->forums as $forum)
    <p style="margin-bottom: 0">{{ $forum->name }} (<a href="/forum/{{ $forum->slug }}">View</a>)</p>
    <p style="margin-top: 0"><small>{{ $forum->description }}</small></p>
  @endforeach
  <h2></h2>
</section>

@endsection

@push('script')

@endpush
