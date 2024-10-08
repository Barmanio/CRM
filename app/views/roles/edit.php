<?php

$title = 'Edit role';
ob_start();
?>


<h1 class="tex-center mb-4">Изменить роль</h1>
<form method="POST" action="/roles/update">
    <input type="hidden" name="id" value="<?= $role['id'] ?>" />
    <div class="mb-3">
        <label for="role_name" class="form-label">Название роли</label>
        <input type="text" class="form-control" id="role_name" name="role_name" value="<?= $role['role_name'] ?>" required />
    </div>
    <div class="mb-3">
        <label for="role_description" class="form-label">Описание роли</label>
        <textarea class="form-control" id="role_description" name="role_description" required><?= $role['role_description'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>


<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>