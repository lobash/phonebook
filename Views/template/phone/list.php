<?php include ROOT . '/views/layouts/header.php';

use components\Validator as Validator; ?>

<?php
/** @var array $aList */
?>

    <main role="main" class="container">
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
            <img class="mr-3" src="/assets/bootstrap/brand/bootstrap-outline.svg" alt="" width="48" height="48">
            <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">Список</h6>
                <small>Ваших контактов</small>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <div>
                <button type="button" class="btn btn-primary btn-sm js-add_new">
                    <span class="glyphicon glyphicon-pencil"></span> Добавить нового
                </button>
            </div>
            <div class="js-list">
                <?php foreach ($aList as $aItem): ?>
                    <?php include ROOT . '/views/template/phone/_item_full.php'; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

<?php include_once ROOT . '/views/template/phone/_form_add.php'; ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>