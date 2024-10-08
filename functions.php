<?php
// Проверка активного пункта меню
function is_active($path)
{
    $currentPath = $_SERVER['REQUEST_URI'];
    return $path === $currentPath ? 'active' : '';
}

function style_task_bg($one_task){
    switch ($one_task['priority']) {
        case 'low':
            $bg_color = '#FFF8DC';
            break;

        case 'medium':
            $bg_color = '#ADFF2F';
            break;

        case 'high':
            $bg_color = '#000080';
            break;

        case 'urgent':
            $bg_color = '#8B0000';
            break;

    }
    return $bg_color;
}

function style_task_text($one_task)
{
    switch ($one_task['priority']) {
        case 'low':
            $text_color = '#696969';
            break;

        case 'medium':
            $text_color = '#696969';
            break;

        case 'high':
            $text_color = '#DCDCDC';
            break;

        case 'urgent':
            $text_color = '#DCDCDC';
            break;

    }
    return  $text_color;
}

function task_pr($one_task)
{

    switch ($one_task['priority']) {
        case 'low':
            $task_priority = 'Низкий';
            break;

        case 'medium':
            $task_priority = 'Средний';
            break;

        case 'high':
            $task_priority = 'Высокий';
            break;

        case 'urgent':
            $task_priority = 'Неотложная задача';
            break;

    }
    return $task_priority;
}

function task_st($one_task)
{

    switch ($one_task['status']) {
        case 'new':
            $task_status = 'Новая';
            break;

        case 'in_progress':
            $task_status = 'В процессе';
            break;

        case 'completed':
            $task_status = 'Завершена';
            break;

        case 'on_hold':
            $task_status = 'Ожидает';
            break;
        case 'cancelled':
            $task_status = 'Отменена';
            break;

    }

    return $task_status;

}

function client_st($one_task)
{

    switch ($one_task['status']) {
        case 'new':
            $task_status = 'Новый';
            break;

        case 'studies':
            $task_status = 'Занимается';
            break;

        case 'paused':
            $task_status = 'Приостановил обучение';
            break;

        case 'leave':
            $task_status = 'Покинул чат';
            break;

    }

    return $task_status;

}
?>