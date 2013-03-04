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
		echo $adminMenu->addNavigation('eigenaar.php');
		$adminMenu->addItemButton(_AM_ANIMAL_NEWEIGENAAR, 'eigenaar.php?op=new_eigenaar', 'add');
		echo $adminMenu->renderButton();
		$criteria = new CriteriaCompo();
		$criteria->setSort("ID");
		$criteria->setOrder("ASC");
		$numrows = $eigenaarHandler->getCount();
		$eigenaar_arr = $eigenaarHandler->getall($criteria);
	
		//Table view
		if ($numrows>0) 
		{			
			echo "<table width='100%' cellspacing='1' class='outer'>
				<tr>
					<th align=\"center\">"._AM_ANIMAL_EIGENAAR_FIRSTNAME."</th>
						<th align=\"center\">"._AM_ANIMAL_EIGENAAR_LASTNAME."</th>
						<th align=\"center\">"._AM_ANIMAL_EIGENAAR_POSTCODE."</th>
						<th align=\"center\">"._AM_ANIMAL_EIGENAAR_WOONPLAATS."</th>
						<th align=\"center\">"._AM_ANIMAL_EIGENAAR_STREETNAME."</th>
						<th align=\"center\">"._AM_ANIMAL_EIGENAAR_HOUSENUMBER."</th>
						<th align=\"center\">"._AM_ANIMAL_EIGENAAR_PHONENUMBER."</th>
						<th align=\"center\">"._AM_ANIMAL_EIGENAAR_EMAILADRES."</th>
						<th align=\"center\">"._AM_ANIMAL_EIGENAAR_WEBSITE."</th>
						<th align=\"center\">"._AM_ANIMAL_EIGENAAR_USER."</th>
						
					<th align='center' width='10%'>"._AM_ANIMAL_FORMACTION."</th>
				</tr>";
					
			$class = "odd";
			
			foreach (array_keys($eigenaar_arr) as $i)
			{	
				if ( $eigenaar_arr[$i]->getVar("eigenaar_pid") == 0)
				{
					echo "<tr class='".$class."'>";
					$class = ($class == "even") ? "odd" : "even";
					echo "<td align=\"center\">".$eigenaar_arr[$i]->getVar("firstname")."</td>";
					echo "<td align=\"center\">".$eigenaar_arr[$i]->getVar("lastname")."</td>";
					echo "<td align=\"center\">".$eigenaar_arr[$i]->getVar("postcode")."</td>";
					echo "<td align=\"center\">".$eigenaar_arr[$i]->getVar("woonplaats")."</td>";
					echo "<td align=\"center\">".$eigenaar_arr[$i]->getVar("streetname")."</td>";
					echo "<td align=\"center\">".$eigenaar_arr[$i]->getVar("housenumber")."</td>";
					echo "<td align=\"center\">".$eigenaar_arr[$i]->getVar("phonenumber")."</td>";
					echo "<td align=\"center\">".$eigenaar_arr[$i]->getVar("emailadres")."</td>";
					echo "<td align=\"center\">".$eigenaar_arr[$i]->getVar("website")."</td>";
					echo "<td align=\"center\">".$eigenaar_arr[$i]->getVar("user")."</td>";
					
					echo "<td align='center' width='10%'>
						<a href='eigenaar.php?op=edit_eigenaar&ID=".$eigenaar_arr[$i]->getVar("ID")."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
						<a href='eigenaar.php?op=delete_eigenaar&ID=".$eigenaar_arr[$i]->getVar("ID")."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
						</td>";
					echo "</tr>";
				}	
			}
			echo "</table><br /><br />";
		}
	
    break;

    case "new_eigenaar":        
        echo $adminMenu->addNavigation("eigenaar.php");
        $adminMenu->addItemButton(_AM_ANIMAL_EIGENAARLIST, 'eigenaar.php?op=list', 'list');
        echo $adminMenu->renderButton();

        $obj =& $eigenaarHandler->create();
        $form = $obj->getForm();
		$form->display();
    break;	
	
	case "save_eigenaar":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("eigenaar.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["ID"])) {
           $obj =& $eigenaarHandler->get($_REQUEST["ID"]);
        } else {
           $obj =& $eigenaarHandler->create();
        }
		
		//Form firstname
		$obj->setVar("firstname", $_REQUEST["firstname"]);
		//Form lastname
		$obj->setVar("lastname", $_REQUEST["lastname"]);
		//Form postcode
		$obj->setVar("postcode", $_REQUEST["postcode"]);
		//Form woonplaats
		$obj->setVar("woonplaats", $_REQUEST["woonplaats"]);
		//Form streetname
		$obj->setVar("streetname", $_REQUEST["streetname"]);
		//Form housenumber
		$obj->setVar("housenumber", $_REQUEST["housenumber"]);
		//Form phonenumber
		$obj->setVar("phonenumber", $_REQUEST["phonenumber"]);
		//Form emailadres
		$obj->setVar("emailadres", $_REQUEST["emailadres"]);
		//Form website
		$obj->setVar("website", $_REQUEST["website"]);
		//Form user
		$obj->setVar("user", $_REQUEST["user"]);
		
		
        if ($eigenaarHandler->insert($obj)) {
           redirect_header("eigenaar.php?op=list", 2, _AM_ANIMAL_FORMOK);
        }

        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
		$form->display();
	break;
	
	case "edit_eigenaar":
	    echo $adminMenu->addNavigation("eigenaar.php");
        $adminMenu->addItemButton(_AM_ANIMAL_NEWEIGENAAR, 'eigenaar.php?op=new_eigenaar', 'add');
		$adminMenu->addItemButton(_AM_ANIMAL_EIGENAARLIST, 'eigenaar.php?op=list', 'list');
        echo $adminMenu->renderButton();
		$obj = $eigenaarHandler->get($_REQUEST["ID"]);
		$form = $obj->getForm();
		$form->display();
	break;
	
	case "delete_eigenaar":
		$obj =& $eigenaarHandler->get($_REQUEST["ID"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("eigenaar.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($eigenaarHandler->delete($obj)) {
				redirect_header("eigenaar.php", 3, _AM_ANIMAL_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "ID" => $_REQUEST["ID"], "op" => "delete_eigenaar"), $_SERVER["REQUEST_URI"], sprintf(_AM_ANIMAL_FORMSUREDEL, $obj->getVar("eigenaar")));
		}
	break;	
}
include_once "admin_footer.php";
?>