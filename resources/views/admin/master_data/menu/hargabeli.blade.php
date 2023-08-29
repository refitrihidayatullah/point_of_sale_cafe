<script>
document.addEventListener('DOMContentLoaded', function () {
    const hargaBeli = document.getElementById('harga_beli');

    hargaBeli.addEventListener('input', function () {
        const value = hargaBeli.value.replace(/\D/g, '');
        const formattedValue = new Intl.NumberFormat('id-ID').format(value);

        hargaBeli.value = formattedValue;
    });
});
</script>