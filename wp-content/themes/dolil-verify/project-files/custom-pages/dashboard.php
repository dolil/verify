<?php
/**
 * Dolilsheba functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dolilsheba
 */



/* 
 * Creating a Top-Level Admin Page
 */
add_action('admin_menu', 'dolil_admin_menu_dashboard');

function dolil_admin_menu_dashboard()
{
	add_menu_page('ড্যাশবোর্ড', 'ড্যাশবোর্ড', 'edit_published_posts', 'soms', 'soms_home_page', 'dashicons-dashboard', 6);
}

// Add content to admin page
function soms_home_page()
{
	?>
	<div class="wrap">
		<div class="container-fluid">
			<section class="">
				<div class="">
					<div class="row main-features-card-list">
						<div class="col-md-3">
							<div class="card shadow-none mb-5 mt-2">
								<div class="card-header">
									<h4>তথ্যাদি অনুসন্ধান শাখা</h4>
								</div>
								<ul class="list-group list-group-flush">
									<li class="list-group-item">
										<a class="color-black" style="opacity: 0.7; href="#">বাজারমূল্য তথ্য অনুসন্ধান</a>
									</li>
									<li class="list-group-item">
										<a class="color-black" href="<?php echo admin_url();?>edit.php?post_type=restricted_land">সরকারি/সংরক্ষিত জমি</a>
									</li>
									<li class="list-group-item"><a class="color-black" style="opacity: 0.7; href="#">দলিলের তথ্য অনুসন্ধান</a></li>
									<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
									<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<?php
}


/* 
 * Creating a Top-Level Admin Page
 */
add_action('admin_menu', 'dolil_admin_menu_rs_land');

function dolil_admin_menu_rs_land()
{
	add_menu_page('সংরক্ষিত জমি', 'সকল সংরক্ষিত জমি', 'edit_published_posts', 'rs-land', 'soms_rs_land_page', 'dashicons-dashboard', 6);
}

// Add content to admin page
function soms_rs_land_page()
{
	?>
	<div class="wrap">
		<div class="dolil-container">
			<div class="container-fluid">
				<h1>সংরক্ষিত জমির তালিকা</h1>
			</div>
			<?php $query = new WP_Query([
				'post_type' => 'restricted_land',
				'nopaging' => true,
				'posts_per_page' => '-1',
			]); ?>

			<?php if ($query->have_posts()): ?>
				<div class="container-fluid">
					<div class="table-responsive">
						<table class="table table-bordered table-striped text-center">
							<thead>
								<tr>
									<th class="border-left-0">ID</th>
									<th class="border-left-0">দলিল নম্বর</th>
									<th class="border-left-0">গ্রহীতা</th>
									<th class="border-left-0">দাতা</th>									
									<th class="border-left-0">মৌজা</th>
									<th class="border-left-0">খতিয়ান নং</th>
									<th class="border-left-0">দাগ নং</th>
									<th class="border-left-0">জমির পরিমাণ</th>
									<th class="border-left-0">মুল্য</th>
									<th class="border-left-0">মন্তব্য</th>
								</tr>
							</thead>
							<tbody>
								<?php while ($query->have_posts()):
									$query->the_post(); ?>
									<tr>
										<td><?php the_title(); ?></td>
										<td class="border-left-0"><?php the_field('_deed_code'); ?></td>
										<td class="border-left-0"><?php the_field('_deed_buyer'); ?></td>
										<td class="border-left-0"><?php the_field('_deed_seller'); ?></td>
										<td class="border-left-0"><?php the_field('_mouza_name'); ?></td>
										<td class="border-left-0"><?php the_field('_khatian_number'); ?></td>
										<td class="border-left-0"><?php the_field('_plot_number'); ?></td>
										<td class="border-left-0"><?php the_field('_land_area'); ?></td>
										<td class="border-left-0"><?php the_field('_land_value'); ?></td>
										<td class="border-left-0"><?php the_field('_restrcited_land_type'); ?></td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
					<!--/.table-responsive-->
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
		<!--/.dolil-container-->

	</div>
	<?php
}