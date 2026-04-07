@extends('layouts.stisla.index', ['title' => 'Detail Buku ' . $book->title, 'section_header' => 'Detail Buku'])

@section('content')
<div class="row">
  <div class="col-lg-4">
    <div class="card">
      <img src="{{ asset($book->image) }}" class="card-img-top" alt="{{ $book->title }}">
    </div>
  </div>
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <h4>{{ $book->title }}</h4>
        <table class="table">
          <tr>
            <td style="width: 150px;">Nomor Buku</td>
            <td style="width: 10px;">:</td>
            <td>{{ $book->book_number }}</td>
          </tr>
          <tr>
            <td>Kategori</td>
            <td>:</td>
            <td>{{ $book->book_type->name }}</td>
          </tr>
          <tr>
            <td>Penerbit</td>
            <td>:</td>
            <td>{{ $book->publisher }}</td>
          </tr>
          <tr>
            <td>Bahasa</td>
            <td>:</td>
            <td>{{ $book->languages }}</td>
          </tr>
          <tr>
            <td>Tanggal Ditambahkan</td>
            <td>:</td>
            <td>{{ date_format(date_create($book->date_of_added), 'd-m-Y') }}</td>
          </tr>
          <tr>
            <td>Stok</td>
            <td>:</td>
            <td>{{ $book->stock }}</td>
          </tr>
        </table>
        <a href="{{ route('anggota.books.index') }}" class="btn btn-secondary">Kembali</a>
        @if($book->stock > 0)
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pinjam-buku-modal">Pinjam Buku</button>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

@push('modal')
<div class="modal fade" id="pinjam-buku-modal" tabindex="-1" role="dialog" aria-labelledby="pinjamBukuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pinjamBukuModalLabel">Pinjam Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('anggota.json-book-borrowers.store') }}" method="POST" id="pinjam-buku-form">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="book_id" value="{{ $book->id }}">
          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
          <div class="form-group">
            <label for="date_start">Tanggal Mulai</label>
            <input type="date" class="form-control" name="date_start" required>
          </div>
          <div class="form-group">
            <label for="date_end">Tanggal Selesai</label>
            <input type="date" class="form-control" name="date_end" required>
          </div>
          <div class="form-group">
            <label for="notes">Keterangan</label>
            <textarea class="form-control" name="notes" rows="3" placeholder="Opsional"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" id="pinjam-buku-submit">Pinjam</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endpush

@push('js')
<script>
  $(document).ready(function() {
    $("#pinjam-buku-submit").click(function(e) {
      e.preventDefault();
      let form = $("#pinjam-buku-form");
      let token = $("input[name=_token]").val();

      $.ajax({
        url: form.attr("action"),
        type: "POST",
        data: form.serialize(),
        success: function(data) {
          $("#pinjam-buku-modal").modal("hide");
          Swal.fire({
            title: "Berhasil",
            text: "Permintaan peminjaman buku berhasil dikirim.",
            icon: "success",
            timerProgressBar: true,
            onBeforeOpen: () => {
              Swal.showLoading();
              timerInterval = setInterval(() => {
                const content = Swal.getContent();
                if (content) {
                  const b = content.querySelector("b");
                  if (b) {
                    b.textContent = Swal.getTimerLeft();
                  }
                }
              }, 100);
            },
            showConfirmButton: false
          });

          setTimeout(function() {
            window.location.href = "{{ route('anggota.dashboard.index') }}";
          }, 1500);
        },
        error: function(data) {
          Swal.fire("Gagal!", "Gagal mengirim permintaan peminjaman.", "warning");
        }
      });
    });
  });
</script>
@endpush