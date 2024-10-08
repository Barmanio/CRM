<?php

$title = 'Lesson create';
ob_start(); 
?>
<head>
    <title></title>
</head>
  <h1 class="mb-4">Новый урок</h1>
    <form method="POST" action="/lessons/store">
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
          <label for="direction_id">Направление</label>
            <select class="form-control" id="direction_id" name="direction_id" required>
                <?php foreach ($directions as $direction): ?>
                    <option value="<?= $direction['id'] ?>"><?= $direction['title'] ?></option>
                <?php endforeach; ?>
            </select>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-6 mb-3">
        <label for="day_week">День недели</label>
        <select class="form-control" id="day_week" name="day_week" required>
            <option value="Mo">Понедельник</option>
            <option value="Tu">Вторник</option>
            <option value="We">Среда</option>
            <option value="Th">Четверг</option>
            <option value="Fr">Пятница</option>
            <option value="Sa">Суббота</option>
            <option value="Su">Воскресенье</option>
        </select>
      </div>
      <div class="col-12 col-md-2 mb-3">
          <label for="time">Время</label>
          <input type="time" class="form-control" id="time" name="time">
      </div>
    </div>
    </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
<script>
    document.addEventListener("DOMContentLoaded", function (){
        flatpickr("#time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minuteIncrement: 15
        });
    });
</script>
<?php $content = ob_get_clean(); 

include 'app/views/layout.php';
?>