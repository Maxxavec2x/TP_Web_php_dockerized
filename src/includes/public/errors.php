<p>
<?php

    if (isset($errors)) {
        if (count($errors) > 0): ?>
            <div class="validation_errors">
                <?php foreach ($errors as $error): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php } ?>

</p>
