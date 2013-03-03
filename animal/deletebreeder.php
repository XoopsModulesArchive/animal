<?php
// ------------------------------------------------------------------------- 

require_once "../../mainfile.php";
if ( file_exists(XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php") ) 
    require_once XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php";
else 
	include_once XOOPS_ROOT_PATH ."/modules/animal/language/english/templates.php";
// Include any common code for this module.
require_once(XOOPS_ROOT_PATH ."/modules/animal/include/functions.php");

$xoopsOption['template_main'] = "pedigree_delete.html";

include XOOPS_ROOT_PATH.'/header.php';

//get module configuration
$module_handler =& xoops_gethandler('module');
$module         =& $module_handler->getByDirname('animal');
$config_handler =& xoops_gethandler('config');
$moduleConfig   =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));


//check for access
$xoopsModule =& XoopsModule::getByDirname("animal");	
if (empty($xoopsUser)) 
{
	redirect_header("javascript:history.go(-1)", 3, _NOPERM."<br />"._PED_REGIST);
	exit();
}

global $xoopsTpl;
global $xoopsDB;
global $xoopsModuleConfig;

$id= $_GET['id'];
//query (find values for this dog (and format them))
$queryString = "SELECT lastname, firstname, user from ".$xoopsDB->prefix("eigenaar")." WHERE ID=".$id;
$result = $xoopsDB->query($queryString);

while ($row = $xoopsDB->fetchArray($result)) 
{
	//ID
	$id = $row['ID'];
	//name
	$naam = htmlentities(stripslashes($row['lastname']).", ".stripslashes($row['firstname']), ENT_QUOTES);
	$namelink = "<a href=\"owner.php?ownid=".$row['ID']."\">".stripslashes($row['lastname']).", ".stripslashes($row['firstname'])."</a>";
	//user who entered the info
	$dbuser = $row['user'];
}

//create form
include XOOPS_ROOT_PATH."/class/xoopsformloader.php";
$form = new XoopsThemeForm($naam, 'deletedata', 'deletebreederpage.php', 'POST');
//hidden value current record owner
$form->addElement(new XoopsFormHidden('dbuser', $dbuser));
//hidden value dog ID
$form->addElement(new XoopsFormHidden('dogid', $_GET['id']));
$form->addElement(new XoopsFormHidden('curname', $naam));
$form->addElement(new XoopsFormHiddenToken($name = 'XOOPS_TOKEN_REQUEST', $timeout = 360));
$form->addElement(new XoopsFormLabel(_PED_DELE_SURE, _PED_DELE_CONF_OWN."<b>".$naam."</b> ?"));
$breeder = breederof($_GET['id'],1);
if ($breeder != "")
{
	$form->addElement(new XoopsFormLabel(_PED_DELE_WARN, strtr(_PED_DELE_WARN_BREEDER, array( '[animalTypes]' => $moduleConfig['animalTypes'] ))."<br /><br />".$breeder));
}
$owner = breederof($_GET['id'],0);
if ($owner != "")
{
	$form->addElement(new XoopsFormLabel(_PED_DELE_WARN, strtr(_PED_DELE_WARN_OWNER, array( '[animalTypes]' => $moduleConfig['animalTypes'] ))."<br /><br />".$owner));
}
$form->addElement(new XoopsFormButton('', 'button_id', _PED_BTN_DELE, 'submit'));
//add data (form) to smarty template
$xoopsTpl->assign("form", $form->render());

//footer
include XOOPS_ROOT_PATH."/footer.php";

?>