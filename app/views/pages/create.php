<?php

$title = 'Create page';
ob_start();
?>

<h1 class="tex-center mb-4">Новая страница</h1>
<form method="POST" action="/pages/store">
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" name="title" required >
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Путь</label>
        <input type="text" class="form-control" id="slug" name="slug" required></input>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Роли, имеющие доступ</label>
        <?php foreach ($roles as $role): ?>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="roles[]" value="<?php echo $role['id'];?>" >
            <label class="form-check-label" for="roles"><?php echo $role['role_name'];?></label>
        </div>
        <?php endforeach; ?>
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>                          
        


<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>