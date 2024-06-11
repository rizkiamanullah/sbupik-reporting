<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function WoM($date)
    {
        $num = 1;
        for ($d = 1; $d < cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')) + 1; $d++) {
            if (date('N', strtotime(date('Y-m-' . $d))) == 6) {
                $num += 1;
            }
            if (date('Y-m-' . $d) == date('Y-m-d')) {
                break;
            }
        }
        return $num;
    }
}
