<?php
include('config.php');
include('includes/public/head_section.php');
include(ROOT_PATH . '/includes/all_functions.php');
?>

<title>MyWebSite | Topic : <?php $_GET['topic'] ?> </title>

</head>

<body>

	<div class="container">

		<!-- Navbar -->
		<?php include(ROOT_PATH . '/includes/public/navbar.php'); ?>
		<!-- // Navbar -->

		<!-- content -->
		<div class="content">
			<h2 class="content-title">Post from this topic</h2>
			<hr>
			<?php foreach(getPublishedPostsByTopic($_GET['topic']) as $post){ ?>
				<div class="post" style="margin-left: 0px;">
					<p>Titre : <?php echo $post['title'];?></p>
					<img src="static/images/<?php echo 'post_image' . $post['id'] . '.jpg';?>" alt="Alternative" width="100%" width="100%">
					<p>Topic : <?php echo $post['topic']['name'];?></p>
					<p>Date de publication de l'article : <?php echo $post['updated_at'];?></p> <!--  En vrai hors vanne je sais pas si la date de publication c'est updated_at ou created_at, donc à voir. -->
					<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>"> Read more </a>
				</div>
			<?php } ?>
		</div>
		<!-- // content -->


	</div>
	<!-- // container -->


	<!-- Footer -->
	<?php include(ROOT_PATH . '/includes/public/footer.php'); ?>
	<!-- // Footer -->
