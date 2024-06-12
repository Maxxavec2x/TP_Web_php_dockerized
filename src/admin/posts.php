<?php include('../config.php'); ?>
<?php include(ROOT_PATH . '/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/includes/admin/head_section.php'); ?>
<?php include('post_functions.php'); ?>
<!-- //BTW: ideally we need to create a role_user table (users<->role_user<->roles)
	// role_user(id, user_id,role_id)

	^ C'est le prof qui a écrit ça btw, j'ai créé la table mais j'ai pas compris l'intérêt dans les fonctions getAdminRoles() et getAdminUsers() 🤔
	Je pense que c'est bcp plus simple de query role et user directement. J'imagine que l'intérêt c'est de pouvoir créer des users avec plusieurs roles ?

	-->
<?php
// Get all admin roles from DB : by admin roles i mean (Admin or Author)
$roles = getAdminRoles(); // table roles

// Get all admin users from DB
$admins = getAdminUsers(); // by admin roles i mean (Admin or Author), table users
?>

<title>Admin | Manage users</title>
</head>

<body>
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/includes/admin/header.php') ?>
	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/includes/admin/menu.php') ?>

		<!-- Display records from DB-->
<div class="table-div">

<!-- Display notification message -->
<?php include(ROOT_PATH . '/includes/public/messages.php') ?>
<?php $posts = getAllPosts(); ?>

    <table class="table">
        <thead>
            <th>N</th>
            <th>Author</th>
            <th>Title</th>
            <th>Views</th>
            <th>Publish</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            <?php foreach ($posts as $key => $post) : ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td>
                        <?php echo $post['author']; ?>, &nbsp;
                    </td>
                    <td><?php echo $post['title']; ?></td>
                    <td><?php echo $post['views']; ?></td>
                    <td>
                        <a class="fa fa-pencil btn unpublish" href="posts.php?unpublish=<?php echo $post['id'] ?>">
                        </a>
                    </td>
                    <td>
                        <a class="fa fa-pencil btn edit" href="create_post.php?edit-post=<?php echo $post['id'] ?>">
                        </a>
                    </td>
                    <td>
                        <a class="fa fa-trash btn delete" href="create_post.php?delete-post=<?php echo $post['id'] ?>">
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
</div>
<!-- // Display records from DB -->

	</div>

</body>

</html>







