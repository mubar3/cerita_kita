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
            'toko_id' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
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
            ->join('toko_barangs','toko_barangs.id','=','toko2barang_trans.barang_id')
            ->where('toko_barangs.is_produk','y')
            ->where('toko2_trans.toko_id',$data->toko_id)
            ->whereBetween('toko2_trans.created_at',[$data->tanggal_awal,Carbon::parse($data->tanggal_akhir)->addDay()])
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
            'toko_id' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
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
            ->where('toko_barangs.is_produk','y')
            ->where('toko2_trans.toko_id',$data->toko_id)
            ->whereBetween('toko2_trans.created_at',[$data->tanggal_awal,Carbon::parse($data->tanggal_akhir)->addDay()])
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
    public function get_penjualan_jam(Request $data)
    {
        $validator = Validator::make($data->all(),[
            'toko_id' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
        ]);
        if($validator->fails()){      
            return response()->json(['status'=>false,'message'=>$validator->errors()]);
        }

        $pj=Db::table('toko2barang_trans')
            ->select(
                Db::raw('sum(toko2barang_trans.jumlah) as penjualan'),
                // Db::raw('HOUR(toko2barang_trans.created_at) AS jam'),
                Db::raw('DATE_FORMAT(toko2barang_trans.created_at, "%H : 00") AS jam'),
            )
            ->join('toko2_trans','toko2_trans.id','=','toko2barang_trans.trans_id')
            ->join('toko_barangs','toko_barangs.id','=','toko2barang_trans.barang_id')
            ->where('toko_barangs.is_produk','y')
            ->where('toko2_trans.toko_id',$data->toko_id)
            ->whereBetween('toko2_trans.created_at',[$data->tanggal_awal,Carbon::parse($data->tanggal_akhir)->addDay()])
            ->groupBy('jam')
            ->orderBy('jam')
            ->get();
        $label_pj=[];
        $value_pj=[];
        foreach ($pj as $key) {
            array_push($label_pj, $key->jam);
            array_push($value_pj, $key->penjualan);
        }

        // DB::beginTransaction();
        try {

            // DB::commit();
            return response()->json(['status'=>true, 'label'=>$label_pj, 'value'=>$value_pj]);
        } catch (Exception $e) {
            // DB::rollBack();
            return response()->json(['status'=>false,'message'=>'Terjadi Kesalahan dalam penyimpanan data']);
        }
    }

    public function get_barang(Request $data)
    {
        $validator = Validator::make($data->all(),[
            'toko_id' => 'required'
        ]);
        if($validator->fails()){      
            return response()->json(['status'=>false,'message'=>$validator->errors()]);
        }

        $barang=Db::table('toko_barangs')->where('toko_id',$data->toko_id)->get();

        // DB::beginTransaction();
        try {

            // DB::commit();
            return response()->json(['status'=>true, 'data'=>$barang]);
        } catch (Exception $e) {
            // DB::rollBack();
            return response()->json(['status'=>false,'message'=>'Terjadi Kesalahan dalam penyimpanan data']);
        }
    }

    public function get_bahan(Request $data)
    {
        $validator = Validator::make($data->all(),[
            'barang_id' => 'required',
            'toko_id' => 'required',
        ]);
        if($validator->fails()){      
            return response()->json(['status'=>false,'message'=>$validator->errors()]);
        }

        $bahan=Db::table('stok_bahans')
            ->select(
                'stok_bahans.*',
                'bahans.nama',
            )   
            ->join('bahans','bahans.id','=','stok_bahans.bahan_id')
            ->where('stok_bahans.barang_id',$data->barang_id)
            ->get();

        $data_bahan=Db::table('bahans')->where('toko_id',$data->toko_id)->get();

        // DB::beginTransaction();
        try {

            // DB::commit();
            return response()->json(['status'=>true, 'data'=>$bahan, 'data_bahan'=>$data_bahan]);
        } catch (Exception $e) {
            // DB::rollBack();
            return response()->json(['status'=>false,'message'=>'Terjadi Kesalahan dalam penyimpanan data']);
        }
    }

    public function save_bahan(Request $data) 
    {
        $validator = Validator::make($data->all(),[
            'takar' => 'required',
            'bahan' => 'required',
            'barang_id' => 'required',
        ]);
        if($validator->fails()){      
            return response()->json(['status'=>false,'message'=>$validator->errors()]);
        }
        // return $data->takar[1];
        
        DB::beginTransaction();
        try {
            $bahan=Db::table('stok_bahans')->where('barang_id',$data->barang_id)->delete();
            for ($i=0; $i < count($data->takar); $i++) { 
                Db::table('stok_bahans')->insert([
                    'bahan_id' => $data->bahan[$i],
                    'barang_id' => $data->barang_id,
                    'takar_gr' => $data->takar[$i],
                ]);
            }

            DB::commit();
            return response()->json(['status'=>true, 'message'=>'Berhasil']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>false,'message'=>'Terjadi Kesalahan dalam penyimpanan data']);
        }
    }

    public function report(Request $data)  
    {
        $validator = Validator::make($data->all(),[
            'toko_id' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'keuntungan' => 'required',
        ]);
        if($validator->fails()){      
            return response()->json(['status'=>false,'message'=>$validator->errors()]);
        }
        
        // DB::beginTransaction();
        try {
            $user=Db::table('users')
                ->where('toko_id',$data->toko_id)
                ->where('jenis','utama')
                ->where('tipe','mobile')
                ->first();
            if(!$user){
                $session=$this->get_session();
                $user->update([
                    'session' => $session
                ]);
            }else{
                $session=$user->session;
            }

            try {
                $response = Http::post(env('WS_URL').'/api/report', [
                    'session' => $session,
                    'tanggal_awal' => $data->tgl_awal,
                    'tanggal_akhir' => $data->tgl_akhir,
                    'keuntungan' => $data->keuntungan,
                ]);
            } catch(\Illuminate\Http\Client\ConnectionException $e)
            {
                return response()->json(['status'=>false, 'message'=>'Terjadi Kesalahan dalam penyimpanan data']);
            }

            $response = json_decode($response);

            // DB::commit();
            return response()->json(['status'=>true, 'data'=>$response]);
        } catch (Exception $e) {
            // DB::rollBack();
            return response()->json(['status'=>false,'message'=>'Terjadi Kesalahan dalam penyimpanan data']);
        }
        
    }
}
