<?php

$title = 'Edit Branch';
ob_start();
?>

<h1 class="mb-4">Изменить филиал</h1>
<form method="POST" action="/branches/update/<?php echo $branch['id']; ?>">
    <input type="hidden" name="id" value="<?= $branches['id'] ?>" />
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $branch['title'] ?>" required />
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Адрес</label>
        <textarea class="form-control" id="address" name="address" required><?= $branch['address'] ?></textarea>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea class="form-control" id="description" name="description" required><?= $branch['description'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>