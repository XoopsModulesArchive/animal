<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //
// Author: Tobias Liegl (AKA CHAPI)                                          //
// Site: http://www.chapi.de                                                 //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //
require_once(XOOPS_ROOT_PATH ."/modules/animal/include/class_field.php");

//get module configuration
$module_handler =& xoops_gethandler('module');
$module         =& $module_handler->getByDirname('animal');
$config_handler =& xoops_gethandler('config');
$moduleConfig   =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));

function sorttable( $columncount )
{
	$ttemp = "";
	if ($columncount >1)
	{
		for ($t = 1; $t<$columncount; $t++)
		{
			$ttemp .= "'S',";	
		}
		$tsarray = "initSortTable('Result',Array(".$ttemp."'S'));";
	}
	else
	{
		$tsarray = "initSortTable('Result',Array('S'));";
	}
	return $tsarray;
}

function uploadedpict( $num )
{
	$max_imgsize = 1024000;
	$max_imgwidth = 1500;
	$max_imgheight = 1000;
	$allowed_mimetypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png');
	$img_dir = XOOPS_ROOT_PATH . "/modules/animal/images" ;
	include_once(XOOPS_ROOT_PATH."/class/uploader.php");
	$field = $_POST["xoops_upload_file"][$num];
	if( !empty( $field ) || $field != "" ) 
	{
		$uploader = new XoopsMediaUploader($img_dir, $allowed_mimetypes, $max_imgsize, $max_imgwidth, $max_imgheight);
		$uploader->setPrefix( 'img' ) ;
		if( $uploader->fetchMedia( $field ) && $uploader->upload() ) 
		{
			$photo=$uploader->getSavedFileName();
		} 
		else 
		{
			echo $uploader->getErrors();
		}
		makethumbs($photo);
		return $photo;
	}
}

function makethumbs ($filename)
{
	require_once('phpthumb/phpthumb.class.php');	
	$thumbnail_widths = array(150, 400);
	foreach ($thumbnail_widths as $thumbnail_width) 
	{
		$phpThumb = new phpThumb();
		// set data
		$phpThumb->setSourceFilename('images/'.$filename);
		$phpThumb->w = $thumbnail_width;
		$phpThumb->config_output_format    = 'jpeg';
		// generate & output thumbnail
		$output_filename = 'images/thumbnails/'.basename($filename).'_'.$thumbnail_width.'.'.$phpThumb->config_output_format;
		if ($phpThumb->GenerateThumbnail()) // this line is VERY important, do not remove it!
		{ 
			if ($output_filename) 
			{
				if ($phpThumb->RenderToFile($output_filename)) 
				{
					// do something on success
					//echo 'Successfully rendered:<br><img src="'.$output_filename.'">';
				} 
				else 
				{
					echo 'Failed (size='.$thumbnail_width.'):<pre>'.implode("\n\n", $phpThumb->debugmessages).'</pre>';
				}
			} 
		} 
		else 
		{
			echo 'Failed (size='.$thumbnail_width.'):<pre>'.implode("\n\n", $phpThumb->debugmessages).'</pre>';
		}
		unset($phpThumb);
	}
	return true;
}

function unhtmlentities ($string) {
   $trans_tbl =get_html_translation_table (HTML_ENTITIES );
   $trans_tbl =array_flip ($trans_tbl );
   return strtr ($string ,$trans_tbl );
}

