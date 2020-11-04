<?php include ROOT . '/views/layouts/header.php';?>

<?php
/** @var array $aList */
?>

<h1>ЭТО ВЬЮХА СПИСКА</h1>
    <main role="main" class="container">
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
            <img class="mr-3" src="../assets/brand/bootstrap-outline.svg" alt="" width="48" height="48">
            <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">Список</h6>
                <small>Ваших контактов</small>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm">

            <button type="button" class="btn btn-primary btn-sm js-add_new">
                <span class="glyphicon glyphicon-pencil"></span> Добавить нового
            </button>

            <?php foreach ($aList as $item): ?>
            <div class="media text-muted pt-3">
                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg"
                     preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#007bff"/>
                    <text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
                </svg>
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <strong class="d-block text-gray-dark"><?= $item['last_name'] ?> <?= $item['first_name'] ?></strong>
                    <?= $item['phone_number'] ?>
                </p>

                <button type="button" class="btn btn-info btn-sm js-update" data-id="<?= $item['id'] ?>">
                    <span class="glyphicon glyphicon-pencil"></span> Редактировать
                </button>
                <button type="button" class="btn btn-danger btn-sm js-remove" data-id="<?= $item['id'] ?>">
                    <span class="glyphicon glyphicon-remove"></span> Удалить
                </button>
            </div>
            <?php endforeach;?>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </main>

<?php include ROOT . '/views/layouts/footer.php';?>