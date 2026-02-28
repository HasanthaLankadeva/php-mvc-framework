
<?php foreach($modules as $m): ?>
    <p><a href="<?= BASE_URL ?>/posts/module/<?= $m['id'] ?>"><?= $m['name'] ?></a></p>
<?php endforeach; ?>