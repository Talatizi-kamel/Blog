<?php
$filename = __DIR__ . '/data/article.json';
$articles = [];
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if (!$id) {
  header('Location: /');
} else {
  if (file_exists($filename)) {
    $articles = json_decode(file_get_contents($filename), true) ?? [];
    $articleIndex = array_search($id, array_column($articles, 'id'));
    $article = $articles[$articleIndex];
  }
}

?>


<!DOCTYPE html>
<html lang="fr">

  <head>
      <?php require_once 'include/head.php' ?>
      <link rel="stylesheet" href="/public/css/show-article.css">
      <title>Article</title>
  </head>

  <body>
    <div class="container">
      <?php require_once 'include/header.php' ?>
      <div class="content">
        <div class="article-container">
          <a class="article-back" href="/">Retour à la liste des articles</a>
          <div class="article-cover-img" style="background-image:url(<?= $article['image'] ?>)"></div>
          <h1 class="article-title"><?= $article['title'] ?></h1>
          <div class="separator"></div>
          <p class="article-content"><?= $article['content'] ?></p>
        </div>
      </div>
      <?php require_once 'include/footer.php' ?>
    </div>

  </body>

</html>