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
        <div class="form-group">
            <form method="POST" action="{{ url('/save_kupon') }}"  enctype="multipart/form-data"  >
                @csrf
                <input type="file" name="kupon" class="form-control" required>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary btn-sm"> buat</button>
                </div>
                
            </form>
            <div class="mt-3">
                <a href="{{ url('/cetak_kupon') }}" target='_blank'>
                    <button  class="btn btn-primary btn-sm"> cetak 50 kupon</button>
                </a>
            </div>
        </div>
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

@endsection

    

