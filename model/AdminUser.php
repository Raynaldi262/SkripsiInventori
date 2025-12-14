<?php
require('../connect/conn.php');
require('../session/session.php');

$sql = "SELECT * FROM  users a";
$admin_data = mysqli_query($conn, $sql);

$sql = "SELECT * FROM  users a WHERE id = " . $_SESSION['admin_id'] . "";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);


$sql = "SELECT count(*) jumlah FROM  gudang a WHERE  jumlah  <= 20";
$result = mysqli_query($conn, $sql);
$jumlah = mysqli_fetch_assoc($result);

$jumlah_notif = $jumlah['jumlah'];

$sql = "SELECT *  FROM  gudang a WHERE  jumlah  <= 20";
$notifikasi = mysqli_query($conn, $sql);


if (isset($_POST['insert_admin'])) {
    insertAdmin($conn);
}

if (isset($_POST['edit_admin'])) {
    getAdmin($conn);
}

if (isset($_POST['save_admin'])) {
    updateAdmin($conn);
}

if (isset($_POST['deleteUser'])) {
    deleteAdmin($conn);
}

function insertAdmin($conn)
{
    $gmbr_default = 'default.png';
    $img = $_FILES['img']['name'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $phone = $_POST['telp'];    
    $alamat = $_POST['alamat'];
    $pw = $_POST['pw'];
    $role = $_POST['lvl'];
    
    if ($img) {  // kalau upload gambar
        $ekstensi_diperbolehkan    = array('png', 'jpg');
        $nama_img = $_FILES['img']['name'];    //nama filenya apa
        $x = explode('.', $nama_img);   // dpt nama tanpa ekstensi file
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['img']['size'];   //ukuran brp
        $file_tmp = $_FILES['img']['tmp_name'];    //temp filenya apa

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {    // kalau ekstensinya bener
            if ($ukuran < 4044070) {        // max 4 mb
                move_uploaded_file($file_tmp, '../dist/img/admin/' . $nama_img);

            } else {
                msg('Ukuran file max 4mb!!', '../admin/user.php');
            }
        } else {
            msg('Ekstensi File yang diupload hanya diperbolehkan png / jpg!!', '../admin/user.php');
        }
    }else{
        $img = $gmbr_default;
    }

    $sql =  "INSERT INTO users (nik, nama, alamat, telepon, username, password, level, foto)
            VALUES ('". $nik ."', '".$nama."', '".$alamat."', '".$phone."', '".$username."', password('".$pw."'), '".$role."', '".$img."')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Data Berhasil diperbarui!!', '../admin/user.php');
    } else {
        msg('Data gagal diperbarui!!', '../admin/user.php');
    }
}

function updateAdmin($conn)
{
    $id = $_POST['edt_id'];
    $img = $_FILES['edt_img']['name'];
    $nik = $_POST['edt_nik'];
    $nama = $_POST['edt_nama'];
    $username = $_POST['edt_username'];
    $phone = $_POST['edt_telp'];    
    $alamat = $_POST['edt_alamat'];
    $new_pass = $_POST['new_pw'];
    $old_pass = $_POST['old_pw'];
    $role = $_POST['edt_lvl'];

    if ($img) {  // kalau upload gambar
        $ekstensi_diperbolehkan    = array('png', 'jpg');
        $nama_img = $_FILES['edt_img']['name'];    //nama filenya apa
        $x = explode('.', $nama_img);   // dpt nama tanpa ekstensi file
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['edt_img']['size'];   //ukuran brp
        $file_tmp = $_FILES['edt_img']['tmp_name'];    //temp filenya apa

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {    // kalau ekstensinya bener
            if ($ukuran < 4044070) {        // max 4 mb
                move_uploaded_file($file_tmp, '../dist/img/admin/' . $nama_img);

                // start kalau ganti password
                if ($new_pass != null && $old_pass != null) { //kalau pass ga null dan pas new dan konfirmasi sama
                    if (check_pass($id, $old_pass, $conn)) {
                        $sql = "UPDATE users SET
                                    nik = '$nik',
                                    nama = '$nama',
                                    alamat = '$alamat',
                                    telepon = '$phone',
                                    username = '$username',
                                    password = PASSWORD('$new_pass'),
                                    level = '$role',
                                    foto = '$img'
                                WHERE id = '$id'";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            msg('Data berhasil diubah!!', '../admin/user.php');
                        } else msg('Gagal Mengubah data!!', '../admin/user.php');
                    } else msg('Password yang dimasukkan salah, Silahkan coba kembali!!', '../admin/user.php');
                } else {
                    $sql = "UPDATE users SET
                                    nik = '$nik',
                                    nama = '$nama',
                                    alamat = '$alamat',
                                    telepon = '$phone',
                                    username = '$username',
                                    level = '$role',
                                    foto = '$img'
                                WHERE id = '$id'";
                            
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        msg('Data berhasil diubah!!', '../admin/user.php');
                    } else {
                        msg('Gagal Mengubah data!!', '../admin/user.php');
                    }
                }
            } else {
                msg('Ukuran file max 4mb!!', '../admin/user.php');
            }
        } else {
            msg('Ekstensi File yang diupload hanya diperbolehkan png / jpg!!', '../admin/user.php');
        }
    } else {  //kalau tidak upload gambar
        if ($new_pass != null && $old_pass != null) { //kalau pass ga null dan pas new dan konfirmasi sama
        
                if (check_pass($id, $old_pass, $conn)) {
                        $sql = "UPDATE users SET
                                    nik = '$nik',
                                    nama = '$nama',
                                    alamat = '$alamat',
                                    telepon = '$phone',
                                    username = '$username',
                                    password = PASSWORD('$new_pass'),
                                    level = '$role'
                                WHERE id = '$id'";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            msg('Data berhasil diubah!!', '../admin/user.php');
                        } else msg('Gagal Mengubah data!!', '../admin/user.php');
                    } else msg('Password yang dimasukkan salah, Silahkan coba kembali!!', '../admin/user.php');
                } else {
                    $sql = "UPDATE users SET
                                    nik = '$nik',
                                    nama = '$nama',
                                    alamat = '$alamat',
                                    telepon = '$phone',
                                    username = '$username',
                                    level = '$role'
                                WHERE id = '$id'";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        msg('Data berhasil diubah!!', '../admin/user.php');
                    } else {
                        msg('Gagal Mengubah data!!', '../admin/user.php');
                    }
                }
    }
}


function check_pass($id, $old_pass, $conn)
{
    $sql = "select 1 from users where id = " . $id . " and password(password) = '" . $old_pass . "' ";
    return $result = mysqli_query($conn, $sql);
}

function getAdmin($conn)
{
    $sql = "select * from users where id = " . $_POST['admin_id'] . "";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    echo json_encode($result);
}

function deleteAdmin($conn)
{
    
   $sql = "DELETE FROM users WHERE id = '" . $_POST['admin_id'] . "'";
   mysqli_query($conn, $sql);
   header("location: ../admin/user.php");
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
