<?php
require_once('helpers.php');
require_once ('functions.php');
function url ($id){
    $params =$_GET;
    $params['project_id']=$id;
    $scriptname=pathinfo(__FILE__,PATHINFO_BASENAME);
    $query=http_build_query($params);
    $url ="/".$scriptname."?".$query;
    return $url;
}
function whatever($array,$val) {
    foreach ($array as $item)
        if (isset($item['id']) && $item['id'] == $val)
            return true;
        elseif (!isset($_GET['project_id']))
            return true;
    return false;
}
$connect = mysqli_connect("localhost", "root", "","doingsdone");
mysqli_set_charset($connect, "utf8");
if ($connect == false) {
    print("Ошибка подключения: "
        . mysqli_connect_error());
}
else {
    $task= ['1'];
    $project= ['1'];
    if (isset($_GET['project_id'])){
        $task= ['1',$_GET['project_id']];
        $sql = 'SELECT `name`,`date_end`,`date_create`,`status`,`file`,`project_id` FROM tasks where author_id = ? and project_id= ?';
    }
        else{
        $sql = 'SELECT `name`,`date_end`,`date_create`,`status`,`file`,`project_id` FROM tasks where author_id = ?';
        }
    $tasks_list = db_fetch_data ($connect, $sql, $task);
    $sql = 'select p.name, p.id, count(project_id) project_count from tasks t
            right outer join projects p ON p.id = t.project_id
            where p.author_id=?
            group by p.id order by project_count DESC;';
    $projects = db_fetch_data ($connect, $sql, $project);
        //вывод контента
    $test =$_GET['project_id'];
if (whatever($projects,$test)==true) :
    $page_content = include_template('index.php', ['task_list' => $tasks_list]);
    else:
        header("Location: 404");
endif;
    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'projects' => $projects,
        'title' => 'Дела в порядке'
    ]);
    print($layout_content);
}