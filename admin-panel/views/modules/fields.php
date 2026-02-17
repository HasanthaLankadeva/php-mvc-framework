<div class="wrapper">
    <?php require VIEW_PATH.'/template/sidebar.php'; ?>
    <div class="content-wrapper">
        <?php
            if (class_exists('Breadcrumb')) {
                Breadcrumb::render();
            }
        ?>

        <h3>Manage Fields: <?= $table['table_name'] ?></h3>

        <input type="hidden" id="csrf" value="<?= $_SESSION[CSRF_TOKEN_NAME] ?>">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Length</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fields as $f): ?>
                <tr>
                    <td><?= $f['field_name'] ?></td>
                    <td><?= $f['field_type'] ?></td>
                    <td><?= $f['field_length'] ?></td>
                    <td>
                        <?php if ($f['is_system']) continue; ?>
                        <button class="btn btn-danger btn-sm" onclick="deleteField(<?= $f['id'] ?>)">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <hr>

        <h4>Add New Field</h4>

        <form id="addFieldForm">
            <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= $_SESSION[CSRF_TOKEN_NAME] ?>">

            <input type="text" name="field_name" class="form-control mb-2" placeholder="Field Name" required>

            <select name="field_type" class="form-control mb-2" required>
                <?php foreach (FIELD_TYPES as $key => $label): ?>
                    <option value="<?= $key ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>

            <input type="number" name="field_length" class="form-control mb-2" placeholder="Length (optional)">

            <button class="btn btn-success">Add Field</button>
        </form>
    </div>
</div>
<script>
document.getElementById('addFieldForm').addEventListener('submit', async e => {
    e.preventDefault();

    const data = new URLSearchParams(new FormData(e.target));

    const res = await fetch('<?= BASE_URL ?>/modules/addField/<?= $table['id'] ?>', {
        method: 'POST',
        body: data
    });

    const json = await res.json();
    if (json.success) location.reload();
    else alert(json.error);
});

async function deleteField(id) {
    if (!confirm('Delete this field?')) return;

    const res = await fetch('<?= BASE_URL ?>/modules/deleteField/' + id, {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: '<?= CSRF_TOKEN_NAME ?>=' + document.getElementById('csrf').value
    });

    const json = await res.json();
    if (json.success) location.reload();
    else alert(json.error);
}
</script>