<?php
// ------------------------------------------------------------------------- 

require_once "../../mainfile.php";
if ( file_exists(XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php") ) 
    require_once XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php";
else 
	include_once XOOPS_ROOT_PATH ."/modules/animal/language/english/templates.php";
// Include any common code for this module.
require_once(XOOPS_ROOT_PATH ."/modules/animal/include/functions.php");

$xoopsOption['template_main'] = "pedigree_welcome.html";
include XOOPS_ROOT_PATH.'/header.php';

global $xoopsTpl, $xoopsDB, $myts;

$myts = MyTextSanitizer::getInstance(); // MyTextSanitizer object

//query to count dogs
$result=$xoopsDB->query("select count(*) from ".$xoopsDB->prefix("stamboom"));
list($numdogs) = $xoopsDB->fetchRow($result);

//get module configuration
$module_handler =& xoops_gethandler('module');
$module         =& $module_handler->getByDirname('animal');
$config_handler =& xoops_gethandler('config');
$moduleConfig   =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));

$word = $myts->displayTarea(strtr($moduleConfig['welcome'], array( '[numanimals]' => $numdogs, '[animalType]' => $moduleConfig['animalType'], '[animalTypes]' => $moduleConfig['animalTypes'] )));

$xoopsTpl->assign("welcome", _PED_WELCOME);
$xoopsTpl->assign("word", $word);
//comments and footer
include XOOPS_ROOT_PATH."/footer.php";

?>