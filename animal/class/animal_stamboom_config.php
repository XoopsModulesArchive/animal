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

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class animal_stamboom_config extends XoopsObject
{
    //Constructor
    function __construct()
    {
        $this->XoopsObject();
        $this->initVar("ID", XOBJ_DTYPE_INT, null, false, 2);
        $this->initVar("isActive", XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar("FieldName", XOBJ_DTYPE_TXTBOX, null, false, 50);
        $this->initVar("FieldType", XOBJ_DTYPE_ENUM, null, false);
        $this->initVar("LookupTable", XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar("DefaultValue", XOBJ_DTYPE_TXTBOX, null, false, 50);
        $this->initVar("FieldExplenation", XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar("HasSearch", XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar("Litter", XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar("Generallitter", XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar("SearchName", XOBJ_DTYPE_TXTBOX, null, false, 50);
        $this->initVar("SearchExplenation", XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar("ViewInPedigree", XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar("ViewInAdvanced", XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar("ViewInPie", XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar("ViewInList", XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar("locked", XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar("order", XOBJ_DTYPE_INT, null, false, 3);

    }

    function getForm($action = false)
    {
        global $xoopsDB, $xoopsModuleConfig;

        if ($action === false) {
            $action = $_SERVER["REQUEST_URI"];
        }

        $title = $this->isNew() ? sprintf(_AM_ANIMAL_STAMBOOM_CONFIG_ADD) : sprintf(_AM_ANIMAL_STAMBOOM_CONFIG_EDIT);

        include_once(XOOPS_ROOT_PATH . "/class/xoopsformloader.php");

        $form = new XoopsThemeForm($title, "form", $action, "post", true);
        $form->setExtra('enctype="multipart/form-data"');

        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_ISACTIVE, "isActive", 50, 255, $this->getVar("isActive")), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_FIELDNAME, "FieldName", 50, 255, $this->getVar("FieldName")), false);
        $form->addElement(new XoopsFormTextArea(_AM_ANIMAL_STAMBOOM_CONFIG_FIELDTYPE, "FieldType", $this->getVar("FieldType"), 4, 47), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_LOOKUPTABLE, "LookupTable", 50, 255, $this->getVar("LookupTable")), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_DEFAULTVALUE, "DefaultValue", 50, 255, $this->getVar("DefaultValue")), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_FIELDEXPLENATION, "FieldExplenation", 50, 255, $this->getVar("FieldExplenation")), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_HASSEARCH, "HasSearch", 50, 255, $this->getVar("HasSearch")), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_LITTER, "Litter", 50, 255, $this->getVar("Litter")), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_GENERALLITTER, "Generallitter", 50, 255, $this->getVar("Generallitter")), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_SEARCHNAME, "SearchName", 50, 255, $this->getVar("SearchName")), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_SEARCHEXPLENATION, "SearchExplenation", 50, 255, $this->getVar("SearchExplenation")), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_VIEWINPEDIGREE, "ViewInPedigree", 50, 255, $this->getVar("ViewInPedigree")), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_VIEWINADVANCED, "ViewInAdvanced", 50, 255, $this->getVar("ViewInAdvanced")), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_VIEWINPIE, "ViewInPie", 50, 255, $this->getVar("ViewInPie")), false);
        $form->addElement(new XoopsFormText(_AM_ANIMAL_STAMBOOM_CONFIG_VIEWINLIST, "ViewInList", 50, 255, $this->getVar("ViewInList")), false);

//			include_once(XOOPS_ROOT_PATH."/class/tree.php");
//			$Handler =& xoops_getModuleHandler("animal_", "animal");
//			$criteria = new CriteriaCompo();
//            $criteria->setSort('_id');
//            $criteria->setOrder('ASC');
//			$_arr = $Handler->getall();
//			$mytree = new XoopsObjectTree($_arr, "_id", "_pid");
//			$form->addElement(new XoopsFormLabel(_AM_ANIMAL_STAMBOOM_CONFIG_LOCKED, $mytree->makeSelBox("_pid", "_title","--", $this->getVar("_pid"),false)));
//
//			include_once(XOOPS_ROOT_PATH."/class/tree.php");
//			$Handler =& xoops_getModuleHandler("animal_", "animal");
//			$criteria = new CriteriaCompo();
//            $criteria->setSort('_id');
//            $criteria->setOrder('ASC');
//			$_arr = $Handler->getall();
//			$mytree = new XoopsObjectTree($_arr, "_id", "_pid");
//			$form->addElement(new XoopsFormLabel(_AM_ANIMAL_STAMBOOM_CONFIG_ORDER, $mytree->makeSelBox("_pid", "_title","--", $this->getVar("_pid"),false)));

        include_once(XOOPS_ROOT_PATH . "/class/tree.php");
//      $Handler =& xoops_getModuleHandler("animal_", "animal");
        $Handler  =& xoops_getModuleHandler('animal_stamboom_config', "animal");
        $criteria = new CriteriaCompo();
        $criteria->setSort('_id');
        $criteria->setOrder('ASC');
        $_arr   = $Handler->getall();
        $mytree = new XoopsObjectTree($_arr, "_id", "_pid");
        $form->addElement(new XoopsFormLabel(_AM_ANIMAL_STAMBOOM_CONFIG_LOCKED, $mytree->makeSelBox("_pid", "_title", "--", $this->getVar("_pid"), false)));


        $form->addElement(new XoopsFormHidden("op", "save_stamboom_config"));


        //Submit buttons
        $button_tray   = new XoopsFormElementTray("", "");
        $submit_button = new XoopsFormButton("", "submit", _SUBMIT, "submit");
        $button_tray->addElement($submit_button);

        $cancel_button = new XoopsFormButton("", "", _CANCEL, "cancel");
        $cancel_button->setExtra('onclick="history.go(-1)"');
        $button_tray->addElement($cancel_button);

        $form->addElement($button_tray);

        return $form;
    }
}

class animalanimal_stamboom_configHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "mod_pedigree_fields", "animal_stamboom_config", "ID", "isActive");
    }
}

?>