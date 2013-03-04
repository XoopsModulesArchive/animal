<?php
// ------------------------------------------------------------------------- 

require_once "../../mainfile.php";
if ( file_exists(XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php") ) 
    require_once XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php";
else 
	include_once XOOPS_ROOT_PATH ."/modules/animal/language/english/templates.php";
// Include any common code for this module.	
require_once(XOOPS_ROOT_PATH ."/modules/animal/include/functions.php");
require_once(XOOPS_ROOT_PATH ."/modules/animal/include/class_field.php");

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

$dogid = $_POST['dogid'];
$dogname = $_POST['curname'];

if (!empty($dogname)) 
{
	$queryString = "SELECT * from ".$xoopsDB->prefix("mod_pedigree_tree")." WHERE ID=".$dogid;
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
			$sql = "INSERT INTO ".$xoopsDB->prefix("mod_pedigree_trash")." SELECT * FROM ".$xoopsDB->prefix("mod_pedigree_tree")." WHERE ".$xoopsDB->prefix("mod_pedigree_tree").".ID='".$dogid."'";
			mysql_query($sql);
			$delsql = "DELETE FROM ".$xoopsDB->prefix("mod_pedigree_tree")." WHERE ID ='".$row['ID']."'";
			mysql_query($delsql);
			if($row['roft'] == "0")
			{
				$sql = "UPDATE ".$xoopsDB->prefix("mod_pedigree_tree")." SET vader = '0' where vader = '".$row['ID']."'";
			}
			else
			{
				$sql = "UPDATE ".$xoopsDB->prefix("mod_pedigree_tree")." SET moeder = '0' where moeder = '".$row['ID']."'";
			}
			mysql_query($sql);
			$ch = 1;
		}
	}
}

if ($ch)
{
	redirect_header("index.php",2,_MD_DATACHANGED);
}
else
{
	redirect_header("dog.php?id=".$dogid,1,"ERROR!!");
}
//footer
include XOOPS_ROOT_PATH."/footer.php";

?>