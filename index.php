<?php session_start();

include("function.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
main();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jeu Morpion - LSD Edition</title>
  <style>
    <?php include('style.css'); ?>
  </style>
</head>

<body>
  <form method="post">
    <table>
      <tbody>
        <!--
        on segmente l'array en lignes de 3 avec array_chunk :
        array_chunk(array $array, int $length, bool $preserve_keys = false): array 
        -->
        <?php $rows = array_chunk($_SESSION['grid'], 3, true); ?>

        <?php foreach ($rows as $row): ?>
          <tr>
            <?php foreach ($row as $key => $value): ?>
              <td>
                <button type="submit" name="<?= htmlspecialchars($key) ?>"><?= $value === '' ? '&nbsp;' : htmlspecialchars($value) ?></button>
              </td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="center">
      <p>
      <p>

        <?php foreach ($_SESSION['SCORE'] as $team => $score): ?>
      <h3>Score <?= $team ?> : <?= $score ?></h3>
    <?php endforeach; ?>
    <h4>Coups: X = <?= $_SESSION['scoreX'] ?> | O = <?= $_SESSION['scoreO'] ?></h4>

    <h1><?= $_SESSION['message'] ?? '' ?></h1><br />
    <input type="submit" name="reset" value="Recommencer une partie" id="recommencer_partie">
    </div>

  </form>

  <!-- Debug Info (visible uniquement si on cherche) -->
  <div style="margin-top: 50px; opacity: 0.2; font-size: 0.7rem; color: gray;">
    URL: <?= $_SERVER['REQUEST_URI'] ?><br>
    Host: <?= $_SERVER['HTTP_HOST'] ?>
  </div>
</body>

</html>