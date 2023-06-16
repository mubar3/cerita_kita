<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
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
}
