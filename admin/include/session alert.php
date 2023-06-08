<?php
  session_start();
  if (isset($_SESSION['alert']) && isset($_SESSION['text'])) {
    $alert = $_SESSION['alert'];
    $text = $_SESSION['text'];
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>';
    echo '<script>
      Swal.fire({
        icon: "'.$alert.'",
        title: "'.$text.'",
        timer: 1600
      });
    </script>';
    unset($_SESSION['alert']);
    unset($_SESSION['text']);
  }
  ?>
 