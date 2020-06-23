<?php
defined('PHPFOX') or exit('NO DICE!');

/**
 * Class Ban_Component_Controller_Spam
 */
class Ban_Component_Controller_Spam extends Phpfox_Component
{
	/**
	 * Controller
	 */
	public function process()
	{
		$this->template()->setTemplate('blank');		
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('ban.component_controller_spam_clean')) ? eval($sPlugin) : false);
	}
}
