<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: add.html.php 1124 2009-10-02 14:07:30Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{phrase var='foxfavorite.successfully_added_to_your_favorites'}
<ul class="action">
	<li><a href="{url link='profile.foxfavorite'}">{phrase var='foxfavorite.view_your_favorites'}</a></li>
	<li><a href="#" onclick="tb_remove(); return false;">{phrase var='foxfavorite.close'}</a></li>
</ul>