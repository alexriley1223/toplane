@extends('layout.base.app', ['title' => 'Admin Dashboard'])

@section('content')

<h1>Welcome, {{ auth()->user()->name }}</h1>

<h2>Create New Category</h2>
<form method="POST" action="{{ route('admin.category.create') }}">
    @csrf
    <div>
        <input type="text" placeholder="Name" id="name" name="name" required autofocus>
    </div>
    <div>
        <input type="text" placeholder="Description" id="description" name="description" required>
    </div>
    <div>
        <input type="number" id="order" name="order" required>
    </div>
    <div>
        <button type="submit">Submit</button>
    </div>
</form>

<h2>Create New Forum</h2>

<form method="POST" action="{{ route('admin.forum.create') }}">
    @csrf
    <div>
        <input type="text" placeholder="Name" id="name" name="name" required autofocus>
    </div>
    <div>
        <input type="text" placeholder="Description" id="description" name="description" required>
    </div>
    <select name="category_id" id="category_id">
      @foreach(App\Models\Category::all() as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach

    </select>
    <div>
        <input type="number" id="order" name="order" required>
    </div>
    <div>
        <button type="submit">Submit</button>
    </div>
</form>

<h2>Current Forums</h2>

@foreach(App\Models\Category::orderBy('order')->get() as $category)

  <p><b>{{ $category->name }}</b></p>
  @foreach(App\Models\Forum::where('category_id', $category->id)->orderBy('order')->get() as $forum)
    <p style="margin-left: 10px;">{{ $forum->name }}</p>
  @endforeach
@endforeach

@endsection

@push('script')

@endpush
