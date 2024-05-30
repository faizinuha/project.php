<?php
session_start();
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style/style2.css">
</head>

<body>
  <!-- <div class="img-thumbnail img">
  
    <p class="regi">Selamat datang di Register</p>
  </div> -->
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title text-center font-monospace mb-4">Registrasi Pengguna</h2>
      
        <form id="registerForm" action="proses_register.php" method="post" novalidate>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="nama" class="form-label">Nama:</label>
              <input type="text" class="form-control" name="nama" required placeholder="Masukkan Nama" value="<?php echo isset($form_data['nama']) ? htmlspecialchars($form_data['nama']) : ''; ?>">
              <div class="error-feedback">Masukkan Nama.</div>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Email:</label>
              <input type="email" class="form-control" name="email" required placeholder="Masukkan Email" value="<?php echo isset($form_data['email']) ? htmlspecialchars($form_data['email']) : ''; ?>">
              <div class="error-feedback">Masukkan Email yang valid.</div>
            </div>
            <div class="col-md-6">
              <label for="username" class="form-label">Username:</label>
              <input type="text" class="form-control" name="username" required placeholder="Masukkan Username" value="<?php echo isset($form_data['username']) ? htmlspecialchars($form_data['username']) : ''; ?>">
              <div class="error-feedback">Masukkan Username.</div>
            </div>
            <div class="col-md-6">
              <label for="password" class="form-label">Password:</label>
              <input type="password" class="form-control" name="password" required placeholder="Masukkan Password">
              <div class="error-feedback">Masukkan Password.</div>
            </div>
          </div>
          <div class="d-grid gap-2 mt-4">
            <button id="registerBtn" type="submit" class="btn btn-primary">Register</button>
            <a href="login.php" class="btn btn-secondary">Login</a>
          </div>
        </form>
        <div id="spinner" class="spinner-border text-primary visually-hidden" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
      var form = this;
      var spinner = document.getElementById('spinner');

      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
      } else {
        spinner.classList.remove('visually-hidden');
      }
    });
  </script>
</body>

</html>
