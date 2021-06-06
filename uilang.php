<?php
/*
Developed by Habibie
Email: habibieamrullah@gmail.com 
WhatsApp: 6287880334339
WebSite: https://webappdev.my.id
Donate: https://www.paypal.com/paypalme/habibieamrullah
*/
    
    //Bahasa Indonesia
    function translateId(){
		global $language;
        global $rawword;
		//word definitions...
		$definitions = array(
			"A picture has been deleted." => "Sebuah gambar telah dihapus.",
			"About" => "Tentang",
			"Home Thumbnail Mode" => "Mode Thumbnail Halaman Utama",
			"Center Filled" => "Penuh dari Tengah",
			"Stretched Width or Height" => "Lebar atau Tinggi Tertarik",
			"Please fill all details." => "Tolong isi semuanya.",
			"Add more options" => "Tambahkan opsi",
			"Add more picture" => "Tambahkan gambar lain",
			"Add new item for this option" => "Tambahkan item untuk opsi ini",
			"Add new option title:" => "Tambah judul opsi baru",
			"Add to Cart" => "Tambah ke Keranjang",
			"Add" => "Tambah",
			"Clear Cart" => "Kosongkan Keranjang",
			"Order on WhatsApp" => "Pesan Lewat WhatsApp",
			"Back to Shop" => "Kembali ke Toko",
			"Add Product" => "Tambah Produk",
			"Additional Images" => "Gambar Tambahan",
			"Address" => "Alamat",
			"Delivery Address" => "Alamat Pengiriman",
			"Admin WhatsApp Phone Number" => "Nomor hape Admin dengan WhatsApp aktif",
			"All" => "Semua",
			"Back" => "Kembali",
			"Base URL (make sure to include '/' symbol at the end)" => "URL Dasar (pastikan Anda tambahkan simbol '/' di akhir)",
			"Base URL" => "URL Dasar",
			"Categories" => "Kategori",
			"Category updated" => "Kategori telah diperbarui",
			"Category" => "Kategori",
			"Close" => "Tutup",
			"Disable Decimals" => "Sembunyikan Desimal",
			"Congratulation!" => "Selamat!",
			"Contact Information" => "Informasi Pembeli",
			"Content" => "Konten",
			"Continue" => "Lanjut",
			"Currency Symbol" => "Simbol Mata Uang",
			"Date" => "Tanggal",
			"Delete" => "Hapus",
			"Delivery Method" => "Metode Pengiriman",
			"Developed by" => "Dikembangkan oleh",
			"Discount Price" => "Discount Harga",
			"Edit Post" => "Perbarui Pos",
			"Edit" => "Ubah",
			"Email" => "Alamat Email",
			"Enable Facebook Comment?" => "Aktifkan Komentar Facebook?",
			"Enable Recent Posts Slider?" => "Aktifkan slider untuk produk-produk terbaru?",
			"Enter new name for category" => "Nama kategori baru untuk",
			"Error during uploading. Try again" => "Terjadi kesalahan saatu mengunggah file. Coba lagi",
			"File is not valid. Please try again" => "File tidak valid. Coba lagi",
			"Hi" => "Halo",
			"Home" => "Beranda",
			"I would like to order:" => "Saya ingin order:",
			"Icon upload is OK" => "Unggah Ikon OK",
			"Image File" => "File Gambar",
			"Language" => "Bahasa",
			"Login success!" => "Login sukses!",
			"Login" => "Masuk",
			"Logo upload is OK" => "Unggah logo OK",
			"Logout" => "Keluar",
			"MORE" => "LIHAT",
			"Main Color" => "Warna Utama",
			"Mobile" => "Hape",
			"More in" => "Lainnya di",
			"More picture(s) has been added." => "Gambar tambahan sudah diunggah.",
			"More" => "Lebih",
			"Name" => "Nama",
			"New Post" => "Tambah Baru",
			"New category has been added" => "Kategori baru telah ditambahkan",
			"New category" => "Kategori baru",
			"New post has been published. Click" => "Pos baru berhasil diterbitkan. Klik",
			"No category has been added" => "Belum ada kategori yang sudah ditambahkan",
			"No" => "Tidak",
			"Notes" => "Catatan",
			"Nothing found" => "Tidak ditemukan apapun",
			"Oh no..." => "Oh tidak...",
			"One category removed" => "Satu kategori telah dihapus",
			"Option Title" => "Judul Opsi",
			"Option" => "Opsi",
			"Order Items" => "Produk yang Dibeli",
			"Order Now" => "Pesan Sekarang",
			"Order" => "Pesanan",
			"Orders" => "Pesanan masuk",
			"Orders" => "Pesanan",
			"Picture upload is OK" => "Unggah Gambar OK",
			"Pictures" => "Gambar",
			"Post successfully updated." => "Pos berhasil diperbarui",
			"Price" => "Harga",
			"Product price when this option is selected" => "Harga produk saat opsi ini dipilih",
			"Published Posts" => "Telah Terbit",
			"Quantity" => "Jumlah",
			"Recently Published" => "Baru Ditambahkan",
			"Search result for" => "Hasil pencarian kata",
			"Search" => "Cari",
			"Enable Publish Date?" => "Aktifkan Tanggal Terbit?",
			"Secondary Color" => "Warna Kedua",
			"Settings updated!" => "Pengaturan telah diperbarui!",
			"Settings" => "Pengaturan",
			"Share Buttons Option" => "Opsi tombol share",
			"Shopping Cart" => "Keranjang Belanja",
			"Submit" => "Tambahkan",
			"Thank you." => "Terima kasih.",
			"There is no category published." => "Belum ada kategori yang ditambahkan",
			"There is no option has been added." => "Belum ada opsi yang ditambahkan.",
			"There is no order recorded." => "Belum ada order masuk.",
			"There is no post published" => "Belum ada konten",
			"Title" => "Judul",
			"Total" => "Total Semua",
			"Type something..." => "Ketik sesuatu...",
			"Uncategorized" => "Tanpa kategori",
			"Update" => "Perbarui",
			"Upload progress" => "Proses unggah",
			"Video File" => "File Video",
			"Video upload is OK" => "Unggah Video OK",
			"Views" => "Dilihat",
			"WELCOME!\nClick OK to start.\nIf this message appears again, please check that you have correct database connection." => "SELAMAT DATANG!\nKlik OK untuk memulai.\nJika pesan ini muncul lagi, pastikan koneksi database Anda benar.",
			"Website Icon (.ico file)" => "Ikon Situs (file .ico)",
			"Website Title" => "Judul Situs",
			"Write some notes..." => "Tulis catatan untuk penjual...",
			"Yes" => "Ya",
			"You did not add any product." => "Anda belum menambahkan produk apapun.",
			"You did not submit your post correctly. Click" => "Anda tidak memposting konten dengan benar. Klik",
			"You may like:" => "Mungkin Anda tertarik:",
			"has been deleted" => "telah dihapus",
			"here" => "di sini",
			"Order Notes" => "Catatan",
			"to try again" => "untuk mencoba lagi",
			"to view it" => "untuk melihatnya",
		);
		
		return proceedTranslation($definitions, $rawword);
		
    }
	
	//proceed translation
	function proceedTranslation($definitions, $rawword){
		$translation = "[untranslated]";
		$keys = array_keys($definitions); 
		for($x = 0; $x < count($keys); $x++ ) { 
			if($keys[$x] == $rawword)
				$translation = $definitions[$keys[$x]];
		}
		return $translation;
	}
    
    $rawword;
    function uilang($txt){
        global $language;
        global $rawword;
        $rawword = $txt;
        switch($language){
            case "id" :
                return translateId();
                break;
            default :
                return $txt;
                break;
        }
    }
    
    function tt($txt1, $txt2){
        global $language;
        global $rawword;
        if($rawword == $txt1){
            return $txt2;
        }
    }
    
?>