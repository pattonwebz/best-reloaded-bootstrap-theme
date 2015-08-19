<?php
/**
 * ads-posts.php
 * Displays post feature/ad
 *
 * @package WordPress
 * @subpackage Best_Reloaded
 * @since Best Reloaded 0.0
 */
?>
<div class="row-fluid post-ads">
	<?php if(function_exists('drawAdsPlace')) drawAdsPlace(array('id' => 2), true); ?>
</div>
<div class="row-fluid">
		<?php // zemanta_related_posts() ?>
</div>
