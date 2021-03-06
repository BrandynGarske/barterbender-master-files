<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');
/**
 * 
 * 
 * @copyright       [YOUNET_COPYRIGHT]
 * @author          YouNet Company
 * @package         YouNet_Resume
 */
?>

{if count($sCategories)}
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
	        {_p var='custom_fields'}
        </div>
    </div>
    <div id="js_menu_drop_down" style="display:none;">
        <div class="link_menu dropContent" style="display:block;">
            <ul>
                <li><a href="#active" onclick="return $Core.custom.action(this, 'active');">{_p var='custom.set_to_inactive'}</a></li>
                <li><a href="#" onclick="return $Core.custom.action(this, 'edit');">{_p var='custom.edit'}</a></li>
                <li><a href="#" onclick="return $Core.custom.action(this, 'delete');">{_p var='custom.delete'}</a></li>
            </ul>
        </div>
    </div>
    <form method="post" action="{url link='admincp.resume.custom'}">
        <div class="panel-body">
            <div class="table">
                <div class="sortable">
                    {$sCategories}
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <input type="submit" value="{_p('Update Order')}" class="btn btn-primary" />
        </div>
    </form>
</div>
{else}
<div class="extra_info">
    {_p var='custom.no_custom_fields_have_been_added'}
    <div>
        <a href="{url link='admincp.resume.custom.add'}">{phrase var='custom.add_a_new_custom_field'}</a>
    </div>
</div>
{/if}

