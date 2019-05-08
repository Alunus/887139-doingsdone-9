<?php
require_once('data.php');
require_once('helpers.php');



$page_content = include_template('index.php', ['tasks' => $categories]);
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'Дела в порядке'
]);
print($layout_content);