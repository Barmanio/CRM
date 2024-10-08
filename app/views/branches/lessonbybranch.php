<?php

$title = 'Lessons by branch';
ob_start();
?>

<h1 class="mb-4">Список занятий в филиале: <span><?= $branchName;?></span></h1>
<a href="/lessons/create" class="btn btn-success">Новое занятие</a>
<hr>
<div class="accordion" id="tasks-accordion">
    <?php foreach ($lessonByBranch as $one_lesson): ?>
    <div class="accordion-item mb-2">
        <div class="accordion-header d-flex justify-content-between align-items-center row" id="lesson-<?php echo $one_lesson['id']; ?>">
            <h2 class="accordion-header col-12 col-md-6">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lesson-collapse-<?php echo $one_lesson['id']; ?>" aria-expanded="false" aria-controls="lesson-collapse-<?php echo $one_lesson['id'];?>" data-priority="<?php echo $one_lesson['day_week']; ?>">
                    <span class="col-12 col-md-5">
                        <?php echo $one_lesson['direction']['title']; ?>
                    </span>
                    <span class="col-5 col-md-3">
                        <?php echo $one_lesson['day_week']; ?>
                    </span>
                    <span class="col-5 col-md-3">

                        <?php echo substr($one_lesson['time'], 0, 5); ?>
                    </span>
                </button>
            </h2>
        </div>


        <div id="lesson-collapse-<?php echo $one_lesson['id']; ?>" class="accordion-collapse collapse row" aria-labelledby="lesson-<?php echo $one_lesson['id']; ?>" data-bs-parent="#lessons-accordion">
            <div class="accordion-body">
            	<form method="POST" action="/clients/save">
            	
            	<input type="hidden" name="id_branch" value="<?= $branch_id ?>" />
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th scope="col">Имя</th>
                            <?php for ($i = 1; $i <= 36; $i++) {?>
                            <th scope="col">
                                <?php echo $i ?>
                            </th>
                            <?php } ?>
                            </thead>
                    <tbody>
                        <?php foreach ($one_lesson['clients'] as $c_l): ?>
                        <tr>
                            <th scope="row"><?php  echo $c_l['name'].' '. $c_l['surname'] ?></th>
                            <?php for ($i =1; $i <=36; $i++){?>
                            
                            <td><input type="checkbox" class="form-check-input" name="visited[]" value=" <?php echo strval($i).' '.$c_l['client_id']?>" <?php echo $c_l['visiting'][$i-1] ? ' checked' : '';?>  /></td>
                            <?php } ?>
							
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                	<button type="submit" class="btn btn-success me-2">Сохранить</button>
                    <a href="/lessons/edit/<?php echo $one_lesson['id']; ?>" class="btn btn-primary me-2">Изменить</a>
                    <a href="/lessons/delete/<?php echo $one_lesson['id']; ?>" class="btn btn-danger me-2">Удалить</a>
                </div>
				</form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>