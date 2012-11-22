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
 * @version Generated by ModuleStudio 0.5.4 (http://modulestudio.de) at Tue Nov 20 20:20:03 CET 2012.
 */

/**
 * The museoColourInput plugin handles fields carrying a html colour code.
 * It provides a colour picker for convenient editing.
 *
 * @param  array            $params  All attributes passed to this function from the template.
 * @param  Zikula_Form_View $view    Reference to the view object.
 *
 * @return string The output of the plugin.
 */
function smarty_function_museoColourInput($params, $view)
{
    return $view->registerPlugin('MUSeo_Form_Plugin_ColourInput', $params);
}