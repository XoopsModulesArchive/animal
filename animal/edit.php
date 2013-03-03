<?php
// ------------------------------------------------------------------------- 

require_once "../../mainfile.php";
if ( file_exists(XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php") ) 
    require_once XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php";
else 
	include_once XOOPS_ROOT_PATH ."/modules/animal/language/english/templates.php";


//needed for generation of pie charts
ob_start();
include(XOOPS_ROOT_PATH ."/modules/animal/include/class_eq_pie.php");
require_once(XOOPS_ROOT_PATH ."/modules/animal/include/class_field.php");

$xoopsOption['template_main'] = "pedigree_edit.html";

include XOOPS_ROOT_PATH.'/header.php';
// Include any common code for this module.
require_once(XOOPS_ROOT_PATH ."/modules/animal/include/functions.php");

global $xoopsTpl, $xoopsDB;

//get module configuration
$module_handler =& xoops_gethandler('module');
$module         =& $module_handler->getByDirname('animal');
$config_handler =& xoops_gethandler('config');
$moduleConfig   =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));

if (isset($_GET['f']))
{
	if ($_GET['f'] == "save")
	{
		save();
	}	
}
else
{
	edit();
}

function save()
{
	global $xoopsDB, $moduleConfig;
	$a = (!isset($_POST['id']) ? $a = '' : $a = $_POST['id']);
	$animal = new Animal( $a );
	$fields = $animal->numoffields();
	for ($i = 0; $i < count($fields); $i++)
	{
		$userfield = new Field( $fields[$i], $animal->getconfig() );
		if ($userfield->active())
		{
			$currentfield = 'user'.$fields[$i];
			$picturefield = $_FILES[$currentfield]['name'];
			if( empty( $picturefield ) || $picturefield == "" )
			{
				$newvalue = $_POST['user'.$fields[$i]];
			}
			else
			{
				$newvalue = uploadedpict( 0 );
			}
			$sql = "UPDATE ".$xoopsDB->prefix("stamboom")." SET user".$fields[$i]."='".$newvalue."' WHERE ID='".$a."'";
			mysql_query($sql);
			}			
	}
	$sql = "UPDATE ".$xoopsDB->prefix("stamboom")." SET NAAM = '".$_POST['NAAM']."', roft = '".$_POST['roft']."' WHERE ID='".$a."'";
	mysql_query($sql);
	$picturefield = $_FILES['photo']['name'];
	if( empty( $picturefield ) || $picturefield == "" )
	{
		//llalalala
	}
	else
	{
		$foto = uploadedpict( 0 );
		$sql = "UPDATE ".$xoopsDB->prefix("stamboom")." SET foto='".$foto."' WHERE ID='".$a."'";
	}
	mysql_query($sql);
	if ($moduleConfig['ownerbreeder'] == '1')
	{
		$sql = "UPDATE ".$xoopsDB->prefix("stamboom")." SET id_eigenaar = '".$_POST['id_eigenaar']."', id_fokker = '".$_POST['id_fokker']."' WHERE ID='".$a."'";
		mysql_query($sql);
	}	
	redirect_header("dog.php?id=".$a, 2, "Your changes have been saved");	
}

