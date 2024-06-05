<?php include('layouts/navbar-templet.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon"
          href="https://t4.ftcdn.net/jpg/04/92/55/37/360_F_492553733_M1ewmNvrx917YggK3b6IQjiqKzbCpufW.jpg">
     <title>Document</title>
     <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <link href="styles.css" rel="stylesheet">
</head>

<body>

     <div class="content">
          <div id="alert" onclick="valida()"></div>
          <div class="container main">
               <?php
              
               if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-info" role="alert" id="time">' . $_SESSION['message'] . '</div>';
                    
                    unset($_SESSION['message']);
               }
               ?>
               <hr>
               <div class="row">
                    <?php
                    // Koneksi ke database
                    $conn = new mysqli("localhost", "root", "", "blog");

                    // Periksa koneksi
                    if ($conn->connect_error) {
                         die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Memeriksa apakah ada pengguna yang login
                    $current_user = isset($_SESSION['username']) ? $_SESSION['username'] : '';

                    // Query untuk mengambil data posting
                    $sql = "SELECT * FROM posts ORDER BY upload_date DESC LIMIT 9999";
                    $result = $conn->query($sql);

                    // Cek apakah ada postingan
                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                    ?>
                    <!-- image -->
                    <div class="card mb-3">
                         <div class="position-relative">
                              <!-- class imga -->
                              <img src="blogs/uploads/<?php echo $row['image']; ?>"
                                   class="card-img-top post-image mt-4 m-7" style="border-radius: 10px;"
                                   alt="<?php echo $row['title']; ?>">
                              <div class="overlay">
                                   <?php if ($current_user == $row['uploaded_by']) { ?>
                                   <a href="delete_post.php?id=<?php echo $row['id']; ?>"
                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?');"><i
                                             class="bi bi-trash"></i></a>
                                   <?php } ?>
                              </div>
                         </div>
                         <div class="card-body mb-4">
                              <h2 class="card-title"><?php echo $row['title']; ?></h2>
                              <p class="card-text post-content"><?php echo $row['content']; ?></p>
                         </div>

                         <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                              <div>
                                   Diposting oleh: <?php echo $row['uploaded_by']; ?>
                                   Tanggal: <?php echo $row['upload_date']; ?>
                              </div>

                              <div class="button-container">
                                   <a href="blogs/komen.php?post_id=<?php echo $row['id']; ?>"
                                        class="btn btn-primary"><i class="bi bi-chat-left"></i></a>
                                   <a href="in/download.php?gambar=<?php echo $row['image']; ?>"
                                        class="btn btn-primary"><i class="bi bi-download"></i></a>
                              </div>
                         </div>
                    </div>
                    <?php
                         }
                    } else {
                    ?>
                    <p class="alert alert-dark mr-3">Tidak ada gambar</p>
                    <a href="blogs/upload.php" class="alert alert-dark me-1">Klik di sini untuk post</a>
                    <?php
                    }

                    // Tutup koneksi
                    $conn->close();
                    ?>
               </div>
          </div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+0pEd5eY1z4+cBB+z8V+W9CKMpYW4"
          crossorigin="anonymous"></script>
</body>

</html>
