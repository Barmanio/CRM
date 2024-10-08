<?php

$title = 'Todo list - expired';
ob_start();
?>

<h1 class="mb-4">Список невыполненных задач</h1>
<div class="d-flex justify-content-around row filter-priority">
    <a data-priority="low" class="btn mb-3 col-2 sort-btn" style="background: <?= '#FFF8DC'?>; color: <?= '#696969'?>;">Низкий приоритет</a>
    <a data-priority="medium" class="btn mb-3 col-2 sort-btn" style="background: <?= '#ADFF2F'?>; color: <?= '#696969'?>;">Средний приоритет</a>
    <a data-priority="high" class="btn mb-3 col-2 sort-btn" style="background: <?= '#000080'?>; color: <?= '#DCDCDC'?>;">Высокий приоритет</a>
    <a data-priority="urgent" class="btn mb-3 col-2 sort-btn" style="background: <?= '#8B0000'?>; color: <?= '#DCDCDC'?>;">Неотложные</a>
</div>
<div class="accordion" id="tasks-accordion">
    <?php foreach ($expiredTasks as $one_task): ?>
    <?php
        $bg_color = style_task_bg($one_task);
        $text_color = style_task_text($one_task);
        $task_status = task_st($one_task);
        $task_priority = task_pr($one_task);
    ?>
    
    <div class="accordion-item mb-2">
        <div class="accordion-header d-flex justify-content-between align-items-center row" id="task-<?php echo $one_task['id']; ?>">
            <h2 class="accordion-header col-12 col-md-6">
                <button style="background: <?= $bg_color?>; color: <?= $text_color?>;" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#task-collapse-<?php echo $one_task['id']; ?>" aria-expanded="false" aria-controls="task-collapse-<?php echo $one_task['id'];?>" data-priority="<?php echo $one_task['priority']; ?>">
                    <span class="col-12 col-md-5">
                        <strong>
                            <?php echo $one_task['title']; ?>
                        </strong>
                    </span>
                    <span class="col-5 col-md-3">
                        <?php echo $task_priority; ?>
                    </span>
                    <span class="col-5 col-md-3">
                        <span class="due-date">
                            <?php echo $one_task['finish_date']; ?>
                        </span>
                    </span>
                </button>
            </h2>
        </div>
        <div id="task-collapse-<?php echo $one_task['id']; ?>" class="accordion-collapse collapse row" aria-labelledby="task-<?php echo $one_task['id']; ?>" data-bs-parent="#tasks-accordion">
            <div class="accordion-body">
                <p>
                    <strong>
                        <i class="fa-solid fa-layer-group"></i> Категория:
                    </strong><?php echo htmlspecialchars($one_task['category']['title'] ?? 'N/A'); ?>
                </p>
                <p>
                    <strong>
                        <i class="fa-solid fa-battery-three-quarters"></i> Статус:
                    </strong><?php echo htmlspecialchars($task_status); ?>
                </p>
                <p>
                    <strong>
                        <i class="fa-solid fa-person-circle-question"></i> Приоритет:
                    </strong><?php echo htmlspecialchars($task_priority); ?>
                </p>
                <p>
                    <strong>
                        <i class="fa-solid fa-hourglass-start"></i> Дедлайн:
                    </strong><?php echo htmlspecialchars($one_task['finish_date']); ?>
                </p>
                <p>
                    <strong>
                        <i class="fa-solid fa-file-prescription"></i> Описание:
                    </strong><?php echo htmlspecialchars($one_task['description'] ?? ''); ?>
                </p>
                <div class="d-flex justify-content-end">
                    <form action="/todo/tasks/update-status/<?php echo $one_task['id']; ?>" method="POST" class="me-2">
                        <input type="hidden" name="status" value="cancelled" />
                        <button type="submit" class="btn <?=$one_task['status'] == 'cancelled' ? 'btn-dark' : 'btn-light';?>">Отменена</button>
                    </form>
                    <form action="/todo/tasks/update-status/<?php echo $one_task['id']; ?>" method="POST" class="me-2">
                        <input type="hidden" name="status" value="new" />
                        <button type="submit" class="btn <?= $one_task['status'] == 'new' ? 'btn-dark' : 'btn-light'; ?>">Новая</button>
                    </form>
                    <form action="/todo/tasks/update-status/<?php echo $one_task['id']; ?>" method="POST" class="me-2">
                        <input type="hidden" name="status" value="in_progress" />
                        <button type="submit" class="btn <?= $one_task['status'] == 'in_progress' ? 'btn-dark' : 'btn-light'; ?>">В процессе</button>
                    </form>
                    <form action="/todo/tasks/update-status/<?php echo $one_task['id']; ?>" method="POST" class="me-2">
                        <input type="hidden" name="status" value="on_hold" />
                        <button type="submit" class="btn <?= $one_task['status'] == 'on_hold' ? 'btn-dark' : 'btn-light'; ?>">Ожидает</button>
                    </form>
                    <form action="/todo/tasks/update-status/<?php echo $one_task['id']; ?>" method="POST" class="me-2">
                        <input type="hidden" name="status" value="completed" />
                        <button type="submit" class="btn <?= $one_task['status'] == 'completed' ? 'btn-dark' : 'btn-light'; ?>">Выполнена</button>
                    </form>
                    <a href="/todo/tasks/edit/<?php echo $one_task['id']; ?>" class="btn btn-primary me-2">Изменить</a>
                    <a href="/todo/tasks/delete/<?php echo $one_task['id']; ?>" class="btn btn-danger me-2">Удалить</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>