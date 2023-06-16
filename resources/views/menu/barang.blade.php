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
                    <div id="loading">
                        <img width="20%" src="{{ url('storage/'.'loading.gif' )}}" alt="userr">
                    </div>
                    <h5 class="card-title">Toko</h5>
                    <select id="toko" class="select4 form-control" required>
                        <option value="" >Pilih Toko</option>
                        @foreach($tokos as $data)
                        <option value="{{$data->id}}" >{{$data->nama}}</option>
                        @endforeach
                    </select> 
                    <br>
                    <br>
                    <h5 class="card-title">Barang</h5>
                    <select name="no_hp" id="select_barang" class="select4 form-control" required>
                            <option value="" >Pilih barang</option>
                    </select> 
                    <br>
                    <br>
                    <div class="mt-3">
                        <button id="tambah" class="btn btn-primary btn-sm"> tambah</button>
                    </div>
                    
                    <table id="daftar_barang" class="table table-light table-striped dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Bahan</th>
                                <th scope="col">Takaran (Gr/cup)</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="alert" role="alert"></div>
                    <br>
                    <div class="mt-3">
                        <button id="send" class="btn btn-primary btn-sm"> update</button>
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
    $('#loading').hide();
    $(document).ready(function(e) {   
        
        $('#daftar_barang').on('click', '.delete-row', function() {
            // Find the parent row and remove it
            $(this).closest('tr').remove();
        });
        $('#tambah').on('click', function() {
            $('#loading').show();
            // console.log('ss')
            $.ajax({
                type : 'post',
                url : '{{ url('/api/get_bahan') }}',
                data : {
                    barang_id : $('#select_barang').val(),
                    toko_id : $('#toko').val(),
                },
                success : function(data){
                    if(data.status){
                        // atur select
                        var select='<select name="bahan[]">';
                        (data.data_bahan).forEach(key => {
                            // console.log(key)
                            select=select+'<option value="'+key.id+'">'+key.nama+'</option>'
                        });
                        select=select+'</select>';
                        $('#daftar_barang').append($('<tr>')
                            .append($('<td>').append(
                                // '<input type="text" value="'+element.nama+'">'
                                select
                            ))
                            .append($('<td>').append(
                                '<input type="text" name="takar[]">'
                            ))
                            .append($('<td>').append(
                                '<button class="delete-row">Delete</button>'
                            ))
                            );
                    }
                },
            });
            $('#loading').hide();
        });
        $('#select_barang').on('change', function() {
            $('#loading').show();
            // console.log('ss')
            show_bahan(this.value)

            $('#loading').hide();
        });
    });

    function show_bahan(barang_id) {
        $.ajax({
            type : 'post',
            url : '{{ url('/api/get_bahan') }}',
            data : {
                barang_id : barang_id,
                toko_id : $('#toko').val(),
            },
            success : function(data){
                if(data.status){
                    $('#daftar_barang tbody').empty();
                    (data.data).forEach(element => {
                        // atur select
                        var select='<select name="bahan[]">';
                        (data.data_bahan).forEach(key => {
                            // console.log(key)
                            if(key.id == element.bahan_id){
                                select=select+'<option value="'+key.id+'" selected>'+key.nama+'</option>'
                            }else{
                                select=select+'<option value="'+key.id+'">'+key.nama+'</option>'
                            }
                        });
                        select=select+'</select>';
                        $('#daftar_barang').append($('<tr>')
                            .append($('<td>').append(
                                // '<input type="text" value="'+element.nama+'">'
                                select
                            ))
                            .append($('<td>').append(
                                '<input type="text" name="takar[]" value="'+element.takar_gr+'">'
                            ))
                            .append($('<td>').append(
                                '<button class="delete-row">Delete</button>'
                            ))
                            );
                    });
                }else{
                    $('#daftar_barang tbody').empty();
                }
            },
        });
        
    }
    
    $('#toko').change(function() {
        $('#loading').show();

        $.ajax({
            type : 'post',
            url : '{{ url('/api/get_barang') }}',
            data : {
                toko_id : this.value,
            },
            success : function(data){
                if(data.status){
                    (data.data).forEach(element => {
                        $('#select_barang').append($('<option>').text(element.nama).val(element.id));
                    });
                    $('#daftar_barang tbody').empty();
                }else{
                    $('#select_barang').empty();
                    $('#daftar_barang tbody').empty();
                }
                $('#loading').hide();
            },
        });

    });
    
    $('#send').on('click', function() {
        // takar value
        var takarValues = [];
        $('input[name="takar[]"]').each(function() {
            takarValues.push($(this).val());
        });
        // bahan value
        var bahanValues = [];
        $('select[name="bahan[]"]').each(function() {
            bahanValues.push($(this).val());
        });

        $('#loading').show();

        $.ajax({
            type : 'post',
            url : '{{ url('/api/save_bahan') }}',
            data : {
                takar : takarValues,
                bahan : bahanValues,
                barang_id : $('#select_barang').val()
            },
            success : function(data){
                $('.alert').removeClass('alert-success');
                $('.alert').removeClass('alert-danger');
                // console.log(data)
                if(data.status){
                    show_bahan($('#select_barang').val())
                    $('.alert').addClass('alert-success').html(data.message);
                }else{
                    show_bahan($('#select_barang').val())
                    $('.alert').addClass('alert-danger').html(data.message);

                }
                setTimeout(function() {
                    $('.alert').removeClass('alert-success');
                    $('.alert').removeClass('alert-danger');
                    $('.alert').html('')
                }, 2000);
                $('#loading').hide();
            },
        });
    });
</script>

@endsection

    

