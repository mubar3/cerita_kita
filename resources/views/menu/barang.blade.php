@php
// $title_web='Kirim Pesan WA'
@endphp
@extends('master.master')

@section('berandaActive','active')
{{-- @section('page_title', $title) --}}

@section('konten')

{{-- start navigasi --}}
<div class="row">
    <div class="col-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Barang</label>
                    <select name="no_hp" id="select_barang" class="select4 form-control" required>
                            <option value="" >Pilih barang</option>
                            @foreach($barang as $data)    
                                <option value="{{$data->id}}" >{{$data->nama}}</option>
                            @endforeach
                    </select> 
                    <br>
                    <br>
                    
                    <table id="daftar_barang" class="table table-light table-striped dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <br>
                    <div class="mt-3">
                        <button id="send" type="submit" class="btn btn-primary btn-sm"> Kirim</button>
                    </div>
                </div>
            </div>

        </ul>
    </div>
</div>                
    </div>
</div>

{{-- end navigasi --}}
<input type="hidden" name="page5">

@endsection

@section('my-script')
<style>
    .week-range{
        margin-top: 5px;
        font-size: .7rem !important;
        color: #242424;
        font-weight: normal;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(e) {   
        $('#select_barang').on('change', function() {
            // console.log('ss')
            $('#daftar_barang tbody').empty();
            $('#daftar_barang').append($('<tr>')
                .append($('<td>').append(this.value))
                .append($('<td>').append("text2"))
                .append($('<td>').append("text3"))
                );
        });
    });
</script>

@endsection

    

