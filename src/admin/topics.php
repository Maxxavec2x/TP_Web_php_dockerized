<?php include('../config.php'); ?>
<?php include(ROOT_PATH . '/includes/all_functions.php'); ?>
<?php include(ROOT_PATH . '/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/includes/admin/head_section.php'); ?>


<!-- //BTW: ideally we need to create a role_user table (users<->role_user<->roles)
	// role_user(id, user_id,role_id)

	^ C'est le prof qui a écrit ça btw, j'ai créé la table mais j'ai pas compris l'intérêt dans les fonctions getAdminRoles() et getAdminUsers() 🤔
	Je pense que c'est bcp plus simple de query role et user directement. J'imagine que l'intérêt c'est de pouvoir créer des users avec plusieurs roles ?

	-->
<?php
// Get all topics
$topics = getAllTopics(); // table roles

?>

<title>Admin | Manage Topic</title>
</head>

<body>
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/includes/admin/header.php') ?>
	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/includes/admin/menu.php') ?>

		<!-- Middle form - to create and edit  -->
		<div class="action">
			<h1 class="page-title">Create/Edit Topics</h1>

			<form method="post" action="<?php echo BASE_URL . 'admin/topics.php'; ?>">

				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/public/errors.php') ?>

				<!-- if editing user, the id is required to identify that user -->
				<?php if ($isEditingTopic === true) : ?>
					<input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
				<?php endif ?>

				<input type="text" name="topicName" placeholder="Topic" value="<?php echo $topic_name;?>">

				<!-- if editing user, display the update button instead of create button -->
				<?php if ($isEditingTopic === true) : ?>
					<button type="submit" class="btn" name="update_topic">UPDATE</button>
				<?php else : ?>
					<button type="submit" class="btn" name="create_topic">Save Topic</button>
				<?php endif ?>

			</form>
		</div>
		<!-- // Middle form - to create and edit -->

		<!-- Display records from DB-->
		<div class="table-div">

			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/includes/public/messages.php') ?>

			<?php if (empty($topics)) : ?>
				<h1>No Topics in the database.</h1>
			<?php else : ?>
				<table class="table">
					<thead>
						<th>N</th>
						<th>Topic Name</th>
						<th colspan="2">Action</th>
					</thead>
					<tbody>
						<?php foreach ($topics as $key => $topic) : ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td>
									<?php echo $topic['name']; ?>, &nbsp;
								</td>
								<td>
									<a class="fa fa-pencil btn edit" href="topics.php?edit-topic=<?php echo $topic['id'] ?>">
									</a>
								</td>
								<td>
									<a class="fa fa-trash btn delete" href="topics.php?delete-topic=<?php echo $topic['id'] ?>">
									</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>
		</div>
		<!-- // Display records from DB -->

	</div>

</body>

</html>
