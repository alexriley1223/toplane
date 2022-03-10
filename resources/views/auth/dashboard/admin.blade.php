@extends('layout.base.app', ['title' => 'Admin Dashboard'])

@section('content')

<h1>Welcome, {{ auth()->user()->name }}</h1>

<h2>Create New Category</h2>

<h2>Create New Forum</h2>

@endsection

@push('script')

@endpush
