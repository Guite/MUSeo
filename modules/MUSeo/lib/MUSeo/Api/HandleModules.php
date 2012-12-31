<?php
/**
 * MUSeo.
 *
 * @copyright Michael Ueberschaer
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @package MUSeo
 * @author Michael ueberschaer <konakt@webdesign-in-bremen.com>.
 * @link http://webdesign-in-bremen.com
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.5.4 (http://modulestudio.de) at Tue Nov 20 20:20:03 CET 2012.
 */

/**
 * This is the HandleModules api helper class.
 */
class MUSeo_Api_HandleModules extends MUSeo_Api_Base_HandleModules
{
	/**
	 *
	 * Enter description here ...
	 */
	public static function checkModules()
	{
		$modules = ModUtil::getVar('MUSeo', 'modules');
		$modules = explode(',', $modules);
			
		return $modules;
	}

	/**
	 *
	 */
	public static function setModuleMetaTags($modname, $modfunc = 'main')
	{
		$metatagrepository = MUSeo_Util_Model::getMetatagRepository();
		$where = 'tbl.theModule = \'' . DataUtil::formatForStore($modname) . '\'';
		$where .= ' AND ';
		$where .= 'tbl.functionOfModule = \'' . DataUtil::formatForStore($modfunc) . '\'';

		$modulerepository = MUSeo_Util_Model::getModuleRepository();
		$where2 = 'tbl.name = \'' . DataUtil::formatForStore($modname) . '\'';
		$moduleinfo = $modulerepository->selectWhere($where2);

		if ($moduleinfo[0]['controllerForView'] == $modfunc) {
			$request = new Zikula_Request_Http();
			$objectType = $request->getGet()->filter($moduleinfo[0]['parameterForObjects'], '', FILTER_SANITIZE_STRING);
			if ($objectType != '') {
					
				$where .= ' AND ';
				$where .= 'tbl.objectOfModule = \'' . DataUtil::formatForStore($objectType) . '\'';
			}
				
			$objectId = $request->getGet()->filter($moduleinfo[0]['nameOfIdentifier'], 0, FILTER_SANITIZE_STRING);

				$where .= ' AND ';
				$where .= 'tbl.idOfObject = \'' . DataUtil::formatForStore($objectId) . '\'';
		
			$objectString = $request->getGet()->filter($moduleinfo[0]['nameOfIdentifier'], '', FILTER_SANITIZE_STRING);

				$where .= ' AND ';
				$where .= 'tbl.stringOfObject = \'' . DataUtil::formatForStore($objectString) . '\'';
		
		}

		if ($moduleinfo[0]['controllerForSingleObject'] == $modfunc && $moduleinfo[0]['controllerForView'] != $moduleinfo[0]['controllerForSingleObject']) {
			$request = new Zikula_Request_Http();
			$objectType = $request->getGet()->filter($moduleinfo[0]['parameterForObjects'], '', FILTER_SANITIZE_STRING);
			if ($objectType != '') {
					
				$where .= ' AND ';
				$where .= 'tbl.objectOfModule = \'' . DataUtil::formatForStore($objectType) . '\'';
			}

			if ($modname != 'PostCalendar') {
				$objectId = $request->getGet()->filter($moduleinfo[0]['nameOfIdentifier'], 0, FILTER_SANITIZE_STRING);
				if ($objectId > 0) {
					$where .= ' AND ';
					$where .= 'tbl.idOfObject = \'' . DataUtil::formatForStore($objectId) . '\'';
				}
				$objectString = $request->getGet()->filter($moduleinfo[0]['nameOfIdentifier'], '', FILTER_SANITIZE_STRING);
				if ($objectString != '') {
					$where .= ' OR ';
					$where .= 'tbl.stringOfObject = \'' . DataUtil::formatForStore($objectString) . '\'';
				}
			}
		}



		$entities = $metatagrepository->selectWhere($where);
			
		if (count($entities) == 1) {
			if ($entities[0]['title']) {
				PageUtil::setVar('title', $entities[0]['title']);
			}
			if ($entities[0]['description']) {
				PageUtil::setVar('description', $entities[0]['description']);
			}
			if ($entities[0]['keywords']) {
				PageUtil::setVar('title', $entities[0]['keywords']);
			}

		}
			
			
	}
}
