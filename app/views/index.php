<?php

$title = 'Home page';
ob_start();
?>

<h1>Календарь</h1>
<div id='calendar'></div>

<?php $path = '/todo/tasks/task/'; ?>

<script>
const tasksJson = <?= json_encode($tasksJson) ?>;
const tasks = JSON.parse(tasksJson); 
const events = tasks.map((task) => {
    return {
      title: task.title,
      start: new Date(task.created_at), 
      end: new Date(task.finish_date), 
      extendedProps: {
        task_id: task.id, 
        },
    };
  });

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth',
        themeSystem: 'bootstrap5',
        events: events,
        eventClick: function (info) {
            const taskId = info.event.extendedProps.task_id;

            const taskUrl = `<?=$path;?>${taskId}`;

            window.location.href = taskUrl;
        },
    });

    calendar.render();
});
</script>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>