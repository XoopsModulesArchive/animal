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

//check for access
$xoopsModule =& XoopsModule::getByDirname("animal");	
if (empty($xoopsUser)) 
{
	redirect_header("javascript:history.go(-1)", 3, _NOPERM."<br />"._PED_REGIST);
	exit();
}


global $xoopsTpl, $xoopsDB, $xoopsUser;

$ownid = $_POST['dogid'];
$ownername = $_POST['curname'];

if (!empty($ownername)) 
{
	$queryString = "SELECT * from ".$xoopsDB->prefix("eigenaar")." WHERE ID=".$ownid;
	$result = $xoopsDB->query($queryString);
	while ($row = $xoopsDB->fetchArray($result)) 
	{
		//check for edit rights
		$access = 0;
		$xoopsModule =& XoopsModule::getByDirname("animal");
		if (!empty($xoopsUser))
		{
			if ($xoopsUser->isAdmin($xoopsModule->mid()))
			{ 
				$access = 1; 
			}
			if ($row['user'] == $xoopsUser->getVar("uid"))
			{
				$access = 1;	
			}
		}
		if ($access == "1")
		{ 
			$delsql = "DELETE FROM ".$xoopsDB->prefix("eigenaar")." WHERE ID =".$row['ID'];
			mysql_query($delsql);
			$sql = "UPDATE ".$xoopsDB->prefix("stamboom")." SET id_eigenaar = '0' where id_eigenaar = ".$row['ID'];
			mysql_query($sql);
			$sql = "UPDATE ".$xoopsDB->prefix("stamboom")." SET id_fokker = '0' where id_fokker = ".$row['ID'];
			mysql_query($sql);
			$ch = 1;
		}
	}
}

if ($ch)
{
	redirect_header("index.php",1,_MD_DATACHANGED);
}
else
{
	redirect_header("owner.php?ownid=".$ownid,1,"ERROR!!");
}
//footer
include XOOPS_ROOT_PATH."/footer.php";

?>