function pups($oid, $gender)
{
	global $xoopsDB, $numofcolumns, $nummatch, $pages, $columns, $dogs;
	$content = "";
	if ($gender == 0)
	{
		$sqlquery = "SELECT d.id as d_id, d.naam as d_naam, d.roft as d_roft, d.* FROM ".$xoopsDB->prefix("stamboom")." d LEFT JOIN ".$xoopsDB->prefix("stamboom")." f ON d.vader = f.id LEFT JOIN ".$xoopsDB->prefix("stamboom")." m ON d.moeder = m.id where d.vader=".$oid." order by d.naam";	
	}
	else
	{ 
		$sqlquery = "SELECT d.id as d_id, d.naam as d_naam, d.roft as d_roft, d.* FROM ".$xoopsDB->prefix("stamboom")." d LEFT JOIN ".$xoopsDB->prefix("stamboom")." f ON d.vader = f.id LEFT JOIN ".$xoopsDB->prefix("stamboom")." m ON d.moeder = m.id where d.moeder=".$oid." order by d.naam";
	}
	$queryresult = $xoopsDB->query($sqlquery);
	$nummatch = $xoopsDB->getRowsNum($queryresult);
	
	$animal = new Animal( );
	//test to find out how many user fields there are...
	$fields = $animal->numoffields();
	$numofcolumns = 1;
	$columns[] = array ('columnname' => "Name");
	for ($i = 0; $i < count($fields); $i++)
	{
		$userfield = new Field( $fields[$i], $animal->getconfig() );
		$fieldType = $userfield->getSetting( "FieldType" );
		$fieldobject = new $fieldType( $userfield, $animal );
		//create empty string
		$lookupvalues = "";
		if ($userfield->active() && $userfield->inlist())
		{
			if ($userfield->haslookup())
			{
				$lookupvalues = $userfield->lookup($fields[$i]);
				//debug information
				//print_r($lookupvalues);	
			}
			$columns[] = array ('columnname' => $fieldobject->fieldname, 'columnnumber' => $userfield->getID(), 'lookupval' => $lookupvalues);
			$numofcolumns++;
			unset($lookupvalues);
		}
	}

	while ($rowres = $xoopsDB->fetchArray($queryresult))
	{
		if ($rowres['d_roft'] == "0")
			$gender = "<img src=\"images/male.gif\">";
		else 
			$gender = "<img src=\"images/female.gif\">";
		$name = stripslashes($rowres['d_naam']);
		;
		//empty array
		unset($columnvalue);
		//fill array
		for ($i = 1; $i < ($numofcolumns); $i++)
		{
			$x = $columns[$i]['columnnumber'];
			if (is_array($columns[$i]['lookupval']))
			{
				foreach ($columns[$i]['lookupval'] as $key => $keyvalue)
				{
					if($keyvalue['id'] == $rowres['user'.$x])
					{
						$value = $keyvalue['value'];
					}	
				}	
				//debug information
				///echo $columns[$i]['columnname']."is an array !";
			}
			//format value - cant use object because of query count
			elseif (substr($rowres['user'.$x], 0, 7) == 'http://')
			{
				$value = "<a href=\"".$rowres['user'.$x]."\">".$rowres['user'.$x]."</a>";	
			}
			else { $value = $rowres['user'.$x]; }		
			$columnvalue[] = array ('value' => $value);	
		}
		$dogs[] = array ('id' => $rowres['d_id'], 'name' => $name, 'gender' => $gender, 'link' => "<a href=\"dog.php?id=".$rowres['d_id']."\">".$name."</a>",'colour' => "", 'number' => "", 'usercolumns' => $columnvalue);	
	}
	return null;
}

