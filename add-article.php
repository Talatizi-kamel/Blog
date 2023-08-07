<?php
const ERROR_REQUIRED = 'Veuillez rensigner ce champ';
const ERROR_TITLE_TOO_SHORT = 'le titre est trop court';
const ERROR_CONTENT_TOO_SHORT = 'L\'article est trop court';
const ERROR_IMAGE_URL = 'L\'image doit etre une url valide';
$filename = __DIR__ . '/data/article.json';

$errors = [
    'title' => '',
    'image' => '',
    'category' => '',
    'content' => ''
];

if (file_exists($filename)) {
    $article = json_decode(file_get_contents($filename), true) ?? [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'title' => FILTER_SANITIZE_STRING,
        'image' => FILTER_VALIDATE_URL,
        'category' => FILTER_SANITIZE_STRING,
        'content' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ]
    ]);


    $title = $_POST['title'] ?? '';
    $image = $_POST['image'] ?? '';
    $category = $_POST['category'] ?? '';
    $content = $_POST['content'] ?? '';

    if (!$title) {
        $errors['title'] = ERROR_REQUIRED;
    } elseif (strlen($title) < 5) {
        $errors['title'] = ERROR_TITLE_TOO_SHORT;
    }

    if (!$image) {
        $errors['image'] = ERROR_REQUIRED;
    } elseif (!filter_var($image, FILTER_VALIDATE_URL)) {
        $errors['image'] = ERROR_IMAGE_URL;
    }

    if (!$category) {
        $errors['category'] = ERROR_REQUIRED;
    }

    if (!$content) {
        $errors['content'] = ERROR_REQUIRED;
    } elseif (strlen($content) < 50) {
        $errors['content'] = ERROR_CONTENT_TOO_SHORT;
    }


    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
        $article = [...$article, [
            'title' => $title,
            'image' => $image,
            'category' => $category,
            'content' => $content,
            'id' => time()
        ]];
        file_put_contents($filename, json_encode($article));
        header('Location: /');
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/index.js">
    </script>
    <title>add article</title>
</head>

<body>
    <div class="container">
        <?php require_once 'include/header.php'; ?>
        <link rel="stylesheet" href="public/css/add-article.css">
        <div class="content">
            <div class="block p-20 form-container">

                <h1>écrire un article</h1>
                <form action="/add-article.php" , method="POST">
                    <div class="form-control">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title">
                        <?php if ($errors['title']) : ?>
                            <p class="text-danger"> <?= $errors['title'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-control">
                        <label for="image">Image</label>
                        <input type="text" name="image" id="image">

                        <?php if ($errors['image']) : ?>
                            <p class="text-danger"> <?= $errors['image'] ?></p>
                        <?php endif; ?>

                    </div>
                    <div class="form-control">
                        <label for="category">Catégorie</label>
                        <select name="category" id="category">
                            <option value="technology">Technogie</option>
                            <option value="nature">Nature</option>
                            <option value="politic">Politique</option>
                        </select>
                        <?php if ($errors['category']) : ?>
                            <p class="text-danger"> <?= $errors['category'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-control">
                        <label for="content">content</label>
                        <textarea name="content" id="content"></textarea>
                        <?php if ($errors['content']) : ?>
                            <p class="text-danger"> <?= $errors['content'] ?></p>
                        <?php endif; ?>
                    </div>


                    <div class="form-actions">
                        <a href="/"> <button class="btn btn-secondary" type="button">Annuler</button></a>
                        <button class="btn btn-primary" type="submit">Sauvegarder</button>
                    </div>

                </form>
            </div>



        </div>
        <?php require_once 'include/footer.php'; ?>
    </div>
</body>

</html>