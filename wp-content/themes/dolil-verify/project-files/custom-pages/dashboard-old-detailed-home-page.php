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
add_action( 'admin_menu', 'dolil_admin_menu_dashboard' );

function dolil_admin_menu_dashboard() {
	add_menu_page( 'ড্যাশবোর্ড', 'ড্যাশবোর্ড', 'edit_published_posts', 'soms', 'soms_home_page', 'dashicons-dashboard', 6  );
}

// Add content to admin page
function soms_home_page(){
	?>
	<div class="wrap">
	
		<div class="PageBreadcrumb"><div class="content-header"><div class="container-fluid"><div class="row mb-0"><div class="col-10"><ol class="breadcrumb"><li class="breadcrumb-item"><a aria-current="page" class="text-decoration-none active" href="/dashboard">Home</a></li><li class="breadcrumb-item active">Dashboard </li></ol></div></div></div></div></div>
	
		<section class="">
		  <div class="">
			<div class="row main-features-card-list">
			  <div class="col-md-3">
				<div class="card shadow-none mb-5 mt-2">
				  <div class="card-header"><h4>দলিল শাখা</h4></div>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" href="/deeds"> দলিল দাখিল গ্রহণ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/dashboard" style="opacity: 0.7;">শ্রেণীভিত্তিক বাজারমূল্য</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/dolils/awaiting-registered-deeds">নিবন্ধন অপেক্ষমান দলিল</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">নিবন্ধিত দলিলের তথ্য</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">সূচিকৃত দলিলের তথ্য</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" href="/dolil-delivery">দলিল ফেরত প্রদান</a></li>
				  </ul>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="card shadow-none mb-5 mt-2">
				  <div class="card-header"><h4>রিপোর্ট সমূহ</h4></div>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" href="/reports/daily">দৈনিক রিপোর্ট</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">সাপ্তাহিক রিপোর্ট</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" href="/reports/monthly">মাসিক রিপোর্ট</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" href="/reports/quarterly">ত্রৈমাসিক রিপোর্ট</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" href="/reports/yearly">বাৎসরিক রিপোর্ট</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">বিবিধ রিপোর্ট</a></li>
				  </ul>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="card shadow-none mb-5 mt-2">
				  <div class="card-header"><h4>তল্লাশ ও নকল শাখা</h4></div>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" href="/search-inspection-copy/all">সকল আবেদন</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/search-inspection-copy/search">তল্লাশের আবেদন</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/search-inspection-copy/inspection">পরিদর্শনের আবেদন</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" href="/search-inspection-copy/copy">নকলের আবেদন</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/reports/misc-register-inspections ">তল্লাশ ও পরিদর্শন রেজিস্টার</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
				  </ul>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="card shadow-none mb-5 mt-2">
				  <div class="card-header"><h4>ট্রেজারী ও বিল শাখা</h4></div>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/treasury-bill/revenue-information">চালানের তথ্য</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush d-none">
					<li class="list-group-item">
					  <a class="color-black" href="/treasury-bill/challan-information">চালান জমা প্রদানের তথ্য</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">প্রাপ্ত বরাদ্দ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">বেতন বিল</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">অন্যান্য বিল</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/dashboard" style="opacity: 0.7;">প্রকৃত ব্যয় ও সম্ভাব্য চাহিদা</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/dashboard" style="opacity: 0.7;">সম্ভাব্য চাহিদা ও বাজেট</a>
					</li>
				  </ul>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="card shadow-none mb-5 mt-2">
				  <div class="card-header"><h4>রেকর্ড শাখা</h4></div>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">ফর্ম রেজিস্টার</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">ক্যাটালগ বহি</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">মহাফেজখানায় রেকর্ড প্রেরণ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">দলিল ও রেকর্ড ধ্বংসকরণ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/dashboard" style="opacity: 0.7;">বিনষ্টযোগ্য দাবিবিহীন দলিলের তালিকা</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" style="opacity: 0.7;">ধ্বংসযোগ্য নথিপত্রের তালিকা (R)</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">আদালতে রেকর্ড প্রেরণ</a></li>
				  </ul>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="card shadow-none mb-5 mt-2">
				  <div class="card-header"><h4>নকলনবিশ শাখা</h4></div>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" href="/" style="opacity: 0.7;">দলিল বিতরণ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/dashboard" style="opacity: 0.7;">সার্টিফাইড কপি বিতরণ</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">কাজের বিবরণ (ডায়েরী) (R)</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">মাসিক বিল (Report)</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/copyist/bill-payments-details">বিল পরিশোধের বিবরণী</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">সূচিকরণ কাজ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">বিবিধ কাজ</a></li>
				  </ul>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="card shadow-none mb-5 mt-2">
				  <div class="card-header"><h4>তথ্যাদি অনুসন্ধান শাখা</h4></div>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/search-info/market-value-information">বাজারমূল্য তথ্য অনুসন্ধান</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/search-info/restricted-lands-information">সরকারি/সংরক্ষিত জমি</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a href="/search-info/deed-information">দলিলের তথ্য অনুসন্ধান</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
				  </ul>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="card shadow-none mb-5 mt-2">
				  <div class="card-header"><h4>চিঠিপত্র শাখা</h4></div>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">চিঠিপত্র গ্রহণ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">চিঠিপত্র প্রেরণ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">স্মারকলিপি গ্রহণ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">স্মারকলিপি প্রেরণ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
				  </ul>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="card shadow-none mb-5 mt-2">
				  <div class="card-header"><h4>রশিদ শাখা</h4></div>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">৫২ ধারা রশিদ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">তল্লাশ ও পরিদর্শন রশিদ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">বিবিধ রশিদ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
				  </ul>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="card shadow-none mb-5 mt-2">
				  <div class="card-header"><h4>বিবিধ দলিল শাখা</h4></div>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" href="/dolils/commissions">ভিজিট/কমিশন</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">অগ্রাহ্যকৃত দলিল</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">অপেক্ষমান দলিল</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">#</a></li>
				  </ul>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="card shadow-none mb-5 mt-2">
				  <div class="card-header"><h4>স্থানীর সরকার শাখা</h4></div>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item">
					  <a class="color-black" href="/reports/local-govt-tax-register">দৈনিক রিপোর্ট</a>
					</li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">মাসিক রিপোর্ট</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">বাৎসরিক রিপোর্ট</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">বিল সমূহ</a></li>
				  </ul>
				  <ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="color-black" style="opacity: 0.7;">চালান/রাজস্বের তথ্য</a></li>
				  </ul>
				</div>
			  </div>
			</div>
		  </div>
		</section>
	</div>
	<?php
}


