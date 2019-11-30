<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.upwork.com/o/profiles/users/_~01a15cf8508f1d2eec/
 * @since      1.0.0
 *
 * @package    Top_Goods_Lister
 * @subpackage Top_Goods_Lister/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php 
	echo '<div class="tgl-shortcodes">';
    echo _e( '<span>Use the shortcode to  show <strong>"Single Product": <br> [tgl single="' . $post->post_name . '"] </span>', 'top-goods-lister' );;
    echo '<br>';
    echo '<span>Use the shortcode to  show <strong>"Top Products List"</strong> <br> [tgl list="' . $term[0]->name . '" count="3"] </span>';
	echo '</div>';
    echo '<div class="aff_and_ord">';
    echo '<span style="color:red;">The next two fields is required </span><br><br>';
    echo '<span>Order: </span><input type="number" name="order" value="' . esc_textarea( $order )  . '" class="widefat">';
    echo '<br>';
    echo '<span>Affiliate Link: </span><input type="text" name="afflink" value="' . esc_textarea( $afflink )  . '" class="widefat">';
    echo '</div>';
    echo '<hr>';
    echo '<span>Feadback Link: </span><input type="text" name="fdblink" value="' . esc_textarea( $fdblink )  . '" class="widefat">';
    echo '<br>';
    echo '<span>Brend Link: </span><input type="text" name="brendlink" value="' . esc_textarea( $brendlink )  . '" class="widefat">';
    echo '<br>';
    echo '<span>Brend Name: </span><input type="text" name="brendname" value="' . esc_textarea( $brendname )  . '" class="widefat">';
    echo '<div class="slidecontainer">';
	echo '<span>Star Range 	&#10032; 	&#10032; 	&#10032; 	&#10032; 	&#10032;: <output name="starrangeOutputName" id="starrangeOutputId">' . esc_textarea( $starrange ) . '</output></span> 
	<input type="range" name="starrange" id="starrangeInputId" value="' . esc_textarea( $starrange ) . '" min="10" max="50" oninput="starrangeOutputId.value = starrangeInputId.value" class="widefat star-range-slider">
		';
	echo '</div>';

 ?>