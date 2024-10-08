<?php

$title = 'Roles';
ob_start();
?>


<h1 class="mb-4">Роли</h1>
<a href="/roles/create" class="btn btn-success">Новая роль</a>
    <table class="table">
         <thead>
              <tr>
              <th>ID</th>
              <th>Название роли</th>
              <th>Описание роли</th>
              <th>Действия</th>
              </tr>
         </thead>
         <tbody>
            <?php foreach($roles as $role): ?>
            <tr>
            <td><?= $role['id'] ?></td>
            <td><?= $role['role_name'] ?></td>
            <td><?= $role['role_description'] ?></td>
            <td>
                <a href="/roles/edit/<?= $role['id'] ?>" class="btn btn-sm btn-outline-primary">Изменить</a>
                <form method="POST" action="/roles/delete/<?= $role['id'] ?>" class="d-inline-block">
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Удалить</button> 
                </form>
            </td>
            </tr>
            <?php endforeach; ?>
         </tbody>
    </table>

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>