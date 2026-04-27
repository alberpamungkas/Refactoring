<table class="table table-hover">
    <thead>
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Tahun</th>
        <th>Pemain</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($movies as $movie)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $movie->judul }}</td>
            <td>{{ $movie->category->nama_kategori }}</td>
            <td>{{ $movie->tahun }}</td>
            <td>{{ $movie->pemain }}</td>
            <td class="text-nowrap">
                <a href="{{ url('/movies/edit/' . $movie->id) }}" class="btn btn-warning">Edit</a>

                <a href="{{ route('movies.delete', $movie->id) }}" 
                   class="btn btn-danger"
                   onclick="return confirm('Yakin hapus?')">
                   Hapus
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>