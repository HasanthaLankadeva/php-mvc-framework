
<?php foreach($items as $i): ?>
    <p><a href="<?= BASE_URL ?>/posts/module/<?= $module_id ?>/<?= $table['table_name'] ?>/<?= $i['id'] ?>"><?= $i['name'] ?></a></p>
<?php endforeach; ?>