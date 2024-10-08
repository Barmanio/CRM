<?php


$title = 'User list';
ob_start(); 
?>

<h1>Список пользователей</h1>

<a href="/users/create" class="btn btn-success">Новый пользователь</a>
<table class="table">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Имя пользователя</th>
			<th scope="col">Email</th>
            <th scope="col">Email подтверждён</th>
            <th scope="col">Админ</th>
			<th scope="col">Роль</th>
			<th scope="col">Активен</th>
            <th scope="col">Последняя авторизация</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
		<tr>
            <td>
                <?php echo $user['id'];?>
            </td>
            <td>
                <?php echo $user['username'];?>
            </td>
            <td>
                <?php echo $user['email'];?>
            </td>
            <td>
                <?php echo $user['email_verification']? 'Yes' : 'No';?>
            </td>
            <td>
                <?php echo $user['is_admin']? 'Yes' : 'No';?>
            </td>
            <td>
                <?php echo $user['role'];?>
            </td>
            <td>
                <?php echo $user['is_active']? 'Yes' : 'No';?>
            </td>
            <td>
                <?php echo $user['last_login'];?>
            </td>
			<td>
                <a href="/users/edit/<?php echo $user['id'];?>" class="btn btn-sm btn-outline-primary">Изменить</a>
                <a href="/users/delete/<?php echo $user['id'];?>" class="btn btn-sm btn-outline-danger">Удалить</a>

			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>