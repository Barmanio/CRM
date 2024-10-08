<?php

$title = 'Directions';
ob_start();
?>


<h1 class="mb-4">Направления</h1>
<a href="/directions/create" class="btn btn-success">Новое направление</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($directions as $direction): ?>
        <tr>
            <td>
                <?= $direction['id'] ?>
            </td>
            <td>
                <?= $direction['title'] ?>
            </td>
            <td>
                <?= $direction['description'] ?>
            </td>
            <td>
                <a href="/directions/edit/<?= $direction['id'] ?>" class="btn btn-sm btn-outline-primary">Изменить</a>
                <form method="POST" action="/directions/delete/<?= $direction['id'] ?>" class="d-inline-block">
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Удалить</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>