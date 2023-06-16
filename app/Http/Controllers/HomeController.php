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
use App\Models\Toko_user;
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
        return view('home')->with([
            'tMulai'    => date('Y-m-01'),
            'tAkhir'    => date('Y-m-d'),
            'tmulaiNewuser' => date('Y-m'),
            'page_title'     => $this->title,
            'logo' => $this->logo,
            'logo2' => $this->logo2,
            'tokos' => Toko_user::select(
                        'tokos.*'
                    )
                    ->join('tokos','tokos.id','=','toko_users.toko_id')
                    ->where('toko_users.user_id',Auth::user()->id)
                    ->where('toko_users.status','y')
                    ->get(),
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
            'logo2' => $this->logo2,
            'tokos' => Toko_user::select(
                        'tokos.*'
                    )
                    ->join('tokos','tokos.id','=','toko_users.toko_id')
                    ->where('toko_users.user_id',Auth::user()->id)
                    ->where('toko_users.status','y')
                    ->get(),
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