/* 
* Creating a Top-Level Admin Page
*/
add_action( 'admin_menu', 'dolil_admin_menu_rs_land' );

function dolil_admin_menu_rs_land() {
	add_menu_page( 'সংরক্ষিত জমি', 'সংরক্ষিত জমি', 'edit_published_posts', 'rs-land', 'soms_rs_land_page', 'dashicons-dashboard', 6  );
}

// Add content to admin page
function soms_rs_land_page(){
	?>
	<div class="wrap">
		<div class="dolil-container">
			<div class="container-fluid">
				<h1>সংরক্ষিত জমির তালিকা</h1>
			</div>
			<?php $query = new WP_Query( [
				'post_type'      => 'restricted_land',
				'nopaging'       => true,
				'posts_per_page' => '-1',
			] ); ?>

			<?php if ( $query->have_posts() ) : ?>
				<div class="container-fluid">
					<div class="table-responsive">
						<table class="table table-bordered table-striped text-center">
							<thead>
								<tr>
									<th class="border-left-0">ID</th>
									<th class="border-left-0">মৌজা</th>
									<th class="border-left-0">দলিল নম্বর</th>
									<th class="border-left-0">দাতা</th>
									<th class="border-left-0">গ্রহীতা</th>
									<th class="border-left-0">খতিয়ান নং</th>										
									<th class="border-left-0">দাগ নং</th>
									<th class="border-left-0">জমির পরিমাণ</th>
									<th class="border-left-0">মুল্য</th>
									<th class="border-left-0">মন্তব্য</th>
								</tr>
							</thead>
							<tbody>
								<?php while ( $query->have_posts() ) : $query->the_post(); ?>
									<tr>
										<td><?php the_title(); ?></td>
										<td class="border-left-0">১ নং বিশারকান্দি</td>
										<td class="border-left-0">২০২৫০০১</td>
										<td class="border-left-0">জসিম উদ্দিন</td>
										<td class="border-left-0">করিম আহমেদ</td>
										<td class="border-left-0">৫০২</td>
										<td class="border-left-0">১০২৪, ১০৩৫, ৩০১</td>
										<td class="border-left-0">০.৫ শতাংশ</td>
										<td class="border-left-0">৩,০০,০০০ টাকা</td>
										<td class="border-left-0"></td>
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