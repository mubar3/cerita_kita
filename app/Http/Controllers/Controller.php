<?php

namespace App\Http\Controllers;

use App\Models\Qr_code;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $title='Cerita Kita';
    public $logo='logo.jpg';
    public $logo2='logo2.jpg';

    function convertDayToIndonesian($day) {
        $englishDays = array(
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        );
        
        $indonesianDays = array(
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );
        
        $index = array_search($day, $englishDays);
        
        if ($index !== false) {
            return $indonesianDays[$index];
        } else {
            return 'Invalid day';
        }
    }

    public function get_session()
    {
        $code=Session::getId();
        if (Db::table('users')->where('session', $code)->exists()) {
            $this->get_session();
        }
        return $code;   
    }

    public function generateQrCode()
    {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);

        $code = '';

        while (strlen($code) < 10) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if(Qr_code::where('qr',$code)->first()){
            $this->generateQrCode();
        }else{
            return $code;
        }

    }

    public function get_kupon($qr)
    {
        return view('menu.kupon_cek')->with([
            'qr' => Qr_code::where('qr',$qr)->first()
        ]);   
    }

    public function update_kupon(Request $data)
    {
        Qr_code::where('qr',$data->qr)->update(['respon' => $data->input]);
        return $this->get_kupon($data->qr);
    }
}
