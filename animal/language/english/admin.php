<?php
// English strings for displaying information about this module in the site administration web pages

define("_AM_PEDIGREE_CONFIGURE", "Configure pedigree");
define("_AM_PEDIGREE_EDIT", "Edit");
define("_AM_PEDIGREE_TITLE_ADMIN", "Pedigree Administration");
define("_AM_PEDIGREE_CTITLE", "Configuration");
define("_AM_PEDIGREE_EMPTY", "There is nothing in the database.");

define("_AM_PEDIGREE_DESCRIPTION", "pedigree Description");

// UI Labels and prompt Strings
define("_AM_PEDIGREE_LABEL_MAIN_TITLE", "Main Title for pedigree");
define("_AM_PEDIGREE_LABEL_CONFIG_MAIN_COUNT", "Number of Rows on Main Page.");
define("_AM_PEDIGREE_LABEL_CONFIG_MAIN_WHERE", "SQL Where clause for Main Page.");
define("_AM_PEDIGREE_LABEL_CONFIG_BLOCK_COUNT", "Number of Rows for block display.");
define("_AM_PEDIGREE_LABEL_CONFIG_BLOCK_WHERE", "Where clause for block display");

// printf format strings
define("_AM_PEDIGREE_FMT_ERROR", "<P>ERROR: %s<BR>SQL: %s</P>\n");

// Error Messages/Status Messages
define("_AM_PEDIGREE_ERR_ERROR", "Error");
define("_AM_PEDIGREE_OK_DB", "Database update succeeded.");
define("_AM_PEDIGREE_ERR_QUERY", "SQL");
define("_AM_PEDIGREE_ERR_REPLACE_FAILED", "Update failed.");
define("_AM_PEDIGREE_ERR_QUERY_FAILED", "Query failed.");

// Buttons	
define("_AM_PEDIGREE_BUT_GO", "Go!");
define("_AM_PEDIGREE_BUT_SAVE", "Save");
define("_AM_PEDIGREE_BUT_EDIT", "Edit");
define("_AM_PEDIGREE_BUT_DELETE", "DELETE");

// Database Stuff
define("_AM_PEDIGREE_STAMBOOM_TITLE", "Pedigree Administration");
define("_AM_PEDIGREE_LABEL_STAMBOOM_EDIT", "Edit Pedigree");
define("_AM_PEDIGREE_LABEL_STAMBOOM_EDIT2", "Edit");
define("_AM_PEDIGREE_LABEL_STAMBOOM_ADD", "Add Pedigree");
define("_AM_PEDIGREE_LABEL_STAMBOOM_DEL", "Delete This Entry");

define("_AM_PEDIGREE_ERR_STAMBOOM_NONE", "Pedigree Not Found");
define("_AM_PEDIGREE_ERR_STAMBOOM_BAD_KEY", "ERROR. Invalid key entered for Pedigree ");

define("_AM_PEDIGREE_EIGENAAR_TITLE", "Owner Administration");
define("_AM_PEDIGREE_LABEL_EIGENAAR_EDIT", "Edit Owner");
define("_AM_PEDIGREE_LABEL_EIGENAAR_EDIT2", "Edit");
define("_AM_PEDIGREE_LABEL_EIGENAAR_ADD", "Add Owner");
define("_AM_PEDIGREE_LABEL_EIGENAAR_DEL", "Delete Owner");

define("_AM_PEDIGREE_ERR_EIGENAAR_NONE", "Owner Not Found");
define("_AM_PEDIGREE_ERR_EIGENAAR_BAD_KEY", "ERROR. Invalid key entered for Owner ");

//===========================================
//Menu
define("_AM_ANIMAL_STATISTICS","animal Statistics");
define("_AM_ANIMAL_THEREARE_STAMBOOM_TRASH","There are <span class='bold'>%s</span> deleted Pedigrees in the Database");
define("_AM_ANIMAL_THEREARE_EIGENAAR","There are <span class='bold'>%s</span> Owners in the Database");
define("_AM_ANIMAL_THEREARE_STAMBOOM_TEMP","There are <span class='bold'>%s</span> Temp Pedigrees in the Database");
define("_AM_ANIMAL_THEREARE_STAMBOOM","There are <span class='bold'>%s</span> Pedigrees in the Database");
define("_AM_ANIMAL_THEREARE_STAMBOOM_CONFIG","There are <span class='bold'>%s</span> Custom Fields in the Database");//Buttons

define("_AM_ANIMAL_NEWSTAMBOOM_TRASH","Add New Deleted");
define("_AM_ANIMAL_STAMBOOM_TRASHLIST","List Deleted");//Buttons
define("_AM_ANIMAL_NEWEIGENAAR","Add New Owner");
define("_AM_ANIMAL_EIGENAARLIST","List Owners");//Buttons
define("_AM_ANIMAL_NEWSTAMBOOM_TEMP","Add New stamboom_temp");
define("_AM_ANIMAL_STAMBOOM_TEMPLIST","List stamboom_temp");//Buttons
define("_AM_ANIMAL_NEWSTAMBOOM","Add New Pedigree");
define("_AM_ANIMAL_STAMBOOMLIST","List Pedigrees");//Buttons
define("_AM_ANIMAL_NEWSTAMBOOM_CONFIG","Add New Custom Field");
define("_AM_ANIMAL_STAMBOOM_CONFIGLIST","List Custom Fields");
//Index

