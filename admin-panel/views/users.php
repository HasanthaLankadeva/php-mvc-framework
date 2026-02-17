<div class="wrapper">
    <?php require VIEW_PATH . '/template/sidebar.php'; ?>
    <div class="content-wrapper">
        <div class="topbar d-flex justify-content-between align-items-center mb-3">
            <button class="btn btn-outline-secondary d-md-none" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <h4>Users</h4>
        </div>

        <!-- Users Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?= $stats['users'] ?? 0 ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Active Users</h5>
                        <p class="card-text"><?= $stats['active_users'] ?? 0 ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">New Users (30d)</h5>
                        <p class="card-text"><?= $stats['new_users'] ?? 0 ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Recent Users</h5>
                <div class="mb-3">
    <a href="<?= BASE_URL ?>/users/create" class="btn btn-success">Create New User</a>
</div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>/users/toggleStatus/<?= $user['id'] ?>" class="badge <?= $user['status']=='active'?'bg-success':'bg-secondary' ?>">
                                    <?= ucfirst($user['status']) ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?= BASE_URL ?>/users/delete/<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Users Growth Chart -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Growth (Last 6 Months)</h5>
                <canvas id="usersChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
const ctxUsers = document.getElementById('usersChart').getContext('2d');
new Chart(ctxUsers, {
    type: 'line',
    data: {
        labels: <?= json_encode($chartData['months']) ?>,
        datasets: [{
            label: 'New Users',
            data: <?= json_encode($chartData['values']) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2,
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true } }
    }
});
</script>