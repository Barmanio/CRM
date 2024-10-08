<?php
$title = 'Todo Category';
ob_start();
?>

<h1 class="mb-4">Todo Category</h1>
<a href="/todo/category/create" class="btn btn-success">Новая категория</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Используется</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categories as $category): ?>
        <tr>
            <td>
                <?= $category['id'] ?>
            </td>
            <td>
                <?= $category['title'] ?>
            </td>
            <td>
                <?= $category['description'] ?>
            </td>
            <td>
                <?= $category['usability'] == 1 ? 'Yes' : 'No' ?>
            </td>
            <td>
                <a href=">/todo/category/edit/<?= $category['id'] ?>" class="btn btn-sm btn-outline-primary">Изменить</a>
                <form method="POST" action="/todo/category/delete/<?= $category['id'] ?>" class="d-inline-block">
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