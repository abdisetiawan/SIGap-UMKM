@extends('layouts.master')
@section('content')
@if(session('sukses'))
<div class="alert alert-success" role="alert">
    {{session('sukses')}}
</div>
@endif
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data Kategori UMKM</h3>
                        @if(auth()->user()->role == 'admin')
                        <div class="right">
                            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i
                                    class="lnr lnr-plus-circle"></i></button>
                        </div>
                        @endif
                    </div>
                    <div class="panel-body text-wrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    @if(auth()->user()->role == 'admin')
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $no = 0;?>
                                    @foreach($data_kategori as $kategori)
                                    <?php $no++ ;?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$kategori->nama_ktgr}}</td>
                                    @if(auth()->user()->role == 'admin')
                                    <td>
                                        <a href="/kategori/{{$kategori->id}}/edit"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm delete"
                                            kategori-id="{{$kategori->id}}">Delete</a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Data kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/kategori/create" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group {{$errors->has('nama_ktgr') ? 'has-error' : ''}}">
                        <label for="nama_ktgr">Nama Kategori</label>
                        <input name="nama_ktgr" type="text" class="form-control" id="nama_ktgr"
                            placeholder="Nama Kategori" autocomplete="off" value="{{old('nama_ktgr')}}">
                        @if($errors->has('nama_ktgr'))
                        <span class="help-block">{{$errors->first('nama_ktgr')}}</span>
                        @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
<script>
    $('.delete').click(function () {
        var kategori_id = $(this).attr('kategori-id');
        swal({
                title: "Apakah anda yakin?",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                console.log(willDelete);
                if (willDelete) {
                    window.location = "/kategori/" + kategori_id + "/delete";
                }
            });
    });

</script>
@stop
