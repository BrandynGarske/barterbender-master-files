<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('NO DICE!');

class Auction_Component_Block_detailactivities extends Phpfox_Component {

	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process() {
        $aYnAuctionDetail = $this->getParam('aYnAuctionDetail');
        
        $aAuction = $aYnAuctionDetail['aAuction'];
        
        $this->template()->assign(array(
            'aAuction' => $aAuction,
            )
        );
    }

}

?>
