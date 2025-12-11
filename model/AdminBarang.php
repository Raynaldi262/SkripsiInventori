<?php
require('../connect/conn.php');
require('../session/session.php');


$sql = "SELECT * FROM  tb_supplier";
$supplier = mysqli_query($conn, $sql);


$sql2 = "SELECT * FROM  jenis_barang";
$jenis_barang = mysqli_query($conn, $sql2);
$jenis_barang2 = mysqli_query($conn, $sql2);


$sql3 = "SELECT * FROM  satuan";
$satuan_barang = mysqli_query($conn, $sql3);
$satuan_barang2 = mysqli_query($conn, $sql3);

$sql4 = "SELECT * FROM  gudang";
$data_barang = mysqli_query($conn, $sql4);

$sql5 = "SELECT * FROM  barang_masuk";
$masuk = mysqli_query($conn, $sql5);

$sql6 = "SELECT * FROM  barang_keluar";
$keluar = mysqli_query($conn, $sql6);

if (isset($_POST['detail_keluar'])) {
    detailKeluar($conn);
}

if (isset($_POST['detail_masuk'])) {
    detailMasuk($conn);
}

if (isset($_POST['insert_keluar'])) {
    insertKeluar($conn);
}

if (isset($_POST['insert_masuk'])) {
    insertMasuk($conn);
}

if (isset($_POST['insert_barang'])) {
    insertBarang($conn);
}

if (isset($_POST['insert_jenis'])) {
    insertJenis($conn);
}

if (isset($_POST['insert_satuan'])) {
    insertSatuan($conn);
}

if (isset($_POST['insert_supplier'])) {
    insertSupplier($conn);
}

if (isset($_POST['edit_jenis'])) {
    getJenis($conn);
}

if (isset($_POST['edit_satuan'])) {
    getSatuan($conn);
}

if (isset($_POST['edit_supplier'])) {
    getSupplier($conn);
}

if (isset($_POST['edit_barang'])) {
    getBarang($conn);
}

if (isset($_POST['save_jenis'])) {
    updateJenis($conn);
}

if (isset($_POST['save_satuan'])) {
    updateSatuan($conn);
}

if (isset($_POST['save_supplier'])) {
    updateSupplier($conn);
}

if (isset($_POST['save_barang'])) {
    updateBarang($conn);
}

if (isset($_POST['deleteJenis'])) {
    deleteJenis($conn);
}

if (isset($_POST['deleteSatuan'])) {
    deleteSatuan($conn);
}

if (isset($_POST['deleteSupplier'])) {
    deleteSupplier($conn);
}

if (isset($_POST['deleteBarang'])) {
    deleteBarang($conn);
}

if (isset($_POST['deleteMasuk'])) {
    deleteMasuk($conn);
}

if (isset($_POST['deleteKeluar'])) {
    deleteKeluar($conn);
}

function insertKeluar($conn){
    $trx = $_POST['trx'];
    $tgl = $_POST['tgl'];
    $kdbarang = $_POST['barang'];
    $jumlah = $_POST['jmlh'];
    $tujuan = $_POST['tujuan'];

    $sqlBarang = "select kode_barang, jumlah, nama_barang, satuan 
                from gudang where kode_barang = '".$kdbarang."' ";
    $result = mysqli_query($conn, $sqlBarang);
    $row = mysqli_fetch_assoc($result);

    $nmBarang = $row['nama_barang'];
    $satuan = $row['satuan'];
    $jmlhTotal = $row['jumlah'] - $jumlah;

    if($jmlhTotal < 0){
        msg('Stok tidak mencukupi!!', '../admin/barangKeluar.php');
    }else{


        $sql = "INSERT INTO barang_keluar(id_transaksi, tanggal, kode_barang, nama_barang, jumlah, tujuan, satuan)
        VALUES ('$trx', '$tgl', '$kdbarang', '$nmBarang', '$jumlah', '$tujuan', '$satuan')";

        $result = mysqli_query($conn, $sql);

        $sql2 =  "UPDATE gudang set jumlah = '".$jmlhTotal."' where kode_barang = '".$kdbarang."' ";
        $result2 = mysqli_query($conn, $sql2);


        if ($result) {
            msg('Data Berhasil ditambahkan!!', '../admin/barangKeluar.php');
        } else {
            msg('Data gagal ditambahkan!!', '../admin/barangKeluar.php');
        }
    }
}


