<?php /** @var array $aItem */ ?>
<?php /** @var string $sCsrf */ ?>

<?php //решил вынести шаблон, т.к. по логике он и внешне должен бы отличаться от списочной части ?>

<div class="js-item">
    <div>
        <img alt="avatar" width="50px" height="50px"
            <?php if (!empty($aItem['image'])): ?>
                src="<?= WEB_IMAGE_DIR . '/' . $aItem['image'] ?>"
            <?php else: ?>
                src="<?= WEB_IMAGE_DIR . '/no_img.png' ?>"
            <?php endif; ?>
        >

    </div>
    <div class="media text-muted pt-3">
        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <strong class="d-block text-gray-dark"><?= $aItem['last_name'] ?> <?= $aItem['first_name'] ?></strong>
            <?= $aItem['phone_number'] ?>
        </p>
    </div>
</div>