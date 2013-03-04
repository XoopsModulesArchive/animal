<?php
function xoops_module_update_animal() {

	include_once XOOPS_ROOT_PATH.'/modules/animal/include/functions.php';
   global $xoopsDB;

if(tableExists($xoopsDB->prefix('eigenaar')))
{
    $sql=sprintf('ALTER TABLE ' . $xoopsDB->prefix('eigenaar') . ' RENAME ' .$xoopsDB->prefix('mod_pedigree_owner'));
    	$result=$xoopsDB->queryF($sql);
    	if (!$result) {
        	echo '<br />' .  _AM_NEWS_UPGRADEFAILED.' '._AM_NEWS_UPGRADEFAILED2;
        	$errors++;
    	}
}

if(tableExists($xoopsDB->prefix('stamboom')))
{
    $sql=sprintf('ALTER TABLE ' . $xoopsDB->prefix('stamboom') . ' RENAME ' .$xoopsDB->prefix('mod_pedigree_tree'));
    	$result=$xoopsDB->queryF($sql);
    	if (!$result) {
        	echo '<br />' .  _AM_NEWS_UPGRADEFAILED.' '._AM_NEWS_UPGRADEFAILED2;
        	$errors++;
    	}
}

if(tableExists($xoopsDB->prefix('stamboom_config')))
{
    $sql=sprintf('ALTER TABLE ' . $xoopsDB->prefix('stamboom_config') . ' RENAME ' .$xoopsDB->prefix('mod_pedigree_fields'));
    	$result=$xoopsDB->queryF($sql);
    	if (!$result) {
        	echo '<br />' .  _AM_NEWS_UPGRADEFAILED.' '._AM_NEWS_UPGRADEFAILED2;
        	$errors++;
    	}
}

if(tableExists($xoopsDB->prefix('stamboom_temp')))
{
    $sql=sprintf('ALTER TABLE ' . $xoopsDB->prefix('stamboom_temp') . ' RENAME ' .$xoopsDB->prefix('mod_pedigree_temp'));
    	$result=$xoopsDB->queryF($sql);
    	if (!$result) {
        	echo '<br />' .  _AM_NEWS_UPGRADEFAILED.' '._AM_NEWS_UPGRADEFAILED2;
        	$errors++;
    	}
}

if(tableExists($xoopsDB->prefix('stamboom_trash')))
{
    $sql=sprintf('ALTER TABLE ' . $xoopsDB->prefix('stamboom_trash') . ' RENAME ' .$xoopsDB->prefix('mod_pedigree_trash'));
    	$result=$xoopsDB->queryF($sql);
    	if (!$result) {
        	echo '<br />' .  _AM_NEWS_UPGRADEFAILED.' '._AM_NEWS_UPGRADEFAILED2;
        	$errors++;
    	}
}

    return TRUE;

}