<?php
session_start();


$conn = mysqli_connect("localhost","root","","stockbarang");


//menambah stock barang
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn,"insert into stock (namabarang, deskripsi, stock) values('$namabarang','$deskripsi','$stock')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};


//menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerimanya = $_POST['penerimanya'];
    $qty = $_POST['qty'];
    $satuan = $_POST['satuan'];
    $kabupaten = $_POST['kabupaten'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn,"insert into masuk (idbarang, idpenerima, qty, satuan, kabupaten) values('$barangnya','$penerimanya','$qty','$satuan','$kabupaten')");
    $updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

//menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerimanya = $_POST['penerimanya'];
    $qty = $_POST['qty'];
    $satuan = $_POST['satuan'];
    $kabupaten = $_POST['kabupaten'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

    $addtokeluar = mysqli_query($conn,"insert into keluar (idbarang, idpenerima, qty, satuan, kabupaten) values('$barangnya','$penerimanya','$qty','$satuan','$kabupaten')");
    $updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtokeluar&&$updatestockmasuk){
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}



//menambah data penerima
if(isset($_POST['addpenerima'])){
    $namapenerima = $_POST['namapenerima'];
    $nik = $_POST['nik'];
    $ttl = $_POST['ttl'];
    $pekerjaan = $_POST['pekerjaan'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];

    $addtopenerima = mysqli_query($conn,"insert into penerima (namapenerima, nik, ttl, pekerjaan, alamat, telpon) values('$namapenerima','$nik','$ttl','$pekerjaan','$alamat','$telpon')");
    if($addtopenerima){
        header('location:penerima.php');
    } else {
        echo 'Gagal';
        header('location:penerima.php');
    }
};



//mengubah data stock
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($conn,"update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang='$idb'");
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//menghapus data stock
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn,"delete from stock where idbarang='$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}


//mengubah barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $qty = $_POST['qty'];
    $satuan = $_POST['satuan'];
    $kabupaten = $_POST['kabupaten'];

    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stockskrg+$selisih;
        $kurangistoknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', satuan='$satuan', kabupaten='$kabupaten' where idmasuk='$idm'");
            if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            }
    }else{
        $selisih = $qtyskrg-$qty;
        $kurangin = $stockskrg-$selisih;
        $kurangistoknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', satuan='$satuan', kabupaten='$kabupaten' where idmasuk='$idm'");
            if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            }
    }

}


//menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $qty = $_POST['kty'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok-$qty;

    $update = mysqli_query($conn,"update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from masuk where idmasuk='$idm'");

    if($update&&$hapusdata){
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }
}



//mengubah barang keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $qty = $_POST['qty'];
    $satuan = $_POST['satuan'];
    $kabupaten = $_POST['kabupaten'];

    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stockskrg-$selisih;
        $kurangistoknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', satuan='$satuan', kabupaten='$kabupaten' where idkeluar='$idk'");
            if($kurangistocknya&&$updatenya){
                header('location:keluar.php');
            } else {
                echo 'Gagal';
                header('location:keluar.php');
            }
    }else{
        $selisih = $qtyskrg-$qty;
        $kurangin = $stockskrg+$selisih;
        $kurangistoknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', satuan='$satuan', kabupaten='$kabupaten' where idkeluar='$idk'");
            if($kurangistocknya&&$updatenya){
                header('location:keluar.php');
            } else {
                echo 'Gagal';
                header('location:keluar.php');
            }
    }

}


//menghapus barang keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $qty = $_POST['kty'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok+$qty;

    $update = mysqli_query($conn,"update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from keluar where idkeluar='$idk'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }
}



//menambah admin baru
if(isset($_POST['addadmin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $queryinsert = mysqli_query($conn,"insert into login (email, password) values('$email','password')");
    if($queryinsert){
        header('location:admin.php');
    } else {
        echo 'Gagal';
        header('location:admin.php');
    }
};



//mengedit data admin
if(isset($_POST['updateadmin'])){
    $emailbaru = $_POST['emailadmin'];
    $passwordbaru = $_POST['passwordbaru'];
    $idnya = $_POST['id'];

    $queryupdate= mysqli_query($conn,"update login set email='$emailbaru', password='$passwordbaru' where iduser='$idnya'");
    if($queryupdate){
        header('location:admin.php');
    } else {
        echo 'Gagal';
        header('location:admin.php');
    }
};



//menghapus data admin
if(isset($_POST['hapusadmin'])){
    $id = $_POST['id'];

    $querydelete= mysqli_query($conn,"delete from login where iduser='$id'");
    if($querydelete){
        header('location:admin.php');
    } else {
        echo 'Gagal';
        header('location:admin.php');
    }
};


//mengubah data stock
if(isset($_POST['updatepenerima'])){
    $idp = $_POST['idp'];
    $namapenerima = $_POST['namapenerima'];
    $nik = $_POST['nik'];
    $ttl = $_POST['ttl'];
    $pekerjaan = $_POST['pekerjaan'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];

    $updatepenerima = mysqli_query($conn,"update penerima set namapenerima='$namapenerima', nik='$nik', ttl='$ttl', pekerjaan='$pekerjaan', alamat='$alamat', telpon='$telpon' where idpenerima='$idp'");
    if($updatepenerima){
        header('location:penerima.php');
    } else {
        echo 'Gagal';
        header('location:penerima.php');
    }
}

//menghapus data stock
if(isset($_POST['hapuspenerima'])){
    $idp = $_POST['idp'];

    $hapuspenerima = mysqli_query($conn,"delete from penerima where idpenerima='$idp'");
    if($hapuspenerima){
        header('location:penerima.php');
    } else {
        echo 'Gagal';
        header('location:penerima.php');
    }
}



?>