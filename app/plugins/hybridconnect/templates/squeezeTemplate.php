<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8" />

<html>
<head>
<title><?php echo get_the_title(); ?></title>
<?php wp_head(); ?>
</head>

<body>
<div id="content">
	<?php the_content(); ?>
</div>
 <?php wp_footer(); ?>
</body>
</html>