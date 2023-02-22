<?php
$data = file_get_contents('../data/data.json');
$raw = json_decode($data, true);
$players = $raw['players'];
if (isset($_GET['position'])) {
  $temp = [];
  foreach ($players as $p) {
    if (strtolower($p["position"]) == $_GET['position']) {
      $temp[] = $p;
      $players = $temp;
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <title>Real Madrid</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Real Madrid</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link <?= isset($_GET['position']) ? '' : 'active' ?>" aria-current="page" href="index.php">All Players</a>
          <a class="nav-link <?= isset($_GET['position']) && $_GET['position'] == 'goalkeeper' ? 'active' : '' ?>" href="index.php?position=goalkeeper">Goalkeepers</a>
          <a class="nav-link <?= isset($_GET['position']) && $_GET['position'] == 'defender' ? 'active' : '' ?>" href="index.php?position=defender">Defenders</a>
          <a class="nav-link <?= isset($_GET['position']) && $_GET['position'] == 'midfielder' ? 'active' : '' ?>" href="index.php?position=midfielder">Midfielders</a>
          <a class="nav-link <?= isset($_GET['position']) && $_GET['position'] == 'forward' ? 'active' : '' ?>" href="index.php?position=forward">Forwards</a>
        </div>
      </div>
    </div>
  </nav>
  <!-- Close navbar -->

  <!-- Main -->
  <div class="container mt-3">
    <div class="row">
      <div class="col">
        <h1 class="title">All Players</h1>
      </div>
    </div>

    <div class="row my-5">
      <?php foreach ($players as $player) : ?>
        <div class="col-lg-3 mb-3">
          <div class="card">
            <img src="../img/<?= strtolower($player['back-name']); ?>.jpg" class="card-img-top" alt="<?= strtolower($player['back-name']); ?>">
            <div class="card-body">
              <h4 class="card-title"><?= $player['back-name']; ?> / <?= $player['back-number']; ?></h4>
              <h5 class="card-title fw-normal"><?= $player['position']; ?></h5>
              <button class="btn btn-primary mt-4 modal-button" data-bs-toggle="modal" data-bs-target="#detail-player" data-back-number="<?= $player['back-number']; ?>">Detail</button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <!-- Close main -->

  <!-- Modal Button -->
  <div class="modal fade" id="detail-player" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Kroos / #8</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-around">
            <div class="col-md-5">
              <img src="../img/kroos.jpg" class="card-img-top" alt="" style="width: 20rem;">
            </div>
            <div class="col-md-7">
              <ul class="list-group">
                <li class="list-group-item">
                  <h4>Toni Kroos</h4>
                </li>
                <li class="list-group-item">Position : Midfielder</li>
                <li class="list-group-item">Play Time : 31</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Close modal -->


  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {
      const templateModal = (data) => {
        return `<div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">${data["back-name"]} / #${data["back-number"]}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-around">
            <div class="col-md-5">
              <img src="../img/${data["back-name"]}.jpg" class="card-img-top" alt="${data["back-name"]}" style="width: 20rem;">
            </div>
            <div class="col-md-7">
              <ul class="list-group">
                <li class="list-group-item">
                  <h4>${data["name"]}</h4>
                </li>
                <li class="list-group-item">${data["position"]}</li>
                <li class="list-group-item">Play Time : ${data["play-time"]}</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>`;
      }

      $(".modal-button").on('click', function() {
        let id = $(this).data("back-number");
        $.getJSON('../data/data.json', function(data) {
          let players = data.players;
          $.each(players, function(i, player) {
            if (player['back-number'] == id) {
              $(".modal-dialog").html(templateModal(player));
              return;
            }
          })
        })
      })

      // $(".nav-link").on('click', function(e) {
      //   $(".nav-link").removeClass("active");
      //   let data = $(this).text();
      //   localStorage.setItem("data", data);
      //   $(".nav-link").each(function(i, e) {
      //     if (e.textContent == localStorage.getItem('data')) {
      //       $(this).addClass("active")
      //       console.log($(this));
      //     }
      //   })
      // })

    });
  </script>
</body>

</html>