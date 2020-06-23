<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 17, 2020, 12:25 am */ ?>
<?php
    
 if (! isset ( $this->_aVars['aFeed']['feed_display'] ) || $this->_aVars['aFeed']['feed_display'] != 'view' || ( $this->_aVars['aFeed']['feed_display'] == 'view' && ! empty ( $this->_aVars['aFeed']['is_detail_item'] ) )): ?>
<?php if (! empty ( $this->_aVars['aFeed']['is_detail_item'] )): ?>
    <div class="js_comment_like_holder js_ync_reaction_display_in_detail" style="display: none;" id="js_feed_like_holder_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
        <div id="js_like_body_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
<?php endif; ?>

<?php if (isset ( $this->_aVars['ajaxLoadLike'] ) && $this->_aVars['ajaxLoadLike']): ?>
    <div id="js_like_body_<?php echo $this->_aVars['aFeed']['feed_id']; ?>" class="ync-reaction-like-body">
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['feed_like_phrase'] )): ?>
    <div class="activity_like_holder ync-reaction-activity-like" id="activity_like_holder_<?php echo $this->_aVars['aFeed']['feed_id']; ?>">
        <div class="ync-reaction-list-mini dont-unbind-children">
<?php if (! empty ( $this->_aVars['aFeed']['most_reactions'] )): ?>
<?php for ($this->_aVars['i'] = 0; $this->_aVars['i'] <= 2; $this->_aVars['i']++): ?>
<?php if (isset ( $this->_aVars['aFeed']['most_reactions'][$this->_aVars['i']] )): ?>
                        <div class="ync-reaction-item js_reaction_item">
                            <a href="javascript:void(0)" class="item-outer"
                               data-toggle="ync_reaction_toggle_user_reacted_cmd"
                               data-action="ync_reaction_show_list_user_react_cmd"
                               data-type_id="<?php echo $this->_aVars['aFeed']['like_type_id']; ?>"
                               data-item_id="<?php echo $this->_aVars['aFeed']['item_id']; ?>"
                               data-feed_id="<?php if (isset ( $this->_aVars['aFeed']['feed_id'] )):  echo $this->_aVars['aFeed']['feed_id'];  else: ?>0<?php endif; ?>"
                               data-total_reacted="<?php echo $this->_aVars['aFeed']['most_reactions'][$this->_aVars['i']]['total_reacted']; ?>"
                               data-react_id="<?php echo $this->_aVars['aFeed']['most_reactions'][$this->_aVars['i']]['id']; ?>"
                               data-table_prefix="<?php if (isset ( $this->_aVars['aFeed']['feed_table_prefix'] )):  echo $this->_aVars['aFeed']['feed_table_prefix'];  elseif (defined ( 'PHPFOX_IS_PAGES_VIEW' ) && defined ( 'PHPFOX_PAGES_ITEM_TYPE' )): ?>pages_<?php endif; ?>"
                            >
                                <img src="<?php echo $this->_aVars['aFeed']['most_reactions'][$this->_aVars['i']]['full_path']; ?>" alt="">
                            </a>
                            <div class="ync-reaction-tooltip-user js_ync_reaction_tooltip">
                                <div class="item-title"><?php echo _p(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aFeed']['most_reactions'][$this->_aVars['i']]['title'])); ?> (<?php echo Phpfox::getService('core.helper')->shortNumber($this->_aVars['aFeed']['most_reactions'][$this->_aVars['i']]['total_reacted']); ?>)</div>
                                <div class="item-tooltip-content js_ync_reaction_preview_reacted">
                                    <div class="item-user"><?php echo _p('loading_three_dot'); ?></div>
                                </div>
                            </div>
                        </div>
<?php endif; ?>
<?php endfor; ?>
<?php endif; ?>
         </div>
<?php echo $this->_aVars['aFeed']['feed_like_phrase']; ?>
<?php if (( isset ( $this->_aVars['aFeed']['feed_total_like'] ) && $this->_aVars['aFeed']['feed_total_like'] )): ?>
        <a href="javascript:void(0)" class="ync-reaction-total" style="display: none;"
           data-action="ync_reaction_show_list_user_react_cmd"
           data-type_id="<?php echo $this->_aVars['aFeed']['like_type_id']; ?>"
           data-item_id="<?php echo $this->_aVars['aFeed']['item_id']; ?>"
           data-feed_id="<?php if (isset ( $this->_aVars['aFeed']['feed_id'] )):  echo $this->_aVars['aFeed']['feed_id'];  else: ?>0<?php endif; ?>"
           data-react_id="0"
           data-table_prefix="<?php if (isset ( $this->_aVars['aFeed']['feed_table_prefix'] )):  echo $this->_aVars['aFeed']['feed_table_prefix'];  elseif (defined ( 'PHPFOX_IS_PAGES_VIEW' ) && defined ( 'PHPFOX_PAGES_ITEM_TYPE' )): ?>pages_<?php endif; ?>">
<?php echo Phpfox::getService('core.helper')->shortNumber($this->_aVars['aFeed']['feed_total_like']); ?>
        </a>
<?php endif; ?>
    </div>
<?php else: ?>
    <div class="activity_like_holder activity_not_like">
<?php echo _p('when_not_like'); ?>
    </div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['ajaxLoadLike'] ) && $this->_aVars['ajaxLoadLike']): ?>
    </div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aFeed']['is_detail_item'] )): ?>
        </div>
    </div>
<?php endif;  endif; ?>

