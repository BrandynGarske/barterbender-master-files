<?php
defined('PHPFOX') or exit('NO DICE!');
?>

<div class="sub_section_menu core-block-categories">
    <ul {if isset($sUlClass)}class="{$sUlClass}"{else}class="action category-list"{/if}>
    {foreach from=$aCategories item=aCategory key=iCategoryCount}
    <li class="{if isset($iCurrentCategory) && $iCurrentCategory == $aCategory.category_id}active{/if} {if isset($iParentCategoryId) && $iParentCategoryId == $aCategory.category_id}open{/if} {if isset($sModule)}{$sModule}_{/if}category">
        <div {if isset($aCategory.sub) && count($aCategory.sub) > 0}class="no_ajax_link category_show_more_less_link category-item"{else}class="category-item"{/if} >
            <a class="name" href="{$aCategory.url}{if Phpfox_Request::instance()->get('view') != ''}view_{request var='view'}/{/if}" id="{if isset($sModule)}{$sModule}_{/if}category_{$aCategory.category_id}">
                {_p var=$aCategory.name}
            </a>
            {if isset($aCategory.sub) && count($aCategory.sub) > 0}
            <span class="category-toggle core-btn-collapse" data-toggle="collapse" data-target="#{if isset($sModule)}{$sModule}_{/if}sub_list_category_{$aCategory.category_id}" {if isset($iParentCategoryId) && $iParentCategoryId == $aCategory.category_id}aria-expanded="true"{/if}>
                <i class="ico ico-angle-down"></i>
            </span>
            {/if}
        </div>

        {if isset($aCategory.sub) && count($aCategory.sub)}
        <ul class="collapse {if isset($iParentCategoryId) && $iParentCategoryId == $aCategory.category_id}in{/if}" id="{if isset($sModule)}{$sModule}_{/if}sub_list_category_{$aCategory.category_id}">
            {foreach from=$aCategory.sub item=aSubCategory key=iKey}
            <li class="{if isset($iCurrentCategory) && $iCurrentCategory == $aSubCategory.category_id}active{/if} {if isset($sModule)}{$sModule}_{/if}subcategory_{$aCategory.category_id} special_subcategory">
                <a href="{$aSubCategory.url}{if Phpfox_Request::instance()->get('view') != ''}view_{request var='view'}/{/if}" id="{if isset($sModule)}{$sModule}_{/if}subcategory_{$aSubCategory.category_id}">
                    {_p var=$aSubCategory.name}
                </a>
            </li>
            {/foreach}
        </ul>
        {/if}
    </li>
    {/foreach}
    </ul>
</div>