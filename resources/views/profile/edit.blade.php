@extends('layouts.stisla.index', ['title' => 'Edit Profil', 'section_header' => 'Edit Profil'])

@section('content')
<div class="row">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <h4>Edit Profil</h4>
      </div>
      <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
          </div>

          <div class="form-group">
            <label for="address">Alamat</label>
            <textarea class="form-control" name="address" rows="3">{{ $user->address }}</textarea>
          </div>

          <div class="form-group">
            <label for="image">Foto Profil</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="image" id="image">
              <label class="custom-file-label" for="image">Pilih file...</label>
            </div>
          </div>

          <div class="form-group">
            <label for="password">Password Baru (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" class="form-control" name="password" placeholder="Minimum 8 karakter">
          </div>

          <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi password baru">
          </div>

          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-header">
        <h4>Foto Profil</h4>
      </div>
      <div class="card-body text-center">
        @if($user->image)
        <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" class="img-thumbnail mb-3" style="max-width: 200px;">
        @else
        <img src="{{ asset('assets/images/profiles/default.png') }}" alt="{{ $user->name }}" class="img-thumbnail mb-3" style="max-width: 200px;">
        @endif
        <p class="text-muted">Kosongkan password jika tidak ingin mengubah</p>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
  $(document).ready(function() {
    $('#image').on('change', function() {
      let fileName = $(this).val();
      $(this).next('.custom-file-label').html(fileName);
    });
  });
</script>
@endpush