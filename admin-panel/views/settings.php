<div class="wrapper">
    <?php require VIEW_PATH . '/template/sidebar.php'; ?>
    <div class="content-wrapper">
        <div class="topbar d-flex justify-content-between align-items-center mb-3">
            <button class="btn btn-outline-secondary d-md-none" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <h4>Settings</h4>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Settings</h5>
                        <p class="card-text"><?= $stats['total'] ?? 0 ?></p>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST">
            <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= Csrf::generate(); ?>">
            <?php foreach($settings as $setting): ?>
            <div class="mb-3">
                <label><?= $setting['name'] ?></label>
                <input type="text" name="settings[<?= $setting['id'] ?>]" class="form-control" value="<?= $setting['value'] ?>">
            </div>
            <?php endforeach; ?>
            <button class="btn btn-primary">Save Settings</button>
        </form>
    </div>
</div>