<?php

$title = 'Create direction';
ob_start();
?>

<h1 class="tex-center mb-4">Новое направление</h1>
<form method="POST" action="/directions/store">
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" name="title" required >
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <input type="text" class="form-control" id="description" name="description" required></input>
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>                          
        


<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>