function bas($oid, $pa ,$ma)
{
	global $xoopsDB, $numofcolumns1, $nummatch1, $pages1, $columns1, $dogs1;
	if ($pa == "0" && $ma == "0")
	{
		$sqlquery = "SELECT * FROM ".$xoopsDB->prefix("stamboom")." where vader = ".$pa." and moeder = ".$ma." and ID != ".$oid." and vader != '0' and moeder !='0' order by NAAM";
	}
	else
	{
	$sqlquery = "SELECT * FROM ".$xoopsDB->prefix("stamboom")." where vader = ".$pa." and moeder = ".$ma." and ID != ".$oid." order by NAAM";
	}
	$queryresult = $xoopsDB->query($sqlquery);
	$nummatch1 = $xoopsDB->getRowsNum($queryresult);
	
	$animal = new Animal( );
	//test to find out how many user fields there are...
	$fields = $animal->numoffields();
	$numofcolumns1 = 1;
	$columns1[] = array ('columnname' => "Name");
	for ($i = 0; $i < count($fields); $i++)
	{
		$userfield = new Field( $fields[$i], $animal->getconfig() );
		$fieldType = $userfield->getSetting( "FieldType" );
		$fieldobject = new $fieldType( $userfield, $animal );
		//create empty string
		$lookupvalues = "";
		if ($userfield->active() && $userfield->inlist())
		{
			if ($userfield->haslookup())
			{
				$lookupvalues = $userfield->lookup($fields[$i]);
				//debug information
				//print_r($lookupvalues);	
			}
			$columns1[] = array ('columnname' => $fieldobject->fieldname, 'columnnumber' => $userfield->getID(), 'lookupval' => $lookupvalues);
			$numofcolumns1++;
			unset($lookupvalues);
		}
	}
	
	while ($rowres = $xoopsDB->fetchArray($queryresult))
	{
		if ($rowres['roft'] == "0")
			$gender = "<img src=\"images/male.gif\">";
		else 
			$gender = "<img src=\"images/female.gif\">";
		$name = stripslashes($rowres['NAAM']);
		;
		//empty array
		unset($columnvalue1);
		//fill array
		for ($i = 1; $i < ($numofcolumns1); $i++)
		{
			$x = $columns1[$i]['columnnumber'];
			if (is_array($columns1[$i]['lookupval']))
			{
				foreach ($columns1[$i]['lookupval'] as $key => $keyvalue)
				{
					if($keyvalue['id'] == $rowres['user'.$x])
					{
						$value = $keyvalue['value'];
					}	
				}	
				//debug information
				///echo $columns[$i]['columnname']."is an array !";
			}
			//format value - cant use object because of query count
			elseif (substr($rowres['user'.$x], 0, 7) == 'http://')
			{
				$value = "<a href=\"".$rowres['user'.$x]."\">".$rowres['user'.$x]."</a>";	
			}
			else { $value = $rowres['user'.$x]; }		
			$columnvalue1[] = array ('value' => $value);	
		}
		$dogs1[] = array ('id' => $rowres['ID'], 'name' => $name, 'gender' => $gender, 'link' => "<a href=\"dog.php?id=".$rowres['ID']."\">".$name."</a>",'colour' => "", 'number' => "", 'usercolumns' => $columnvalue1);	
	}
	return null;
}

function breederof($oid, $breeder)
{
	global $xoopsDB;
	$content = "";
	
	if ($breeder == 0)
	{
		$sqlquery = "SELECT ID, NAAM, roft from ".$xoopsDB->prefix("stamboom")." WHERE id_eigenaar = '".$oid."' order by NAAM"; 	
	}
	else
	{ 
		$sqlquery = "SELECT ID, NAAM, roft from ".$xoopsDB->prefix("stamboom")." WHERE id_fokker = '".$oid."' order by NAAM";
	}
	$queryresult = $xoopsDB->query($sqlquery);
	while ($rowres = $xoopsDB->fetchArray($queryresult))
	{
		if ($rowres['roft'] == "0")
			$gender = "<img src=\"images/male.gif\">";
		else 
			$gender = "<img src=\"images/female.gif\">";
		$link = "<a href=\"dog.php?id=".$rowres['ID']."\">".stripslashes($rowres['NAAM'])."</a>";
		$content .= $gender." ".$link."<br />";
	}
	
	return $content;
}

function getname($oid)
{
	global $xoopsDB;
	$sqlquery = "SELECT NAAM from ".$xoopsDB->prefix("stamboom")." WHERE ID = '".$oid."'"; 	
	$queryresult = $xoopsDB->query($sqlquery);
	while ($rowres = $xoopsDB->fetchArray($queryresult))
	{
		$an = stripslashes($rowres['NAAM']);	
	}
	return $an;
}

function showparent($PA)
{
	global $xoopsDB;
	$sqlquery = "SELECT NAAM from ".$xoopsDB->prefix("stamboom")." where ID='".$PA."'";
	$queryresult = $xoopsDB->query($sqlquery);
	while ($rowres = $xoopsDB->fetchArray($queryresult))
	{
		$result = $rowres['NAAM'];
	}
	if(isset($result)) { return $result; }
	else { return; }	
}