//General
define("_AM_ANIMAL_FORMOK","Registered successfull");
define("_AM_ANIMAL_FORMDELOK","Deleted successfull");
define("_AM_ANIMAL_FORMSUREDEL", "Are you sure to Delete: <b><span style=\"color : Red\"> %s </span></b>");
define("_AM_ANIMAL_FORMSURERENEW", "Are you sure to Update: <b><span style=\"color : Red\"> %s </span></b>");
define("_AM_ANIMAL_FORMUPLOAD","Upload");
define("_AM_ANIMAL_FORMIMAGE_PATH","File presents in %s");
define("_AM_ANIMAL_FORMACTION","Action");

define("_AM_ANIMAL_STAMBOOM_TRASH_ADD","Add Family Tree trash");
define("_AM_ANIMAL_STAMBOOM_TRASH_EDIT","Edit Family Tree trash");
define("_AM_ANIMAL_STAMBOOM_TRASH_DELETE","Delete Family Tree trash");
define("_AM_ANIMAL_STAMBOOM_TRASH_ID","ID");
define("_AM_ANIMAL_STAMBOOM_TRASH_NAAM","Name");
define("_AM_ANIMAL_STAMBOOM_TRASH_ID_EIGENAAR","Owner ID");
define("_AM_ANIMAL_STAMBOOM_TRASH_ID_FOKKER","Breeder ID");
define("_AM_ANIMAL_STAMBOOM_TRASH_USER","Submitter");
define("_AM_ANIMAL_STAMBOOM_TRASH_ROFT","Roft");
define("_AM_ANIMAL_STAMBOOM_TRASH_MOEDER","Mother");
define("_AM_ANIMAL_STAMBOOM_TRASH_VADER","Father");
define("_AM_ANIMAL_STAMBOOM_TRASH_FOTO","Photo");
define("_AM_ANIMAL_STAMBOOM_TRASH_COI","Coi");

define("_AM_ANIMAL_EIGENAAR_ADD","Add Owner");
define("_AM_ANIMAL_EIGENAAR_EDIT","Edit Owner");
define("_AM_ANIMAL_EIGENAAR_DELETE","Delete Owner");
define("_AM_ANIMAL_EIGENAAR_ID","Id");
define("_AM_ANIMAL_EIGENAAR_FIRSTNAME","First name");
define("_AM_ANIMAL_EIGENAAR_LASTNAME","Last name");
define("_AM_ANIMAL_EIGENAAR_POSTCODE","Post code");
define("_AM_ANIMAL_EIGENAAR_WOONPLAATS","City");
define("_AM_ANIMAL_EIGENAAR_STREETNAME","Street");
define("_AM_ANIMAL_EIGENAAR_HOUSENUMBER","House #");
define("_AM_ANIMAL_EIGENAAR_PHONENUMBER","Phone");
define("_AM_ANIMAL_EIGENAAR_EMAILADRES","Email");
define("_AM_ANIMAL_EIGENAAR_WEBSITE","Website");
define("_AM_ANIMAL_EIGENAAR_USER","Submitter");

define("_AM_ANIMAL_STAMBOOM_TEMP_ADD","Add Breed ");
define("_AM_ANIMAL_STAMBOOM_TEMP_EDIT","Edit a stamboom_temp");
define("_AM_ANIMAL_STAMBOOM_TEMP_DELETE","Delete a stamboom_temp");
define("_AM_ANIMAL_STAMBOOM_TEMP_ID","ID");
define("_AM_ANIMAL_STAMBOOM_TEMP_NAAM","Name");
define("_AM_ANIMAL_STAMBOOM_TEMP_ID_EIGENAAR","Owner ID");
define("_AM_ANIMAL_STAMBOOM_TEMP_ID_FOKKER","Breed ID");
define("_AM_ANIMAL_STAMBOOM_TEMP_USER","Submitter");
define("_AM_ANIMAL_STAMBOOM_TEMP_ROFT","Roft");
define("_AM_ANIMAL_STAMBOOM_TEMP_MOEDER","Mother");
define("_AM_ANIMAL_STAMBOOM_TEMP_VADER","Father");
define("_AM_ANIMAL_STAMBOOM_TEMP_FOTO","Photo");
define("_AM_ANIMAL_STAMBOOM_TEMP_COI","Coi");

