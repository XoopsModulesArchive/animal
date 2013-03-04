<?php   
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
/**
 * animal module for xoops
 *
 * @copyright       The TXMod XOOPS Project http://sourceforge.net/projects/thmod/
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GPL 2.0 or later
 * @package         animal
 * @since           2.5.x
 * @author          XOOPS Development Team ( name@site.com ) - ( http://xoops.org )
 * @version         $Id: const_entete.php 9860 2012-07-13 10:41:41Z txmodxoops $
 */

include_once "admin_header.php";
//It recovered the value of argument op in URL$
$op = animal_CleanVars($_REQUEST, 'op', 'list', 'string');
switch ($op) 
{   
    case "list": 
    default:               
		echo $adminMenu->addNavigation('stamboom_config.php');
		$adminMenu->addItemButton(_AM_ANIMAL_NEWSTAMBOOM_CONFIG, 'stamboom_config.php?op=new_stamboom_config', 'add');
		echo $adminMenu->renderButton();
		$criteria = new CriteriaCompo();
		$criteria->setSort("ID");
		$criteria->setOrder("ASC");
		$numrows = $stamboom_configHandler->getCount();
		$stamboom_config_arr = $stamboom_configHandler->getall($criteria);
	
		//Table view
		if ($numrows>0) 
		{			
			echo "<table width='100%' cellspacing='1' class='outer'>
				<tr>
					<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_ISACTIVE."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_FIELDNAME."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_FIELDTYPE."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_LOOKUPTABLE."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_DEFAULTVALUE."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_FIELDEXPLENATION."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_HASSEARCH."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_LITTER."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_GENERALLITTER."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_SEARCHNAME."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_SEARCHEXPLENATION."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_VIEWINPEDIGREE."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_VIEWINADVANCED."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_VIEWINPIE."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_CONFIG_VIEWINLIST."</th>
						
					<th align='center' width='10%'>"._AM_ANIMAL_FORMACTION."</th>
				</tr>";
					
			$class = "odd";
			
			foreach (array_keys($stamboom_config_arr) as $i)
			{	
				if ( $stamboom_config_arr[$i]->getVar("stamboom_config_pid") == 0)
				{
					echo "<tr class='".$class."'>";
					$class = ($class == "even") ? "odd" : "even";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("isActive")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("FieldName")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("FieldType")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("LookupTable")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("DefaultValue")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("FieldExplenation")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("HasSearch")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("Litter")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("Generallitter")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("SearchName")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("SearchExplenation")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("ViewInPedigree")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("ViewInAdvanced")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("ViewInPie")."</td>";
					echo "<td align=\"center\">".$stamboom_config_arr[$i]->getVar("ViewInList")."</td>";
					
					echo "<td align='center' width='10%'>
						<a href='stamboom_config.php?op=edit_stamboom_config&ID=".$stamboom_config_arr[$i]->getVar("ID")."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
						<a href='stamboom_config.php?op=delete_stamboom_config&ID=".$stamboom_config_arr[$i]->getVar("ID")."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
						</td>";
					echo "</tr>";
				}	
			}
			echo "</table><br /><br />";
		}
	
    break;

    case "new_stamboom_config":        
        echo $adminMenu->addNavigation("stamboom_config.php");
        $adminMenu->addItemButton(_AM_ANIMAL_STAMBOOM_CONFIGLIST, 'stamboom_config.php?op=list', 'list');
        echo $adminMenu->renderButton();

        $obj =& $stamboom_configHandler->create();
        $form = $obj->getForm();
		$form->display();
    break;	
	
	case "save_stamboom_config":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("stamboom_config.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["ID"])) {
           $obj =& $stamboom_configHandler->get($_REQUEST["ID"]);
        } else {
           $obj =& $stamboom_configHandler->create();
        }
		
		//Form isActive
		$obj->setVar("isActive", $_REQUEST["isActive"]);
		//Form FieldName
		$obj->setVar("FieldName", $_REQUEST["FieldName"]);
		//Form FieldType
		$obj->setVar("FieldType", $_REQUEST["FieldType"]);
		//Form LookupTable
		$obj->setVar("LookupTable", $_REQUEST["LookupTable"]);
		//Form DefaultValue
		$obj->setVar("DefaultValue", $_REQUEST["DefaultValue"]);
		//Form FieldExplenation
		$obj->setVar("FieldExplenation", $_REQUEST["FieldExplenation"]);
		//Form HasSearch
		$obj->setVar("HasSearch", $_REQUEST["HasSearch"]);
		//Form Litter
		$obj->setVar("Litter", $_REQUEST["Litter"]);
		//Form Generallitter
		$obj->setVar("Generallitter", $_REQUEST["Generallitter"]);
		//Form SearchName
		$obj->setVar("SearchName", $_REQUEST["SearchName"]);
		//Form SearchExplenation
		$obj->setVar("SearchExplenation", $_REQUEST["SearchExplenation"]);
		//Form ViewInPedigree
		$obj->setVar("ViewInPedigree", $_REQUEST["ViewInPedigree"]);
		//Form ViewInAdvanced
		$obj->setVar("ViewInAdvanced", $_REQUEST["ViewInAdvanced"]);
		//Form ViewInPie
		$obj->setVar("ViewInPie", $_REQUEST["ViewInPie"]);
		//Form ViewInList
		$obj->setVar("ViewInList", $_REQUEST["ViewInList"]);
		//Form locked
		$obj->setVar("locked", $_REQUEST["locked"]);
		//Form order
		$obj->setVar("order", $_REQUEST["order"]);
		
		
        if ($stamboom_configHandler->insert($obj)) {
           redirect_header("stamboom_config.php?op=list", 2, _AM_ANIMAL_FORMOK);
        }

        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
		$form->display();
	break;
	
	case "edit_stamboom_config":
	    echo $adminMenu->addNavigation("stamboom_config.php");
        $adminMenu->addItemButton(_AM_ANIMAL_NEWSTAMBOOM_CONFIG, 'stamboom_config.php?op=new_stamboom_config', 'add');
		$adminMenu->addItemButton(_AM_ANIMAL_STAMBOOM_CONFIGLIST, 'stamboom_config.php?op=list', 'list');
        echo $adminMenu->renderButton();
		$obj = $stamboom_configHandler->get($_REQUEST["ID"]);
		$form = $obj->getForm();
		$form->display();
	break;
	
	case "delete_stamboom_config":
		$obj =& $stamboom_configHandler->get($_REQUEST["ID"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("stamboom_config.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($stamboom_configHandler->delete($obj)) {
				redirect_header("stamboom_config.php", 3, _AM_ANIMAL_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "ID" => $_REQUEST["ID"], "op" => "delete_stamboom_config"), $_SERVER["REQUEST_URI"], sprintf(_AM_ANIMAL_FORMSUREDEL, $obj->getVar("stamboom_config")));
		}
	break;	
}
include_once "admin_footer.php";
?>