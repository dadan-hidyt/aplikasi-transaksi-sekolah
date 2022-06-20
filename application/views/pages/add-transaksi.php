        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">TAMBAH TRANSAKSI</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
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

            .card-input {
              width: 49%;
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
          <?= $this->session->flashdata('cart_msg'); ?>
          <div class="prd-sell d-flex flex-row w-100 bg-white">
            <div class="card-secc d-flex justify-content-between w-100 h-100">
              <div class="card-input d-flex bg-white rounded">
                <div class="d-flex flex-column justify-content-center w-100 h-100">
                  <label for="date" class="date d-flex align-items-center justify-content-between">
                    <span>Tanggal :</span>
                    <input disabled type="text" value="<?= date("d-m-Y"); ?>" id="tanggal">
                  </label>
                  <label for="siswa" class="siswa d-flex align-items-center justify-content-between">
                    <span>Kasir :</span>
                    <input disabled type="text" value="<?= $UserData->username; ?>-<?= $this->session->userdata("akses"); ?>" id="kasir">
                  </label>
                  <label for="customer" class="customer d-flex align-items-center justify-content-between">
                    <span>Siswa :</span>
                    <select id="siswa">
                      <?php if (!empty($DataSiswa)) : ?>
                        <?php foreach ($DataSiswa as $value) : ?>
                          <option value="<?= $value->nisn; ?>"><?= $value->nama; ?> (<?= $value->nisn; ?>) </option>
                        <?php endforeach ?>
                      <?php else : ?>
                        <option value="">--tidak ada data--</option>
                      <?php endif ?>
                    </select>
                  </label>
                </div>
              </div>
              <div class="card-input d-flex bg-white rounded w-75 ml-4">
                <form action="<?= base_url('transaksi/addCart'); ?>" method="POST" class="d-flex flex-column justify-content-center w-100 h-100">
                  <label for="product" class="product d-flex align-items-center justify-content-between">
                    <span>Product :</span>
                    <select name="kode-produk" id="product">
                      <?php if (!empty($DataProduk)) : ?>
                        <?php foreach ($DataProduk as $produk) : ?>
                          <option value="<?= $produk->kode_produk; ?>"><?= $produk->nama_produk; ?></option>
                        <?php endforeach ?>
                      <?php else : ?>
                        <option value="">--tidak ada data</option>
                      <?php endif ?>
                    </select>
                  </label>
                  <label for="deadline" class="deadline d-flex align-items-center justify-content-between">
                    <span>qty :</span>
                    <input type="number" name="qty" placeholder="masukan quantity" id="deadline">
                  </label>
                  <label for="deadline" class="deadline d-flex align-items-center justify-content-between">
                    <?php
                    $bulan_indonesia = array(
                      1 => "Januari",
                      "Februari",
                      "Maret",
                      "April",
                      "Mei",
                      "Juni",
                      "Juli",
                      "Agustus",
                      "September",
                      "Oktober",
                      "November",
                      "Desember"
                    );
                    ?>
                    <span>Bulan bayar :</span>
                    <label for="" class="bln-byr d-flex justify-content-between">
                      <select name="bulan1" id="bulan-bayar" class="w-50">
                        <option value="">---Bayar dari bulan---</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                          echo "<option value='{$i}'>{$bulan_indonesia[$i]}</option>";
                        }
                        ?>
                      </select>
                      <select name="bulan2" id="bulan-bayar" class="w-50">
                        <option value="">---Sampai bulan---</option>
                        <?php
                        for ($i = 0; $i <= 12; $i++) {
                          if (isset($bulan_indonesia[$i])) {
                            echo "<option value='{$i}'>{$bulan_indonesia[$i]}</option>";
                          }
                        }
                        ?>
                      </select>
                    </label>
                  </label>
                  <div class="button">
                    <button class="button-add btn btn-primary rounded"><i class="fa fa-shopping-cart"></i> Add</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- table -->
          <div class="card-table table-responsive bg-white rounded w-100 h-100 mt-4">
            <table class="table w-100">
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col">Kode</th>
                  <th scope="col">Nama produk</th>
                  <th scope="col">Harga</th>
                  <th scope="col">qty</th>
                  <th scope="col">Bulan Bayar</th>
                  <th scope="col">Subtotal</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($cartData)) : $i = 0; ?>
                  <?php foreach ($cartData as $value) : $i++; ?>
                    <tr>
                      <th scope="row" class="text-center"><?= $i; ?></th>
                      <td><?= $value['id'] ?></td>
                      <td><?= $value['name'] ?></td>
                      <td>Rp. <?= number_format($value['price'], 0, '', '.') ?></td>
                      <td><?= $value['qty']; ?></td>
                      <td><?= !empty($value['bulan_bayar_str']) ? $value['bulan_bayar_str'] : "-" ?></td>
                      <td>Rp. <?= number_format($value['subtotal'], 0, '', '.') ?></td>
                      <td class="text-center"><a onclick="return confirm('apakah yakin?')" href="<?= base_url('transaksi/cart_item_delete/' . $value['rowid']); ?>" class="btn-del btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <!-- count session -->
          <div class="card-secc d-flex justify-content-between w-100 h-100">
            <div class="card-count d-flex justify-content-center bg-white mt-4 rounded h-50 bg-primary">
              <div class="d-flex flex-column justify-content-center w-100 h-100">
                <label for="subtotal" class="subtotal d-flex align-items-center justify-content-between"><span><b>Subtotal</b> :</span>
                  <b style="padding: 20px;font-size: 25px;">Rp. <?= number_format($cart_sub_total, 0, '', '.'); ?></b>
                  <input type="number" hidden id="subtotal" value="<?= $cart_sub_total ?>">
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
              <button type="button" id="payment" style="display:none;" class="button-process btn btn-success w-100">Bayar</button>
              <button type="button" onclick="window.history.back()" class="button-cancel btn btn-danger w-100">Cancel</button>

            </div>
          </div>
        </div>
        <div class="mb-4"></div>
        <!---Container Fluid-->
        <script>

          window.onload = function() {
            function element($element) {
              return document.querySelector($element);
            }
            let subtotal = element("#subtotal");
            if (subtotal.value > 0) {
              element("#cash").onkeyup = function(e) {
                let totalBayar = e.target.value - subtotal.value;
                if (totalBayar < 0) {
                  element("#change").value = "Rp. " + totalBayar.toLocaleString("id");
                  element("#change").style.border = "1px solid red";
                } else {
                  element("#change").value = "Rp. " + totalBayar.toLocaleString("id");
                  element("#change").style.border = "1px solid green";
                }
                if (e.target.value >= 1) {
                  element("#payment").style.display = "block";
                } else {
                  element("#payment").style.display = "none";
                }
              }
            }
            if (typeof element("#payment") != undefined) {
              element("#payment").onclick = function() {
                const siswa = element("#siswa").value;

                const kasir = element("#kasir").value;
                const tanggal = element("#tanggal").value;
                const cash = element("#cash").value;
                element("#payment").innerHTML = "Proccess...";
                $.ajax({
                  url: `<?= base_url("transaksi/payment"); ?>`,
                  type: "POST",
                  responseType: "json",
                  data: `tanggal=${tanggal}&siswa=${siswa}&kasir=${kasir}&cash=${cash}`,
                  success: function(e) {
                    if (e.success == true) {
                      alert('transaksi berhasil');
                      element("#payment").style.display = "none";
                      document.body.innerHTML = e.struk;
                      window.print();
                    }
                  }
                });
              }
            }

          }
        </script>