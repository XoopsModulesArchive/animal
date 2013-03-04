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
		echo $adminMenu->addNavigation('stamboom_temp.php');
		$adminMenu->addItemButton(_AM_ANIMAL_NEWSTAMBOOM_TEMP, 'stamboom_temp.php?op=new_stamboom_temp', 'add');
		echo $adminMenu->renderButton();
		$criteria = new CriteriaCompo();
		$criteria->setSort("ID");
		$criteria->setOrder("ASC");
		$numrows = $stamboom_tempHandler->getCount();
		$stamboom_temp_arr = $stamboom_tempHandler->getall($criteria);
	
		//Table view
		if ($numrows>0) 
		{			
			echo "<table width='100%' cellspacing='1' class='outer'>
				<tr>
					<th align=\"center\">"._AM_ANIMAL_STAMBOOM_TEMP_NAAM."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_TEMP_ID_EIGENAAR."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_TEMP_ID_FOKKER."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_TEMP_USER."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_TEMP_ROFT."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_TEMP_MOEDER."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_TEMP_VADER."</th>
						<th align=\"center\">"._AM_ANIMAL_STAMBOOM_TEMP_FOTO."</th>
						
					<th align='center' width='10%'>"._AM_ANIMAL_FORMACTION."</th>
				</tr>";
					
			$class = "odd";
			
			foreach (array_keys($stamboom_temp_arr) as $i)
			{	
				if ( $stamboom_temp_arr[$i]->getVar("stamboom_temp_pid") == 0)
				{
					echo "<tr class='".$class."'>";
					$class = ($class == "even") ? "odd" : "even";
					echo "<td align=\"center\">".$stamboom_temp_arr[$i]->getVar("NAAM")."</td>";
					echo "<td align=\"center\">".$stamboom_temp_arr[$i]->getVar("id_eigenaar")."</td>";
					echo "<td align=\"center\">".$stamboom_temp_arr[$i]->getVar("id_fokker")."</td>";
					echo "<td align=\"center\">".$stamboom_temp_arr[$i]->getVar("user")."</td>";
					echo "<td align=\"center\">".$stamboom_temp_arr[$i]->getVar("roft")."</td>";
					echo "<td align=\"center\">".$stamboom_temp_arr[$i]->getVar("moeder")."</td>";
					echo "<td align=\"center\">".$stamboom_temp_arr[$i]->getVar("vader")."</td>";
					echo "<td align=\"center\">".$stamboom_temp_arr[$i]->getVar("foto")."</td>";
					
					echo "<td align='center' width='10%'>
						<a href='stamboom_temp.php?op=edit_stamboom_temp&ID=".$stamboom_temp_arr[$i]->getVar("ID")."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
						<a href='stamboom_temp.php?op=delete_stamboom_temp&ID=".$stamboom_temp_arr[$i]->getVar("ID")."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
						</td>";
					echo "</tr>";
				}	
			}
			echo "</table><br /><br />";
		}
	
    break;

    case "new_stamboom_temp":        
        echo $adminMenu->addNavigation("stamboom_temp.php");
        $adminMenu->addItemButton(_AM_ANIMAL_STAMBOOM_TEMPLIST, 'stamboom_temp.php?op=list', 'list');
        echo $adminMenu->renderButton();

        $obj =& $stamboom_tempHandler->create();
        $form = $obj->getForm();
		$form->display();
    break;	
	
	case "save_stamboom_temp":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("stamboom_temp.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["ID"])) {
           $obj =& $stamboom_tempHandler->get($_REQUEST["ID"]);
        } else {
           $obj =& $stamboom_tempHandler->create();
        }
		
		//Form NAAM
		$obj->setVar("NAAM", $_REQUEST["NAAM"]);
		//Form id_eigenaar
		$obj->setVar("id_eigenaar", $_REQUEST["id_eigenaar"]);
		//Form id_fokker
		$obj->setVar("id_fokker", $_REQUEST["id_fokker"]);
		//Form user
		$obj->setVar("user", $_REQUEST["user"]);
		//Form roft
		$obj->setVar("roft", $_REQUEST["roft"]);
		//Form moeder
		$obj->setVar("moeder", $_REQUEST["moeder"]);
		//Form vader
		$obj->setVar("vader", $_REQUEST["vader"]);
		//Form foto
		$obj->setVar("foto", $_REQUEST["foto"]);
		//Form coi
		$obj->setVar("coi", $_REQUEST["coi"]);
		
		
        if ($stamboom_tempHandler->insert($obj)) {
           redirect_header("stamboom_temp.php?op=list", 2, _AM_ANIMAL_FORMOK);
        }

        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
		$form->display();
	break;
	
	case "edit_stamboom_temp":
	    echo $adminMenu->addNavigation("stamboom_temp.php");
        $adminMenu->addItemButton(_AM_ANIMAL_NEWSTAMBOOM_TEMP, 'stamboom_temp.php?op=new_stamboom_temp', 'add');
		$adminMenu->addItemButton(_AM_ANIMAL_STAMBOOM_TEMPLIST, 'stamboom_temp.php?op=list', 'list');
        echo $adminMenu->renderButton();
		$obj = $stamboom_tempHandler->get($_REQUEST["ID"]);
		$form = $obj->getForm();
		$form->display();
	break;
	
	case "delete_stamboom_temp":
		$obj =& $stamboom_tempHandler->get($_REQUEST["ID"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("stamboom_temp.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($stamboom_tempHandler->delete($obj)) {
				redirect_header("stamboom_temp.php", 3, _AM_ANIMAL_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "ID" => $_REQUEST["ID"], "op" => "delete_stamboom_temp"), $_SERVER["REQUEST_URI"], sprintf(_AM_ANIMAL_FORMSUREDEL, $obj->getVar("stamboom_temp")));
		}
	break;	
}
include_once "admin_footer.php";
?>