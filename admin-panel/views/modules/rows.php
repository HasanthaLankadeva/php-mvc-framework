<div class="wrapper">
    <?php require VIEW_PATH.'/template/sidebar.php'; ?>
    <div class="content-wrapper">

        <?php
            if (class_exists('Breadcrumb')) {
                Breadcrumb::render();
            }
        ?>

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <strong>Rows</strong>
                <a href="<?= BASE_URL ?>/modules/rowForm/<?= $table['id'] ?>"
                class="btn btn-sm btn-primary">
                    + Add Row
                </a>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r): ?>
                        <tr>
                            <td><?= htmlspecialchars($r['name']) ?></td>
                            <td><?= $r['created_at'] ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>/modules/rowForm/<?= $table['id'] ?>/<?= $r['id'] ?>"
                                class="btn btn-sm btn-secondary">
                                    Edit
                                </a>

                                <button class="btn btn-sm btn-danger delete-row"
                                        data-id="<?= $r['id'] ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Show/Hide Add Row Form
function showAddForm() {
    document.getElementById('addForm').style.display = 'block';
}
function hideAddForm() {
    document.getElementById('addForm').style.display = 'none';
}

// Add row via AJAX
document.getElementById('addRowForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    // Convert to URLSearchParams for AJAX POST
    const params = new URLSearchParams();
    for (const pair of formData.entries()) {
        params.append(pair[0], pair[1]);
    }

    const res = await fetch('<?= BASE_URL ?>/modules/addRow/<?= $table['id'] ?>', {
        method: 'POST',
        body: params
    });
    const json = await res.json();
    if(json.success){
        location.reload(); // reload to show new row
    } else {
        alert('Failed to add row');
    }
});

// Delete row via AJAX
async function deleteRow(rowId) {
    if(!confirm('Delete this row?')) return;

    // Get CSRF token from a hidden input or meta tag
    const csrfToken = document.querySelector('input[name="<?= CSRF_TOKEN_NAME ?>"]').value;

    const res = await fetch('<?= BASE_URL ?>/modules/deleteRow/<?= $table['id'] ?>/'+rowId, {
        method:'POST',
        headers: {
            'Content-Type':'application/x-www-form-urlencoded'
        },
        body: '<?= CSRF_TOKEN_NAME ?>=' + encodeURIComponent(csrfToken)
    });

    let json;
    try {
        json = await res.json();
    } catch(e) {
        const text = await res.text();
        console.error('Server response:', text);
        alert('Failed to parse JSON response.');
        return;
    }

    if(json.success) location.reload();
}

</script>