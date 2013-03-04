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

function b_waiting_animal()
{
	$xoopsDB =& XoopsDatabaseFactory::getDatabaseConnection();
    $ret = array() ;

	// waiting mod_stamboom_trash
	$block = array();

    $result = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("mod_pedigree_trash")." WHERE stamboom_trash_waiting=1");
	if ( $result ) {
		$block['adminlink'] = XOOPS_URL."/modules/animal/admin/stamboom_trash.php?op=listWaiting";
		list($block['pendingnum']) = $xoopsDB->fetchRow($result);
		$block['lang_linkname'] = _PI_WAITING_WAITINGS ;
	}
   $ret[] = $block ;

	// waiting mod_eigenaar
	$block = array();

    $result = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("mod_pedigree_owner")." WHERE eigenaar_waiting=1");
	if ( $result ) {
		$block['adminlink'] = XOOPS_URL."/modules/animal/admin/eigenaar.php?op=listWaiting";
		list($block['pendingnum']) = $xoopsDB->fetchRow($result);
		$block['lang_linkname'] = _PI_WAITING_WAITINGS ;
	}
   $ret[] = $block ;

	// waiting mod_stamboom_temp
	$block = array();

    $result = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("mod_pedigree_temp")." WHERE stamboom_temp_waiting=1");
	if ( $result ) {
		$block['adminlink'] = XOOPS_URL."/modules/animal/admin/stamboom_temp.php?op=listWaiting";
		list($block['pendingnum']) = $xoopsDB->fetchRow($result);
		$block['lang_linkname'] = _PI_WAITING_WAITINGS ;
	}
   $ret[] = $block ;

	// waiting mod_stamboom
	$block = array();

    $result = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("mod_pedigree_tree")." WHERE stamboom_waiting=1");
	if ( $result ) {
		$block['adminlink'] = XOOPS_URL."/modules/animal/admin/stamboom.php?op=listWaiting";
		list($block['pendingnum']) = $xoopsDB->fetchRow($result);
		$block['lang_linkname'] = _PI_WAITING_WAITINGS ;
	}
   $ret[] = $block ;

	// waiting mod_stamboom_config
	$block = array();

    $result = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("mod_pedigree_fields")." WHERE stamboom_config_waiting=1");
	if ( $result ) {
		$block['adminlink'] = XOOPS_URL."/modules/animal/admin/stamboom_config.php?op=listWaiting";
		list($block['pendingnum']) = $xoopsDB->fetchRow($result);
		$block['lang_linkname'] = _PI_WAITING_WAITINGS ;
	}
   $ret[] = $block ;

	return $ret;
};