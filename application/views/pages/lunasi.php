<?php
if (empty($DataTransaksi)) {
    redirect("transaksi");
}
$nama = "";
$tungakan = 0;
foreach ($DataTransaksi as $transaksi) {
    $nama = $transaksi->nama;
    $kode_transaksi = $transaksi->id_transaksi;
    $tanggal = $transaksi->tanggal_transaksi;
    $tungakan = abs($transaksi->kurang_bayar);
    $nisn = $transaksi->nisn;

}
?>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h2 mb-0 text-gray-800">LUNASI TRANSAKSI</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Lunasi</li>
            </ol>
          </div>
          <style>
            .card-input,
            .card-count,
            .card-trx {
              height: 180px;
              border: 1px solid #dfdfdf;
              box-shadow: 1px 1px 1px 1px #dfdfdf;
              padding: 8px 10px;
            }

            .card-count {
              width: 38%;
            }
            .date, .siswa, .customer {
                width: 95%;
            }
            .card-trx {
              width: 38%;
              height: 103px;
            }

            .btn-process {
              width: 20%;
              height: 90px;
            }

            .card-table {
              border: 1px solid #dfdfdf;
              box-shadow: 1px 1px 1px 1px #dfdfdf;
            }

            input {
              outline: none;
              padding: 0 5px;
              border: 1px solid #d5d5d5;
              border-radius: 4px;
              width: 60%;
              margin-right: 10px;
            }

            select {
              outline: none;
              width: 60%;
              margin-right: 10px;
              border-radius: 4px;
              border: 1px solid #d5d5d5;
            }

            .bln-byr {
              width: 61%;
            }

            .button-add,
            .button-process,
            .button-cancel {
              outline: none;
              border: none;
              padding: 7px;
              width: 80px;
              color: #fff;
              font-size: 14px;
            }

            .button-add:hover,
            .button-process:hover,
            .button-cancel:hover {
              opacity: .8;
            }

            .btn-del {
              font-size: 16px;
            }

            .table {
              border-collapse: collapse;
              padding-top: 10px;
              margin: 0 auto;
            }

            @media print {
              button {
                display: none;
              }
            }
          </style>
            <div id="er"></div>

            <div class="prd-sell d-flex flex-row w-100 bg-white">
            <div class="card-secc d-flex justify-content-between w-100 h-100">
              <div class="card-input d-flex w-100 bg-white rounded">
                <div class="d-flex flex-column justify-content-center w-100 h-100">
                  <label for="date" class="date d-flex align-items-center justify-content-between mx-auto">
                    <b>#Kode Transaksi</b>
                    <input disabled type="text" value="<?= $kode_transaksi; ?>" id="tanggal">
                  </label>
                  <label for="date" class="date d-flex align-items-center justify-content-between mx-auto">
                    <span>Tanggal :</span>
                    <input disabled type="text" value="<?= $tanggal; ?>" id="tanggal">
                  </label>
                    <label for="date" class="date d-flex align-items-center justify-content-between mx-auto">
                        <span>Siswa :</span>
                        <input disabled type="text" value="<?= $nama; ?>" id="tanggal">
                    </label>

                </div>
              </div>
            </div>
          </div>
          <!-- table -->
          <div class="card-table table-responsive bg-white rounded w-100 h-100 mt-4">
            <table class="table w-100">
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col">Nama produk</th>
                  <th scope="col">Harga</th>
                  <th scope="col">qty</th>
                    <th scope="col">jmlh bln</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $i = 0;
              $sub = 0;
              $total_bayar = 0;
              foreach ($DataTransaksi as $tr) {
                  $total_bayar = $tr->total_bayar;
                  $sub += $tr->jumlah_bayar;
                  $i++;
                  ?>
                    <tr>
                        <td class="text-center"><?= $i; ?></td>
                        <td><?= $tr->nama_produk; ?></td>
                        <td>Rp. <?= number_format($tr->jumlah_bayar,2,',','.'); ?></td>
                        <td><?= $tr->qty; ?></td>
                        <td><?= $tr->bulan_bayar ?></td>
                    </tr>
                  <?php
              }
              ?>
              <tr>
                  <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subtotal bayar : Rp. <?= number_format($sub,2,',','.'); ?></td>
              </tr>
              <tr>
                  <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Terbayar : Rp. <?= number_format($total_bayar,2,',','.'); ?></td>
              </tr>
              <tr>
                  <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Belum bayar : Rp. <?= number_format($tungakan,2,',','.') ?></td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- count session -->
          <div class="card-secc d-flex justify-content-between w-100 h-100">
            <div class="card-count d-flex justify-content-center bg-white mt-4 rounded h-50 bg-primary">
              <div class="d-flex flex-column justify-content-center w-100 h-100">
                <label for="subtotal" class="subtotal d-flex align-items-center justify-content-between"><span><b>Total Bayar</b> :</span>
                  <b style="padding: 20px;font-size: 25px;">Rp. <?= number_format($tungakan,2,',','.') ?></b>
                  <input type="number" hidden id="subtotal" value="<?=$tungakan?>">
                </label>
              </div>
            </div>
            <div class="card-trx d-flex justify-content-center bg-white mt-4 rounded">
              <div class="d-flex flex-column justify-content-center w-100 h-100">
                <label for="cash" class="cash d-flex align-items-center justify-content-between"><span>Cash :</span>
                  <input type="number" id="cash">
                </label>
                <label for="change" class="change d-flex align-items-center justify-content-between"><span>Kembalian :</span>
                  <input type="text" disabled placeholder="" id="change">
                </label>
              </div>
            </div>
            <div class="btn-process d-flex flex-column justify-content-between mt-4">
              <button type="button" id="payment" class="button-process btn btn-success w-100">Bayar</button>
              <button type="button" onclick="window.history.back()" class="button-cancel btn btn-danger w-100">Cancel</button>
                <form  action="<?= base_url('transaksi/output/'.$kode_transaksi) ?>" method="POST">
                    <input type="text" value="<?= $kode_transaksi; ?>" name="transaksi" hidden>
                    <input type="text" value="<?= $nisn; ?>" name="siswa" hidden>
                    <button class="print button-cancel btn btn-warning w-100" style="display: none" type="submit" name="out">Print struk</button>
                </form>

            </div>

          </div>
        </div>
        <div class="mb-4"></div>
        <script>
            jQuery(window).ready(function () {
                let button_payment = $("#payment");
                $("#cash").on("keyup change",function (){
                        let hutang = $("#subtotal").val();
                          let cash = $("#cash").val();
                          let akhir = cash-hutang;
                          $("#change").val(akhir.toLocaleString('id-ID'))
                });

                button_payment.on("click",function () {
                    button_payment.html("prosess...");
                    const cash = $("#cash");
                    const kembalian = $("#change");
                    const alerts = $("#er");
                    const total_bayar = $("#subtotal");
                    if (cash.val() <= 0) {
                        alerts.html(`<p class="alert alert-danger">Cash tidak boleh kosong</p>`);
                    } else {
                        const ajaxconf = {
                            url : window.location.href,
                            type:"POST",
                            data: {
                                cash:cash.val(),
                                total_bayar:total_bayar.val()
                            },
                        }
                        let xhr = $.ajax(ajaxconf);
                        xhr.done(function (e){
                            if (e != '0') {
                                alerts.html(`<p class="alert alert-success">${e}</p>`);
                                $(".print").show();
                                $("#payment").hide();
                            } else {
                                alerts.html(`<p class="alert alert-warning">Gagal</p>`);
                            }
                        });
                    }
                })
            });
        </script>
