<div class="sidebar admin-sidebar" id="sidebar">
    <h4 class="text-center py-3"><?= APP_NAME ?></h4>
    <ul class="list-unstyled">
        <li>
            <a href="<?= BASE_URL ?>/admin/dashboard" class="<?= ($active=='dashboard') ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i> <span class="link-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>/posts" class="<?= ($active=='posts') ? 'active' : '' ?>">
                <i class="fas fa-edit"></i>  <span class="link-text">Add Posts</span>
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>/reports" class="<?= ($active=='reports') ? 'active' : '' ?>">
                <i class="fas fa-chart-line"></i> <span class="link-text">Reports</span>
            </a>
        </li>
        
        <li>
            <a href="<?= BASE_URL ?>/modules" class="<?= ($active=='modules') ? 'active' : '' ?>">
                <i class="fas fa-cubes"></i>  <span class="link-text">Modules</span>
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>/users" class="<?= ($active=='users') ? 'active' : '' ?>">
                <i class="fas fa-users"></i> <span class="link-text">Users</span>
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>/settings" class="<?= ($active=='settings') ? 'active' : '' ?>">
                <i class="fas fa-cogs"></i> <span class="link-text">Settings</span>
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>/logout">
                <i class="fas fa-sign-out-alt"></i> <span class="link-text">Logout</span>
            </a>
        </li>
    </ul>
</div>