function insertMasuk($conn){
    $trx = $_POST['trx'];
    $tgl = $_POST['tgl'];
    $kdbarang = $_POST['barang'];
    $jumlah = $_POST['jmlh'];
    $nmSupplier = $_POST['supplier'];

    $sqlBarang = "select kode_barang, jumlah, nama_barang, satuan 
                from gudang where kode_barang = '".$kdbarang."' ";
    $result = mysqli_query($conn, $sqlBarang);
    $row = mysqli_fetch_assoc($result);

    $nmBarang = $row['nama_barang'];
    $satuan = $row['satuan'];
    $jmlhTotal = $row['jumlah'] + $jumlah;


    $sql = "INSERT INTO barang_masuk (id_transaksi, tanggal, kode_barang, nama_barang, pengirim, jumlah, satuan)
        VALUES ('$trx', '$tgl', '$kdbarang', '$nmBarang', '$nmSupplier', '$jumlah', '$satuan')";

    
    $result = mysqli_query($conn, $sql);

    $sql2 =  "UPDATE gudang set jumlah = '".$jmlhTotal."' where kode_barang = '".$kdbarang."' ";
    $result2 = mysqli_query($conn, $sql2);


    if ($result) {
        msg('Data Berhasil ditambahkan!!', '../admin/barangMasuk.php');
    } else {
        msg('Data gagal ditambahkan!!', '../admin/barangMasuk.php');
    }

}

function insertJenis($conn){
    $jenis = $_POST['jb'];

    $sql =  "INSERT INTO jenis_barang (jenis_barang)
            VALUES ('". $jenis ."')";

    
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Data Berhasil ditambahkan!!', '../admin/jenisBarang.php');
    } else {
        msg('Data gagal ditambahkan!!', '../admin/jenisBarang.php');
    }

}

function insertSatuan($conn){
    $satuan = $_POST['sb'];

    $sql =  "INSERT INTO satuan (satuan)
            VALUES ('". $satuan ."')";

    
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Data Berhasil ditambahkan!!', '../admin/satuanBarang.php');
    } else {
        msg('Data gagal ditambahkan!!', '../admin/satuanBarang.php');
    }

}

function insertSupplier($conn){
    $kode = $_POST['ks'];
    $nama = $_POST['ns'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];

    $sql = "INSERT INTO tb_supplier (kode_supplier, nama_supplier, alamat, telepon)
        VALUES ('$kode', '$nama', '$alamat', '$hp')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Data Berhasil ditambahkan!!', '../admin/supplierBarang.php');
    } else {
        msg('Data gagal ditambahkan!!', '../admin/supplierBarang.php');
    }

}

function updateJenis($conn){
    $id = $_POST['edt_id'];
    $jenis = $_POST['edt_jenis'];

    $sql =  "UPDATE jenis_barang set jenis_barang = '".$jenis."' where id = '".$id."'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Data Berhasil diubah!!', '../admin/jenisBarang.php');
    } else {
        msg('Data gagal diubah!!', '../admin/jenisBarang.php');
    }

}

function updateSupplier($conn){
    $id = $_POST['edt_id'];
    $kode = $_POST['edt_ks'];
    $nama = $_POST['edt_ns'];
    $alamat = $_POST['edt_alamat'];
    $hp = $_POST['edt_hp'];

    $sql = "UPDATE tb_supplier SET 
            kode_supplier = '$kode',
            nama_supplier = '$nama',
            alamat = '$alamat',
            telepon = '$hp'
        WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Data Berhasil diubah!!', '../admin/supplierBarang.php');
    } else {
        msg('Data gagal diubah!!', '../admin/supplierBarang.php');
    }

}

function updateSatuan($conn){
    $id = $_POST['edt_id'];
    $satuan = $_POST['edt_satuan'];

    $sql =  "UPDATE satuan set satuan = '".$satuan."' where id = '".$id."'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Data Berhasil diubah!!', '../admin/satuanBarang.php');
    } else {
        msg('Data gagal diubah!!', '../admin/satuanBarang.php');
    }

}

function deleteJenis($conn)
{
    
   $sql = "DELETE FROM jenis_barang WHERE id = '" . $_POST['admin_id'] . "'";
   mysqli_query($conn, $sql);
   header("location: ../admin/jenisBarang.php");
}

function deleteSatuan($conn)
{
    
   $sql = "DELETE FROM satuan WHERE id = '" . $_POST['admin_id'] . "'";
   mysqli_query($conn, $sql);
   header("location: ../admin/satuanBarang.php");
}

function deleteSupplier($conn)
{
    
   $sql = "DELETE FROM tb_supplier WHERE id = '" . $_POST['admin_id'] . "'";
   mysqli_query($conn, $sql);
   header("location: ../admin/supplierBarang.php");
}


function getJenis($conn)
{
    $sql = "select * from jenis_barang where id = " . $_POST['admin_id'] . "";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    echo json_encode($result);
}

function getSatuan($conn)
{
    $sql = "select * from satuan where id = " . $_POST['admin_id'] . "";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    echo json_encode($result);
}

