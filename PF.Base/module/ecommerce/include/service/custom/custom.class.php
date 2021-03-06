<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('NO DICE!');

class Ecommerce_Service_Custom_Custom extends Phpfox_service {

    private $_aHasOption = array('select', 'radio', 'multiselect', 'checkbox');

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->_sTable = Phpfox::getT('ecommerce_custom_field');
        $this->_sTableOption = Phpfox::getT('ecommerce_custom_option');
        $this->_sTableValue = Phpfox::getT('ecommerce_custom_value');
    }

    public function getHasOption()
    {
        return $this->_aHasOption;
    }

    public function getCustomField()
    {
        $aFields = $this->database()->select('*')
                ->from($this->_sTable)
                ->order('ordering ASC')
                ->execute('getSlaveRows');

        if (is_array($aFields) && count($aFields))
        {
            foreach ($aFields as $k => $aField)
            {
                if (in_array($aField['var_type'], $this->_aHasOption))
                {
                    $aOptions = $this->database()->select('*')->from($this->_sTableOption)->where('field_id = ' . $aField['field_id'])->order('option_id ASC')->execute('getSlaveRows');

                    if (is_array($aOptions) && count($aOptions))
                    {
                        foreach ($aOptions as $k2 => $aOption)
                        {
                            $aFields[$k]['option'][$aOption['option_id']] = $aOption['phrase_var_name'];
                        }
                    }
                }
            }
        }

        return $aFields;
    }

    public function getForCustomEdit($iId)
    {
        $aField = $this->database()->select('*')->from($this->_sTable)->where('field_id = ' . (int) $iId)->execute('getRow');

        list($sModule, $sVarName) = explode('.', $aField['phrase_var_name']);

        // Get the name of the field in every language
        $aPhrases = $this->database()->select('language_id, text')
                ->from(Phpfox::getT('language_phrase'))
                ->where('var_name = \'' . $this->database()->escape($sVarName) . '\'')
                ->execute('getSlaveRows');

        foreach ($aPhrases as $aPhrase)
        {
            $aField['name'][$aField['phrase_var_name']][$aPhrase['language_id']] = $aPhrase['text'];
        }

        if ($aField['var_type'] == 'select' || $aField['var_type'] == 'multiselect' || $aField['var_type'] == 'radio' || $aField['var_type'] == 'checkbox')
        {
            $aOptions = $this->database()->select('option_id, field_id, phrase_var_name')
                    ->from($this->_sTableOption)
                    ->where('field_id = ' . $aField['field_id'])
                    ->order('option_id ASC')
                    ->execute('getSlaveRows');

            foreach ($aOptions as $iKey => $aOption)
            {
                list($sModule, $sVarName) = explode('.', $aOption['phrase_var_name']);

                $aPhrases = $this->database()->select('language_id, text, var_name')
                        ->from(Phpfox::getT('language_phrase'))
                        ->where('var_name = \'' . $this->database()->escape($sVarName) . '\'')
                        ->execute('getSlaveRows');

                foreach ($aPhrases as $aPhrase)
                {
                    if (!isset($aField['option'][$aOption['option_id']][$aOption['phrase_var_name']][$aPhrase['language_id']]))
                    {
                        $aField['option'][$aOption['option_id']][$aOption['phrase_var_name']][$aPhrase['language_id']] = array();
                    }
                    $aField['option'][$aOption['option_id']][$aOption['phrase_var_name']][$aPhrase['language_id']]['text'] = $aPhrase['text'];
                }
            }
        }
        return $aField;
    }

    public function getCustomFieldByGroupId($iGroupId)
    {
        $aFields = $this->database()->select('*')
                ->from($this->_sTable)
                ->where('group_id =' . $iGroupId)
                ->order('ordering ASC')
                ->execute('getSlaveRows');

        if (is_array($aFields) && count($aFields))
        {
            foreach ($aFields as $k => $aField)
            {
                if (in_array($aField['var_type'], $this->_aHasOption))
                {
                    $aOptions = $this->database()->select('*')->from($this->_sTableOption)->where('field_id = ' . $aField['field_id'])->order('option_id ASC')->execute('getSlaveRows');
                    if (is_array($aOptions) && count($aOptions))
                    {
                        foreach ($aOptions as $k2 => $aOption)
                        {
                            $aFields[$k]['option'][$aOption['option_id']] = $aOption['phrase_var_name'];
                        }
                    }
                }
            }
        }

        return $aFields;
    }

    public function getCustomGroupById($iGroupId){
        return $this->database()->select('*')->from(Phpfox::getT('directory_custom_group'))->where('group_id = '.(int)$iGroupId)->execute('getRow');
    }

    public function getCustomFieldByProductId($iProductId,$sType = 'auction')
    {
        if((int)$iProductId == 0){
            return array();
        }
        $aFields = $this->database()->select('cg.phrase_var_name as group_phrase_var_name,cf.*, cv.value,cv.product_id')
            ->from($this->_sTable, 'cf')
            ->leftJoin($this->_sTableValue, 'cv', 'cv.field_id = cf.field_id AND cv.product_id = '.$iProductId)
            ->Join(Phpfox::getT('ecommerce_custom_group'), 'cg', 'cg.group_id = cf.group_id')
            ->where('cv.product_type = "'.$sType.'"')
            ->group('cf.field_id')
            ->order('cf.ordering ASC')
            ->execute('getSlaveRows');


        if(is_array($aFields) && count($aFields))
        {
            foreach($aFields as $k=>$aField)
            {
                if(in_array($aField['var_type'], $this->_aHasOption))
                {
                    //get all option of specific field.
                    $aOptions = $this->database()->select('*')->from($this->_sTableOption)->where('field_id = '.$aField['field_id'])->order('option_id ASC')->execute('getSlaveRows');
                    if(is_array($aOptions) && count($aOptions))
                    {
                        foreach($aOptions as $k2=>$aOption)
                        {
                            $aFields[$k]['option'][$aOption['option_id']] = $aOption['phrase_var_name'];
                        }
                    }

                    //get default option of specifice field belong to specific directory.
                    $aOptions = $this->database()->select('co.*')
                        ->from($this->_sTableOption, 'co')
                        ->leftJoin($this->_sTableValue, 'cv', 'cv.option_id = co.option_id')
                        ->where('co.field_id = '.$aField['field_id'].' AND cv.product_id = '.$iProductId)
                        ->order('co.option_id ASC')
                        ->execute('getSlaveRows');
                    
                    if(is_array($aOptions) && count($aOptions))
                    {
                        foreach($aOptions as $k2=>$aOption)
                        {
                            $aFields[$k]['value'][$aOption['option_id']] = $aOption['phrase_var_name'];
                        }
                    }
                }
            }
        }

        
        return $aFields;
    }
       



}
