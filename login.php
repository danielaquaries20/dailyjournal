<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//menyertakan code dari file koneksi
include "koneksi.php";

//check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) { 
	header("location:admin.php"); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
    $password = md5($_POST['password']);

    //prepared statement
    $stmt = $conn->prepare("SELECT * 
                          FROM user_web 
                          WHERE username=? AND password=?");

    //parameter binding 
    $stmt->bind_param("ss", $username, $password);//username string dan password string

    //database executes the statement
    $stmt->execute();

    //menampung hasil eksekusi
    $hasil = $stmt->get_result();

    //mengambil baris dari hasil sebagai array asosiatif
    $row = $hasil->fetch_array(MYSQLI_ASSOC);

    //check apakah ada baris hasil data user yang cocok
    if (!empty($row)) {
        //jika ada, simpan variable username pada session
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];

        //mengalihkan ke halaman admin
        header("location:admin.php");
    } else {
        //jika tidak ada (gagal), alihkan kembali ke halaman login
        header("location:login.php");
    }

    //menutup koneksi database
    $stmt->close();
    $conn->close();
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Login | Daily Journal Daniel</title>
        <link rel="icon"
            href="https://images.unsplash.com/photo-1720293315632-37efe958d5ec?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1fHx8ZW58MHx8fHx8" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    </head>

    <body class="bg-danger-subtle">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card border-0 shadow rounded-5">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="bi bi-person-circle h1 display-4"></i>
                                <p>Wellcome to My Daily Journal</p>
                                <hr />
                            </div>
                            <form action="" method="post">
                                <input type="text" name="username" class="form-control my-4 py-2 rounded-4"
                                    placeholder="Username" />
                                <input type="password" name="password" class="form-control my-4 py-2 rounded-4"
                                    placeholder="Password" />
                                <div class="text-center my-3 d-grid">
                                    <button class="btn btn-danger rounded-4">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <?php
        //set variable username dan password dummy
        $username = "admin";
        $password = "123456";

        //check apakah ada request dengan method POST yang dilakukan
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //tampilkan isi dari variable POST menggunakan perulangan
    

            //check apakah username dan password yang di POST sama dengan data dummy
            if ($_POST['username'] == $username and $_POST['password'] == $password) {
                echo '
        <div class="container mt-3 pt-3 mb-5">
        <div class="row"> 
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card border-0 shadow rounded-5 bg-warning-subtle">
                    <div class="card-body">
                        <div style="color:#6D4C41">
                            Yang Anda Inputkan <br>
                            <b>Username: ' . $_POST['username'] . '</b> <br>
                            <b>Password: ' . $_POST['password'] . '</b> <br>

                            <br>Respon: <br>
                            Username dan Password Salah
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        ';
            } else {
                echo '
            <div class="container mt-3 pt-3 mb-5">
            <div class="row"> 
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card border-0 shadow rounded-5 bg-warning-subtle">
                        <div class="card-body">
                            <div style="color:#6D4C41">
                                Yang Anda Inputkan <br>
                                <b>Username: ' . $_POST['username'] . '</b> <br>
                                <b>Password: ' . $_POST['password'] . '</b> <br>
    
                                <br>Respon: <br>
                                Username dan Password Salah
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            ';
            }
        }
        ;
        ?> -->
    </body>

    </html>
    <?php
}
?>
