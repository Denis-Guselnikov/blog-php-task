<?php
include "app/database/path.php";
include "function.php";
?>
<!doctype html>
<html lang="ru">

<head>
    <?php include "app/include/head.php"; ?>
    <title>Результаты поиска</title>
</head>

<body>
    <?php include "app/include/header.php"; ?>
    <!-- Статьи START -->
    <div class="container">
        <div class="content row">
            <!-- main -->
            <div class="main-content col-12">
                <h2>Результаты поиска</h2>
                <?php
                if (isset($_GET['search'])) {
                    $posts = getSearch($_GET['search']);
                } ?>
                <?php foreach ($posts as $post) : ?>
                    <div class="post row">
                        <!-- картинка -->
                        <div class="img col-12 col-md-4">
                            <img src="static/image/6.jpg" alt="" class="img-thumbnail">
                        </div>
                        <!-- описание -->
                        <div class="post-text col-12 col-md-8">
                            <h5><a href="<?= BASE_URL . 'single.php?post=' . $post['id']; ?>"><?= $post['title']; ?></a></h5>
                            <i class="far fa-user">ID Автора: <?= $post['id_user']; ?> -- </i>
                            <i class="far fa-calendar">Дата: <?= $post['created']; ?> -- </i>
                            <i class="far fa-topic">ID Темы: <?= $post['id_topic']; ?></i>
                            <p class="preview-text"><?= $post['content']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Статьи END -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>