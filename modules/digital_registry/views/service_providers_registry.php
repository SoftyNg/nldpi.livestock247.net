<div class="container mt-5">
    <h2 class="fw-semibold mb-4">Livestock Identity Service Providers Registry</h2>

    <div class="mb-4">
        <input type="text" id="search-input" class="form-control" placeholder="Search by name or location">
    </div>

    <div id="registry-results">
        <!-- Content will be loaded here via AJAX -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function loadResults(search = '', page = 1) {
        const params = new URLSearchParams({ search, page });
        fetch('<?= BASE_URL ?>digital_registry/ajax_service_providers_registry?' + params)
            .then(res => res.text())
            .then(html => {
                document.querySelector('#registry-results').innerHTML = html;
            });
    }

    // Initial load
    loadResults();

    // Search input listener
    const searchInput = document.querySelector('#search-input');
    searchInput.addEventListener('input', function () {
        loadResults(this.value.trim(), 1);
    });

    // Delegate pagination clicks
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('pagination-link')) {
            e.preventDefault();
            const page = e.target.dataset.page;
            const search = searchInput.value.trim();
            loadResults(search, page);
        }
    });
});
</script>
