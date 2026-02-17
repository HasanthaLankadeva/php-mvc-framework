<div class="wrapper">
    <?php require VIEW_PATH . '/template/sidebar.php'; ?>
    <div class="content-wrapper">
        <div class="topbar mb-3">
            <h4>Create User</h4>
        </div>

        <form method="POST" action="<?= BASE_URL ?>/users/store">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-primary">Create User</button>
            <a href="<?= BASE_URL ?>/users" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>