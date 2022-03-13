@extends('layout.base.app', ['title' => 'Home'])

@section('content')

<section class="user-edit">
  <div class="user-edit__container">
    <h1>Edit Your Profile</h1>
    {{-- Tabs --}}
    <div class="user-edit__tabs">
      <ul>
        <li><a href="">Login Information</a></li>
        <li><a href="">Forum Information</a></li>
        <li><a href="">Profile Information</a></li>
      </ul>
    </div>

    {{-- Content --}}
    <div class="user-edit__content">
      {{ $errors }}
      {{-- Login Information --}}
      <form action="{{ route('user.edit.login') }}" method="POST">

      </form>

      {{-- --}}
      <form action="{{ route('user.edit.forum') }}" method="POST">

      </form>

      {{-- Profile Information --}}
      <form action="{{ route('user.edit.profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="profile_picture">Profile Picture</label>
        <input type="file" name="profile_picture" id="profile_picture">

        <input type="submit">
      </form>
    </div>

  </div>
</section>

@endsection

@push('script')

@endpush
