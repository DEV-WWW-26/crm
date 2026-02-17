<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';
?>

<form id=regform" action="../../controllers/company.php" method="post">

    <?php
    include 'company.html';
    ?>

  <button type="submit" class="btn btn-primary">Добавить</button>
  <button type="button" class="btn btn-primary">Отмена</button>

</form>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';
?>

