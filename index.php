<?php
require_once('data.php');
require_once('helpers.php');

/*function counter($tasks, $category)
{
    $i = 0;
    foreach ($tasks as $key) {
        if ($key['category'] == $task) {
            $i++;
        }
    }
    return $i;
}*/

function time_different($task) {
    $int_end_str = $task['date'];
    $end_ts= strtotime($int_end_str);
    $ts_current = time();
    $dt_diff = $end_ts-$ts_current;
    return ($dt_diff);
    }

$page_content = include_template('index.php', ['task_list' => $task_list]);
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'Дела в порядке'
]);
print($layout_content);