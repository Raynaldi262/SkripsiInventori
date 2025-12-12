<?php
require('../connect/conn.php');
require('../session/session.php');
if (isset($_POST['btnlogin'])) {

    $username = strtoupper($_POST['username']);
    $password = $_POST['password'];

    //create some sql statement             
    $sql = "SELECT * FROM users WHERE upper(username) = '$username' AND password = password('$password')";
    $result = mysqli_query($conn, $sql);

        // get nmbr of result
        $numrows = mysqli_num_rows($result);
    
        if ($numrows == 1) {   // kalau hasilnya ktmu dan 1
            $user = mysqli_fetch_assoc($result);

            
        $query = "SELECT nama_barang, jumlah FROM gudang WHERE jumlah <= 5";
        $result = mysqli_query($conn, $query);

        $messages = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = "Stok " . $row['nama_barang'] . " tinggal " . $row['jumlah'];
        }

        if (!empty($messages)) {
            $_SESSION['alerts'][] = [
                "icon" => "warning",
                "message" => implode("<br>", $messages) // gabung jadi 1 string
            ];
        }

        

        // var_dump($_SESSION['alerts']); die;
            // msukin data yg login ke session
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['role_id'] = $user['level'];

            ?>
                <!-- login berhasil  -->
                <script type="text/javascript">
                    alert("Selamat datang ");
                    window.location = "../admin/index.php?success=1";
                </script>
            <?php
        }
        else {
            ?>
            <script type="text/javascript">
                alert("Maaf, username / password yang dimasukan salah, silahkan coba kembali.");
                window.location = "login_admin.php";
            </script>
        <?php
        }
}
?>