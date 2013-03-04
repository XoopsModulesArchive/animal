<?php
// English strings for displaying information about this module in the site administration web pages

// The name of this module. Prefix (_MI_) is for Module Information
define("_MI_PEDIGREE_NAME", "Pedigree");
define("_MI_PEDIGREE_TITLE", "pedigree TITLE");

// The description of this module
define("_MI_PEDIGREE_DESC", "Pedigree module to administrate pet pedigrees");

// Names of blocks in this module. Note that not all modules have blocks
define("_MI_PEDIGREE_BLOCK_ONE_TITLE", "Pedigree: Sample Block");
define("_MI_PEDIGREE_BLOCK_ONE_DESC", "A simple, working block example.");
define("_MI_PEDIGREE_BLOCK_TWO_TITLE", "Pedigree: Database Block");
define("_MI_PEDIGREE_BLOCK_TWO_DESC", "A simple, working block example that queries a database.");
define("_MI_PEDIGREE_BLOCK_MENU_TITLE", "Pedigree database menu");
define("_MI_PEDIGREE_BLOCK_MENU_DESC", "Pedigree menu block");
define("_MI_PEDIGREE_BLOCK_RAND_TITLE", "Dobermann Pedigree");
define("_MI_PEDIGREE_BLOCK_RAND_DESC", "Random Pedigree block");

// Names of the menu items displayed for this module in the site administration web pages
define("_MI_OWNERBREEDER", "Use owner/breeder fields");
define("_MI_PROVERSION", "Pro-version");
define("_MI_BROTHERS", "Show brothers & sisters ?");
define("_MI_PUPS", "Show the pups/children field ?");
define("_MI_WELCOME", "Welcome/intro text");
define("_MI_MOTHER", "mother language option");
define("_MI_FATHER", "father language option");
define("_MI_MALE", "male language option");
define("_MI_FEMALE", "female language option");
define("_MI_LITTER","litter language option");
define("_MI_USELITTER", "Should the add a litter feature be used ?");
define("_MI_SHOWELCOME", "Show th welcome screen ?");
define("_MI_PEDIGREE_MENU_OVER", "Display overview ?");
define("_MI_PEDIGREE_MENU_OVER_DESC", "This option is used to display the Selected Dog, Parents, Grandparents and Great-grandparents below the pedigree.");
define("_MI_PEDIGREE_MENU_PICS", "Display pictures in pedigree ?");
define("_MI_PEDIGREE_MENU_PICS_DESC", "Use this option to toggle the display of pictures within the pedigree.");
define("_MI_PEDIGREE_MENU_GEND", "Display gender information in pedigree ?");
define("_MI_PEDIGREE_MENU_GEND_DESC", "Use this option to toggle the display of gender information within the pedigree.");
define("_MI_PEDIGREE_MENU_ADIN", "Display additional information in pedigree ?");
define("_MI_PEDIGREE_MENU_ADIN_DESC", "Use this option to toggle the display of additional information within the pedigree.<br /><i>Pedigree number, date of birth, colour etc.</i><br/>Only for selected dog not for the entire pedigree.");
define("_MI_PEDIGREE_MENU_PERP", "Select number of results per page");
define("_MI_PEDIGREE_MENU_PERP_DESC", "Here you can select the number of results shown per page for queries.");
define("_MI_PEDIGREE_MENU_HD", "Display HD-information in pedigree ?");
define("_MI_ANIMALTYPE", "Enter the type of animal you will be creating pedigree's for");
define("_MI_ANIMALTYPE_DESC", "The value should fit in the sentences below.<br /><i>Please add optional information for this <b>dog</b>.</i><br/><i>Select the first letter of the <b>dog</b>.</i>");
define("_MI_ANIMALTYPES", "Enter the type of animal you will be creating pedigree's for");
define("_MI_ANIMALTYPES_DESC", "The value should fit in the sentences below.<br /><i>No <b>dogs</b> meeting your query have been found.</i><br /><i> Here you can search for specific <b>dogs</b> by entering a year.</i>");
define("_MI_LASTIMAGE", "Show the image in the lastrow of the pedigree");
define("_MI_LASTIMAGE_DESC", "Here you can set if the image will be visible in the last row of the pedigree or not");
define("_MI_PEDCOLOURS", "Pedigree colour information");
define("_MI_PEDCOLOURS_DESC", "The value represents how the pedigree will look.<br />Use <a href=\"../animal/admin/colors.php\">this wizard</a> to set the colour information.");


//menu items
define("_PED_WEL", "Welcome");
define("_PED_VSD", "View/Search dogs");
define("_PED_VOB", "View owners/breeders");
define("_PED_LA", "Latest additions");
define("_PED_AOB", "Add an owner/breeder");
define("_PED_AD", "Add a dog");
define("_PED_M50", "Members top-50");
define("_PED_AIO", "Advanced info & orphans");
define("_PED_VM", "Virtual mating");
define("_PED_AL", "Add a litter");

