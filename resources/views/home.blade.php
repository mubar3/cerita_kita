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
                <div id="loading">
                    <img width="20%" src="{{ url('storage/'.'loading.gif' )}}" alt="userr">
                </div>
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

    var chart = new ApexCharts(document.querySelector("#chartph"), options);

    chart.render();
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
        $('#loading').show();
        
        $.ajax({
            type : 'post',
            url : '{{ url('/api/get_penjualan_harian') }}',
            data : {
                toko_id : this.value,
            },
            success : function(data){
                if(data.status){
                    chart.updateOptions({
                        series: [{
                            name: 'penjualan',
                            data: data.value
                        }],
                        xaxis: {
                            categories: data.label
                        }
                    });
                }else{
                    chart.updateOptions({
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
                toko_id : this.value,
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
                toko_id : this.value,
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

    });
</script>

@endsection