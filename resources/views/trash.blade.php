@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1>Data Buku</h1>
@stop

@section('content')

<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            {{ __('pengelolaan Buku')}}
        </div>
        <div class="card-body">
            <div class="btn btn-group">
                <form id="form-restore-all" action="{{route('admin.restore.all')}}" method="post">
                    @csrf
                    <button type="button" id="btn-restore-all" class="btn btn-primary">
                        Restore All <i class="fa fa-plus"></i>
                    </button>
                </form>
                <form id="form-delete-all" action="{{route('admin.empty')}}" method="post">
                    @csrf
                    @method('delete')
                    <button id="btn-delete-all" class="btn btn-danger" type="submit">Hapus Semua <i
                            class="fa fa-recycle"></i> </button>
                </form>
            </div>
            <hr />
            <table id="my-table" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>JUDUL</th>
                        <th>PENULIS</th>
                        <th>TAHUN</th>
                        <th>PENERBIT</th>
                        <th>COVER</th>
                        <th>ASLI</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp
                    @foreach($books as $book)
                    <tr class="text-center">
                        <td>{{$no++}}</td>
                        <td>{{$book->judul}}</td>
                        <td>{{$book->penulis}}</td>
                        <td>{{$book->tahun}}</td>
                        <td>{{$book->penerbit}}</td>
                        <td>
                            @if($book->cover !== null) <img src="{{asset('storage/cover_buku/'.$book->cover)}}" width="100px"/>
                            @else
                                [Garbar tidak tersedia]
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form id="restore" action="/trash/restore/{{$book->id}}" method="post">
                                    @csrf
                                    <button type="button" id="btn-restore" class="btn btn-success">Kembalikan
                                        Data</button>
                                </form>
                                <form id="delete" action="/trash/destroy/{{$book->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" id="btn-delete" class="btn btn-danger">Hapus
                                        Permanen</button>
                                </form>
                            </div>
                        </td>
                    
                    </tr>    
                    @endforeach
                </tbody>
                

            </table>
        </div>
    </div>
</div>
@stop
@section('adminlte_js')
<script>
    $(function () {
        $(document).on('click', '#btn-delete', function () {
            var form = event.target.form;
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Kamu tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
        $(document).on('click', '#btn-restore-all', function () {
            var x = $('#form-restore-all');
            event.preventDefault();
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Ingin Mengembalikan Semua Data Yang Ada Di Recycle Bin?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kembalikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    x.submit();
                }
            })
        });
        $(document).on('click', '#btn-restore', function () {
            var form = event.target.form;
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Ingin Mengembalikan Data Buku Ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kembalikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#restore').submit();
                }
            })
        });
        $(document).on('click', '#btn-delete-all', function () {
            event.preventDefault();
            Swal.fire({
                title: 'Apa kamu yakin?',
                html: "Ingin Mengosongkan Recycle Bin? <br> <strong>Data Tidak Dapat Dikembalikan!</strong>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-delete-all').submit();
                }
            })
        });
    });
</script>
@endsection