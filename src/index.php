<?php
include('config.php');
include('includes/public/head_section.php');
include(ROOT_PATH . '/includes/public/registration_login.php');
include(ROOT_PATH . '/includes/all_functions.php');
?>
<!-- TEST WORKLOW A DELETE -->
<title>MyWebSite | Home </title>

</head>

<body>

	<div class="container">

		<!-- Navbar -->
		<?php include(ROOT_PATH . '/includes/public/navbar.php'); ?>
		<!-- // Navbar -->

		<!-- Banner -->
		<?php include(ROOT_PATH . '/includes/public/banner.php'); ?>
		<!-- // Banner -->

		<!-- Messages -->

		<!-- // Messages -->

		<!-- content -->
		<div class="content">
			<h2 class="content-title">Recent Articles</h2>
			<hr>
			<?php foreach(getPublishedPosts() as $post){ ?>
				<div class="post" style="margin-left: 0px;">
					<p class="category"><?php echo $post['topic'];?></p>
					<img src="static/images/<?php echo $post['image']; ?>" alt="Alternative" class="post_image">
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