//notication items
define("_DOG_DATA_NOTIFY", "Changes");
define("_DOG_DATA_NOTIFYCAP", "Keep me informed about changes to this dog's information");
define("_DOG_DATA_NOTIFYDSC", "Notification for changes");
define("_DOG_DATA_NOTIFYSBJ", "A change has been made");

//notification categories
define("_MI_PED_DOG_NOTIFY", "Individual dog");
define("_MI_PED_DOG_NOTIFY_DSC", "Description of individual dog");

//==============================================================================
// Admin
define("_MI_ANIMAL_ADMIN_NAME","Animal");
define("_MI_ANIMAL_ADMIN_HOME_DESC","Back to Home");
define("_MI_ANIMAL_ADMIN_PERMISSIONS_DESC","Users Permissions");
define("_MI_ANIMAL_ADMIN_ABOUT_DESC" , "About this module");
define("_MI_ANIMAL_ADMIN_HELP_DESC" , "Help for this module");
define("_MI_ANIMAL_ADMIN_DESC","This module does the following: ");

//Menu
define("_MI_ANIMAL_ADMENU1","Home");
define("_MI_ANIMAL_ADMENU2","Deleted");
define("_MI_ANIMAL_ADMENU3","Owner");
define("_MI_ANIMAL_ADMENU4","Temporary");
define("_MI_ANIMAL_ADMENU5","Pedigree");
define("_MI_ANIMAL_ADMENU6","Custom Fields");
define("_MI_ANIMAL_ADMENU7","Permissions");define("_MI_ANIMAL_ADMENU8","About");

//Blocks
define("_MI_ANIMAL_STAMBOOM_TRASH_BLOCK_RECENT","Deleted Recent");
define("_MI_ANIMAL_STAMBOOM_TRASH_BLOCK_DAY","Deleted Today");
define("_MI_ANIMAL_STAMBOOM_TRASH_BLOCK_RANDOM","Deleted Random");
define("_MI_ANIMAL_EIGENAAR_BLOCK_RECENT","Owner Recent");
define("_MI_ANIMAL_EIGENAAR_BLOCK_DAY","Owner Today");
define("_MI_ANIMAL_EIGENAAR_BLOCK_RANDOM","Owner Random");
define("_MI_ANIMAL_STAMBOOM_TEMP_BLOCK_RECENT","stamboom_temp Recent");
define("_MI_ANIMAL_STAMBOOM_TEMP_BLOCK_DAY","stamboom_temp Today");
define("_MI_ANIMAL_STAMBOOM_TEMP_BLOCK_RANDOM","stamboom_temp Random");
define("_MI_ANIMAL_STAMBOOM_BLOCK_RECENT","stamboom Recent");
define("_MI_ANIMAL_STAMBOOM_BLOCK_DAY","stamboom Today");
define("_MI_ANIMAL_STAMBOOM_BLOCK_RANDOM","stamboom Random");
define("_MI_ANIMAL_STAMBOOM_CONFIG_BLOCK_RECENT","stamboom_config Recent");
define("_MI_ANIMAL_STAMBOOM_CONFIG_BLOCK_DAY","stamboom_config Today");
define("_MI_ANIMAL_STAMBOOM_CONFIG_BLOCK_RANDOM","stamboom_config Random");


//Config
define("_MI_ANIMAL_EDITOR","Editor");
define("_MI_ANIMAL_EDITOR_DESC","Select the Editor to use");
define("_MI_ANIMAL_KEYWORDS","Keywords");
define("_MI_ANIMAL_KEYWORDS_DESC","Insert here the keywords (separate by comma)");
define("_MI_ANIMAL_MAXSIZE","Mime size");
define("_MI_ANIMAL_MAXSIZE_DESC","Set maximum size of the image file for Uploads");
define("_MI_ANIMAL_MIMETYPES","Mime Types");
define("_MI_ANIMAL_MIMETYPES_DESC","Select the allowed Mime Types for Uploads");

define("_MI_ANIMAL_IDPAYPAL", "Paypal ID");
define("_MI_ANIMAL_IDPAYPAL_DESC", "Insert here your PayPal ID for donactions.");
define("_MI_ANIMAL_ADVERTISE","Advertisement Code");
define("_MI_ANIMAL_ADVERTISE_DESC","Insert here the advertisement code");

//define("_MI_ANIMAL_ACTSOCIALNETWORKS","View Social networks?");
//define("_MI_ANIMAL_ACTSOCIALNETWORKS_DESC","If you want to see the buttons of social networks, click on Yes");
//define("_MI_ANIMAL_SOCIALNETWORKS","Code of socialnetworks");
//define("_MI_ANIMAL_SOCIALNETWORKS_DESC","Insert here the code of social networks");

define("_MI_ANIMAL_SOCIAL_BOOKMARKS","Social Bookmarks");
define("_MI_ANIMAL_SOCIAL_BOOKMARKS_DESC","Show Social Bookmarks in the form");
define("_MI_ANIMAL_FBCOMMENTS","Facebook comments");
define("_MI_ANIMAL_FBCOMMENTS_DESC","Allow Facebook comments in the form");