@extends('layout.base.app', ['title' => 'Home'])

@section('content')

<section class="user-edit">
  <div class="user-edit__container">
    <h1>Edit Your Profile</h1>

    <div class="user-edit__flex">
      {{-- Tabs --}}
      <div class="user-edit__tabs">
        <ul>
          <li><a class="tab-link" href="#" onclick="changeTab(event, 'login')">Login Information</a></li>
          <li><a class="tab-link" href="#" onclick="changeTab(event, 'profile')">Profile Information</a></li>
          <li><a class="tab-link" href="#" onclick="changeTab(event, 'forum')">Forum Information</a></li>
        </ul>
      </div>

      {{-- Content --}}
      <div class="user-edit__content">
        {{ $errors }}
        {{-- Login Information --}}
        <div id="login" class="tab-item">
          <form action="{{ route('user.edit.login') }}" method="POST">
            @csrf

            <label for="password">New Password</label>
            <input type="password" name="password" id="password">

            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation">

            <input type="submit">
          </form>
        </div>

        {{-- Profile Information --}}
        <div id="profile" class="tab-item" style="display: none">
          <form action="{{ route('user.edit.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="profile_picture">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture">

            <input type="submit">
          </form>
        </div>

        <div id="forum" class="tab-item" style="display: none">
          <p>Validate Summoner</p>
          <form action="{{ route('user.summoner.create') }}" method="POST">
            @csrf
            <label for="region">Region</label>
            <select name="region" id="region">
              <option value="NA">NA</option>
              <option value="BR">BR</option>
              <option value="EUNE">EUNE</option>
              <option value="EUW">EUW</option>
              <option value="LAN">LAN</option>
              <option value="LAS">LAS</option>
              <option value="OCE">OCE</option>
              <option value="RU">RU</option>
              <option value="TR">TR</option>
              <option value="JP">JP</option>
              <option value="KR">KR</option>
            </select>
            <label for="summoner">Summoner Name</label>
            <input type="text" name="summoner" id="summoner">
          </form>
          <p>?* Verifying before you submit.</p>
          <p>Set your summoner icon to: </p>
          <img src="https://static.wikia.nocookie.net/leagueoflegends/images/f/f6/Blue_Siege_Minion_profileicon.png" alt="">

          <form action="{{ route('user.edit.forum') }}" method="POST">
            @csrf
          </form>
        </div>

      </div>
    </div>

  </div>
</section>

@endsection

@push('script')
<script>
  function changeTab(evt, tab) {

    var i, tabcontent, tablinks;
    tabitems = document.getElementsByClassName("tab-item");

    console.log(tabitems);

    for (i = 0; i < tabitems.length; i++) {
      tabitems[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tab-link");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tab).style.display = "block";
    evt.currentTarget.className += " active";
  }
</script>
@endpush
