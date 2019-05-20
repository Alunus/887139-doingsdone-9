<?php
require_once('helpers.php');
require_once ('functions.php');

$connect = mysqli_connect("localhost", "root", "","doingsdone");
mysqli_set_charset($connect, "utf8");
if ($connect == false) {
    print("Ошибка подключения: "
        . mysqli_connect_error());
}
else {
    $task= ['1'];
    $sql = 'SELECT `name`,`date_end`,`date_create`,`status`,`file` FROM tasks where author_id = ?';
    $tasks_list = db_fetch_data ($connect, $sql, $task);
    $project= ['1'];
    $sql = 'SELECT p.name, COUNT(project_id) project_count FROM tasks t
            right JOIN  projects p ON t.project_id = p.id
            where p.author_id = ?
            GROUP BY name ORDER BY project_count DESC;';
    $projects = db_fetch_data ($connect, $sql, $project);
    $page_content = include_template('index.php', ['task_list' => $tasks_list]);
    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'projects' => $projects,
        'title' => 'Дела в порядке'
    ]);
    print($layout_content);
}