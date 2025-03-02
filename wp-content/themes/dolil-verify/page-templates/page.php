<?php
/**
* Template Name: Home
*
* Template for displaying a full width content.
*/
	
get_header(); ?>

	<main id="primary" class="site-main">
		
		<div class="container" style="padding:60px;">
		
			<h1>Welcome to SOMS System </h1>

			<?php $adminurl = get_admin_url();?>
			<a href="<?php echo $adminurl; ?>">Login to SOMS System</a>
		</div>
		

	</main><!-- #main -->

<?php

