<?php
    
    $locktime       =  15;
    $initialvalue   =    1;
    $records        =    100000;
    
    $s_today        =    1;
    $s_yesterday    =    1;
    $s_all          =    1;
    $s_week         =    1;
    $s_month        =    1;
    
    $s_digit        =    1;
    $disp_type      =     'Mechanical';
    
    $widthtable     =    '60';
    $pretext        =     '';
    $posttext       =     '';
    $locktime       =    $locktime * 60;
    // Now we are checking if the ip was logged in the database. Depending of the value in minutes in the locktime variable.
    $day            =    date('d');
    $month          =    date('n');
    $year           =    date('Y');
    $daystart       =    mktime(0,0,0,$month,$day,$year);
    $monthstart     =  mktime(0,0,0,$month,1,$year);
    // weekstart
    $weekday        =    date('w');
    $weekday--;
    if ($weekday < 0)    $weekday = 7;
    $weekday        =    $weekday * 24*60*60;
    $weekstart      =    $daystart - $weekday;

    $yesterdaystart =    $daystart - (24*60*60);
    $now            =    time();
    $ip             =    $_SERVER['REMOTE_ADDR'];
    
    $query          =    "SELECT MAX(id) AS total FROM counter";
    $t = $d->fetch_array($d->query($query));
    $tongtruycap   =    $t['total'];
    
    if ($tongtruycap !== NULL) {
        $tongtruycap += $initialvalue;
    } else {
        $tongtruycap = $initialvalue;
    }
    
    // Delete old records
    $temp = $tongtruycap - $records;
    
    if ($temp>0){
        $query         =  "DELETE FROM counter WHERE id<'$temp'";
        $d->query($query);
    }
    
    $query             =    "SELECT COUNT(*) AS visitip FROM counter WHERE ip='$ip' AND (tm+'$locktime')>'$now'";
    $vip  = $d->fetch_array($d->query($query));
    $items             =    $vip['visitip'];
    
    if (empty($items))
    {
        $query = "INSERT INTO counter (id, tm, ip) VALUES ('', '$now', '$ip')";
        $d->query($query);
    }
    
    $n                 =     $tongtruycap;
    $div = 100000;
    while ($n > $div) {
        $div *= 10;
    }

    $query             =    "SELECT COUNT(*) AS todayrecord FROM counter WHERE tm>'$daystart'";
    $todayrec  = $d->fetch_array($d->query($query));
    $homnay     =    $todayrec['todayrecord'];
    
    $query             =    "SELECT COUNT(*) AS yesterdayrec FROM counter WHERE tm>'$yesterdaystart' and tm<'$daystart'";
    $yesrec  = $d->fetch_array($d->query($query));
    $homqua     =    $yesrec['yesterdayrec'];
        
    $query             =    "SELECT COUNT(*) AS weekrec FROM counter WHERE tm>='$weekstart'";
    $weekrec = $d->fetch_array($d->query($query));
    $trongtuan     =    $weekrec['weekrec'];

    $query             =    "SELECT COUNT(*) AS monthrec FROM counter WHERE tm>='$monthstart'";
    $monthrec  = $d->fetch_array($d->query($query));
    $trongthang     =    $monthrec['monthrec'];
	
?> 