function getSupplier($conn)
{
    $sql = "select * from tb_supplier where id = " . $_POST['admin_id'] . "";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    echo json_encode($result);
}

function getFormat(){

    $conn1 = mysqli_connect("localhost", "root", "", "inventori2") or die("Error in connection!");
    $no = mysqli_query($conn1, "select kode_barang from gudang order by kode_barang desc");
    $kdbarang = mysqli_fetch_assoc($no);

    $kode = $kdbarang['kode_barang'];


    $urut = substr($kode, 8, 3);
    $tambah = (int) $urut + 1;
    $bulan = date("m");
    $tahun = date("y");
    $format ="";

    if(strlen($tambah) == 1){
        $format = "BAR-".$bulan.$tahun."00".$tambah;
    } else if(strlen($tambah) == 2){
        $format = "BAR-".$bulan.$tahun."0".$tambah;
        
    } else{
        $format = "BAR-".$bulan.$tahun.$tambah;
    }


    return $format;
}

function getFormatMasuk(){

    $conn1 = mysqli_connect("localhost", "root", "", "inventori2") or die("Error in connection!");
    $no = mysqli_query($conn1, "select id_transaksi from barang_masuk order by id_transaksi desc");
    
    $idtran = mysqli_fetch_array($no);
    $kode = $idtran['id_transaksi'];


    $urut = substr($kode, 8, 3);
    $tambah = (int) $urut + 1;
    $bulan = date("m");
    $tahun = date("y");

    if(strlen($tambah) == 1){
        $format = "TRM-".$bulan.$tahun."00".$tambah;
    } else if(strlen($tambah) == 2){
        $format = "TRM-".$bulan.$tahun."0".$tambah;
        
    } else{
        $format = "TRM-".$bulan.$tahun.$tambah;

    }

    return $format;
}


function getFormatKeluar(){

    $conn1 = mysqli_connect("localhost", "root", "", "inventori2") or die("Error in connection!");
    $no = mysqli_query($conn1, "select id_transaksi from barang_keluar order by id_transaksi desc");
    $idtran = mysqli_fetch_array($no);
    $kode = $idtran['id_transaksi'];


    $urut = substr($kode, 8, 3);
    $tambah = (int) $urut + 1;
    $bulan = date("m");
    $tahun = date("y");

    if(strlen($tambah) == 1){
        $format = "TRK-".$bulan.$tahun."00".$tambah;
    } else if(strlen($tambah) == 2){
        $format = "TRK-".$bulan.$tahun."0".$tambah;
        
    } else{
        $format = "TRK-".$bulan.$tahun.$tambah;

    }

    return $format;
}

function getFormatSupp(){

    $conn1 = mysqli_connect("localhost", "root", "", "inventori2") or die("Error in connection!");
    $no = mysqli_query($conn1, "select kode_supplier from tb_supplier order by kode_supplier desc");
    $kdsupplier = mysqli_fetch_array($no);
    $kode = $kdsupplier['kode_supplier'];


    $urut = substr($kode, 8, 3);
    $tambah = (int) $urut + 1;
    $bulan = date("m");
    $tahun = date("y");

    if(strlen($tambah) == 1){
        $format = "SUP-".$bulan.$tahun."00".$tambah;
    } else if(strlen($tambah) == 2){
        $format = "SUP-".$bulan.$tahun."0".$tambah;
        
    } else{
        $format = "SUP-".$bulan.$tahun.$tambah;

    }

    return $format;
}


function msg($pesan, $url)
{
?>
    <script type="text/javascript">
        alert('<?php echo $pesan ?>');
        window.location = '<?php echo $url ?>';
    </script>
<?php
}