function findid($naam_hond)
{
	global $xoopsDB;
	$sqlquery = "SELECT ID from ".$xoopsDB->prefix("stamboom")." where NAAM= '$naam_hond'";
	$queryresult = $xoopsDB->query($sqlquery);
	while ($rowres = $xoopsDB->fetchArray($queryresult))
	{
		$result = $rowres['ID'];
	}
	return $result;
}

function makelist($result, $prefix, $link, $element)
{
	global $xoopsDB, $xoopsTpl;
	$animal = new Animal( );
	//test to find out how many user fields there are...
	$fields = $animal->numoffields();
	$numofcolumns = 1;
	$columns[] = array ('columnname' => "Name");
	for ($i = 0; $i < count($fields); $i++)
	{
		$userfield = new Field( $fields[$i], $animal->getconfig() );
		$fieldType = $userfield->getSetting( "FieldType" );
		$fieldobject = new $fieldType( $userfield, $animal );
		if ($userfield->active() && $userfield->inlist())
		{
			if($userfield->haslookup())
			{
				$id = $userfield->getid();
				$q = $userfield->lookup( $id );
			}
			else
			{
				$q = "";	
			}
			$columns[] = array ('columnname' => $fieldobject->fieldname, 'columnnumber' => $userfield->getID(), 'lookuparray' => $q);
			$numofcolumns++;
		}
	}
	
	//add prelimenairy row to array if passed
	if (is_array($prefix)) { $dogs[] = $prefix; }
	
	while ($row = $xoopsDB->fetchArray($result)) 
	{
		//reset $gender
		$gender = "";
		if (!empty($xoopsUser))
		{
			if ($row['user'] == $xoopsUser->getVar("uid") || $modadmin == true)
			{
				$gender = "<a href=\"dog.php?id=".$row['ID']."\"><img src=\"images/edit.gif\" alt="._PED_BTN_EDIT."></a><a href=\"delete.php?id=".$row['ID']."\"><img src=\"images/delete.gif\" alt="._PED_BTN_DELE."></a>";
			}
			else { $gender = ""; }
		}
		if ($row['roft'] == 0) { $gender .= "<img src=\"images/male.gif\">"; }
		else { $gender .= "<img src=\"images/female.gif\">"; }
		if ($row['foto'] != '')
		{ $camera = " <img src=\"images/camera.png\">"; }
		else { $camera = ""; }
		$name = stripslashes($row['NAAM']).$camera;
		//empty array
		unset($columnvalue);
		//fill array
		for ($i = 1; $i < ($numofcolumns); $i++)
		{
			$x = $columns[$i]['columnnumber'];
			$lookuparray = $columns[$i]['lookuparray'];
			if (is_array($lookuparray))
			{
				for ($index = 0; $index < count($lookuparray); $index++)
				{	
					if ( $lookuparray[$index]['id'] == $row['user'.$x] )
					{
						//echo "<h1>".$lookuparray[$index]['id']."</h1>";
						$value = $lookuparray[$index]['value'];
					}
				}		
			}
			//format value - cant use object because of query count
			elseif (substr($row['user'.$x], 0, 7) == 'http://')
			{
				$value = "<a href=\"".$row['user'.$x]."\">".$row['user'.$x]."</a>";	
			}
			else 
			{ 
				$value = $row['user'.$x]; 
			}		
			$columnvalue[] = array ('value' => $value);	
			unset($value);
		}
		
		
		$linkto = "<a href=\"".$link.$row[$element]."\">".$name."</a>";
		//create array
		$dogs[] = array ('id' => $row['ID'], 'name' => $name, 'gender' => $gender, 'link' => $linkto, 'colour' => "", 'number' => "", 'usercolumns' => $columnvalue);
	}
	
	//add data to smarty template
	//assign dog
	$xoopsTpl->assign("dogs", $dogs);
	$xoopsTpl->assign("columns", $columns);
	$xoopsTpl->assign("numofcolumns", $numofcolumns);
	$xoopsTpl->assign("tsarray", sorttable($numofcolumns));

}

?>