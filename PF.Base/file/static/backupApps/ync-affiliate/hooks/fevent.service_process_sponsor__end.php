<?php

if(Phpfox::isModule('yncaffiliate') && $iId)
{
    $aAd = db()->select('*')
                ->from(Phpfox::getT('ad_sponsor'))
                ->where('module_id = \'fevent\' AND item_id ='.$iId)
                ->order('sponsor_id DESC')
                ->execute('getRow');
    if(count($aAd) && isset($aAd['sponsor_id']))
    {
        $aInvoice = db()->select('*')
                            ->from(Phpfox::getT('ad_invoice'))
                            ->where('ad_id = '.$aAd['sponsor_id'])
                            ->execute('getRow');
        if($aInvoice && $aInvoice['status'] == 'completed')
        {
            $aPurchase = [
                'amount' => $aInvoice['price'],
                'currency_id' => $aInvoice['currency_id'],
            ];
            Phpfox::getService('yncaffiliate.commission.process')->handlePayment($aInvoice['user_id'],$aPurchase,'sponsor_advanced_event','fevent');
        }
    }
}
