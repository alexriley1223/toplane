@extends('layout.base.app', ['title' => 'New Post'])

@section('content')

{{-- Default Section --}}
<section class="home">

  <form method="POST" action="{{ route('forum.create-reply') }}">
    @csrf
    <input type="hidden" id="identity" name="identity" value="{{ $identity->identity }}">

    <input type="text" id="content" name="content" placeholder="Content" required>

    <input type="submit">
  </form>
</section>

@endsection

@push('script')

@endpush
