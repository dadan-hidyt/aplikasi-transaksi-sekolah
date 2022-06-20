 $data = array(
                    'id'      => $product->kode_produk,
                    'qty'     => $jmlhBln,
                    'price'   => $product->harga_produk,
                    'name'    => $product->nama_produk,
                    'options' => array()
                );
                if ($this->cart->insert($data)) {
                    $this->session->set_flashdata("cart_msg", "<p class='alert alert-success'>Product berhasil di tambahkan ke cart!</p>");
                    redirect("transaksi/add");
                }