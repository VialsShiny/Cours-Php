<!DOCTYPE html>
<html lang='FR-fr'>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Eshop</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name='description' content='Eshop Page'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <style>
    .card img {
      height: 17.5rem;
      width: 100%;
      object-fit: cover;
      object-position: top;
    }
  </style>
</head>

<body>

  <?php
  include_once './inc/init.inc.php';
  include_once './inc/functions.inc.php';

  require_once './inc/header.inc.php';
  require_once './inc/main.inc.php';
  require_once './inc/footer.inc.php';

  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>