function detailMasuk($conn)
{
    
    $sql = "select * from barang_masuk
            where kode_barang = '" . $_POST['admin_id'] . "'";
    $result = mysqli_query($conn, $sql);
    // $result = mysqli_fetch_assoc($result);

    // echo json_encode($result);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

function detailKeluar($conn)
{
    
    $sql = "select * from barang_keluar
            where kode_barang = '" . $_POST['admin_id'] . "'";
    $result = mysqli_query($conn, $sql);
    // $result = mysqli_fetch_assoc($result);

    // echo json_encode($result);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

function getBarang($conn)
{
    $sql = "select * from gudang where id = " . $_POST['admin_id'] . "";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    echo json_encode($result);
}

function insertBarang($conn)
{
    $gmbr_default = 'default.png';
    $id = $_POST['kode'];
    $img = $_FILES['img']['name'];
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $satuan = $_POST['satuan'];
    $jumlah = $_POST['jmlh'];

    if ($img) {  // kalau upload gambar
        $ekstensi_diperbolehkan    = array('png', 'jpg');
        $nama_img = $_FILES['img']['name'];    //nama filenya apa
        $x = explode('.', $nama_img);   // dpt nama tanpa ekstensi file
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['img']['size'];   //ukuran brp
        $file_tmp = $_FILES['img']['tmp_name'];    //temp filenya apa

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {    // kalau ekstensinya bener
            if ($ukuran < 4044070) {        // max 4 mb
                move_uploaded_file($file_tmp, '../dist/img/barang/' . $nama_img);

                $sql = "INSERT INTO gudang (kode_barang, nama_barang, jenis_barang, jumlah, satuan, foto) 
                VALUES ('$id', '$nama', '$jenis', '0', '$satuan', '$img')";


                $result = mysqli_query($conn, $sql);

                if ($result) {
                    msg('Data berhasil ditambahkan!!', '../admin/barang.php');
                } else msg('Gagal menambahkan data!!', '../admin/barang.php');
            } else {
                msg('Ukuran file max 4mb!!', '../admin/barang.php');
            }
        } else {
            msg('Ekstensi File yang diupload hanya diperbolehkan png / jpg!!', '../admin/barang.php');
        }
    }else{ 
        
        $sql = "INSERT INTO gudang (kode_barang, nama_barang, jenis_barang, jumlah, satuan, foto) 
                VALUES ('$id', '$nama', '$jenis', '0', '$satuan', '$gmbr_default')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            msg('Data berhasil diubah!!', '../admin/barang.php');
        } else msg('Gagal Mengubah data!!', '../admin/barang.php');
    }
}


function updateBarang($conn)
{
    $gmbr_default = 'default.png';
    $id = $_POST['edt_id'];
    $img = $_FILES['edt_img']['name'];
    $nama = $_POST['edt_nama'];
    $jenis = $_POST['edt_jenis'];
    $satuan = $_POST['edt_satuan'];

    if ($img) {  // kalau upload gambar
        $ekstensi_diperbolehkan    = array('png', 'jpg');
        $nama_img = $_FILES['edt_img']['name'];    //nama filenya apa
        $x = explode('.', $nama_img);   // dpt nama tanpa ekstensi file
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['edt_img']['size'];   //ukuran brp
        $file_tmp = $_FILES['edt_img']['tmp_name'];    //temp filenya apa

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {    // kalau ekstensinya bener
            if ($ukuran < 4044070) {        // max 4 mb
                move_uploaded_file($file_tmp, '../dist/img/barang/' . $nama_img);

                $sql = "UPDATE gudang 
                SET nama_barang = '$nama', jenis_barang = '$jenis',  satuan = '$satuan', foto = '$img'
                WHERE id = '$id'";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    msg('Data berhasil diubah!!', '../admin/barang.php');
                } else msg('Gagal Mengubah data!!', '../admin/barang.php');
            } else {
                msg('Ukuran file max 4mb!!', '../admin/barang.php');
            }
        } else {
            msg('Ekstensi File yang diupload hanya diperbolehkan png / jpg!!', '../admin/barang.php');
        }
    }else{ 
        
        $sql = "UPDATE gudang 
        SET nama_barang = '$nama', jenis_barang = '$jenis', jumlah = '$jumlah', satuan = '$satuan'
        WHERE id = '$id'";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            msg('Data berhasil diubah!!', '../admin/barang.php');
        } else msg('Gagal Mengubah data!!', '../admin/barang.php');
    }
}

function deleteBarang($conn)
{
   $sql = "DELETE FROM gudang WHERE id = '" . $_POST['admin_id'] . "'";
   mysqli_query($conn, $sql);
   header("location: ../admin/barang.php");
}

function deleteMasuk($conn)
{
   $kode = $_POST['kode_barang'];
   $jmlh = $_POST['jmlh_barang'];

   $sql2 = "UPDATE gudang set jumlah = jumlah - '".$jmlh."' where kode_barang = '".$kode."' ";
   mysqli_query($conn, $sql2);

   $sql = "DELETE FROM barang_masuk WHERE id = '" . $_POST['admin_id'] . "'";
   mysqli_query($conn, $sql);


   header("location: ../admin/barangMasuk.php");
}

function deleteKeluar($conn)
{
   $kode = $_POST['kode_barang'];
   $jmlh = $_POST['jmlh_barang'];

   $sql2 = "UPDATE gudang set jumlah = jumlah + '".$jmlh."' where kode_barang = '".$kode."' ";
   mysqli_query($conn, $sql2);

   $sql = "DELETE FROM barang_keluar WHERE id = '" . $_POST['admin_id'] . "'";
   mysqli_query($conn, $sql);


   header("location: ../admin/barangKeluar.php");
}