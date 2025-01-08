<?php
include "koneksi.php";
?>
<div class="container">
    <!-- Form Update User -->
    <form method="post" action="" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Ganti Password</label>
                <input type="text" class="form-control" name="judul" placeholder="Tuliskan Password Baru" required>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                <input type="file" class="form-control" name="gambar">
            </div>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput3" class="form-label">Foto Profile saat ini</label>
            <?php
            if ($row["gambar"] != '') {
                if (file_exists('img/' . $row["gambar"] . '')) {
                    ?>
                    <br><img src="img/<?= $row["gambar"] ?>" width="100">
                    <?php
                }
            }
            ?>
            <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
        </div>
        <div class="modal-footer">

            <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
        </div>
    </form>

</div>

<script>
    $(document).ready(function () {
        load_data();
        function load_data(hlm) {
            $.ajax({
                url: "profile_data.php",
                method: "POST",
                data: {
                    hlm: hlm
                },
                success: function (data) {
                    $('#profile_data').html(data);
                }
            })
        }

        $(document).on('click', '.halaman', function () {
            var hlm = $(this).attr("id");
            load_data(hlm);
        });
    });
</script>

<?php
include "upload_foto.php";

//jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    $gambar = '';
    $username = $_SESSION['username'];
    $tanggal = date("Y-m-d H:i:s");
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

        $stmt = $conn->prepare("UPDATE galerry 
                                SET                                 
                                gambar = ?,
                                username = ?,
                                tanggal = ?                                
                                WHERE id = ?");

        $stmt->bind_param("sssi", $gambar, $username, $tanggal, $id);
        $simpan = $stmt->execute();
    } else {
        //insert data
        $stmt = $conn->prepare("INSERT INTO galerry (gambar,username,tanggal)
                                VALUES (?,?,?)");

        $stmt->bind_param("sss", $gambar, $username, $tanggal);
        $simpan = $stmt->execute();
    }

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

//jika tombol hapus diklik
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        //hapus file gambar
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM galerry WHERE id =?");

    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>