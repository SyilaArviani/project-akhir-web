<?php

require "koneksi.php";
$id = $_GET["id"];

$query = "SELECT * FROM mahasiswa where id = '$id' ";
$result = mysqli_query($conn, $query);

if ( !isset($_GET["id"]) ) {
    header("Location: index.php");
    exit;
}else if (mysqli_num_rows ( $result ) == 1 ) {

}else{
    header("Location: index.php");
    exit;
}

function ubah($data){

    global $conn;
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $kelas = $_POST["kelas"];

    $query = " UPDATE mahasiswa SET
                nama = '$nama',
                nim = '$nim',
                kelas = '$kelas'
                WHERE id = '$id' ";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

if ( isset ($_POST["update"]) ){
    if ( ubah ($_POST) > 0 ){
        echo "<script>
              alert('Berhasil Mengubah Data');
              document.location.href = 'index.php';
              </script> ";
    }else{
        echo "<script>
              alert('Gagal');
              </script> ";
    }
}

?>

<html>
    <body>
        <h1>Halaman Update</h1>
        <form action="" method="post">
            <?php while ($row = mysqli_fetch_assoc ( $result )) {?>

            <input type="hidden" name="id" value="<?php echo $row ['id']?>">
            Nama :
            <input type="text" name="nama" value="<?php echo $row ['nama']?>">
            <br>
            NIM : 
             <input type="text" name="nim" value="<?php echo $row ['nim']?>">
            <br>
             Kelas :
            <input type="text" name="kelas" value="<?php echo $row ['kelas']?>">
             <br>
            <button type="submit" name="update">Update</button>
            <?php } ?>
        </form>
    </body>
</html>