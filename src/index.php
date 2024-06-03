<?php include('config.php'); ?>
<?php include('includes/public/head_section.php'); ?>
<?php include(ROOT_PATH . '/includes/public/registration_login.php'); ?>
<?php include(ROOT_PATH . '/includes/all_functions.php'); ?>

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
				<p><?php echo $post['title'];?></p>
			<?php } ?>
			

			



		</div>
		<!-- // content -->


	</div>
	<!-- // container -->


	<!-- Footer -->
	<?php include(ROOT_PATH . '/includes/public/footer.php'); ?>
	<!-- // Footer -->