<?php

$title = 'Task create';
ob_start(); 
?>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
  <h1 class="mb-4">Создание задачи</h1>
    <form method="POST" action="/todo/tasks/store">
    <div class="row">
        <!-- Title field -->
        <div class="mb-3 col-12 col-md-12">
            <label for="title" class="form-label">Название</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
    </div>
    <div class="row">
        <!-- Category field -->
      <div class="col-12 col-md-6 mb-3">
        <label for="category_id">Категория</label>
        <select class="form-control" id="category_id" name="category_id" required>
          <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <!-- Finish date field -->
      <div class="col-12 col-md-6 mb-3">
          <label for="finish_date">Дедлайн</label>
          <input type="text" class="form-control" id="finish_date" name="finish_date" placeholder="Укажите время и дату">
      </div>
    </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
<script>
    document.addEventListener("DOMContentLoaded", function (){
        flatpickr("#finish_date", {
            enableTime: true,
            noCalendar: false,
            dateFormat: "Y-m-d H:00:00",
            time_24h: true,
            minuteIncrement: 15
        });
    });
</script>
<?php $content = ob_get_clean(); 

include 'app/views/layout.php';
?>