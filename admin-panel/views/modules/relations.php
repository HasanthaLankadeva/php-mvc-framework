<div class="wrapper">
    <?php require VIEW_PATH.'/template/sidebar.php'; ?>
    <div class="content-wrapper">
        <?php
            if (class_exists('Breadcrumb')) {
                Breadcrumb::render();
            }
        ?>

        <h3>Relations with (<?= $table['table_name'] ?>) As parent</h3>
        <p><a href="<?= BASE_URL ?>/modules/addrelations/<?= $module_id ?>/<?= $table['id'] ?>">New relation</a></p>

        <div class="relations-wrapper">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Relation</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($relations as $t): ?>
                    <tr>
                        <td><a href="<?= BASE_URL ?>/modules/rows/<?= $t['id'] ?>"><?= $t['relationname'] ?></a></td>
                        <td>id-><?= $table['table_name'] ?> (<?= $t['childtable'] ?>:parentID)</td>
                        <td>
                            <a href="<?= BASE_URL ?>/modules/relations/<?= $t['id'] ?>" class="btn btn-warning btn-sm">Edit relations</a>
                            <!-- Optional: Delete table -->
                            <a href="<?= BASE_URL ?>/modules/deleteTable/<?= $t['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this table?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
