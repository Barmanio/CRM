<?php

$title = 'Edit client';
ob_start();
?>

<h1 class="mb-4">Изменить данные</h1>
<form method="POST" action="/clients/update/<?php echo $client['id']; ?>">
    <input type="hidden" name="id" value="<?= $client['id'] ?>" />
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($client['name']) ?>" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="surname" class="form-label">Фамилия</label>
            <input type="text" class="form-control" id="surname" name="surname"  value="<?= htmlspecialchars($client['surname']) ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <label for="parent" class="form-label">Родитель</label>
            <input type="text" class="form-control" id="parent" name="parent"  value="<?= htmlspecialchars($client['parent']) ?>" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" class="form-control" placeholder  ="+7 (000) 000-0000" id="phone" name="phone" value="<?= htmlspecialchars($client['phone']) ?>" required>
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
          <input type="text" class="form-control" id="age" name="age" value="<?= htmlspecialchars($client['age']) ?>">
      </div>
    </div>
    <div class="row">
        <!-- Status field -->
        <div class="col-12 col-md-6 mb-3">
            <label for="status">Статус</label>
            <select class="form-control" id="status" name="status" required>
                <option value="new" <?= $client['status'] == 'new' ? 'selected' : '' ?>>Новый</option>
                <option value="studies" <?= $client['status'] == 'studies' ? 'selected' : '' ?>>Занимается</option>
                <option value="paused" <?= $client['status'] == 'paused' ? 'selected' : '' ?>>Приостановил обучение</option>
                <option value="leave" <?= $client['status'] == 'leave' ? 'selected' : '' ?>>Покинул чат</option>
            </select>
        </div>

        <!-- Priority field -->
        <div class="col-12 col-md-6 mb-3">
            <label for="comment">Комментарий</label>
            <textarea class="form-control" id="comment" name="comment" required><?= $client['comment'] ?></textarea>
        </div>
    </div>
    <div class="col-12 col-md-6 mb-3">
           <label for="lessons">Записан на занятие:</label>
            <select class="form-control" id="lessons" name="lessons">
              <?php foreach ($lessons as $one_lesson): ?>
                <option value="<?= $one_lesson['id'] ?>"><?= $one_lesson['nameLes'] ?></option>
              <?php endforeach; ?>
            </select>
        </div>
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>