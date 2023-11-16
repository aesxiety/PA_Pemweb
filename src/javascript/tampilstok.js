// Script untuk menampilkan stok secara live menggunakan AJAX

function tampilkanStok() {
    var produkID = $("#produk").val();
    var ukuranID = $("#ukuran").val();

    // Lakukan kueri AJAX untuk mendapatkan stok berdasarkan produk dan ukuran
    $.ajax({
        url: "get_stok.php",
        type: "GET",
        data: { produk_id: produkID, ukuran_id: ukuranID },
        success: function(data) {
            $("#stokContainer").html(data);
        }
    });
}