define("_AM_ANIMAL_STAMBOOM_ADD","Add a Tree");
define("_AM_ANIMAL_STAMBOOM_EDIT","Edit a Tree");
define("_AM_ANIMAL_STAMBOOM_DELETE","Delete a Tree");
define("_AM_ANIMAL_STAMBOOM_ID","ID");
define("_AM_ANIMAL_STAMBOOM_NAAM","Name");
define("_AM_ANIMAL_STAMBOOM_ID_EIGENAAR","Owner ID");
define("_AM_ANIMAL_STAMBOOM_ID_FOKKER","Breeder ID");
define("_AM_ANIMAL_STAMBOOM_USER","Submitter");
define("_AM_ANIMAL_STAMBOOM_ROFT","Roft");
define("_AM_ANIMAL_STAMBOOM_MOEDER","Mother");
define("_AM_ANIMAL_STAMBOOM_VADER","Father");
define("_AM_ANIMAL_STAMBOOM_FOTO","Photo");
define("_AM_ANIMAL_STAMBOOM_COI","Coi");

define("_AM_ANIMAL_STAMBOOM_CONFIG_ADD","Add Custom Field");
define("_AM_ANIMAL_STAMBOOM_CONFIG_EDIT","Edit Custom Field");
define("_AM_ANIMAL_STAMBOOM_CONFIG_DELETE","Delete Custom Field");
define("_AM_ANIMAL_STAMBOOM_CONFIG_ID","Id");
define("_AM_ANIMAL_STAMBOOM_CONFIG_ISACTIVE","Is Active");
define("_AM_ANIMAL_STAMBOOM_CONFIG_FIELDNAME","Field name");
define("_AM_ANIMAL_STAMBOOM_CONFIG_FIELDTYPE","Field type");
define("_AM_ANIMAL_STAMBOOM_CONFIG_LOOKUPTABLE","Lookup table");
define("_AM_ANIMAL_STAMBOOM_CONFIG_DEFAULTVALUE","Default value");
define("_AM_ANIMAL_STAMBOOM_CONFIG_FIELDEXPLENATION","Field explanation");
define("_AM_ANIMAL_STAMBOOM_CONFIG_HASSEARCH","Has search");
define("_AM_ANIMAL_STAMBOOM_CONFIG_LITTER","Litter");
define("_AM_ANIMAL_STAMBOOM_CONFIG_GENERALLITTER","General litter");
define("_AM_ANIMAL_STAMBOOM_CONFIG_SEARCHNAME","Search name");
define("_AM_ANIMAL_STAMBOOM_CONFIG_SEARCHEXPLENATION","Search explanation");
define("_AM_ANIMAL_STAMBOOM_CONFIG_VIEWINPEDIGREE","View in pedigree");
define("_AM_ANIMAL_STAMBOOM_CONFIG_VIEWINADVANCED","View in advanced");
define("_AM_ANIMAL_STAMBOOM_CONFIG_VIEWINPIE","View in pie");
define("_AM_ANIMAL_STAMBOOM_CONFIG_VIEWINLIST","View in list");
define("_AM_ANIMAL_STAMBOOM_CONFIG_LOCKED","Locked");
define("_AM_ANIMAL_STAMBOOM_CONFIG_ORDER","Order");

//Blocks.php

define("_AM_ANIMAL_STAMBOOM_TRASH_BLOCK_DAY","stamboom_trashs of Today");
define("_AM_ANIMAL_STAMBOOM_TRASH_BLOCK_RANDOM","stamboom_trashs Random");
define("_AM_ANIMAL_STAMBOOM_TRASH_BLOCK_RECENT","stamboom_trashs Recent");

define("_AM_ANIMAL_EIGENAAR_BLOCK_DAY","eigenaars of Today");
define("_AM_ANIMAL_EIGENAAR_BLOCK_RANDOM","eigenaars Random");
define("_AM_ANIMAL_EIGENAAR_BLOCK_RECENT","eigenaars Recent");

define("_AM_ANIMAL_STAMBOOM_TEMP_BLOCK_DAY","stamboom_temps of Today");
define("_AM_ANIMAL_STAMBOOM_TEMP_BLOCK_RANDOM","stamboom_temps Random");
define("_AM_ANIMAL_STAMBOOM_TEMP_BLOCK_RECENT","stamboom_temps Recent");

define("_AM_ANIMAL_STAMBOOM_BLOCK_DAY","stambooms of Today");
define("_AM_ANIMAL_STAMBOOM_BLOCK_RANDOM","stambooms Random");
define("_AM_ANIMAL_STAMBOOM_BLOCK_RECENT","stambooms Recent");

define("_AM_ANIMAL_STAMBOOM_CONFIG_BLOCK_DAY","stamboom_configs of Today");
define("_AM_ANIMAL_STAMBOOM_CONFIG_BLOCK_RANDOM","stamboom_configs Random");
define("_AM_ANIMAL_STAMBOOM_CONFIG_BLOCK_RECENT","stamboom_configs Recent");

//Permissions
define("_AM_ANIMAL_PERMISSIONS_ACCESS","Permissions to access");
define("_AM_ANIMAL_PERMISSIONS_VIEW","Permissions to view");
define("_AM_ANIMAL_PERMISSIONS_SUBMIT","Permissions to submit");
//Error NoFrameworks
define("_AM_ERROR_NOFRAMEWORKS","Error: You don&#39;t use the Frameworks \"admin module\". Please install this Frameworks");
define("_AM_ANIMAL_MAINTAINEDBY", "is maintained by the");
?>