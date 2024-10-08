<?php

$title = 'Client list';
ob_start();

?>

<h1 class="mb-4">Список клиентов</h1>
<a href="/clients/create" class="btn btn-success">Новый ученик</a>
<div class="accordion" id="tasks-accordion">
    <?php foreach ($clients as $one_client): ?>
    <?php
        $client_status = client_st($one_client);
    ?>
    <div class="accordion-item mb-2">
        <div class="accordion-header d-flex justify-content-between align-items-center row" id="client-<?php echo $one_client['id']; ?>">
            <h2 class="accordion-header col-12 col-md-6">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#client-collapse-<?php echo $one_client['id']; ?>" aria-expanded="false" aria-controls="client-collapse-<?php echo $one_client['id'];?>" data-priority="<?php echo $one_client['surname']; ?>">
                    <span class="col-12 col-md-5">
                        <strong>
                            <?php echo $one_client['name'] ." ". $one_client['surname']; ?>
                        </strong>
                    </span>
                    <span class="col-5 col-md-3">
                        <?php echo $client_status; ?>
                    </span>
                </button>
            </h2>
        </div>
        <div id="client-collapse-<?php echo $one_client['id']; ?>" class="accordion-collapse collapse row" aria-labelledby="client-<?php echo $one_client['id']; ?>" data-bs-parent="#clients-accordion">
            <div class="accordion-body">

                <p class="row">
                    <span class="col-12 col-md-6">
                        <strong>
                            <i class="fa-solid fa-layer-group"></i> Категория:
                        </strong><?php echo htmlspecialchars($one_client['branch']['title'] ?? 'N/A'); ?>
                    </span>
                    <span class="col-12 col-md-6">
                        <strong>
                            <i class="fa-solid fa-battery-three-quarters"></i> Статус:
                        </strong><?php echo htmlspecialchars($client_status); ?>
                    </span>
                </p>
                <p class="row">
                    <span class="col-12 col-md-6">
                        <strong>
                            <i class="fa-solid fa-layer-group"></i> Родитель:
                        </strong><?php echo htmlspecialchars($one_client['parent']); ?>
                    </span>
                    <span class="col-12 col-md-6">
                        <strong>
                            <i class="fa-solid fa-battery-three-quarters"></i> Возраст:
                        </strong><?php echo htmlspecialchars($one_client['age']); ?>
                    </span>
                </p>
                <p>
                    <strong>
                        <i class="fa-solid fa-file-prescription"></i> Комментарий:
                    </strong><?php echo htmlspecialchars($one_client['comment'] ?? ''); ?>
                </p>
                <hr />
                <div class="d-flex justify-content-end">
                    <a href="/clients/edit/<?php echo $one_client['id']; ?>" class="btn btn-primary me-2">Изменить</a>
                    <a href="/clients/delete/<?php echo $one_client['id']; ?>" class="btn btn-danger me-2">Удалить</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>