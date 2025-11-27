<?php

/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */
require_once  '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
  ob_start();
?>

  <?php
  $bulan = $_GET['bulan'];
  switch ($bulan) {
    case '01':
      $bln = 'Januari';
      break;
    case '02':
      $bln = 'Februari';
      break;
    case '03':
      $bln = 'Maret';
      break;
    case '04':
      $bln = 'April';
      break;
    case '05':
      $bln = 'Mei';
      break;
    case '06':
      $bln = 'Juni';
      break;
    case '07':
      $bln = 'Juli';
      break;
    case '08':
      $bln = 'Agustus';
      break;
    case '09':
      $bln = 'September';
      break;
    case '10':
      $bln = 'Oktober';
      break;
    case '11':
      $bln = 'November';
      break;
    case '12':
      $bln = 'Desember';
      break;

    default:
      # code...
      break;
  }
  switch (date('m')) {
    case '01':
      $b = 'Januari';
      break;
    case '02':
      $b = 'Februari';
      break;
    case '03':
      $b = 'Maret';
      break;
    case '04':
      $b = 'April';
      break;
    case '05':
      $b = 'Mei';
      break;
    case '06':
      $b = 'Juni';
      break;
    case '07':
      $b = 'Juli';
      break;
    case '08':
      $b = 'Agustus';
      break;
    case '09':
      $b = 'September';
      break;
    case '10':
      $b = 'Oktober';
      break;
    case '11':
      $b = 'November';
      break;
    case '12':
      $b = 'Desember';
      break;

    default:
      # code...
      break;
  }
  ?>

  <!DOCTYPE html>
  <html lang="eng">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
      .table {
        border-collapse: collapse;
        width: 100vw;

      }

      th,
      td {
        padding: 8px;

      }

      table.bordered th,
      table.bordered td {
        border: 1px solid black;
      }

      table.bordered th {
        text-align: center;
      }
    </style>

  </head>

  <body>
    <!-- kop surat -->
    <table class="table">
      <colgroup>
        <col style="width: 10%" class="angka">
        <col style="width: 75%" class="angka">
        <col style="width: 10%" class="angka">
      </colgroup>
      <tr>
        <td>
          <img src="../assets/img/hatara.jpg" height="90" alt="" class="gambar">
        </td>
        <td style="text-align: center; padding: 16px 48px;">


          <span style="font-size: 20px;font-weight: bold;text-align: center;">Hatara Banjarbaru</span>
          <br>
          <span style="font-size: 12px;font-weight: lighter;text-align: center;">Jl. Kembang Bakung, No. 12, Loktabat Utara, <br> Kec. Banjarbaru Utara, Kalimantan Selatan 70714</span>

        </td>
        <td>

        </td>
      </tr>
    </table>
    <!-- kop surat -->


    <hr>


    <br>
    <h2 style="text-align: center;">Laporan Produk Terlaris
    </h2>
    <br>
    <table class="table">
      <colgroup>
        <col style="width: 50%">
        <col style="width: 50%">
      </colgroup>
      <thead>
        <tr>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Dicetak : <?= ucfirst($_SESSION['nama']) ?></td>
          <td style="text-align: right;">Periode : <?= $bln ?></td>
        </tr>
      </tbody>
    </table>
    <br>
    <br>

    <table class="table bordered">
  <colgroup>
    <col style="width: 5%" class="angka">
    <col style="width: 40%" class="angka">
    <col style="width: 25%" class="angka">
    <col style="width: 30%" class="angka">
  </colgroup>
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Produk</th>
      <th>Jumlah Terjual</th>
      <th>Pendapatan Dari Produk</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include_once '../config/koneksi.php';
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    $no = 1;

    $query = "
      SELECT p.nama_produk, SUM(dt.jumlah) AS jumlah_terjual, SUM(dt.jumlah * p.harga) AS pendapatan
      FROM katalog p
      JOIN detail_transaksi dt ON p.id = dt.id_produk
      JOIN transaksi t ON t.id_transaksi = dt.id_transaksi
      WHERE MONTH(t.tanggal) = $bulan AND YEAR(t.tanggal) = $tahun
      GROUP BY p.id, p.nama_produk
      ORDER BY jumlah_terjual DESC;
    ";

    $result = mysqli_query($koneksi, $query);

    while ($row = mysqli_fetch_assoc($result)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_produk']; ?></td>
        <td><?= $row['jumlah_terjual']; ?></td>
        <td>Rp<?= number_format($row['pendapatan'], 0, ',', '.'); ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>



    <br>
    <br>
    <br>

    <table class="table ">
      <colgroup>
        <col style="width: 60%" class="angka">
        <col style="width: 40%" class="angka">
      </colgroup>



      <tr style="text-align: right;">
        <td></td>
        <td>Banjarbaru, <?= date('d') . ' ' . $b . ' ' . date('Y')  ?> </td>
      </tr>
      
      <tr style="text-align: right;">
        <td></td>
        <td>
          <br><br><br><br>
        </td>
      </tr>
      <tr style="text-align: right;">
        <td></td>
        <td>
          <?= ucfirst($_SESSION['nama']) ?>
        </td>
      </tr>
    </table>

  </body>

  </html>

<?php

  $content = ob_get_clean();
  ob_clean();
  $html2pdf = new Html2Pdf('P', 'A4', 'fr');
  $html2pdf->pdf->SetDisplayMode('fullpage');
  $html2pdf->writeHTML($content);
  $html2pdf->output('example05.pdf');
} catch (Html2PdfException $e) {
  $html2pdf->clean();

  $formatter = new ExceptionFormatter($e);
  echo $formatter->getHtmlMessage();
}
?>