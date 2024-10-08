<?php

$title = 'Create role';
ob_start();
?>


<h1 class="tex-center mb-4">Новая роль</h1>
        <form method="POST" action="/roles/store">
    <div class="mb-3">
        <label for="role_name" class="form-label">Название роли</label>
        <input type="text" class="form-control" id="role_name" name="role_name" required />
    </div>
    <div class="mb-3">
        <label for="role_description" class="form-label">Описание роли</label>
        <textarea class="form-control" id="role_description" name="role_description" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>



<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>