@extends('master.master')

@section('berandaActive','active')

@section('konten')

{{-- start navigasi --}}
<div class="row">
    {{-- <div class="col-sm-4">
    </div> --}}
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Toko</h5>
                <select id="toko" class="select4 form-control" required>
                    <option value="" >Pilih Toko</option>
                    @foreach($tokos as $data)
                    <option value="{{$data->id}}" >{{$data->nama}}</option>
                    @endforeach
                </select> 
                <br>
                <br>
                <h5 class="card-title">Tanggal awal</h5>
                <input id="tgl_awal" type="date" class="form-control">
                <br>
                <h5 class="card-title">Tanggal akhir</h5>
                <input id="tgl_akhir" type="date" class="form-control">
                <br>
                <h5 class="card-title">Keuntungan (%)</h5>
                <input id="keuntungan" type="text" class="form-control" value="50">
                <div id="loading">
                    <img width="20%" src="{{ url('storage/'.'loading.gif' )}}" alt="userr">
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Report</h5>
                <table>
                    <tr>
                        <td>Keuntungan Bersih</td>
                        <td>:</td>
                        <td id="keuntungan_bersih">0</td>
                    </tr>
                    <tr>
                        <td>Keuntungan Kotor</td>
                        <td>:</td>
                        <td id="keuntungan_kotor">0</td>
                    </tr>
                    <tr>
                        <td>Sewa</td>
                        <td>:</td>
                        <td id="sewa">0</td>
                    </tr>
                    <tr>
                        <td>Gaji karyawan</td>
                        <td>:</td>
                        <td id="gaji">0</td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Penjualan Harian</h5>
                <div id="chartph" ></div>
                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Penjualan Produk</h5>
                <div id="chartpp" ></div>
                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Penjualan / jam</h5>
                <div id="chartpj" ></div>
                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
        </div>
    </div>
</div>
{{-- <div class="row">
</div> --}}
{{-- end navigasi --}}

@endsection

@section('my-script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    
    // date in day 1
    document.getElementById('tgl_awal').valueAsDate = new Date(new Date().getFullYear()+'-'+new Date().getMonth()+'-'+1+' 12:00');
    document.getElementById('tgl_akhir').valueAsDate = new Date();
    
    $('#loading').hide();

    var options = {
        chart: {
    height: 'auto',
    width: '100%',
            type: 'bar'
        },
        series: [{
            name: 'penjualan',
            data: []
        }],
        xaxis: {
            categories: []
        }
    }

    var chart0 = new ApexCharts(document.querySelector("#chartph"), options);

    chart0.render();
</script>
<script>
    var options = {
        chart: {
    height: 'auto',
    width: '100%',
            type: 'bar'
        },
        series: [{
            name: 'penjualan',
            data: []
        }],
        xaxis: {
            categories: []
        }
    }

    var chart1 = new ApexCharts(document.querySelector("#chartpp"), options);

    chart1.render();
</script>
<script>
    var options = {
        chart: {
    height: 'auto',
    width: '100%',
            type: 'bar'
        },
        series: [{
            name: 'penjualan',
            data: []
        }],
        xaxis: {
            categories: []
        }
    }

    var chart2 = new ApexCharts(document.querySelector("#chartpj"), options);

    chart2.render();
</script>


<style>
    .week-range{
        margin-top: 5px;
        font-size: .7rem !important;
        color: #242424;
        font-weight: normal;
    }
</style>

<script type="text/javascript">
    $('#toko').change(function() {
        chart()
        report()
    });
    $("#tgl_awal").change(function() {
        chart()
        report()
    });
    $("#tgl_akhir").change(function() {
        chart()
        report()
    });
    $("#keuntungan").change(function() {
        chart()
        report()
    });


    function chart(){
        $('#loading').show();
        
        $.ajax({
            type : 'post',
            url : '{{ url('/api/get_penjualan_harian') }}',
            data : {
                toko_id : $('#toko').val(),
                tanggal_awal : $('#tgl_awal').val(),
                tanggal_akhir : $('#tgl_akhir').val(),
            },
            success : function(data){
                // console.log(data)
                if(data.status){
                    chart0.updateOptions({
                        series: [{
                            name: 'penjualan',
                            data: data.value
                        }],
                        xaxis: {
                            categories: data.label
                        }
                    });
                }else{
                    chart0.updateOptions({
                        series: [{
                            name: 'penjualan',
                            data: []
                        }],
                        xaxis: {
                            categories: []
                        }
                    });
                }
                $('#loading').hide();
            },
        });
        
        $.ajax({
            type : 'post',
            url : '{{ url('/api/get_penjualan_produk') }}',
            data : {
                toko_id : $('#toko').val(),
                tanggal_awal : $('#tgl_awal').val(),
                tanggal_akhir : $('#tgl_akhir').val(),
            },
            success : function(data){
                if(data.status){
                    chart1.updateOptions({
                        series: [{
                            name: 'penjualan',
                            data: data.value
                        }],
                        xaxis: {
                            categories: data.label
                        }
                    });
                }else{
                    chart1.updateOptions({
                        series: [{
                            name: 'penjualan',
                            data: []
                        }],
                        xaxis: {
                            categories: []
                        }
                    });
                }
                $('#loading').hide();
            },
        });
        
        $.ajax({
            type : 'post',
            url : '{{ url('/api/get_penjualan_jam') }}',
            data : {
                toko_id : $('#toko').val(),
                tanggal_awal : $('#tgl_awal').val(),
                tanggal_akhir : $('#tgl_akhir').val(),
            },
            success : function(data){
                // console.log(data)
                if(data.status){
                    chart2.updateOptions({
                        series: [{
                            name: 'penjualan',
                            data: data.value
                        }],
                        xaxis: {
                            categories: data.label
                        }
                    });
                }else{
                    chart2.updateOptions({
                        series: [{
                            name: 'penjualan',
                            data: []
                        }],
                        xaxis: {
                            categories: []
                        }
                    });
                }
                $('#loading').hide();
            },
        });
    }
    function report() {
        $('#loading').show();
        $.ajax({
            type : 'post',
            url : '{{ url('/api/report') }}',
            data : {
                // toko_id : this.value,
                toko_id : $('#toko').val(),
                tgl_awal : $('#tgl_awal').val(),
                tgl_akhir : $('#tgl_akhir').val(),
                keuntungan : $('#keuntungan').val(),
            },
            success : function(data){
                if(data.status){
                    // console.log(data)
                    $('#keuntungan_bersih').html(formatRp(data.data.keuntungan_bersih))
                    $('#keuntungan_kotor').html(formatRp(data.data.keuntungan_kotor))
                    $('#sewa').html(formatRp(data.data.biaya_sewa))
                    $('#gaji').html(formatRp(data.data.total_gaji))
                }else{
                    $('#keuntungan_bersih').html('0')
                    $('#keuntungan_kotor').html('0')
                    $('#sewa').html('0')
                    $('#gaji').html('0')

                }
                $('#loading').hide();
            },
        });
    }

    function formatRp(amount, locale = "id-ID", currency = "IDR") {
        const number = parseFloat(amount);
        return number.toLocaleString(locale, {
        style: "currency",
        currency: currency,
        });
    }
</script>

@endsection