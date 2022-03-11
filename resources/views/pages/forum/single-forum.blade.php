@extends('layout.base.app', ['title' => 'Home'])

@section('content')

{{-- Default Section --}}
<section class="home">
  <h1>{{ $forum->name }}</h1>
  <hr>
  @foreach ($forum->posts as $forum)
    <p style="margin-bottom: 0">{{ $forum->name }}</p>
    <p style="margin-top: 0"><small>{{ $forum->description }}</small></p>
  @endforeach
</section>

@endsection

@push('script')

@endpush
