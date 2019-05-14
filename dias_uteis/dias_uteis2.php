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

function getWorkingDays($startDate, $endDate)
{
    $begin = strtotime($startDate);
    $end   = strtotime($endDate);
    if ($begin > $end) {
        echo "startdate is in the future! <br />";

        return 0;
    } else {
        $no_days  = 0;
        $weekends = 0;
        while ($begin < $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
                $weekends++;
            };
            // +1 day
            $begin += 86400; 
        };
        $working_days = $no_days - $weekends;

        return $working_days;
    }
}

?>   
