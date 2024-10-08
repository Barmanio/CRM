<?php

$title = 'Branch add';
ob_start();
?>


<h1 class="tex-center mb-4">Новый филиал</h1>
<form method="POST" action="/branches/store">
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" name="title" required />
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Адрес</label>
        <textarea class="form-control" id="address" name="address" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>



<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>