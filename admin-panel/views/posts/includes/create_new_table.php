<!-- Add Table Form -->
<form method="POST" action="<?= BASE_URL ?>/modules/addTable/<?= $moduleId ?>">
    <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= Csrf::generate(); ?>">
    <div class="mb-3">
        <label>Table Name</label>
        <input type="text" name="table_name" class="form-control" required>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_main" id="is_main" value="1">
        <label class="form-check-label" for="is_main">Set as Main Table</label>
    </div>
    <button class="btn btn-primary">Create Table</button>
</form>