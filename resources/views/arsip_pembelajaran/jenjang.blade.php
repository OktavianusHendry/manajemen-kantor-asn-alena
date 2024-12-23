<div class="container">
    <h1>Pembelajaran untuk {{ $jenjang->nama_jenjang }}</h1>

    <!-- Form Pencarian Kelas -->
    <form method="GET" action="{{ route('arsip_pembelajaran.jenjang', ['id_jenjang' => $jenjang->id]) }}">
        <div class="form-group">
            <input type="text" name="kelas" class="form-control" placeholder="Cari kelas...">
            <button type="submit" class="btn btn-primary mt-2">Cari</button>
        </div>
    </form>

    <!-- Menampilkan Pembelajaran dalam Card -->
    <div class="row mt-4">
        @foreach ($pembelajaran as $item)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul_pembelajaran }}</h5>
                        <p class="card-text">Kelas: {{ $item->kelas }}</p>
                        <p class="card-text">Kategori: {{ $item->kategori->nama_kategori }}</p>
                        <p class="card-text">Sub Kategori: {{ $item->sub_kategori->nama_sub_kategori }}</p>
                        <a href="{{ route('arsip_pembelajaran.show', $item->id) }}" class="btn btn-primary">Lihat
                            Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    {{ $pembelajaran->links() }}
</div>
