<?php

if ($sTemplate == 'core.block.template-menusub') {
    if (!empty($this->_aVars['aFilterMenusIcons']) && is_array($this->_aVars['aFilterMenusIcons'])) {
        $this->_aVars['aFilterMenusIcons'][_p('video_channel')] = 'ico ico-file-movie-o';
    }
} else if ($sTemplate == 'admincp.controller.stat.dashboard') {
    if (!empty($this->_aVars['aItems']) && is_array($this->_aVars['aItems'])) {
        foreach ($this->_aVars['aItems'] as $key => $aItem) {
            if ($aItem['phrase'] == _p('video_channel')) {
                $this->_aVars['aItems'][$key]['icon'] = 'ico ico-file-movie-o';
            }
        }
    }
    if (!empty($this->_aVars['aRemainItems']) && is_array($this->_aVars['aRemainItems'])) {
        foreach ($this->_aVars['aRemainItems'] as $key => $aItem) {
            if ($aItem['phrase'] == _p('video_channel')) {
                $this->_aVars['aRemainItems'][$key]['icon'] = 'ico ico-file-movie-o';
            }
        }
    }
}

