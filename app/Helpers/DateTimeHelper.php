<?php

namespace App\Helpers;

class DateTimeHelper {
    public static function timeAgo($date)
    {
        if($date==null){ return '-'; }
        date_default_timezone_set('UTC');
        $diff_time= \Carbon\Carbon::createFromTimeStamp(strtotime($date))->diffForHumans();
        return $diff_time;
    }
    public static function dateAgo($date,$type2='')
    {
        if($date==null || $date=='0000-00-00 00:00:00'){ return '-'; }
        $diff_time1= \Carbon\Carbon::createFromTimeStamp(strtotime($date))->diffForHumans();
        $datetime = new \DateTime($date);
        $datetime->setTimezone(new \DateTimeZone(\Auth::check() ? \Auth::user()->time_zone ?? 'UTC' : 'UTC'));
        $diff_time= \Carbon\Carbon::parse($datetime->format('Y-m-d H:i:s'))->isoFormat('LLL');
        if($type2 != ''){ return $diff_time; }
        return $diff_time1 .' on '.$diff_time;
    }

    public static function date($date, $format = 'd-m-Y H:i:s')
    {
        if($date==null || $date=='0000-00-00 00:00:00'){ return '-'; }
        $datetime = new \DateTime($date);
        $la_time = new \DateTimeZone(\Auth::check() ? \Auth::user()->time_zone ?? 'UTC' : 'UTC');
        $datetime->setTimezone($la_time);
        $newDate= $datetime->format('Y-m-d H:i:s');
        $diff_time = \Carbon\Carbon::createFromTimeStamp(strtotime($newDate))->format($format);
        return $diff_time;
    }

    public static function saveDate($date)
    {
        if($date==null || $date=='0000-00-00 00:00:00'){ return null; }
        $datetime = new \DateTime($date);
        $la_time = new \DateTimeZone(\Auth::check() ? \Auth::user()->time_zone ?? 'UTC' : 'UTC');
        $datetime->setTimezone($la_time);
        $newDate= $datetime->format('Y-m-d H:i:s');
        $diff_time = \Carbon\Carbon::createFromTimeStamp(strtotime($newDate));
        return $diff_time;
    }
    public static function strtotimeToDate($date)
    {
        if($date==null || $date=='0000-00-00 00:00:00'){ return '-'; }
        date_default_timezone_set(\Auth::check() ? \Auth::user()->time_zone ?? 'UTC' : 'UTC');
        $diff_time = \Carbon\Carbon::createFromTimeStamp($date);
        return $diff_time;
    }
    public static function getMonthByNumber($month){
        $val="";
        switch ($month){
            case 1:
                $val="Janvier";
                break;
            case 2:
                $val="Fevrier";
                break;
            case 3:
                $val="Mars";
                break;
            case 4:
                $val="Avril";
                break;
            case 5:
                $val="Mai";
                break;
            case 6:
                $val="Juin";
                break;
            case 7:
                $val="Juillet";
                break;
            case 8:
                $val="Aout";
                break;
            case 9:
                $val="Septembre";
                break;
            case 10:
                $val="Octobre";
                break;
            case 11:
                $val="Novembre";
                break;
            case 12:
                $val="Decembre";
                break;
        }
        return $val;
    }
    public static function getDayByNumber($day){
        $val="";
        switch ($day){
            case 1:
                $val="LUN";
                break;
            case 2:
                $val="MAR";
                break;
            case 3:
                $val="MER";
                break;
            case 4:
                $val="JEU";
                break;
            case 5:
                $val="VEND";
                break;
            case 6:
                $val="SAM";
                break;
            case 0:
                $val="DIM";
                break;
        }
        return $val;
    }
    public static function getNextMonth($month,$year){
        if ($month==12){
            return [
                'month'=>1,
                'year'=>intval($year)+1
            ];
        }else{
            return [
                'month'=>intval($month)+1,
                'year'=>intval($year)
            ];
        }
    }
    public static function getPreviousMonth($month,$year){
        if ($month==1){
            return [
                'month'=>12,
                'year'=>intval($year)-1
            ];
        }else{
            return [
                'month'=>intval($month)-1,
                'year'=>intval($year)
            ];
        }
    }
    public static function getWeek($day){
        $month = $day->format('m');
        $day_number = $day->format('d');
        $id_var = getdate(mktime(1, 1, 1, $month, $day_number, $day->format('y')));

    }
    public static function getMin($heure){
        $h = explode(':',$heure)[0];
        $m = explode(':',$heure)[1];
        return $h*60 +$m;
    }
    public static function daysOfWeekXML($day)
    {
        // Give number of day in the week
        $day_number = date('N', strtotime($day));

        $day_week_futur = [];
        $day_week_past = [];

        // Retrieve future days in the week
        for ($i = $day_number; $i <= 7; $i++) {
            $next_day = strtotime('+' . $i - $day_number . ' day', strtotime($day));
            array_push($day_week_futur, date('Y-m-d', $next_day));
        }

        // Retrieve days past in the week
        for ($day_number; $day_number > 1; $day_number--) {
            $previous_day = strtotime('-' . ($day_number - 1) . ' day', strtotime($day));
            array_push($day_week_past, date('Y-m-d', $previous_day));
        }
        // Concatenate all days in the week in array
        return array_merge($day_week_past, $day_week_futur);
    }
    public static function getDaysofmonthBynumber($day){
        $daym_ = new \DateTime($day);
        $id_var = getdate(mktime(1, 1, 1, $daym_->format('m'), $daym_->format('d'), $daym_->format('y')));
        $number_day=$id_var['wday'];
        $last=date('Y-m-t',strtotime($day));
        $last_ = new \DateTime($last);
       $arrays=[];
        for ($i=$number_day;$i<intval($last_->format('d'));$i++){
            $make_time=mktime(1, 1, 1, $last_->format('m'), $i, $last_->format('y'));
           $id_var_ = getdate($make_time);
            $day_number= $id_var_['wday'];
            if ($day_number==$number_day){
                $arrays[]=date('Y-m-d',$make_time);
            }
        }
        return $arrays;
    }
}
