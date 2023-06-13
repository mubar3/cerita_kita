@extends('master.master')

@section('berandaActive','active')

@section('konten')

{{-- start navigasi --}}
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Penjualan Harian</h5>
                <div id="chartph" ></div>
                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Penjualan Produk</h5>
                <div id="chartpp" ></div>
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
    var options = {
        chart: {
    height: 'auto',
    width: '100%',
            type: 'bar'
        },
        series: [{
            name: 'penjualan',
            data: @json($value_ph)
        }],
        xaxis: {
            categories: @json($label_ph)
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
            data: @json($value_pp)
        }],
        xaxis: {
            categories: @json($label_pp)
        }
    }

    var chart = new ApexCharts(document.querySelector("#chartpp"), options);

    chart.render();
</script>



<style>
    .week-range{
        margin-top: 5px;
        font-size: .7rem !important;
        color: #242424;
        font-weight: normal;
    }
</style>

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" crossorigin="anonymous"></script>

@endsection