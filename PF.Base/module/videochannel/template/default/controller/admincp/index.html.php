<?php

defined('PHPFOX') or exit('NO DICE!');

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            {phrase var='categories'}
        </div>
    </div>

    <div class="panel-body">
        <div class="table-responsive flex-sortable">
            <table id="js_drag_drop" class="table table-bordered">
                <thead>
                <tr>
                    <th></th>
                    <th class="w40"></th>
                    <th>{phrase var='name'}</th>
                    <th class="t_center w60">{phrase var='active'}</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$aCategories key=iKey item=aCategory}
                <tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
                    <td class="drag_handle"><input type="hidden" name="val[ordering][{$aCategory.category_id}]" value="{$aCategory.ordering}" /></td>
                    <td class="t_center">
                        <a href="#" class="js_drop_down_link" title="{phrase var='Manage'}"></a>
                        <div class="link_menu">
                            <ul>
                                <li><a href="{url link='admincp.videochannel.add' id=$aCategory.category_id}">{phrase var='edit'}</a></li>
                                {if isset($aCategory.categories) && ($iTotalSub = count($aCategory.categories))}
                                <li><a href="{url link='admincp.videochannel' sub={$aCategory.category_id}">{phrase var='manage_sub_categories_total' total=$iTotalSub}</a></li>
                                {/if}

                                {if !empty($aCategory.numberItems)}
                                <li><a href="" class="jsWarning" data-title="{_p('notice')}" data-message="{phrase var='you_can_not_delete_this_category_because_there_are_many_items_related_to_it'}">{phrase var='delete'}</a></li>
                                {else}
                                <li><a href="{url link='admincp.videochannel' delete=$aCategory.category_id}" class="sJsConfirm" data-message="{phrase var='are_you_sure'}">{phrase var='delete'}</a></li>
                                {/if}
                            </ul>
                        </div>
                    </td>
                    <td>
                        {if Core\Lib::phrase()->isPhrase($this->_aVars['aCategory']['name'])}
                        {_p var=$aCategory.name}
                        {else}
                        {$aCategory.name|convert}
                        {/if}
                    </td>
                    <td class="t_center">
                        <div class="js_item_is_active"{if !$aCategory.is_active} style="display:none;"{/if}>
                        <a href="#?call=videochannel.updateActivity&amp;id={$aCategory.category_id}&amp;active=0" class="js_item_active_link" title="{phrase var='deactivate'}"></a>
        </div>
        <div class="js_item_is_not_active"{if $aCategory.is_active} style="display:none;"{/if}>
        <a href="#?call=videochannel.updateActivity&amp;id={$aCategory.category_id}&amp;active=1" class="js_item_active_link" title="{phrase var='activate'}"></a>
    </div>
    </td>
    </tr>
    {/foreach}
    </tbody>
    </table>
</div>
</div>
</div>

{literal}
<script type="text/javascript">
    $Behavior.onInitCategory = function(){
        $('.jsWarning').click(function() {
            var buttons = {};
            buttons[oTranslations['cancel']] = {
                'class': 'button dont-unbind',
                text: oTranslations['cancel'],
                click: function() {
                    $(this).dialog("close");
                }
            };
            $(document.createElement('div'))
                .attr({title: $(this).data('title'), class: 'confirm'})
                .html($(this).data('message'))
                .dialog({
                    dialogClass: 'pf_js_confirm',
                    close: function() {
                        $(this).remove();
                    },
                    buttons: buttons,
                    draggable: true,
                    modal: true,
                    resizable: false,
                    width: 'auto'
                });
            return false;
        });
    }

</script>
{/literal}