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
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBukuModal">
                    <i class="fa da-plus"></i>Restore All
                </button>
                 <a href="{{route('admin.print.books')}}" target="blank" class="btn btn-secondary"><i class="fa fa-trash">Dellet All</i></a>

            <hr/>
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
                    <tr>
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
                            <div class="btn-grup" role="group" aria-label="Basic example">
                                <button type="button" id="btn-edit-buku" class="btn btn-success" data-toggle="modal"
                                data-target="#editBukuModal" data-id="{{$book->id}}">Restore</button>
                                <button type="button" id="btn-delete-buku" class="btn btn-danger" onclick="hapus('{{$book->id}}','{{$book->judul}}')">Dellet Permanet</button>
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