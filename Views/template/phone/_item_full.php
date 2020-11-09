<?php /** @var array $aItem */ ?>
<?php /** @var string $sCsrf */ ?>

<div class="js-item">
    <div>
        <img alt="avatar" width="50px" height="50px"
            <?php if (!empty($aItem['image'])): ?>
                src="<?= WEB_IMAGE_DIR . '/' . $aItem['image'] ?>"
            <?php else: ?>
                src="<?= '/cover/no_img.png' ?>"
            <?php endif; ?>
        >

    </div>
    <div class="media text-muted pt-3">
        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <strong class="d-block text-gray-dark"><?= $aItem['last_name'] ?> <?= $aItem['first_name'] ?></strong>
            <?= $aItem['phone_number'] ?>
        </p>

        <button type="button" class="btn btn-info btn-sm js-view" data-csrf="<?= $sCsrf ?>"
                data-id="<?= $aItem['id'] ?>">
            <span class="glyphicon glyphicon-pencil"></span> Просмотр
        </button>
        <button type="button" class="btn btn-danger btn-sm js-remove" data-csrf="<?= $sCsrf ?>"
                data-id="<?= $aItem['id'] ?>">
            <span class="glyphicon glyphicon-remove"></span> Удалить
        </button>
    </div>
</div>