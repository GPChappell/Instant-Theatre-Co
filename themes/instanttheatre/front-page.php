<?php
/**
 * The main template file.
 *
 * @package RED_Starter_Theme
 */

get_header();
 ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>
<!-- ///////////////banner /////////////////////-->
			<div class="banner-carousel">

		<?php		$fields = CFS()->get( 'banner_loop' );
foreach ( $fields as $field ) {
	
	$keys = array_keys($field['title_link']);
$values = array_values($field['title_link']);

	?>
	<div class="banner-cell" >
	<div class="banner-thumbnail">
		<?php
		echo '<a href="'.$values[0].'" target="'.$values[2].'">'.'<img src="' . $field['banner_image']. '" alt="Banner Image">'.'</a>';
		?>
		
	</div>
	<div class="banner-text-info">
	<?php
echo '<a href="'.$values[0].'" target="'.$values[2].'">'.$values[1].'</a>';
		
		echo $field['banner_info'];
		?>
		<button class="blue-btn">buy tickets</button>
		</div>
</div>
		
		<?php
}   // end foreach /////////////////////////////////////////////////
?>

			</div>
			<h1>upcoming shows</h1>
			<div class="upcoming-shows">
				<div class="show-wrapper">
					<div class="thumbnail"></div>
				</div>
				<div class="show-wrapper">
					<div class="thumbnail"></div>
				</div>
				<div class="show-wrapper">
					<div class="thumbnail"></div>
				</div>
			</div>
			<h1>upcoming classes</h1>
				<div class="upcoming-classes">
				<div class="class-wrapper">
					<div class="thumbnail"></div>
				</div>
				<div class="class-wrapper">
					<div class="thumbnail"></div>
				</div>
				<div class="class-wrapper">
					<div class="thumbnail"></div>
				</div>
				</div>





		<!--/////////////////////// whats improv////////////////////////////// -->
			
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large' ); ?>
		<?php endif; ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php red_starter_posted_on(); ?> / <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> / <?php red_starter_posted_by(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
		

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>


		<section class="instagram-carousel">
				<h1>instagram</h1>
			<div id="instagram-feed" class="instagram-feed"></div>
			<div class="front-page-links"><a class="front-page-links" href="https://www.instagram.com/instanttheatre/">view on instagram <i class="fa fa-chevron-right"></i></a>
</div>
		</section>

		<!-- ///////////////////////////shows///////////////////////// -->

		<!-- // Grab the 5 next "party" events (by tag) -->
<?php $events = array(
		'post_type' => 'tribe_events',
    'eventDisplay'   => 'list',
    'posts_per_page' => 3,
		'tax_query'=> array(
			array(
					'taxonomy' => 'tribe_events_cat',
					'field' => 'slug',
					'terms' => 'shows'
			)
	)

);
?>

<?php $shows = new WP_Query( $events ); /* $args set above*/ ?>

<?php if ( $shows->have_posts() ) : ?>
<div class="show-containor">
	 <?php while ( $shows->have_posts() ) : $shows->the_post(); ?>
	 

    <div class="show-thumbnail">
	 <?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large' ); ?>
				<?php endif; ?>
				
				<div class="entry-meta">
			<?php red_starter_posted_on(); ?> / <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> 
			<!-- / -->
			<?php echo $shows->post_content; ?>
			 <?php 
			 
			//  inhabitent_posted_by(); 
			 ?>
			
			<h1><?php the_title(); ?></h1>
		<p><?php echo tribe_get_start_date( $post, true, 'l, F j' ); ?></p>
				 <p><?php echo tribe_get_start_date( $post, true, 'h:i A' ); ?></p>
				 <?php	
		echo tribe_get_venue();
		echo tribe_get_cost();
?>
		<a href="<?php echo tribe_get_event_website_url( $post ); ?>" class="buy-tickets-button">Buy Tickets</a>
       <a href="<?php echo tribe_get_event_link( $post ); ?>" class="learn-more-link" rel="bookmark">Learn More</a>
		
			<a class="buttonReadMore" href="<?php the_permalink();?>"> read more</a>
		</div><!-- .entry-meta -->


</div><!-- .journal-wrapper -->
	 <?php endwhile; ?>

</div><!-- .journal-blocks -->

<?php the_posts_navigation(); ?>
   <?php wp_reset_postdata(); ?>
<?php else : ?>
      <h2>Nothing found!</h2>
<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
