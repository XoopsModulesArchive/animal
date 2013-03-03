<?php
// ------------------------------------------------------------------------- 

require_once "../../mainfile.php";
if ( file_exists(XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php") ) 
    require_once XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php";
else 
	include_once XOOPS_ROOT_PATH ."/modules/animal/language/english/templates.php";



include XOOPS_ROOT_PATH.'/header.php';
// Include any common code for this module.
require_once(XOOPS_ROOT_PATH ."/modules/animal/include/functions.php");

global $xoopsTpl, $xoopsDB;

//get module configuration
$module_handler =& xoops_gethandler('module');
$module         =& $module_handler->getByDirname('animal');
$config_handler =& xoops_gethandler('config');
$moduleConfig   =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));


echo "<form method=\"post\" action=\"convert.php\">convert:<input type=\"text\" name=\"van\">";
echo "to:<input type=\"text\" name=\"naar\">";
echo "<input type=\"submit\"></form>";

if ($_POST['naar'] != "")
{
	$query = "update ".$xoopsDB->prefix("stamboom")." set user4 = '".$_POST['naar']."' where user4 = '".$_POST['van']."'";	
	echo $query."<br />";
	mysql_query($query);
}


$result=$xoopsDB->query("select user4, count('user4') as X from ".$xoopsDB->prefix("stamboom")." group by 'user4'");
$count = 0; $total = 0;
while ($row = $xoopsDB->fetchArray($result)) 
{
	$count++;
	echo $row['user4']." - ".$row['X']."<br>";
	$total = $total + $row['X'];
}
echo "<hr>".$count."-".$total;







//comments and footer
include XOOPS_ROOT_PATH."/footer.php";

?>