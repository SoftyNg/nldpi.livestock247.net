<!-- ===================== Styles ===================== -->
<style>
    .company-name {
        color: #079455;
        align-self: stretch;
        font-family: Inter;
        font-size: 20px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%; /* 24px */
    }

    
    .label,
    .reject-label,
    .pending-label {
        display: inline-flex;
        align-items: center;
        border-radius: 12px;
        padding: 5px 10px;
        font-size: 14px;
        font-weight: 500;
    }

    .label {
        background-color: #e8f5e9;
        border: 1px solid #4caf50;
        color: #4caf50;
    }

    .label::before {
        content: '';
        width: 8px;
        height: 8px;
        background-color: #4caf50;
        border-radius: 50%;
        margin-right: 8px;
    }   

    /* Remove default Bootstrap active background from pagination */
.pagination .page-item.active .page-link {
    background-color: transparent !important;
    border-color: transparent !important;
    color: #000 !important; /* Optional: change color to black */
    font-weight: bold;
}

/* Optional: remove hover background */
.pagination .page-link:hover {
    background-color: #f0f0f0; /* or transparent */
    color: #000;
}

</style>

<div class="container mt-5">
    <h2 class="fw-semibold mb-4">Veterinary Professional Registry</h2>
    <p>Find A Veterinary Professional</p>
    <div class="mb-4 card p-4">
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
        fetch('<?= BASE_URL ?>digital_registry/ajax_vet_professionals_registry?' + params)
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
