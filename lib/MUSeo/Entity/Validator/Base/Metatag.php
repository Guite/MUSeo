<?php
/**
 * MUSeo.
 *
 * @copyright Michael Ueberschaer (MU)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @package MUSeo
 * @author Michael Ueberschaer <kontakt@webdesign-in-bremen.com>.
 * @link http://webdesign-in-bremen.com
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.7.0 (http://modulestudio.de).
 */

/**
 * Validator class for encapsulating entity validation methods.
 *
 * This is the base validation class for metatag entities.
 */
class MUSeo_Entity_Validator_Base_Metatag extends MUSeo_Validator
{
    /**
     * Performs all validation rules.
     *
     * @return mixed either array with error information or true on success
     */
    public function validateAll()
    {
        $errorInfo = array('message' => '', 'code' => 0, 'debugArray' => array());
        $dom = ZLanguage::getModuleDomain('MUSeo');
        if (!$this->isValidInteger('id')) {
            $errorInfo['message'] = __f('Error! Field value may only contain digits (%s).', array('id'), $dom);
            return $errorInfo;
        }
        if (!$this->isNumberNotLongerThan('id', 9)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('id', 9), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotEmpty('workflowState')) {
            $errorInfo['message'] = __f('Error! Field value must not be empty (%s).', array('workflow state'), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('titleOfEntity', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('title of entity', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotEmpty('titleOfEntity')) {
            $errorInfo['message'] = __f('Error! Field value must not be empty (%s).', array('title of entity'), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('focusKeyword', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('focus keyword', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('title', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('title', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('description', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('description', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('keywords', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('keywords', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('canonicalUrl', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('canonical url', 255), $dom);
            return $errorInfo;
        }
        if ($this->entity['canonicalUrl'] != '' && !$this->isValidUrl('canonicalUrl')) {
            $errorInfo['message'] = __f('Error! Field value must be a valid url (%s).', array('canonical url'), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('redirectUrl', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('redirect url', 255), $dom);
            return $errorInfo;
        }
        if ($this->entity['redirectUrl'] != '' && !$this->isValidUrl('redirectUrl')) {
            $errorInfo['message'] = __f('Error! Field value must be a valid url (%s).', array('redirect url'), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('facebookTitle', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('facebook title', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('facebookDescription', 2000)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('facebook description', 2000), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('facebookImage', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('facebook image', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('twitterTitle', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('twitter title', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('twitterDescription', 2000)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('twitter description', 2000), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('twitterImage', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('twitter image', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('googlePlusTitle', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('google plus title', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('googlePlusDescription', 2000)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('google plus description', 2000), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('googlePlusImage', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('google plus image', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('whatsAppTitle', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('whats app title', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isValidInteger('pageAnalysisScore')) {
            $errorInfo['message'] = __f('Error! Field value may only contain digits (%s).', array('page analysis score'), $dom);
            return $errorInfo;
        }
        if (!$this->isNumberNotLongerThan('pageAnalysisScore', 11)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('page analysis score', 11), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('theModule', 50)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('the module', 50), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotEmpty('theModule')) {
            $errorInfo['message'] = __f('Error! Field value must not be empty (%s).', array('the module'), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('functionOfModule', 50)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('function of module', 50), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotEmpty('functionOfModule')) {
            $errorInfo['message'] = __f('Error! Field value must not be empty (%s).', array('function of module'), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('objectOfModule', 50)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('object of module', 50), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('nameOfIdentifier', 20)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('name of identifier', 20), $dom);
            return $errorInfo;
        }
        if (!$this->isValidInteger('idOfObject')) {
            $errorInfo['message'] = __f('Error! Field value may only contain digits (%s).', array('id of object'), $dom);
            return $errorInfo;
        }
        if (!$this->isNumberNotLongerThan('idOfObject', 11)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('id of object', 11), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('stringOfObject', 50)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('string of object', 50), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('extraInfos', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('extra infos', 255), $dom);
            return $errorInfo;
        }
    
        return true;
    }
    
    /**
     * Check for unique values.
     *
     * This method determines if there already exist metatags with the same metatag.
     *
     * @param string $fieldName The name of the property to be checked
     * @return boolean result of this check, true if the given metatag does not already exist
     */
    public function isUniqueValue($fieldName)
    {
        if ($this->entity[$fieldName] === '') {
            return false;
        }
    
        $entityClass = 'MUSeo_Entity_Metatag';
        $serviceManager = ServiceUtil::getManager();
        $entityManager = $serviceManager->getService('doctrine.entitymanager');
        $repository = $entityManager->getRepository($entityClass);
    
        $excludeid = $this->entity['id'];
    
        return $repository->detectUniqueState($fieldName, $this->entity[$fieldName], $excludeid);
    }
    
    /**
     * Get entity.
     *
     * @return Zikula_EntityAccess
     */
    public function getEntity()
    {
        return $this->entity;
    }
    
    /**
     * Set entity.
     *
     * @param Zikula_EntityAccess $entity.
     *
     * @return void
     */
    public function setEntity(Zikula_EntityAccess $entity = null)
    {
        $this->entity = $entity;
    }
    
}
