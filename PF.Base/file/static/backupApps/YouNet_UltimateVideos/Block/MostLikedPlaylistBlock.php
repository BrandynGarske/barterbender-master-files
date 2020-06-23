<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 8/11/16
 * Time: 9:25 AM
 */

namespace Apps\YouNet_UltimateVideos\Block;

use Phpfox;

class MostLikedPlaylistBlock extends \Phpfox_Component
{
    public function process()
    {
        $iLimit = $this->getParam('limit', 3);
        if (!$iLimit) {
            return false;
        }

        $aItems =  Phpfox::getService('ultimatevideo.playlist.browse')
            ->getMostLikedPlaylists($iLimit);
        if(empty($aItems)){
            return false;
        }
        Phpfox::getService('ultimatevideo.playlist.browse')->processRows($aItems);
        $this->template()->assign([
            'sHeader'=> _p('most_liked'). ultimatevideo_playlist_view_mode(),
            'bShowTotalView'=> true,
            'bShowTotalLike'=> true,
            'bShowTotalComment'=> false,
            'aItems'=>$aItems
        ]);

        return 'block';
    }

    public function getSettings()
    {
        return [
            [
                'info' => _p('Most Like Playlist Limit'),
                'description' => _p('Define the limit of how many most like playlist can be displayed when viewing the section. Set 0 will hide this block.'),
                'value' => 3,
                'type' => 'integer',
                'var_name' => 'limit',
            ],
            [
                'info' => _p('Most Like Playlist Cache Time'),
                'description' => _p('Define how long we should keep the cache for the <b>Most Like Playlist</b> by minutes. 0 means we do not cache data for this block.'),
                'value' => Phpfox::getParam('core.cache_time_default'),
                'options' => Phpfox::getParam('core.cache_time'),
                'type' => 'select',
                'var_name' => 'cache_time',
            ]
        ];
    }
    public function getValidation()
    {
        return [
            'limit' => [
                'def' => 'int',
                'min' => 0,
                'title' => '"Most Like Playlist Limit" must be greater than or equal to 0'
            ]
        ];
    }
}