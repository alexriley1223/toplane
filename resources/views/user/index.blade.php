@extends('layout.base.app', ['title' => 'Home'])

@section('content')

{{-- Default Section --}}
<section class="profile">
  <h1>{{ $user->name }}</h1>
</section>

@endsection

@push('script')

@endpush
