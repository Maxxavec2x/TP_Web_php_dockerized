<?php
include('config.php');
include('includes/public/head_section.php');
include(ROOT_PATH . '/includes/all_functions.php');
?>

<title>MyWebSite | Topic </title>
<!-- ça pourrait être cool d'afficher le topic en titre, mais de ce que je vois si on fait qqch à partir de la requête get on risque une ✨faille XSS✨, donc à voir 😪 -->

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
					<p class="category"><?php echo $post['topic']['name'];?></p>
					<img src="static/images/<?php echo 'post_image' . $post['id'] . '.jpg';?>" alt="Alternative" class="post_image">
					<div class="post_info">
						<h4><?php echo $post['title'];?></h4>
						<span><?php echo $post['updated_at'];?></span>
						<span class="read_more"><a href="single_post.php?post-slug=<?php echo $post['slug']; ?>"> Read more </a></span>
					</div>
				</div>
			<?php } ?>
		</div>
		<!-- // content -->


	</div>
	<!-- // container -->


	<!-- Footer -->
	<?php include(ROOT_PATH . '/includes/public/footer.php'); ?>
	<!-- // Footer -->
