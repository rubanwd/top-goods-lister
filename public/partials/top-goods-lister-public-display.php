<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.upwork.com/o/profiles/users/_~01a15cf8508f1d2eec/
 * @since      1.0.0
 *
 * @package    Top_Goods_Lister
 * @subpackage Top_Goods_Lister/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->



<div class="products-container">


    
    <?php
            function feadback_link() {
                $aff_link = get_post_custom_values('afflink')[0];
                $fdb_link = get_post_custom_values('fdblink')[0];
                if (isset($fdb_link)) { return $fdb_link; };
                return $aff_link;
            }
            function brend_link() {
                $aff_link = get_post_custom_values('afflink')[0];
                $brend_link = get_post_custom_values('brendlink')[0];
                if (isset($brend_link)) { return $brend_link; };
                return $aff_link;
            }
            function brend_name() {
                $brend_name = get_post_custom_values('brendname')[0];
                if (isset($brend_name)) { return $brend_name; };
                return 'Бренде';
            }

        ?>

	


    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
    	<div class="products-item">
    		<?php if( $products->post_count > 1 ): ?>
                <div class="order-number">
	    			<?php echo get_post_custom_values('order')[0]; ?>
	    		</div>
            <?php endif; ?>

    	    <h3>
    	    	<a href="<?php echo get_post_custom_values('afflink')[0]; ?>" target="_parent" rel="nofollow"><?php the_title(); ?></a>
    	    </h3>
			<div class="stars-rate">
				<?php if( isset(get_post_custom_values('starrange')[0]) ): ?>
					<div class="stars-rate-wrap"></div>
					<div class="rate-slider" style="width: <?php echo get_post_custom_values('starrange')[0] * 2.1; ?>%;"></div>
            	<?php endif; ?>
			</div>
    	    <a href="<?php echo get_post_custom_values('afflink')[0]; ?>" target="_parent" rel="nofollow">
    	    	<?php the_post_thumbnail('full'); ?>
    	    </a>


    	    <div class="aff-target-link">
    	    	<a href="<?php echo get_post_custom_values('afflink')[0]; ?>" 
                    target="_parent" 
                    rel="nofollow" 
                    style="background-color:<?php echo get_option( 'tgl_options' )['target-button-background-color']; ?>;
                            color:<?php echo get_option( 'tgl_options' )['target-button-text-color']; ?>;
                    ">
                    <span>
                        <?php echo get_option( 'tgl_options' )['target-button-text-value']; ?> <i class="fas fa-arrow-right" style="margin-left:6px;"></i>
                    </span>
                </a>
    	    </div>
    	    <div class="feadback-link">
    	    	<a href="<?php echo feadback_link(); ?>" target="_parent" style="color:<?php echo get_option( 'tgl_options' )['feedback-button-text-color']; ?>;
                    "><?php echo get_option( 'tgl_options' )['feedback-button-text-value']; ?></a>
    	    </div>
    	    <div class="line-title">
    	    	<div class="title">
    	    		<span>
    	    			<strong>Описание</strong>
    	    		</span>
    	    	</div>
    	    </div>
    	    <div class="descr-product"><?php the_content(); ?></div>
    	    <div class="brend-link">
    	    	<span>Узнать больше о <a href="<?php echo brend_link(); ?>" target="_parent"> <?php echo brend_name() ?></a></span>
    	    </div>
    	</div>
	<?php endwhile; ?>
</div>