<?php
include "app/database/path.php";
include "function.php";
$posts = selectAll('posts', ['id_topic' => $_GET['id']]);
$topics = selectAll('topics');
$topic = selectOne('topics', ['id' => $_GET['id']]);
?>
<!doctype html>
<html lang="ru">

<head>
    <?php include "app/include/head.php"; ?>
    <title>Blog PHP</title>
</head>

<body>
    <?php include "app/include/header.php"; ?>
    <!-- Статьи START -->
    <div class="container">
        <div class="content row">
            <!-- main -->
            <div class="main-content col-12 col-md-9">
                <h2>Статьи с раздела <?= $topic['name']; ?></h2>
                <?php foreach ($posts as $post) : ?>
                    <div class="post row">
                        <!-- картинка -->
                        <div class="img col-12 col-md-4">
                            <img src="<?=BASE_URL . 'static/image/posts/' . $post['image']; ?>" alt="" class="img-thumbnail">
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
            <!-- sidebar -->
            <div class="sidebar col-12 col-md-3">
                <!-- поиск -->
                <div class="section-search">
                    <h4>Поиск</h4>
                    <form action="search.php" method="get">
                        <input class="text-input" type="text" name="search">
                    </form>
                </div>

                <!-- темы -->
                <div class="section-topic">
                    <h4>Темы</h4>
                    <ul>
                        <?php foreach ($topics as $topic) : ?>
                            <li><a href="<?= BASE_URL . 'topic.php?id=' . $topic['id']; ?>"><?= $topic['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Статьи END -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>