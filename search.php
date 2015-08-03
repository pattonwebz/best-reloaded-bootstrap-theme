<?php
/* =============================================================
 * search.php
 * =============================================================
 * Default page template for all search results
 * ============================================================= */
?>

<?php get_header(); ?>
        <?php get_template_part( 'featured', 'bar' ); ?>

        <div class="row">
            <div class="col-md-8">
                <div id="main_content" class="blog-page" role="main">

			        <?php get_template_part( 'loop', 'main' ); ?>
			        
                    <?php // Add custom pagination ?>
                    <?php if ( function_exists( 'pagenavi' ) ) { pagenavi(); } ?>
		
                </div><!-- end #main_content -->

            </div><!-- end .col-md-8 -->
                    
            <?php get_sidebar( 'main' ); ?>
            
        </div><!-- end .row -->

<?php get_footer(); ?>