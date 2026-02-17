<nav class="breadcrumb-wrapper mb-3">
    <ol class="breadcrumb">
        <?php foreach ($items as $b): ?>
            <?php if (!empty($b['url'])): ?>
                <li class="breadcrumb-item">
                    <a href="<?= $b['url'] ?>"><?= htmlspecialchars($b['label']) ?></a>
                </li>
            <?php else: ?>
                <li class="breadcrumb-item active">
                    <?= htmlspecialchars($b['label']) ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>