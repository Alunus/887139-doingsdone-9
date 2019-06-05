<?php
function db_fetch_data ($link, $sql, $data =[]) {
    $result =[];
    $stmt = db_get_prepare_stmt ($link,$sql, $data);
    mysqli_stmt_execute($stmt);
    $res=mysqli_stmt_get_result($stmt);
    if ($res) {
        $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
    return $result;
}
function time_different($tasks_list) {
    $int_end_str = $tasks_list['date_end'];
    $end_ts= strtotime($int_end_str);
    $ts_current = time();
    $dt_diff = $end_ts-$ts_current;
    return ($dt_diff);
}
