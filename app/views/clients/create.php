<?php
$title = 'Client add';
ob_start();
?>


<h1 class="tex-center mb-4">Новый клиент</h1>
<form method="POST" action="/clients/store">
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="surname" class="form-label">Фамилия</label>
            <input type="text" class="form-control" id="surname" name="surname" required>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <label for="parent" class="form-label">Родитель</label>
            <input type="text" class="form-control" id="parent" name="parent" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" class="form-control" placeholder  ="+7 (000) 000-0000" id="phone" name="phone" required>
        </div>
    </div>

    <div class="row">
      <div class="col-12 col-md-6 mb-3">
        <label for="branch_id">Филиал</label>
        <select class="form-control" id="branch_id" name="branch_id" required>
          <?php foreach ($branches as $branch): ?>
            <option value="<?= $branch['id'] ?>"><?= $branch['title'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-12 col-md-6 mb-3">
          <label for="age">Возраст</label>
          <input type="text" class="form-control" id="age" name="age">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>



<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>