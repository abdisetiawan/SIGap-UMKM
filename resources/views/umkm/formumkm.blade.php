@extends('layouts.master')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="/umkm/create" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group {{$errors->has('nama_umkm') ? 'has-error' : ''}}">
                                <label for="nama_umkm">Nama UMKM</label>
                                <input name="nama_umkm" type="text" class="form-control" id="nama_umkm"
                                    placeholder="Nama UMKM" autocomplete="off" value="{{old('nama_umkm')}}">
                                @if($errors->has('nama_umkm'))
                                <span class="help-block">{{$errors->first('nama_umkm')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="kecamatan_id">Kecamatan</label>
                                <select class="form-control" id="kecamatan_id" name="kecamatan_id">
                                    @foreach($kecamatan as $kcmtn)
                                    <option value="{{$kcmtn->id}}">{{$kcmtn->nama_kcmtn}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kelurahan_id">Kelurahan</label>
                                <select class="form-control" id="kelurahan_id" name="kelurahan_id">
                                    @foreach($kelurahan as $klrhn)
                                    <option value="{{$klrhn->id}}">{{$klrhn->nama_klrhn}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kategori_id">Kategori</label>
                                <select class="form-control" id="kategori_id" name="kategori_id">
                                    @foreach($kategori as $ktgr)
                                    <option value="{{$ktgr->id}}">{{$ktgr->nama_ktgr}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}"">
                                <label for=" alamat">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat" rows="3"
                                    autocomplete="off">{{old('alamat')}}</textarea>
                                @if($errors->has('alamat'))
                                <span class="help-block">{{$errors->first('alamat')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('keterangan') ? 'has-error' : ''}}"">
                                <label for=" keterangan">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="keterangan" rows="3"
                                    autocomplete="off">{{old('keterangan')}}</textarea>
                                @if($errors->has('keterangan'))
                                <span class="help-block">{{$errors->first('keterangan')}}</span>
                                @endif
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class='gllpLatlonPicker'>
                            <div class='gllpMap'></div>
                            <div class="fomr-group">
                                <label for="titik_lat">Latitude</label>
                                <input type='text' name='titik_lat' class='gllpLatitude form-control' value='-7.78992'
                                    readonly />
                            </div>
                            <div class="fomr-group">
                                <label for="titik_long">Longitude</label>
                                <input type='text' name='titik_long' class='gllpLongitude form-control'
                                    value='110.37284' readonly />
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="/umkmsaya" class="btn btn-secondary">Close</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer')
<script>
    $(document).ready(function () {
        $('select[name="kecamatan_id"]').on('change', function () {
            var kecamatan_id = $(this).val();
            if (kecamatan_id) {
                $.ajax({
                    url: '/ambilkelurahan/' + kecamatan_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);

                        $('select[name="kelurahan_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="kelurahan_id"]')
                                .append('<option value="' + value.id + '">' + value
                                    .nama_klrhn + '</option>');
                        });
                    }
                })
            } else {
                $('select[name="kelurahan_id"]').empty();
            }
        });
    });
</script>
@stop
