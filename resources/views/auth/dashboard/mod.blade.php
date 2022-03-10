@extends('layout.base.app', ['title' => 'Mod Dashboard'])

@section('content')

<h1>Welcome, {{ auth()->user()->name }}</h1>

@endsection

@push('script')

@endpush
