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
 * This is the HandleModules api helper class.
 */
class MUSeo_Api_HandleModules extends MUSeo_Api_Base_HandleModules
{
    /**
     * Returns the supported modules set in the configuration.
     *
     * @return array $modules
     */
    public static function checkModules()
    {
        $modules = ModUtil::getVar('MUSeo', 'modules');
        $modules = explode(',', $modules);

        return $modules;
    }

    /**
     * This method is for setting metatags.
     *
     * @param string $modname
     * @param string $modfunc default main
     */
    public static function setModuleMetaTags($modname, $modfunc = 'main')
    {
        $request = new Zikula_Request_Http();

        $extensionRepository = MUSeo_Util_Model::getExtensionRepository();
        $where2 = 'tbl.name = \'' . DataUtil::formatForStore($modname) . '\'';
        $extensionInfo = $extensionRepository->selectWhere($where2);

        if (count($extensionInfo) < 1) {
            return;
        }

        $metatagRepository = MUSeo_Util_Model::getMetatagRepository();

        $filters = self::determineRequestConditions($request, $modname, $modfunc, $extensionInfo[0]);
        $where = implode(' AND ', $filters);
die('A S '.$where);
return;
        // we get the entity
        $entities = $metatagRepository->selectWhere($where);
        if (count($entities) < 1) {
            return;
        }


        $entity = $entities[0];
die('A');
        if (!empty($entity['redirectUrl'])) {
            System::redirect($entity['redirectUrl'], '', 301);
            return;
        }

        if (!empty($entity['title'])) {
            PageUtil::setVar('title', $entity['title']);
        }
        if (!empty($entity['description'])) {
            PageUtil::setVar('description', $entity['description']);
        }
        if (!empty($entity['keywords'])) {
            PageUtil::setVar('keywords', $entity['keywords']);
        }

        $metaTags = array();

        if (!empty($entity['robotsIndex']) || !empty($entity['robotsFollow']) || !empty($entity['robotsAdvanced'])) {
            $robotsString = self::determineRobotsString($entity);
            if (!empty($robotsString)) {
                $metaTags[] = '<meta name="robots" content="' . $robotsString . '" />';
            }
        }

        $modVars = ModUtil::getVar('MUSeo');

        $forceTransport = $modVars['forceTransport'];
        $canonical = '';
        if (!empty($entity['canonicalUrl']) || $forceTransport != 'default') {
            if (empty($entity['canonicalUrl'])) {
                $canonical = $entity['canonicalUrl'];
            } elseif ($forceTransport != 'default') {
                $canonical = System::getCurrentUrl();
            }

            if (!empty($canonical) && $forceTransport != System::serverGetProtocol()) {
                if ($forceTransport != System::serverGetProtocol()) {
                    $canonical = preg_replace( '`^http[s]?`', $forceTransport, $canonical);
                }
                $metaTags[] = '<link rel="canonical" href="' . $canonical . '" />';
            }
        }

        if ($modVars['facebookEnabled']) {
            if ($modVars['facebookAdminApp'] != '') {
                $metaTags[] = '<meta property="fb:app_id" content="'. $modVars['facebookAdminApp'] .'">';
            } elseif ($modVars['facebookAdmins'] != '') {
                $metaTags[] = '<meta property="fb:admins" content="'. $modVars['facebookAdmins'] .'">';
            }
            if ($modVars['facebookSite'] != '') {
                $metaTags[] = '<meta property="article:publisher" content="'. $modVars['facebookSite'] .'">';
            }
            $metaTags[] = '<meta property="og:title" content="'. (($entity['facebookTitle'] != '') ? $entity['facebookTitle'] : PageUtil::getVar('title')) .'">';
            $metaTags[] = '<meta property="og:description" content="'. (($entity['facebookDescription'] != '') ? $entity['facebookDescription'] : PageUtil::getVar('description')) .'">';
            $metaTags[] = '<meta property="og:image" content="' . (($entity['facebookImage'] != '') ? $entity['facebookImage'] : $modVars['openGraphDefaultImage']) . '">';
            $metaTags[] = '<meta property="og:url" content="' . (($canonical) ? $canonical : System::getCurrentUrl()) . '">';
            $metaTags[] = '<meta property="og:site_name" content="' . System::getVar('sitename') . '">';
            $metaTags[] = '<meta property="article:modified_time" content="' . $entity['updatedDate'] . '">';
            $metaTags[] = '<meta property="og_updated_time" content="' . $entity['updatedDate'] . '">';
            $metaTags[] = '<meta property="og:type" content="website">';
            $metaTags[] = '<meta property="og:locale" content="' . ZLanguage::getLocale() . '">';
        }

        if ($modVars['googlePlusEnabled']) {
            $metaTags[] = '<meta itemprop="name" content="'. (($entity['googlePlusTitle'] != '') ? $entity['googlePlusTitle'] : PageUtil::getVar('title')) .'">';
            $metaTags[] = '<meta itemprop="description" content="'. (($entity['googlePlusDescription'] != '') ? $entity['googlePlusDescription'] : PageUtil::getVar('description')) .'">';
            if ($entity['googlePlusImage'] != '') {
                $metaTags[] = '<meta itemprop="image" content="' . $entity['googlePlusImageFullPathUrl'] . '">';
            }
            if ($modVars['googlePlusPublisherPage'] != '') {
                $metaTags[] = '<link href="' . $modVars['googlePlusPublisherPage'] . '" rel="publisher" />';
            }
        }
        if ($modVars['twitterEnabled']) {
            $metaTags[] = '<meta property="og:title" content="'. (($entity['twitterTitle'] != '') ? $entity['twitterTitle'] : PageUtil::getVar('title')) .'">';
            $metaTags[] = '<meta property="og:description" content="'. (($entity['twitterDescription'] != '') ? $entity['twitterDescription'] : PageUtil::getVar('description')) .'">';
            if (!empty($entity['twitterImage'])) {
                $metaTags[] = '<meta property="og:image" content="' . $entity['twitterImageFullPathUrl'] . '">';
            }
            $metaTags[] = '<meta name="twitter:site" content="' . $modVars['twitterSiteUser'] . '">';
            $metaTags[] = '<meta property="og:url" content="' . (($canonical) ? $canonical : System::getCurrentUrl()) . '">';
            $metaTags[] = '<meta name="twitter:card" content="' . $modVars['twitterDefaultCardType'] . '">';
        }

        if (count($metaTags) > 0) {
            PageUtil::addVar('header', implode("\n", $metaTags));
        }
    }

