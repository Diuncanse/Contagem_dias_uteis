<?php
// definições de host, database, usuário e senha
$host = "127.0.0.1";
$db   = "teste";
$user = "root";
$pass = "";

// conecta ao banco de dados
$con = mysqli_connect($host, $user, $pass, $db) or trigger_error(mysql_error(),E_USER_ERROR); 

//get current month for example
$beginday = ($_POST ["Tinsem3"]);
$lastday  = ($_POST ["Tdesl"]);

$nr_work_days = getWorkingDays($beginday, $lastday);
echo $nr_work_days;

function getWorkingDays($startDate, $endDate) {
    $begin = strtotime($startDate);
    $end   = strtotime($endDate);
    if ($begin > $end) {
        return 0;
    }
    else {
        $holidays = array('01/01', '04/03', '05/03', '19/04', '21/04', '01/05', '20/06', '07/09', '12/10', '02/11', '15/11', '25/12');
        $weekends = 0;
        $no_days = 0;
        $holidayCount = 0;
        while ($begin < $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
                $weekends++;
            } elseif (in_array(date("d/m", $begin), $holidays)) {
                $holidayCount++;
            };
            $begin += 86400; // +1 day
        };
        $working_days = $no_days - $weekends - $holidayCount;

        return $working_days;
    }
}

?>   
