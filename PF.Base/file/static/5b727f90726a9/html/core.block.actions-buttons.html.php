{if ((count($aSubMenus) || isset($aCustomMenus))) && Phpfox::isUser() && empty($bNotShowActionButton)}
<div class="app-addnew-block">
    <div class="btn-app-addnew">
        {if count($aSubMenus) == 1 && empty($aCustomMenus) && ($aSubMenu = reset($aSubMenus))}
            <a href="{url link=$aSubMenu.url)}" class="btn btn-success {if !empty($aSubMenus.css_name)}{$aSubMenu.css_name}{/if}" {if !empty($aSubMenus.extra)}{$aSubMenus.extra}{/if}>
                <span class="ico ico-plus"></span>
                <span class="item-text" style="display: none">
                    {if isset($aSubMenu.text)}
                        {$aSubMenu.text|shorten:22:'...'}
                    {else}
                        {_p var=$aSubMenu.var_name}
                    {/if}
                </span>
            </a>
        {elseif empty($aSubMenus) && !empty($aCustomMenus) && count($aCustomMenus) == 1 && ($aSubMenu = reset($aCustomMenus))}
            <a href="{url link=$aSubMenu.url)}" class="btn btn-success {if (isset($aSubMenu.css_class))} {$aSubMenu.css_class}{/if}" {if !empty($aSubMenu.extra)}{$aSubMenu.extra}{/if}>
                <span class="ico ico-plus"></span>
                <span class="item-text" style="display: none">
                    {if isset($aSubMenu.title)}
                        {$aSubMenu.title|shorten:22:'...'}
                    {else}
                        {_p var=$aSubMenu.var_name}
                    {/if}
                </span>
            </a>
        {else}
            <a role="button" class="btn btn-success " data-toggle="dropdown">
                <span class="ico ico-plus"></span>
                <span class="item-text" style="display: none">
                    {_p var='add'}
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                {if (isset($aCustomMenus))}
                    {foreach from=$aCustomMenus key=iKey name=menu item=aMenu}
                    <li>
                        <a class="{if (isset($aMenu.css_class))} {$aMenu.css_class}{/if}" href="{url link=$aMenu.url)}" {if !empty($aMenu.extra)}{$aMenu.extra}{/if}>
                            {if !empty($aMenu.icon_class)}
                                <span class="{$aMenu.icon_class}"></span>
                            {else}
                                <span class="ico ico-compose-alt"></span>
                            {/if}
                            {$aMenu.title}
                        </a>
                    </li>
                    {/foreach}
                {/if}

                {foreach from=$aSubMenus key=iKey name=submenu item=aSubMenu}
                    <li>
                        {if isset($aSubMenu.module) && (isset($aSubMenu.var_name) || isset($aSubMenu.text))}
                            <a href="{url link=$aSubMenu.url)}"{if (isset($aSubMenu.css_name))} class="{$aSubMenu.css_name} no_ajax"{else}class=""{/if}>
                                {if !empty($aSubMenu.icon_class)}
                                    <span class="{$aMenu.icon_class}"></span>
                                {else}
                                    <span class="ico ico-compose-alt"></span>
                                {/if}
                                {if isset($aSubMenu.text)}
                                    {$aSubMenu.text}
                                {else}
                                    {_p var=$aSubMenu.var_name}
                                {/if}
                            </a>
                        {/if}
                    </li>
                {/foreach}
            </ul>
        {/if}
    </div>
</div>
{/if}