<script>
document.addEventListener('DOMContentLoaded', function () {
    const hargaJual = document.getElementById('harga_jual');

    hargaJual.addEventListener('input', function () {
        const value = hargaJual.value.replace(/\D/g, '');
        const formattedValue = new Intl.NumberFormat('id-ID').format(value);

        hargaJual.value = formattedValue;
    });
});
</script>