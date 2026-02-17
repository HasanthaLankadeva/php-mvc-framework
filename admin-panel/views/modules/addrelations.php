<div class="wrapper">
    <?php require VIEW_PATH.'/template/sidebar.php'; ?>
    <div class="content-wrapper">
        <?php
            if (class_exists('Breadcrumb')) {
                Breadcrumb::render();
            }
        ?>

        <h3>Relations with (<?= $table['table_name'] ?>) As parent</h3>
        <p>New relation</p>

        <div class="relations-settings">
            <form id="addRelationsForm">
                <div class="fwrap">
                    <label>Name</label>
                    <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= $_SESSION[CSRF_TOKEN_NAME] ?>">
                    <input type="hidden" name="module_id" value="<?= $module_id ?>">
                    <input type="hidden" name="table_id" value="<?= $table['id'] ?>">
                    <input type="text" name="relationname" class="form-control mb-2" required>
                </div>
                <div class="fwrap">
                    <label>Link to module id</label>
                    <input type="text" value="true" name="relation_link_to_module_id" readonly>
                </div>
                <div class="fwrap">
                    <label>Choose current table relation field</label>
                    <input type="text" value="id" name="current_table_field" readonly>
                </div>
                <div class="fwrap">
                    <label>Choose child table</label>
                    <select name="child_table">
                        <option>Select</option>
                         <?php 
                         foreach ($alltables as $f): ?>
                            <option value="<?= $f['table'] ?>"><?= $f['module'] ?> - <?= $f['table'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="fwrap">
                    <label>Choose child field</label>
                    <input type="text" value="parentID" name="child_field" readonly>
                </div>
            
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="<?= BASE_URL ?>/modules/relations/<?= $module_id ?>/<?= $table['id'] ?>" class="btn btn-secondary">Cancel</a>
            
            
            </form>
        </div>
    </div>
</div>

<script>
// Add row via AJAX
document.getElementById('addRelationsForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    // Convert to URLSearchParams for AJAX POST
    const params = new URLSearchParams();
    for (const pair of formData.entries()) {
        params.append(pair[0], pair[1]);
    }

    const res = await fetch('<?= BASE_URL ?>/modules/saverelation/<?= $module_id ?>/<?= $table['id'] ?>', {
        method: 'POST',
        body: params
    });
    const json = await res.json();
    if(json.success){
        location.href = "<?= BASE_URL ?>/modules/relations/<?= $module_id ?>/<?= $table['id'] ?>";
    } else {
        alert('Failed save relation');
    }
});

</script>