function edit( $id = 0)
{
	global $xoopsTpl, $xoopsDB, $moduleConfig;
	if (isset($_GET['id'])) { $id = $_GET['id']; }
	include XOOPS_ROOT_PATH."/class/xoopsformloader.php";
	
	$sql = "SELECT * FROM ".$xoopsDB->prefix("stamboom")." WHERE ID=".$id;
	$result = $xoopsDB->query($sql);
	while ($row = $xoopsDB->fetchArray($result)) 
	{
		$form = new XoopsThemeForm('Edit '.$row['NAAM'], 'dogname', 'edit.php?f=save', 'POST');
		$form->addElement(new XoopsFormHiddenToken($name = 'XOOPS_TOKEN_REQUEST', $timeout = 360));
		$form->addElement(new XoopsFormHidden('id', $id));
		//name
		$naam = htmlentities(stripslashes($row['NAAM']), ENT_QUOTES);
		$form->addElement(new XoopsFormText("<b>"._PED_FLD_NAME."</b>", 'NAAM', $size=50, $maxsize=255, $value=$naam));
		//gender
		$roft = $row['roft'];
		$gender_radio = new XoopsFormRadio( "<b>"._PED_FLD_GEND."</b>", 'roft', $value = $roft );
		$gender_radio -> addOptionArray( array( '0'=>strtr(_PED_FLD_MALE, array( '[male]' => $moduleConfig['male'] )), '1'=>strtr(_PED_FLD_FEMA, array( '[female]' => $moduleConfig['female'] ))));
		$form->addElement( $gender_radio );
		//father
		$sql = "SELECT * from ".$xoopsDB->prefix("stamboom")." WHERE ID='".$row['vader']."'";
		$resfather = $xoopsDB->query($sql);
		$numfields = mysql_num_rows($resfather);
		if (!$numfields == "0")
		{
			while ($rowfetch = $xoopsDB->fetchArray($resfather))
			{
				$form->addElement(new XoopsFormLabel("<b>".strtr(_PED_FLD_FATH, array( '[father]' => $moduleConfig['father'] ))."</b>","<img src=\"images/male.gif\"><a href=\"seldog.php?curval=".$row['ID']."&gend=1&letter=a\">".$rowfetch['NAAM']."</a>"));
			}
		}
		else
		{
			$form->addElement(new XoopsFormLabel("<b>".strtr(_PED_FLD_FATH, array( '[father]' => $moduleConfig['father'] ))."</b>","<img src=\"images/male.gif\"><a href=\"seldog.php?curval=".$row['ID']."&gend=1&letter=a\">Unknown</a>"));
		}
		//mother
		$sql = "SELECT * from ".$xoopsDB->prefix("stamboom")." WHERE ID='".$row['moeder']."'";
		$resmother = $xoopsDB->query($sql);
		$numfields = mysql_num_rows($resmother);
		if (!$numfields == "0")
		{
			while ($rowfetch = $xoopsDB->fetchArray($resmother))
			{
				$form->addElement(new XoopsFormLabel("<b>".strtr(_PED_FLD_MOTH, array( '[mother]' => $moduleConfig['mother'] ))."</b>","<img src=\"images/female.gif\"><a href=\"seldog.php?curval=".$row['ID']."&gend=0&letter=a\">".$rowfetch['NAAM']."</a>"));
			}
		}
		else
		{
			$form->addElement(new XoopsFormLabel("<b>".strtr(_PED_FLD_MOTH, array( '[mother]' => $moduleConfig['mother'] ))."</b>","<img src=\"images/female.gif\"><a href=\"seldog.php?curval=".$row['ID']."&gend=0&letter=a\">Unknown</a>"));
		}
		//owner/breeder
		if ($moduleConfig['ownerbreeder'] == '1')
		{
			$owner_select = new XoopsFormSelect("<b>"._PED_FLD_OWNE."</b>", $name="id_eigenaar", $value=$row['id_eigenaar'], $size=1, $multiple=false);
			$queryeig = "SELECT ID, lastname, firstname from ".$xoopsDB->prefix("eigenaar")." ORDER BY \"lastname\"";
			$reseig = $xoopsDB->query($queryeig);
			$owner_select -> addOption( 0, $name=_PED_UNKNOWN, $disabled=false );
			while ($roweig = $xoopsDB->fetchArray($reseig))
			{
				$owner_select -> addOption( $roweig['ID'], $name=$roweig['lastname'].", ".$roweig['firstname'], $disabled=false );
			}
			$form->addElement ( $owner_select);
			//breeder
			$breeder_select = new XoopsFormSelect("<b>"._PED_FLD_BREE."</b>", $name="id_fokker", $value=$row['id_fokker'], $size=1, $multiple=false);
			$queryfok = "SELECT ID, lastname, firstname from ".$xoopsDB->prefix("eigenaar")." ORDER BY \"lastname\"";
			$resfok = $xoopsDB->query($queryfok);
			$breeder_select -> addOption( 0, $name=_PED_UNKNOWN, $disabled=false );
			while ($rowfok = $xoopsDB->fetchArray($resfok))
			{
				$breeder_select -> addOption( $rowfok['ID'], $name=$rowfok['lastname'].", ".$rowfok['firstname'], $disabled=false );
			}
			$form->addElement ( $breeder_select);
		}
		//picture
		if ($row['foto'] != "")
		{
			$picture = "<img src=images/thumbnails/".$row['foto']."_400.jpeg>";
			$form->addElement(new XoopsFormLabel('<b>Picture</b>', $picture));
		}
		else { $picture = ""; }
		$form->setExtra( "enctype='multipart/form-data'" );
		$img_box = new XoopsFormFile("<b>Image</b>", "photo", 1024000);
		$img_box->setExtra( "size ='50'") ;
		$form->addElement($img_box);
		//userfields
		//create animal object
		$animal = new Animal( $id );
		//test to find out how many user fields there are..
		$fields = $animal->numoffields();
		for ($i = 0; $i < count($fields); $i++)
		{
			$userfield = new Field( $fields[$i], $animal->getconfig() );
			if ($userfield->active())
			{		
				$fieldType = $userfield->getSetting( "FieldType" );
				$fieldobject = new $fieldType( $userfield, $animal );
				$edditable[$i] = $fieldobject->editField();
				$form->addElement( $edditable[$i] );
			}			
		}
		
	}
	$form->addElement(new XoopsFormButton('', 'button_id', _PED_BUT_SUB, 'submit'));
	$xoopsTpl->assign("form", $form->render());
}

//comments and footer
include XOOPS_ROOT_PATH."/footer.php";

?>