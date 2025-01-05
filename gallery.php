<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Gallery
    </button>
    <div class="row">
        <div class="table-responsive" id="gallery_data">

        </div>

        <!-- Awal Modal Tambah-->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Gallery</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="gallery.php" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar</label>
                                <input type="file" id="image" class="form-control" name="image">
                            </div>
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="old_photo" id="old_photo">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <input type="submit" value="Simpan" name="simpan" class="btn btn-primary">
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
            url: "gallery_data.php",
            method: "POST",
            data: {
                hlm: hlm
            },
            success: function(data) {
                $('#gallery_data').html(data);
            }
        })
    }

    $(document).on('click', '.halaman', function() {
        var hlm = $(this).attr("id");
        load_data(hlm);
    });

    // Add event listener for edit buttons
    $(document).on('click', '.edit', function() {
        var id = $(this).data('id');
        var image = $(this).data('image');
        $('#id').val(id);
        $('#old_photo').val(image);
        $('#modalTambah').modal('show');
    });

    // Add event listener for delete buttons
    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        var image = $(this).data('image');
        if (confirm('Are you sure you want to delete this item?')) {
            $.post('gallery.php', {
                hapus: true,
                id: id,
                image: image
            }, function(response) {
                location.reload();
            });
        }
    });
});
</script>

<?php
include "koneksi.php";
include "upload_foto.php";

//jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    $created_at = date("Y-m-d H:i:s");
    $image = '';
    $photo_name = $_FILES['image']['name'];

    //jika ada file yang dikirim  
    if ($photo_name != '') {
        //panggil function upload_foto untuk cek spesifikasi file yg dikirimkan user
        //function ini memiliki 2 keluaran yaitu status dan message
        $cek_upload = upload_foto($_FILES["image"]);

        //cek status true/false
        if ($cek_upload['status']) {
            //jika true maka message berisi nama file gambar
            $image = $cek_upload['message'];
        } else {
            //jika false maka message berisi pesan error, tampilkan dalam alert
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    }

    //cek apakah ada id yang dikirimkan dari form
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        //jika ada id, lakukan update data dengan id tersebut
        $id = $_POST['id'];

        if ($photo_name == '') {
            //jika tidak ganti gambar
            $image = $_POST['old_photo'];
        } else {
            //jika ganti gambar, hapus gambar lama
            unlink("img/" . $_POST['old_photo']);
        }

        $stmt = $conn->prepare("UPDATE gallery
                                SET
                                image = ?,
                                created_at = ?
                                WHERE id = ?");

        $stmt->bind_param("ssi", $image, $created_at, $id);
        $simpan = $stmt->execute();
    } else {
       //jika tidak ada id, lakukan insert data baru
        $stmt = $conn->prepare("INSERT INTO gallery (image, created_at)
                                VALUES (?, ?)");

        $stmt->bind_param("ss", $image, $created_at);
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
    $image = $_POST['image'];

    if ($image != '') {
        //hapus file image
        unlink("img/" . $image);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id =?");

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