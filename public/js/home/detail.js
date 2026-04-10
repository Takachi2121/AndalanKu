document.addEventListener("DOMContentLoaded", () => {
    const kurangBtn = document.getElementById("kurangQTY");
    const tambahBtn = document.getElementById("tambahQTY");
    const qtyDisplay = document.getElementById("qty");
    const waLink = document.getElementById("waLink");

    let qty = 1;

    const produkNama = waLink.dataset.nama;

    function updateLink() {
        const message = `Halo Andalanku! Saya ingin sewa ${produkNama} dengan jumlah ${qty} buah, apakah barang masih tersedia? Terima Kasih`;
        const encoded = encodeURIComponent(message);
        waLink.href = `https://wa.me/6281617551747?text=${encoded}`;
    }

    tambahBtn.addEventListener("click", () => {
        qty++;
        qtyDisplay.textContent = qty;
        updateLink();
    });

    kurangBtn.addEventListener("click", () => {
        if (qty > 1) {
            qty--;
            qtyDisplay.textContent = qty;
            updateLink();
        }
    });

    updateLink();
});
