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
    <title>addd article</title>
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
                        <!-- <p class="text-error"></p> -->
                    </div>
                    <div class="form-control">
                        <label for="image">Image</label>
                        <input type="text" name="image" id="image">
                        <!-- <p class="text-error"></p> -->
                    </div>
                    <div class="form-control">
                        <label for="category">Catégorie</label>
                        <select name="category" id="category">
                            <option value="technology">Technogie</option>
                            <option value="nature">Nature</option>
                            <option value="politic">Politique</option>
                        </select>
                        <!-- <p class="text-error"></p> -->
                    </div>
                    <div class="form-control">
                        <label for="content">content</label>
                        <textarea name="content" id="content"></textarea>
                        <!-- <p class="text-error"></p> -->
                    </div>


                    <div class="form-actions">
                       <a href="/"> <button class="btn btn-secondary" type="button">Annuler</button></a>
                        <button class="btn btn-primary" type="button">Sauvegarder</button>
                    </div>

                </form>
            </div>

    

        </div>
        <?php require_once 'include/footer.php'; ?>
    </div>
</body>

</html>