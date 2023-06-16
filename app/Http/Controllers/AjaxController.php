<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class AjaxController extends Controller
{
    public function get_penjualan_harian(Request $data)
    {
        $validator = Validator::make($data->all(),[
            'toko_id' => 'required'
        ]);
        if($validator->fails()){      
            return response()->json(['status'=>false,'message'=>$validator->errors()]);
        }

        $ph=Db::table('toko2barang_trans')
            ->select(
                Db::raw('sum(toko2barang_trans.jumlah) as penjualan'),
                Db::raw('DAYNAME(toko2barang_trans.created_at) AS hari'),
            )
            ->join('toko2_trans','toko2_trans.id','=','toko2barang_trans.trans_id')
            ->where('toko2_trans.toko_id',$data->toko_id)
            ->groupBy('hari')
            ->orderBy('hari')
            ->get();
        $label_ph=[];
        $value_ph=[];
        foreach ($ph as $key) {
            array_push($label_ph, $this->convertDayToIndonesian($key->hari));
            array_push($value_ph, $key->penjualan);
        }

        // DB::beginTransaction();
        try {

            // DB::commit();
            return response()->json(['status'=>true, 'label'=>$label_ph, 'value'=>$value_ph]);
        } catch (Exception $e) {
            // DB::rollBack();
            return response()->json(['status'=>false,'message'=>'Terjadi Kesalahan dalam penyimpanan data']);
        }
    }

    public function get_penjualan_produk(Request $data)
    {
        $validator = Validator::make($data->all(),[
            'toko_id' => 'required'
        ]);
        if($validator->fails()){      
            return response()->json(['status'=>false,'message'=>$validator->errors()]);
        }

        $pp=Db::table('toko2barang_trans')
            ->select(
                Db::raw('sum(toko2barang_trans.jumlah) as penjualan'),
                'toko_barangs.nama',
            )
            ->join('toko_barangs','toko_barangs.id','=','toko2barang_trans.barang_id')
            ->join('toko2_trans','toko2_trans.id','=','toko2barang_trans.trans_id')
            ->where('toko2_trans.toko_id',$data->toko_id)
            ->groupBy('toko_barangs.nama')
            ->orderBy('toko_barangs.nama')
            ->get();
        $label_pp=[];
        $value_pp=[];
        foreach ($pp as $key) {
            array_push($label_pp, $key->nama);
            array_push($value_pp, $key->penjualan);
        }

        // DB::beginTransaction();
        try {

            // DB::commit();
            return response()->json(['status'=>true, 'label'=>$label_pp, 'value'=>$value_pp]);
        } catch (Exception $e) {
            // DB::rollBack();
            return response()->json(['status'=>false,'message'=>'Terjadi Kesalahan dalam penyimpanan data']);
        }
    }
}
