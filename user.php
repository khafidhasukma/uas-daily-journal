<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah User
    </button>
    <div class="row">
        <div class="table-responsive" id="user_data">

        </div>

        <!-- Awal Modal Tambah-->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" class="form-control" name="username"
                                    placeholder="Tuliskan username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="Tuliskan password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                <input type="password" id="confirm_password" class="form-control"
                                    name="confirm_password" placeholder="Konfirmasi password" required>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="file" id="photo" class="form-control" name="photo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Modal Tambah-->
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    load_data();

    function load_data(hlm) {
        $.ajax({
            url: "user_data.php",
            method: "POST",
            data: {
                hlm: hlm
            },
            success: function(data) {
                $('#user_data').html(data);
            }
        })
    }

    $(document).on('click', '.halaman', function() {
        var hlm = $(this).attr("id");
        load_data(hlm);
    });
});
</script>

<?php
include "upload_foto.php";

//jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $created_at = date("Y-m-d H:i:s");
    $photo = '';
    $photo_name = $_FILES['photo']['name'];

    //cek apakah password dan konfirmasi password sama
    if ($password !== $confirm_password) {
        echo "<script>
            alert('Password dan konfirmasi password tidak sama');
            document.location='admin.php?page=user';
        </script>";
        die;
    }

    $hashed_password = md5($password); // Hash the password using md5

    //jika ada file yang dikirim  
    if ($photo_name != '') {
        //panggil function upload_foto untuk cek spesifikasi file yg dikirimkan user
        //function ini memiliki 2 keluaran yaitu status dan message
        $cek_upload = upload_foto($_FILES["photo"]);

        //cek status true/false
        if ($cek_upload['status']) {
            //jika true maka message berisi nama file gambar
            $photo = $cek_upload['message'];
        } else {
            //jika false maka message berisi pesan error, tampilkan dalam alert
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=user';
            </script>";
            die;
        }
    }

    //cek apakah ada id yang dikirimkan dari form
    if (isset($_POST['id'])) {
        //jika ada id, lakukan update data dengan id tersebut
        $id = $_POST['id'];

        if ($photo_name == '') {
            //jika tidak ganti gambar
            $photo = $_POST['old_photo'];
        } else {
            //jika ganti gambar, hapus gambar lama
            unlink("img/" . $_POST['old_photo']);
        }

        $stmt = $conn->prepare("UPDATE user
                                SET
                                username =?,
                                password =?,
                                photo = ?,
                                created_at = ?
                                WHERE id = ?");

        $stmt->bind_param("ssssi", $username, $hashed_password, $photo, $created_at, $id);
        $simpan = $stmt->execute();
    } else {
        //jika tidak ada id, lakukan insert data baru
        $stmt = $conn->prepare("INSERT INTO user (username, password, photo, created_at)
                                VALUES (?,?,?,?)");

        $stmt->bind_param("ssss", $username, $hashed_password, $photo, $created_at);
        $simpan = $stmt->execute();
    }

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=user';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=user';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

//jika tombol hapus diklik
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $photo = $_POST['photo'];

    if ($photo != '') {
        //hapus file photo
        unlink("img/" . $photo);
    }

    $stmt = $conn->prepare("DELETE FROM user WHERE id =?");

    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=user';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=user';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>