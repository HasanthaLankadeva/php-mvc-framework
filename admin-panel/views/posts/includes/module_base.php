<p><?= $mainTable['table_name'] ?></p>
<p><a href="<?= BASE_URL ?>/posts/module/<?= $moduleId ?>?includefile=edit&submodule=<?= $mainTable['table_name'] ?>">Add</a></p>
<p><a href="<?= BASE_URL ?>/posts/module/<?= $moduleId ?>?includefile=settings&submodule=<?= $mainTable['table_name'] ?>">Edit table setting</a></p>
<p>---------------</p>
<br/>
<?php foreach($items as $i): ?>
    <p><a href="<?= BASE_URL ?>/posts/module/<?= $moduleId ?>?includefile=edit&submodule=<?= $mainTable['table_name'] ?>&id=<?= $i['id'] ?>"><?= $i['name'] ?></a></p>
<?php endforeach; ?>