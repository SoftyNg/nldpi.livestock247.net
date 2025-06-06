<div class="container mt-5">
    <h2 class="fw-semibold mb-4">Livestock Identity Service Providers Registry</h2>

    <div class="mb-4">
        <input type="text" id="search-input" class="form-control" placeholder="Search by name or location">
    </div>

    <div id="registry-results">
        <!-- Content will be loaded here via AJAX -->
    </div>
</div>
<?php 
  $total_pages = $total_pages ?? 1;
  $current_page = $current_page ?? 1;
?>
<nav class="d-flex justify-content-center">
  <ul class="pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
        <a href="#" class="page-link pagination-link" data-page="<?= $i ?>"><?= $i ?>
      </a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#search-input');
    let debounceTimer;

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

    // Debounced search input listener
    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        const searchTerm = this.value.trim();
        debounceTimer = setTimeout(() => {
            loadResults(searchTerm, 1);
        }, 300);
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
