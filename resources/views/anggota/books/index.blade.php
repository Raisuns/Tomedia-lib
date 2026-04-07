@extends('layouts.stisla.index', ['title' => 'Katalog Buku', 'section_header' => 'Katalog Buku'])

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{ route('anggota.books.index') }}" method="GET">
          <div class="row">
            <div class="col-lg-5">
              <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Cari judul, penerbit, atau nomor buku..." value="{{ request('search') }}">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <select class="form-control" name="book_type_id">
                  <option value="">Semua Kategori</option>
                  @foreach($book_types as $book_type)
                  <option value="{{ $book_type->id }}" {{ request('book_type_id') == $book_type->id ? 'selected' : '' }}>
                    {{ $book_type->name }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> Cari</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@if($books->isEmpty())
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-info text-center">
      Buku tidak ditemukan.
    </div>
  </div>
</div>
@else
<div class="row">
  @foreach($books as $book)
  <div class="col-12 col-sm-6 col-md-4 col-lg-3">
    <div class="card">
      <img src="{{ asset($book->image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 200px; object-fit: cover;">
      <div class="card-body">
        <h5 class="card-title">{{ Str::limit($book->title, 30, '...') }}</h5>
        <p class="card-text">
          <small class="text-muted">{{ $book->publisher }}</small><br>
          <small class="text-muted">Stok: {{ $book->stock }}</small>
        </p>
        <a href="{{ route('anggota.books.show', $book->id) }}" class="btn btn-primary btn-block">Lihat Detail</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endif
@endsection