<?php
include "app/database/path.php";
include "function.php";
$topics = selectAll('topics');
$post = selectOne('posts', ['id' => $_GET['post']]);
?>

<!doctype html>
<html lang="en">

<head>
    <?php include "app/include/head.php"; ?>
    <title>Отдельный пост</title>
</head>

<body>
    <?php include "app/include/header.php"; ?>

    <!-- Статья START -->
    <div class="container">
        <div class="content row">            
            <div class="main-content col-12 col-md-9">
                <h2><?php echo $post['title']; ?></h2>
                <div class="single-post row">
                    <!-- картинка -->
                    <div class="img col-12">
                        <img src="<?=BASE_URL . 'static/image/posts/' . $post['image']; ?>" alt="" class="img-thumbnail">
                    </div>
                    <div class="single-post-info">
                        <i class="far fa-user">ID Автора: <?= $post['id_user']; ?> -- </i>
                        <i class="far fa-calendar">Дата: <?= $post['created']; ?> -- </i>
                        <i class="far fa-topic">ID Темы: <?= $post['id_topic']; ?></i>
                    </div>
                    <div class="single-post-text col-12">
                        <p class="preview-text"><?= $post['content']; ?></p>
                    </div>
                </div>
            </div>

            <!-- sidebar -->
            <div class="sidebar col-12 col-md-3">                
                <!-- темы -->
                <div class="section-topic">
                    <h4>Темы</h4>
                    <ul>
                        <?php foreach ($topics as $topic) : ?>
                            <li><a href="<?= BASE_URL . 'topic.php?id=' . $topic['id']; ?>"><?= $topic['name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <!-- sidebar END -->

        </div>
    </div>
    <!-- Статья END -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>