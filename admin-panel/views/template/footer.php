<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const sidebar = document.getElementById('sidebar');
const toggleBtn = document.getElementById('toggleSidebar');

toggleBtn?.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
});

// Highlight active menu
const links = sidebar.querySelectorAll('a');
links.forEach(link => {
    if (window.location.href.includes(link.getAttribute('href'))) {
        link.classList.add('active');
    }
});
</script>
</body>
</html>