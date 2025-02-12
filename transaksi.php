<?php
$id = $_GET['id'];

include "datadummy.php";

$totalharga = 0;
$pembayaran = 0;
$kembalian = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notransaksi = $_POST['notransaksi'] ?? "";
    $namacustomer = $_POST['namacustomer'] ?? "";
    $tanggal = $_POST['tanggal'] ?? "";
    $pembayaran = $_POST['pembayaran'];
    $kembalian = $_POST['kembalian'];
    $harga = $_POST['harga'];
    $totalharga = $_POST['totalharga'];
    $jumlah = $_POST['jumlah'];

    $defaultvoucher = "JAMUKUAT";
    if (isset($_POST['hitung'])) {
            $voucher = $_POST['voucher'];
            if(($voucher === "JAMUKUAT")){
                $totalharga = ($harga * $jumlah) * 0.9;
            }else{
                $totalharga = $harga * $jumlah;
            }
        }

    if (isset($_POST['hitungkembalian'])) {
        if($pembayaran < $totalharga){
            echo "<script>alert('Pembayaran tidak boleh kurang dari total harga!');</script>";
        }else{
            $kembalian = $pembayaran - $totalharga;
        }
    }

    if (isset($_POST['simpan'])) {
        echo "<script>
        alert('Transaksi berhasil disimpan');
        window.location.href = 'beranda.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Co Kreatif</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar bg-success navbar-success shadow">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="#">Co Kreatif</a>
            <ul class="navbar-nav d-flex flex-row gap-4">
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="beranda.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="#">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Form Transaksi -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <h2 class="text-center text-success fw-bold">TRANSAKSI</h2>

                            <!-- Input No Transaksi -->
                            <div class="mb-3">
                                <label class="form-label">No Transaksi</label>
                                <input type="text" class="form-control" name="notransaksi">
                            </div>

                            <!-- Input Nama Customer -->
                            <div class="mb-3">
                                <label class="form-label">Nama Customer</label>
                                <input type="text" class="form-control" name="namacustomer">
                            </div>

                            <!-- Input Tanggal -->
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal">
                            </div>

                            <!-- Input Pilih Produk -->
                            <div class="mb-3">
                                <label class="form-label">Pilih Produk</label>
                                <input type="text" class="form-control" value="<?= $datapaket[$id][0] ?>" name="pilih" readonly>
                            </div>

                            <!-- Input Harga Produk -->
                            <div class="mb-3">
                                <label class="form-label">Harga Produk</label>
                                <input type="text" class="form-control" value="<?= $datapaket[$id][2] ?>" name="harga" readonly>
                            </div>

                            <!-- Input Jumlah Produk -->
                            <div class="mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah">
                            </div>

                            <!-- Input Voucher -->
                            <div class="mb-3">
                                <label class="form-label">Voucher</label>
                                <input type="text" class="form-control" name="voucher">
                            </div>
                            
                            <!-- Tombol Hitung Total -->
                            <button type="submit" class="btn btn-success mb-3 mt-3" name="hitung">Hitung Total</button>

                            <!-- Input Total Harga -->
                            <div class="mb-3">
                                <label class="form-label">Total Harga</label>
                                <input type="text" class="form-control" name="totalharga" value="<?= $totalharga ?>" readonly>
                            </div>

                            <!-- Input Pembayaran -->
                            <div class="mb-3">
                                <label class="form-label">Pembayaran</label>
                                <input type="text" class="form-control" name="pembayaran" value="<?= $pembayaran ?>">
                            </div>

                            <!-- Tombol Hitung Kembalian -->
                            <button type="submit" class="btn btn-success mb-3 mt-3" name="hitungkembalian">Hitung Kembalian</button>

                            <!-- Input Kembalian -->
                            <div class="mb-3">
                                <label class="form-label">Kembalian</label>
                                <input type="text" class="form-control" name="kembalian" value="<?= $kembalian ?>" readonly>
                            </div>

                            <!-- Tombol Simpan -->
                            <button type="submit" class="btn btn-success mb-3 mt-3" name="simpan">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome untuk ikon -->
    <script src="assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>

<!-- Changellage
    1.validasi pembayaran tidak boleh mines dan tidak boleh kurang dari total harga
    2. kasih diskon JAMU KUAT, Diskonnya 10%
-->