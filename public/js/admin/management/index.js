document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebar-overlay");
    const toggleBtn = document.getElementById("menu-toggle");

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("active");
        overlay.classList.toggle("active");
    });

    overlay.addEventListener("click", function () {
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
    });
});

$(document).ready(function () {
    var table = $('#produk-table').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
        }
    });

    $('#search-nama').on('input', function () {
        table.column(1).search(this.value).draw(); // Nama Produk = kolom ke-1
    });
});
