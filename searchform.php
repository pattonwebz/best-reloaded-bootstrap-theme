<?php
 /**
  * searchform.php
  * This is the markup that is used whenever the default wordpress seach is called front-end
  *
  * @package WordPress
  * @subpackage Best_Reloaded
  * @since Best Reloaded 0.1
  */
?>
<form role="search" method="get" class="navbar-search" action="<?php echo home_url( '/' ); ?>">
    <label class="visually-hidden" for="s">Search:</label>
    <input type="text" class="search-query" placeholder="type and hit &#x0022;enter&#x0022; to search" name="s" id="s" />
    <input type="submit" class="hidden" id="searchsubmit" value="Search" />
</form>
