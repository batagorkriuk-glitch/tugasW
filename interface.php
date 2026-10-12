<?php
// Interface pembayaran
interface MetodePembayaran{
    public function prosesBayar(float $jumlah, string $keterangan): bool;
    public function getNamaMetode(): string;
}

// biar format rupiah
function rupiah($angka){
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Class Transfer Bank
class TransferBank implements MetodePembayaran{
    private $norek;

    function __construct($norek){
        $this->norek = $norek;
    }

    public function getNamaMetode(): string{
        return "Transfer Bank";
    }

    public function prosesBayar(float $jumlah, string $keterangan): bool{
        $admin = 0;
        $total = $jumlah + $admin;

        echo "Metode : ".$this->getNamaMetode()."\n";
        echo "No Rek : ".$this->norek."\n";
        echo "Ket : ".$keterangan."\n";
        echo "Jumlah : ".rupiah($jumlah)."\n";
        echo "Admin : ".rupiah($admin)."\n";
        echo "Total : ".rupiah($total)."\n";
        echo "Berhasil dibayar\n\n";
        return true;
    }
}

// Class QRIS
class QRIS implements MetodePembayaran{
    public function getNamaMetode(): string{
        return "QRIS";
    }
    public function prosesBayar(float $jumlah, string $keterangan): bool{
        $admin = $jumlah * 0.7 / 100;
        $total = $jumlah + $admin;
        echo "Metode : ".$this->getNamaMetode()."\n";
        echo "Ket : ".$keterangan."\n";
        echo "Jumlah : ".rupiah($jumlah)."\n";
        echo "Admin 0.7% : ".rupiah($admin)."\n";
        echo "Total : ".rupiah($total)."\n";
        echo "Berhasil dibayar\n\n";
        return true;
    }
}

// Class Kartu Kredit
class KartuKredit implements MetodePembayaran{
    private $kartu;
    function __construct($kartu){
        $this->kartu = $kartu;
    }
    public function getNamaMetode(): string{
        return "Kartu Kredit";
    }
    public function prosesBayar(float $jumlah, string $keterangan): bool{
        $admin = $jumlah * 2.5 / 100;
        $total = $jumlah + $admin;
        $akhir = substr($this->kartu, -4);

        echo "Metode : ".$this->getNamaMetode()."\n";
        echo "Kartu : **** **** **** ".$akhir."\n";
        echo "Ket : ".$keterangan."\n";
        echo "Jumlah : ".rupiah($jumlah)."\n";
        echo "Admin 2.5% : ".rupiah($admin)."\n";
        echo "Total : ".rupiah($total)."\n";
        echo "Berhasil dibayar\n\n";
        return true;
    }
}

// ujicoba
$bayar1 = new TransferBank("0987654321");
$bayar1->prosesBayar(500000, "Bayar SPP");

$bayar2 = new QRIS();
$bayar2->prosesBayar(500000, "Bayar SPP");

$bayar3 = new KartuKredit("1234567812345678");
$bayar3->prosesBayar(500000, "Bayar SPP");