<?php
$title = 'Branch list';
ob_start();
?>

<h1>Список филиалов</h1>

<a href="/branches/create" class="btn btn-success">Новый филиал</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Адрес</th>
            <th scope="col">Описание</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($branches as $branch): ?>
        <tr>
            <td>
                <?php echo $branch['id'];?>
            </td>
            <td>
                <a href="/branches/lessonbybranch/<?php echo $branch['id'];?>" class="btn btn-sm btn-outline-warning"><?= htmlspecialchars($branch['title']) ?></a>
            </td>
            <td>
                <?php echo $branch['address'];?>
            </td>
            <td>
                <?php echo $branch['description'];?>
            </td>
            <td>
                <a href="/branches/edit/<?php echo $branch['id'];?>" class="btn btn-sm btn-outline-primary">Изменить</a>
                <a href="/branches/delete/<?php echo $branch['id'];?>" class="btn btn-sm btn-outline-danger">Удалить</a>

            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>