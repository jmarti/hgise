<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package hgise
 */

get_header();



//featured ?>
<section class="featured">
	<div class="wrapper">
		<h2>Featured</h2>
		<?php
		
		//featured projects
		include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/featured-projects.php";
		
		//featured videos
		include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/featured-videos.php";
		
		//featured maps
		include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/featured-maps.php";

		?>
	</div>
</section>
<?php

//areas of research ?>
<section class="areas">
	<h2>Areas of research</h2>
	<div id="areas-type" class="wrapper">
		<ul class="tabs-vertical">
			<li class="borders">
				<a href="#borders">Borders</a>
			</li>
			<li class="population">
				<a href="#population">Population</a>
			</li>
			<li class="urbanization">
				<a href="#urbanization">Urbanization</a>
			</li>
			<li class="transport">
				<a href="#transport">Transport</a>
			</li>
		</ul>
		<div id="borders">
			<?php
			$args = array( 'post_type' => 'projects', 'project_type' => 'borders' );
			$loop = new WP_Query( $args );
			include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/area-of-research.php"; ?>
		</div>
		<div id="population">
			<?php
			$args = array( 'post_type' => 'projects', 'project_type' => 'population' );
			$loop = new WP_Query( $args );
			include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/area-of-research.php"; ?>
		</div>
		<div id="urbanization">
			<?php
			$args = array( 'post_type' => 'projects', 'project_type' => 'urbanization' );
			$loop = new WP_Query( $args );
			include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/area-of-research.php"; ?>
		</div>
		<div id="transport">
		<?php
			$args = array( 'post_type' => 'projects', 'project_type' => 'transport' );
			$loop = new WP_Query( $args );
			include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/area-of-research.php"; ?>
		</div>
	</div>
</section>
<?php
//about us
include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/hgise/controllers/about_us.php"; ?>
<?php get_footer();?>


