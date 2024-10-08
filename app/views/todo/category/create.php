<?php

$title = 'Todo category add';
ob_start();
?>


<h1 class="tex-center mb-4">Новая категория</h1>
        <form method="POST" action="/todo/category/store">
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" name="title" required />
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>



<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>