
@php
    $i=1;
@endphp
@foreach ( $qr as $data )
    <div style=" margin-left: 0px;  
        float: left;  
        /* margin-right: 30px;  */
        margin-top:-4px;
        width: 580px;
        height: 110px;
        margin-bottom: 6px;
        background-size: 580px 110px;
        background-image: url({{ asset('kupon'.Auth::user()->id.'.png') }});
        ">
            <div style="border: 2px solid white; 
                border-radius: 5px; 
                position: absolute;
                margin-left: 76px;
                margin-top: 20px; 
                overflow: hidden;" class="img-responsive img" >
                {!! QrCode::size(65)->generate(url('/get_kupon').'/'.$data->qr); !!}
            </div>
    </div>
    
    @if ($i % 60 == 0)
    <div style="page-break-before: always; padding-top:30px"></div>
    @endif
    @php
        $i++;
    @endphp
@endforeach