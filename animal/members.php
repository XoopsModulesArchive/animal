<?php
// ------------------------------------------------------------------------- 

require_once "../../mainfile.php";
if ( file_exists(XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php") ) 
    require_once XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php";
else 
	include_once XOOPS_ROOT_PATH ."/modules/animal/language/english/templates.php";
// Include any common code for this module.

// Get all HTTP post or get parameters into global variables that are prefixed with "param_"
import_request_variables("gp", "param_");

$xoopsOption['template_main'] = "pedigree_members.html";

include XOOPS_ROOT_PATH.'/header.php';

global $xoopsTpl, $xoopsDB;

$queryString = "SELECT count(d.user) as X, d.user as d_user, u.uname as u_uname FROM ".$xoopsDB->prefix("stamboom")." d LEFT JOIN ".$xoopsDB->prefix("users")." u ON d.user = u.uid GROUP  BY user	ORDER BY X desc limit 50";
$result = $xoopsDB->query($queryString);
$numpos = 1;
while ($row = $xoopsDB->fetchArray($result)) 
{
	$content = "";
	$star = $row['X'];
	if ($star > 10000)
	{
		$sterretje = floor($star/10000);
		for($c =0; $c<$sterretje; $c++)
			{
				$content .= "<img src=\"images/star.png\" border=\"0\">";
				$star = $star - 10000;
			}
						
	}
	if ($star > 1000)
	{
		$sterretje = floor($star/1000);
		for($c =0; $c<$sterretje; $c++)
		{
			$content .= "<img src=\"images/star3.gif\" border=\"0\">";
			$star = $star -1000;
		}
						
	}
	if ($star > 100)
	{
		$sterretje = floor($star/100);
		for($c =0; $c<$sterretje; $c++)
		{
			$content .= "<img src=\"images/star2.gif\" border=\"0\">";
		}
	}

	$members[] = array ( 'position' => $numpos, 'user' => "<a href=\"../../userinfo.php?uid=".$row['d_user']."\">".$row['u_uname']."</a>", 'stars' => $content, 'nument' => "<a href=\"result.php?f=user&l=0&w=".$row['d_user']."&o=NAAM\">".$row['X']."</a>" );
	$numpos = $numpos + 1;
}	
$xoopsTpl->assign("members", $members);
$xoopsTpl->assign("title", _PED_M50_TIT);
$xoopsTpl->assign("position", _PED_M50_POS);
$xoopsTpl->assign("numdogs", _PED_M50_NUMD);
//comments and footer
include XOOPS_ROOT_PATH."/footer.php";

?>