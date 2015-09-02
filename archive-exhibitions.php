<?php
/**
 * The template for displaying the Exhibition Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seventeen
 */
get_header(); ?>

    <main id="main" class="site-main container-fluid" role="main">
        <section id="current-exhibitions" class="exhibition-chron-list row">

            <?php if ( have_posts() ) : ?>
			
				<h2 class="label col-sm-12"><?php esc_html_e( 'Current Exhibitions', 'seventeen' ); ?></h2>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

                <?php endwhile; ?>

            <?php else : ?>

                <?php get_sidebar( 'current' ); ?>

            <?php endif; ?>
        
        </section>
        <section id="forthcoming-exhibitions" class="exhibition-chron-list row">
			<h2 class="label col-sm-12"><?php esc_html_e( 'Forthcoming Exhibitions', 'seventeen' ); ?></h2>
        
            <?php get_template_part( 'template-parts/loop', 'forthcoming' ); ?>
        
        </section>
        <section id="previous-exhibitions" class="exhibition-chron-list row">
			<h2 class="label col-sm-12"><?php esc_html_e( 'Past Exhibitions', 'seventeen' ); ?></h2>
			
			<?php
				$args = array(
					'meta_query' => array(
							array(
								'key' => '_seventeen_enddate',
								'value' => time(),
								'compare' => '<'
							)
					),
					'order' => 'DESC',
					'post_type' => 'exhibitions',
					'meta_key' => '_seventeen_enddate',
					'posts_per_page' =>	-1,	
					'orderby' => 'meta_value',
				);
				$previous_exhibtions = new WP_Query();
				$previous_exhibtions->query( $args );
				
				$clean = '';
				$current_year = '';
            
				if ( $previous_exhibtions->have_posts() ) :
					while ( $previous_exhibtions->have_posts() ) : $previous_exhibtions->the_post();

						$meta_enddate = get_post_meta($post->ID, '_seventeen_enddate', true); // get the end date from the post meta
						$year = date( "Y", $meta_enddate ); // chose the year and format it nicely
						
						if ( $current_year !== $year ) :
							if ( !empty( $current_year ) ) :	
								$clean .= '</ul>';
								$clean .= '</div>';
							endif;
							$current_year = $year;
							$clean .= '<div class="year-group">';
							$clean .= '<h2 class="exhibition-year label label-year col-sm-12">' . $year . '</h2>';
							$clean .= '<ul class="list-unstyled exhibition-year-list">';
						endif;
						
						$clean .= '<li class="exhibition-details col-sm-4 col-md-3 col-lg-2"><h2 class="entry-title entry-title-italic"><a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">' . get_the_title() . seventeen_exhibition_dates() . '</a></h2></li>';
					endwhile;
                
					$clean .= '</ul>';
					$clean .= '</div>';
				
				endif;
			?>
			
			<?php echo $clean; ?>
        
        </section>
    </main>

<?php get_footer(); ?>