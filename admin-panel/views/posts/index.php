<div class="wrapper">
    <?php require VIEW_PATH.'/template/sidebar.php'; ?>
    <div class="content-wrapper">

        <h4>Modules</h4>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($modules as $m): ?>
                <?php //print_r($m); ?>
                <tr>
                    <td><?= $m['id'] ?></td>
                    <td><a href="<?= BASE_URL ?>/posts/manage/<?= $m['id'] ?>"><?= $m['name'] ?></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>