    private static function determineRequestConditions($request, $modname, $modfunc, $extensionInfo)
    {
        $filters = array();

        $filters[] = 'tbl.theModule = \'' . DataUtil::formatForStore($modname) . '\'';
        $filters[] = 'tbl.functionOfModule = \'' . DataUtil::formatForStore($modfunc) . '\'';

        if ($modfunc == $extensionInfo['controllerForView']) {
            $objectType = $request->query->filter($extensionInfo['parameterForObjects'], '', FILTER_SANITIZE_STRING);
            if ($objectType != '') {
                $filters[] = 'tbl.objectOfModule = \'' . DataUtil::formatForStore($objectType) . '\'';
            }

            $objectId = $request->query->filter($extensionInfo['nameOfIdentifier'], 0, FILTER_VALIDATE_INT);
            $filters[] = 'tbl.idOfObject = \'' . DataUtil::formatForStore($objectId) . '\'';

            /*$objectString = $request->query->filter($extensionInfo['nameOfIdentifier'], '', FILTER_SANITIZE_STRING);
            $filters[] = 'tbl.stringOfObject = \'' . DataUtil::formatForStore($objectString) . '\'';*/
        }

        if ($modfunc == $extensionInfo['controllerForSingleObject'] && $extensionInfo['controllerForView'] != $extensionInfo['controllerForSingleObject']) {
            $objectType = $request->query->filter($extensionInfo['parameterForObjects'], '', FILTER_SANITIZE_STRING);
            if ($objectType != '') {
                $filters[] = 'tbl.objectOfModule = \'' . DataUtil::formatForStore($objectType) . '\'';
            }

            if ($modname != 'PostCalendar') {
                $objectId = $request->query->filter($extensionInfo['nameOfIdentifier'], 0, FILTER_VALIDATE_INT);
                if ($objectId > 0) {
                    $filters[] = 'tbl.idOfObject = \'' . DataUtil::formatForStore($objectId) . '\'';
                }
                /*$objectString = $request->query->filter($extensionInfo['nameOfIdentifier'], '', FILTER_SANITIZE_STRING);
                if ($objectString != '') {
                    $filters[] = 'tbl.stringOfObject = \'' . DataUtil::formatForStore($objectString) . '\'';
                }*/
            }
        }
        if ($extensionInfo['extraIdentifier'] != '') {
            $identifiers = explode(',', $extensionInfo['extraIdentifier']);

            foreach ($identifiers as $identifier) {
                $result = $request->query->filter($identifier, '');
                if ($result != '') {
                    $filters[] = 'tbl.extraInfos LIKE \'%' . $identifier . '=' . $result . '%\'';
                } else {
                    $filters[] = 'tbl.extraInfos NOT LIKE \'%' . $identifier . '%\'';
                }
            }
        }

        return $filters;
    }

    private static function determineRobotsString($entity)
    {
        $robotsString = '';
        $robots           = array();
        $robots['index']  = ModUtil::getVar('MUSeo', 'robotsIndex');
        $robots['follow'] = ModUtil::getVar('MUSeo', 'robotsFollow');
        $robots['other']  = array();

        if (ModUtil::getVar('MUSeo', 'noodp') == true) {
            $robots['other'][] = 'noodp';
        }
        if (ModUtil::getVar('MUSeo', 'noydir') == true) {
            $robots['other'][] = 'noydir';
        }
        if ($entity['robotsIndex'] != '') {
            $robots['index'] = $entity['robotsIndex'];
        }
        if ($entity['robotsFollow'] != '') {
            $robots['follow'] = $entity['robotsFollow'];
        }
        if (!empty($entity['robotsAdvanced'])){
            $listHelper = new MUSeo_Util_ListEntries(ServiceUtil::getManager());
            foreach ($listHelper->extractMultiList($entity['robotsAdvanced']) as $robotsAdvancedItem) {
                if ($robotsAdvancedItem == true) {
                    $robots['other'][] = $robotsAdvancedItem;
                }
            }
        }
        if ($robots['index'] != 'index') {
            if (!empty($robotsString)){
                $robotsString .= ', ';
            }
            $robotsString .= $robots['index'];
        }
        if ($robots['follow'] != 'follow') {
            if (!empty($robotsString)) {
                $robotsString .= ', ';
            }
            $robotsString .= $robots['follow'];
        }
        if (!empty($robots['other'])) {
            if (!empty($robotsString)) {
                $robotsString .= ', ';
            }
            $robotsString .= implode(',', array_unique($robots['other']));
        }

        return $robotsString;
    }
}
