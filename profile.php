<?php
include "koneksi.php";
?>
<div class="container" id="profile_data">
    <!-- Form Update User -->
    <?php
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        // echo "IdNow: " . $id . "<br>";

        // Query untuk mengambil data user
        $sql = "SELECT * FROM user_web WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Tampilkan data user
            // echo "ID: " . $user['id'] . "<br>";
            // echo "Username: " . $user['username'] . "<br>";
            // echo "Password: " . $user['password'] . "<br>";
            // echo "Foto: " . $user['foto'] . "<br>";
        } else {
            echo "User tidak ditemukan.";
        }
    } else {
        echo "Anda belum login.";
    }
    ?>
    <form method="post" action="" enctype="multipart/form-data">

        <div class="modal-body">
            <div class="mb-3">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Ganti Password</label>
                <input type="password" class="form-control" name="password" placeholder="Tuliskan Password Baru" required>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                <input type="file" class="form-control" name="gambar">
            </div>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput3" class="form-label">Foto Profile saat ini</label>
            <?php
            if ($user["foto"] != '') {
                if (file_exists('img/' . $user["foto"] . '')) {
                    ?>
                    <br><img src="img/<?= $user["foto"] ?>" width="100">
                    <?php
                }
            }
            ?>
            <input type="hidden" name="gambar_lama" value="<?= $user["foto"] ?>">
        </div>
        <div class="modal-footer">

            <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
        </div>
    </form>

</div>

<?php
include "upload_foto.php";

//jika tombol simpan diklik
if (isset($_POST['simpan'])) {

    $password = md5($_POST['password']);
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    //upload gambar
    if ($nama_gambar != '') {
        $cek_upload = upload_foto($_FILES["gambar"]);

        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    }

    if (isset($_POST['id'])) {
        //update data
        $id = $_POST['id'];

        if ($nama_gambar == '') {
            //jika tidak ganti gambar
            $gambar = $_POST['gambar_lama'];
        } else {
            //jika ganti gambar, hapus gambar lama
            unlink("img/" . $_POST['gambar_lama']);
        }

        $stmt = $conn->prepare("UPDATE user_web 
                                SET                                 
                                password = ?,
                                foto = ?                            
                                WHERE id = ?");

        $stmt->bind_param("ssi", $password, $gambar, $id);
        $simpan = $stmt->execute();
    }

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=profile';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=profile';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>