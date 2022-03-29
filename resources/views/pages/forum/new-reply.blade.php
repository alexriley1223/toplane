@extends('layout.base.app', ['title' => 'New Post'])

@section('content')

{{-- Default Section --}}
<section class="home">

  <form method="POST" action="{{ route('forum.reply.create') }}">
    @csrf
    <input type="hidden" id="identity" name="identity" value="{{ $identity->identity }}">

    <input type="text" id="content" name="content" placeholder="Content" required>

    <input type="submit">
  </form>

  @if($errors->any())
    @foreach ($errors->all() as $error)
      <div class="inline-error inline-error__alert">
        @include('modules.svg.alert.alert')
        <p>{{ $error }}</p>
      </div>
    @endforeach
  @endif
</section>

@endsection

@push('script')

@endpush
