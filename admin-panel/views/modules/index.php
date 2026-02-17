<div class="wrapper">
    <?php require VIEW_PATH.'/template/sidebar.php'; ?>
    <div class="content-wrapper">

        <?php
            if (class_exists('Breadcrumb')) {
                Breadcrumb::render();
            }
        ?>

        <h4>Modules</h4>
        <a href="<?= BASE_URL ?>/modules/create" class="btn btn-success mb-3">Add Module</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Tables</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($modules as $m): ?>
                <tr>
                    <td><?= $m['id'] ?></td>
                    <td><?= $m['name'] ?></td>
                    <td><a href="<?= BASE_URL ?>/modules/tables/<?= $m['id'] ?>" class="btn btn-sm btn-primary">View Tables</a></td>
                    <td>
                        <a href="<?= BASE_URL ?>/modules/delete/<?= $m['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete module?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>