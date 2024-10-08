<?php

$title = 'Edit direction';
ob_start();
?>


<h1 class="mb-4">Изменить направление</h1>
<form method="POST" action="/directions/update">
    <input type="hidden" name="id" value="<?= $direction['id'] ?>" />
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $direction['title'] ?>" required />
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <input type="text" class="form-control" id="description" name="description" value="<?= $direction['description'] ?>" required />
    </div>
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>


<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>