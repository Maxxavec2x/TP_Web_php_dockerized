<?php
include('config.php');
include('includes/public/head_section.php');
include(ROOT_PATH . '/includes/all_functions.php');
$postSlug = $_GET['post-slug']; //je pose ça là au cas où
$post = getPost($postSlug);
?>

<title> <?php echo $post['title'] ?> | MyWebSite</title>
</head>

<body>
    <div class="container">
        <!-- Navbar -->
        <?php include(ROOT_PATH . '/includes/public/navbar.php'); ?>
        <!-- // Navbar -->
        <div class="content">
            <!-- Page wrapper -->
            <div class="post-wrapper">
                <!-- full post div -->
                <div class="full-post-div">
                    <h2 class="post-title"> <?php echo $post['title'] ?> </h2>
                        <div class="post-body-div">
                            <?php echo $post['body'] ?>
                        </div>
                </div>
                <!-- // full post div -->
            </div>
            <!-- // Page wrapper -->
            <!-- post sidebar -->
            <div class="post-sidebar">
                <div class="card">
                    <div class="card-header">
                        <h2>Topics</h2>
                    </div>
                    <div class="card-content">
                        <?php foreach(getAllTopics() as $topic) {  ?>
                            <br>
                            <a href="filtered_posts.php"> <h3> <?php  echo $topic['name']; ?> </h3> </a>
                        <?php } ?>
                        <br>
                    </div>
                </div>
            </div>
            <!-- // post sidebar -->
        </div>
    </div>
    <!-- // content -->


    <!-- Footer -->
    <?php include(ROOT_PATH . '/includes/public/footer.php'); ?>
    <!-- // Footer -->