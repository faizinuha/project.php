<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profil</title>
  <!-- Tambahkan stylesheet Bootstrap -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="container">
    <h1>Edit Profil</h1>
    <div class="card">
      <div class="card-body">
        <form action="proses_edit_profil.php" method="POST">
          <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" class="form-control" id="name" name="name"
              value="<?php echo isset($name) ? $name : ''; ?>">
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email"
              value="<?php echo isset($email) ? $email : ''; ?>">
          </div>
          <div class="form-group">
            <label for="instagram">Instagram:</label>
            <input type="text" class="form-control" id="instagram" name="instagram"
              value="<?php echo isset($instagram) ? $instagram : ''; ?>">
          </div>
          <div class="form-group">
            <label for="TikTok">TikTok:</label>
            <input type="text" class="form-control" id="TikTok" name="TikTok"
              value="<?php echo isset($TikTok) ? $TikTok : ''; ?>">
          </div>
          <div class="form-group">
            <label for="Twitter">Twitter</label>
            <input type="text" class="form-control" id="Twitter" name="Twitter"
              value="<?php echo isset($Twitter) ? $Twitter : '' ?>">
          </div>
          <div class="form-group">
            <label for="about_me">About Me:</label>
            <textarea class="form-control" id="about_me"
              name="about_me"><?php echo isset($about_me) ? $about_me : ''; ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
</body>

</html>