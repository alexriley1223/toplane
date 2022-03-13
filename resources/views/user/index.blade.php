@extends('layout.base.app', ['title' => 'Home'])

@section('content')

{{-- Default Section --}}
<section class="profile">
  <h1>{{ $user->name }}</h1>
  <img src="/storage/{{ $user->picture_url }}" alt="{{ $user->name }}'s Profile Image">

  @if(Auth::user()->id == $user->id )
    <a href="{{ route('user.edit') }}">Update Profile</a>
  @endif
</section>

@endsection

@push('script')

@endpush
