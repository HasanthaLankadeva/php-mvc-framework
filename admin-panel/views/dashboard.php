<div class="wrapper">
    <?php require VIEW_PATH . '/template/sidebar.php'; ?>
    <div class="content-wrapper">
        <div class="topbar d-flex justify-content-between align-items-center mb-3">
            <button class="btn btn-outline-secondary d-md-none" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <h4>Dashboard</h4>
        </div>

        <p>Welcome, <?= $_SESSION['user']['username'] ?>!</p>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?= $stats['users'] ?? 0 ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Reports</h5>
                        <p class="card-text"><?= $stats['reports'] ?? 0 ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Settings</h5>
                        <p class="card-text"><?= $stats['settings'] ?? 0 ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Active Sessions</h5>
                        <p class="card-text"><?= $stats['sessions'] ?? 0 ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">User Growth (Last 6 Months)</h5>
                <canvas id="userChart" height="100"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Recent Users</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($recentUsers as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['created_at'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
async function fetchStats() {
    const res = await fetch('<?= BASE_URL ?>/api/stats.php');
    if (!res.ok) return;
    const data = await res.json();

    document.querySelectorAll('.card-text').forEach((el, i) => {
        if(i===0) el.textContent = data.users;
        if(i===1) el.textContent = data.reports;
        if(i===2) el.textContent = data.settings;
        if(i===3) el.textContent = data.sessions;
    });
}

async function fetchRecentUsers() {
    const res = await fetch('<?= BASE_URL ?>/api/users.php');
    if (!res.ok) return;
    const users = await res.json();

    const tbody = document.querySelector('table tbody');
    tbody.innerHTML = '';
    users.forEach(u => {
        tbody.innerHTML += `<tr>
            <td>${u.id}</td>
            <td>${u.username}</td>
            <td>${u.email}</td>
            <td>${u.created_at}</td>
        </tr>`;
    });
}

async function fetchUserChartData() {
    const res = await fetch('<?= BASE_URL ?>/api/users.php');
    if (!res.ok) return;
    const users = await res.json();

    // Example: count users per month (dummy)
    const months = ['Jan','Feb','Mar','Apr','May','Jun'];
    const values = [5,10,8,12,15,20]; // Replace with real calculation if needed

    userChart.data.labels = months;
    userChart.data.datasets[0].data = values;
    userChart.update();
}

// Refresh every 10 seconds
fetchStats();
fetchRecentUsers();
fetchUserChartData();

setInterval(() => {
    fetchStats();
    fetchRecentUsers();
    fetchUserChartData();
}, 10000);
</script>

<script>
const ctx = document.getElementById('userChart').getContext('2d');
const userChart = new Chart(ctx, {
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
        plugins: {
            legend: { display: true }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>