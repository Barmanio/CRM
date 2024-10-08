<?php

$title = 'Edit page';
ob_start();
?>


<h1 class="mb-4">Изменить страницу</h1>
<form method="POST" action="/pages/update">
    <input type="hidden" name="id" value="<?= $page['id'] ?>" />
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $page['title'] ?>" required />
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Путь</label>
        <input type="text" class="form-control" id="slug" name="slug" value="<?= $page['slug'] ?>" required />
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Роли, имеющие доступ</label>
        <?php $page_roles = explode(',',$page['role']);?>
        <?php foreach ($roles as $role): ?>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="roles[]" value="<?php echo $role['id'];?>" <?php echo in_array($role['id'],$page_roles)? 'checked': '';?>>
            <label class="form-check-label" for="roles">
                <?php echo $role['role_name'];?>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>


<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>