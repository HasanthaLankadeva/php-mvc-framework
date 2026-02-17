<div class="wrapper">
    <?php require VIEW_PATH.'/template/sidebar.php'; ?>
    <div class="content-wrapper">
   
        <?php
            if (class_exists('Breadcrumb')) {
                Breadcrumb::render();
            }
        ?>

        <h3>Module: <?= $module['name'] ?></h3>

        <!-- Add Table Form -->
        <form method="POST" action="<?= BASE_URL ?>/modules/addTable/<?= $module['id'] ?>">
            <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= Csrf::generate(); ?>">
            <div class="mb-3">
                <label>Table Name</label>
                <input type="text" name="table_name" class="form-control" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_main" id="is_main" value="1">
                <label class="form-check-label" for="is_main">Set as Main Table</label>
            </div>
            <!--h5>Fields</h5>
            <div id="fields-container"></div>
            <button type="button" class="btn btn-secondary mb-2" onclick="addField()">Add Field</button-->
            <button class="btn btn-primary">Create Table</button>
        </form>

        <h5 class="mt-4">Existing Tables</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Table Name</th>
                    <th>Type</th>
                    <th>Relations</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($tables as $t): ?>
                <tr>
                    <td><?= $t['id'] ?></td>
                    <td><a href="<?= BASE_URL ?>/modules/rows/<?= $t['id'] ?>"><?= $t['table_name'] ?></a></td>
                    <td>
                        <?php if ($t['is_main']): ?>
                            <span class="badge bg-success">Main</span>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= BASE_URL ?>/modules/relations/<?= $module['id'] ?>/<?= $t['id'] ?>" class="btn btn-warning btn-sm">Manage Relations</a>
                    </td>
                    <td>
                        <!-- Manage Fields button -->
                        <a href="<?= BASE_URL ?>/modules/fields/<?= $t['id'] ?>" class="btn btn-warning btn-sm">Manage Fields</a>
                        <!-- Optional: Delete table -->
                        <a href="<?= BASE_URL ?>/modules/deleteTable/<?= $t['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this table?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function addField() {
    const container = document.getElementById('fields-container');
    const index = container.children.length;
    const html = `
    <div class="mb-2">
        <input type="text" name="fields[${index}][field_name]" placeholder="Field Name" required>
        <select name="fields[${index}][field_type]" required>
            <option value="VARCHAR">VARCHAR</option>
            <option value="INT">INT</option>
            <option value="TEXT">TEXT</option>
            <option value="DATE">DATE</option>
            <option value="DATETIME">DATETIME</option>
        </select>
        <input type="number" name="fields[${index}][length]" placeholder="Length" style="width:80px;">
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
}
</script>