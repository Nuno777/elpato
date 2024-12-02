document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('type');
    const statusSelect = document.getElementById('status');
    const filterButton = document.getElementById('filter-button');

    function checkFilters() {
        if (typeSelect.value || statusSelect.value) {
            filterButton.disabled = false;
        } else {
            filterButton.disabled = true;
        }
    }

    typeSelect.addEventListener('change', checkFilters);
    statusSelect.addEventListener('change', checkFilters);

    checkFilters();
});
