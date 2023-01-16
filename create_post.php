<?php
include "app/database/path.php";
include "app/controllers/posts.php";
?>
<!doctype html>
<html lang="ru">

<head>
    <?php include "app/include/head.php"; ?>
    <title>Создание Поста</title>
</head>

<body>

    <?php include "app/include/header.php"; ?>

    <div class="container">
        <div class="posts col-9">            
            <div class="row title-table">
                <h2>Добавление записи</h2>
            </div>
            <div class="row add-post">
                <form action="create_post.php" method="post" enctype="multipart/form-data">
                    <div class="col mb-4">
                        <input value="<?= $title; ?>" name="title" type="text" class="form-control" aria-label="Название статьи">
                    </div>
                    <div class="col">
                        <label for="content" class="form-label">Содержимое записи</label>
                        <textarea name="content" class="form-control" rows="6"><?= $content; ?></textarea>
                    </div>
                    <div class="input-group col mb-4 mt-4">
                        <input name="image" type="file" class="form-control" id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Загрузить</label>
                    </div>
                    <select name="topic" class="form-select mb-2" aria-label="Default select example">
                        <option selected>Категория поста:</option>
                        <?php foreach ($topics = selectAll('topics') as $key => $topic) : ?>
                            <option value="<?= $topic['id']; ?>"><?= $topic['name']; ?></option>
                        <?php endforeach; ?>
                    </select>                    
                    <div class="col col-6">
                        <button name="add_post" class="btn btn-primary" type="submit">Добавить запись</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>