<div class="wrapper">
    <?php require VIEW_PATH . '/template/sidebar.php'; ?>
    <div class="content-wrapper">
        <div class="topbar d-flex justify-content-between align-items-center mb-3">
            <button class="btn btn-outline-secondary d-md-none" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <h4>Reports</h4>
        </div>

        <!-- Reports Stats -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Reports</h5>
                        <p class="card-text"><?= $stats['reports'] ?? 0 ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Completed Reports</h5>
                        <p class="card-text"><?= $stats['completed'] ?? 0 ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Pending Reports</h5>
                        <p class="card-text"><?= $stats['pending'] ?? 0 ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reports Table -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Recent Reports</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <!--th>Actions</th-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reports as $report): ?>
                        <tr>
                            <td><?= $report['id'] ?></td>
                            <td><?= $report['name'] ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>/reports/toggleStatus/<?= $report['id'] ?>" 
                                class="badge <?= $report['status']=='completed'?'bg-success':($report['status']=='in_progress'?'bg-warning':'bg-secondary') ?>">
                                    <?= ucfirst($report['status']) ?>
                                </a>
                            </td>
                            <td><?= $report['date'] ?></td>
                            <td><?= $report['updated_at'] ?? '-' ?></td>
                            <!--td-->
                                <!-- Optional: delete action -->
                                <!--a href="<?= BASE_URL ?>/reports/delete/<?= $report['id'] ?>" 
                                class="btn btn-sm btn-danger" onclick="return confirm('Delete this report?')">Delete</a>
                            </td-->
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Reports Pie Chart -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Report Status Distribution</h5>
                <canvas id="reportsChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
const ctxReports = document.getElementById('reportsChart').getContext('2d');
new Chart(ctxReports, {
    type: 'pie',
    data: {
        labels: ['Completed', 'Pending', 'In Progress'],
        datasets: [{
            data: [<?= $stats['completed'] ?>, <?= $stats['pending'] ?>, <?= $stats['in_progress'] ?>],
            backgroundColor: ['#28a745', '#ffc107', '#17a2b8']
        }]
    },
    options: { responsive: true }
});
</script>