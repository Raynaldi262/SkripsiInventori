<?php
require('../connect/conn.php');
require('../session/session.php');

$sql = "SELECT * FROM  users a WHERE id = " . $_SESSION['admin_id'] . "";
$admin_data = mysqli_query($conn, $sql);

function msg($pesan, $url)
{
?>
    <script type="text/javascript">
        alert('<?php echo $pesan ?>');
        window.location = '<?php echo $url ?>';
    </script>
<?php
}
