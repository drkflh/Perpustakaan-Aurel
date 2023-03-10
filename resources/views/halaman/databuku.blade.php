@extends('index')
@section('content')
<h3>Daftar Buku Perpustakaan Bersama</h3>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <td align="center">No</td>
            <td align="center">ID Buku</td>
            <td align="center">Kode Buku</td>
            <td align="center">Judul Buku</td>
            <td align="center">Pengarang</td>
            <td align="center">Penerbit</td>
            <td align="center">Gambar</td>
        </tr>
    </thead>

    <tbody>
        @foreach ($buku as $index=>$bk)
        <tr>
            <td align="center" scope="row">{{ $index + $buku->firstItem() }}</td>
            <td>{{$bk->id_buku}}</td>
            <td>{{$bk->kode_buku}}</td>
            <td>{{$bk->judul}}</td>
            <td>{{$bk->pengarang}}</td>
            <td>{{$bk->penerbit}}</td>
            <td>
                <img src="{{Storage::url($bk->image)}}" alt="{{ $bk->judul }}" style="max-width: 60px;">
            </td>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection