<?php include('config.php'); ?>
<?php include('includes/public/head_section.php'); ?>
<?php include(ROOT_PATH . '/includes/public/registration_login.php'); ?>
<title>MyWebSite | Resgister </title>
<div class="register_div">
    <form action="<?php echo BASE_URL . 'register.php'; ?>" method="post">
        <h2>Register on MyWebSite</h2>
        <div style="width: 60%; margin: 0px auto;">
            <?php include(ROOT_PATH . '/includes/public/errors.php') ?>
        </div>
        <input type="text" name="username" value="" placeholder="Username">
        <input type="text" name="mail" value="" placeholder="Mail">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="password2" placeholder="Password2">
        <button class="btn" type="submit" name="register_btn">Register</button>
    </form>
</div>
<p>
    Already a member? <a href="login.php">Sign in</a>
</p>
