<?php

namespace App\Http\Controllers;

use App\Exports\NewUserNAExport;
use App\Models\BPMember;
use App\Models\wa;
use App\Models\api_was;
use App\Models\contact;
use App\Models\sending;
use App\Models\MobileAgent;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Http;
use Validator;
use Illuminate\Support\Facades\Auth;
// use Excel;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $ph=Db::table('toko2barang_trans')
            ->select(
                Db::raw('sum(jumlah) as penjualan'),
                Db::raw('DAYNAME(created_at) AS hari'),
            )
            ->groupBy('hari')
            ->orderBy('hari')
            ->get();
        $label_ph=[];
        $value_ph=[];
        foreach ($ph as $key) {
            array_push($label_ph, $this->convertDayToIndonesian($key->hari));
            array_push($value_ph, $key->penjualan);
        }

        $pp=Db::table('toko2barang_trans')
            ->select(
                Db::raw('sum(toko2barang_trans.jumlah) as penjualan'),
                'toko_barangs.nama',
            )
            ->join('toko_barangs','toko_barangs.id','=','toko2barang_trans.barang_id')
            ->groupBy('toko_barangs.nama')
            ->orderBy('toko_barangs.nama')
            ->get();
        $label_pp=[];
        $value_pp=[];
        foreach ($pp as $key) {
            array_push($label_pp, $key->nama);
            array_push($value_pp, $key->penjualan);
        }

        return view('home')->with([
            'tMulai'    => date('Y-m-01'),
            'tAkhir'    => date('Y-m-d'),
            'tmulaiNewuser' => date('Y-m'),
            'page_title'     => $this->title,
            'logo' => $this->logo,
            'label_ph' => $label_ph,
            'value_ph' => $value_ph,
            'label_pp' => $label_pp,
            'value_pp' => $value_pp,
        ]);
    }

    public function barang()
    {
        // return Db::table('toko_barangs')->where('status','y')->get();
        return view('menu.barang')->with([
            'tMulai'    => date('Y-m-01'),
            'tAkhir'    => date('Y-m-d'),
            'tmulaiNewuser' => date('Y-m'),
            'page_title'     => $this->title,
            'logo' => $this->logo,
            'barang' => Db::table('toko_barangs')->where('status','y')->get(),
        ]);
    }

    

    // public function generateUniqueCode()
    // {

    // $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    // $charactersNumber = strlen($characters);
    // $codeLength = 6;

    // $code = '';

    // while (strlen($code) < 6) {
    //     $position = rand(0, $charactersNumber - 1);
    //     $character = $characters[$position];
    //     $code = $code.$character;
    // }

    // if (wa::where('code', $code)->exists()) {
    //     $this->generateUniqueCode();
    // }

    // return $code;

    // }

}
