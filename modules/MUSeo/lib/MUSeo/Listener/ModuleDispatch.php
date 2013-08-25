<?php
/**
 * MUSeo.
 *
 * @copyright Michael ueberschaer
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @package MUSeo
 * @author Michael ueberschaer <konakt@webdesign-in-bremen.com>.
 * @link http://webdesign-in-bremen.com
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.5.4 (http://modulestudio.de) at Sun Nov 18 10:40:42 CET 2012.
 */

/**
 * Event handler implementation class for dispatching modules.
 */
class MUSeo_Listener_ModuleDispatch
{
    /**
     * Listener for the `module_dispatch.postloadgeneric` event.
     *
     * Called after a module api or controller has been loaded.
     * Receives the args `array('modinfo' => $modinfo, 'type' => $type, 'force' => $force, 'api' => $api)`.
     */
    public static function postLoadGeneric(Zikula_Event $event)
    {
    }

    /**
     * Listener for the `module_dispatch.preexecute` event.
     *
     * Occurs in `ModUtil::exec()` after function call with the following args:
     * `array('modname' => $modname, 'modfunc' => $modfunc, 'args' => $args, 'modinfo' => $modinfo, 'type' => $type, 'api' => $api)`.
     */
    public static function preExecute(Zikula_Event $event)
    {

    }

    /**
     * Listener for the `module_dispatch.postexecute` event.
     *
     * Occurs in `ModUtil::exec()` after function call with the following args:
     * `array('modname' => $modname, 'modfunc' => $modfunc, 'args' => $args, 'modinfo' => $modinfo, 'type' => $type, 'api' => $api)`.
     * Receives the modules output with `$event->getData();`.
     * Can modify this output with `$event->setData($data);`.
     */
    public static function postExecute(Zikula_Event $event)
    {
        // we get the module args for the event
        $modargs = $event->getArgs();
        	
        if ($modargs['modname'] != 'Blocks' && $modargs['modname'] != 'Admin') {

            // we look if a module is active for MUSeo
            $modules = MUSeo_Api_HandleModules::checkModules();

            // if we found a module we can do more
            if (is_array($modules) && count($modules) > 0) {
                	
                // we get the allowed controllers
                $controllers = ModUtil::getVar('MUSeo', 'controllers');
                $controllers = explode(',', $controllers);
                if (in_array($modargs['modfunc'][1], $controllers)) {
                    //LogUtil::registerStatus($modargs['modfunc'][1]);

                    if ($modargs['type'] == 'admin') {
                        // admin call nothing to do
                    }
                    else {
                        //LogUtil::registerStatus('User');
                        // we look for not api functions
                        if ($modargs['api'] != 1) {
                            //LogUtil::registerStatus('keine Api');

                            // we look if there is an entry for the module with the relevant name and func
                            $metatagrepository = MUSeo_Util_Model::getMetatagRepository();
                            $where = 'tbl.theModule = \'' . DataUtil::formatForStore($modargs['modname']) . '\'';
                            $where .= ' AND ';
                            $where .= 'tbl.functionOfModule = \'' . DataUtil::formatForStore($modargs['modfunc'][1]) . '\'';
                            $count = $metatagrepository->selectCount($where);

                            if ($count >= 1) {
                                // we call the method to set the metatags if there is an entry
                                MUSeo_Api_Handlemodules::setModuleMetaTags($modargs['modname'], $modargs['modfunc'][1]);
                            }
                        }
                        // api function - nothing to do
                        else {
                            //LogUtil::registerStatus('Api');
                        }
                    }
                }
                //not allowed controller - nothing to do
                else {

                }
            }
            // no active modules, nothing to do
            else {
                	
            }
        }
        // calling module blocks nothing to
        else {

        }

    }

    /**
     * Listener for the `module_dispatch.custom_classname` event.
     *
     * In order to override the classname calculated in `ModUtil::exec()`.
     * In order to override a pre-existing controller/api method, use this event type to override the class name that is loaded.
     * This allows to override the methods using inheritance.
     * Receives no subject, args of `array('modname' => $modname, 'modinfo' => $modinfo, 'type' => $type, 'api' => $api)`
     * and 'event data' of `$className`. This can be altered by setting `$event->setData()` followed by `$event->stop()`.
     */
    public static function customClassname(Zikula_Event $event)
    {
    }
}
