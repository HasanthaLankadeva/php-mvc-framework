<div class="wrapper">
    <?php require VIEW_PATH.'/template/sidebar.php'; ?>
    <div class="content-wrapper">

        <?php
            if (class_exists('Breadcrumb')) {
                Breadcrumb::render();
            }
        ?>

        <h4>Add Module</h4>
        <form method="POST" action="<?= BASE_URL ?>/modules/store">
            <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= Csrf::generate(); ?>">
            <div class="mb-3">
                <label>Module Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            
            <button class="btn btn-primary">Add Module</button>
            <a href="<?= BASE_URL ?>/modules" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>