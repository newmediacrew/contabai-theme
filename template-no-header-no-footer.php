<?php
/*
 * Template Name: No Header No Footer
 */
?>
<!doctype html>
<html lang="<?php echo esc_attr(substr(get_locale(), 0, 2)); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>
<body>
<?php the_content(); ?>
<?php wp_footer(); ?>
</body>
</html>
