<?php
// ------------------------------------------------------------------------- 

require_once "../../mainfile.php";
if ( file_exists(XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php") ) 
    require_once XOOPS_ROOT_PATH ."/modules/animal/language/".$xoopsConfig['language']."/templates.php";
else 
	include_once XOOPS_ROOT_PATH ."/modules/animal/language/english/templates.php";
// Include any common code for this module.
require_once(XOOPS_ROOT_PATH ."/modules/animal/include/functions.php");

$xoopsOption['template_main'] = "pedigree_mpedigree.html";

include XOOPS_ROOT_PATH.'/header.php';

//get module configuration
$module_handler =& xoops_gethandler('module');
$module         =& $module_handler->getByDirname('animal');
$config_handler =& xoops_gethandler('config');
$moduleConfig   =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));

//always start with Anika
$pedid = $_GET['pedid'];
//draw pedigree
pedigree_main($pedid);


//comments and footer
include XOOPS_ROOT_PATH."/footer.php";

//
// Displays the "Main" tab of the module
//
function pedigree_main($ID)
{
	global $xoopsTpl, $xoopsDB, $moduleConfig;

	$queryString = "
	SELECT d.id as d_id, 
	d.naam as d_naam, 
	d.roft as d_roft, 
	f.id as f_id, 
	f.naam as f_naam, 
	m.id as m_id, 
	m.naam as m_naam, 
	ff.id as ff_id, 
	ff.naam as ff_naam,  
	mf.id as mf_id, 
	mf.naam as mf_naam, 
	fm.id as fm_id, 
	fm.naam as fm_naam, 
	mm.id as mm_id, 
	mm.naam as mm_naam,  
	fff.id as fff_id, 
	fff.naam as fff_naam, 
	ffm.id as ffm_id, 
	ffm.naam as ffm_naam, 
	fmf.id as fmf_id, 
	fmf.naam as fmf_naam, 
	fmm.id as fmm_id, 
	fmm.naam as fmm_naam, 
	mmf.id as mmf_id, 
	mmf.naam as mmf_naam,  
	mff.id as mff_id, 
	mff.naam as mff_naam, 
	mfm.id as mfm_id, 
	mfm.naam as mfm_naam, 
	mmm.id as mmm_id, 
	mmm.naam as mmm_naam,
	ffff.id as ffff_id, 
	ffff.naam as ffff_naam, 
	ffmf.id as ffmf_id, 
	ffmf.naam as ffmf_naam, 
	fmff.id as fmff_id, 
	fmff.naam as fmff_naam, 
	fmmf.id as fmmf_id, 
	fmmf.naam as fmmf_naam, 
	mmff.id as mmff_id, 
	mmff.naam as mmff_naam,  
	mfff.id as mfff_id, 
	mfff.naam as mfff_naam, 
	mfmf.id as mfmf_id, 
	mfmf.naam as mfmf_naam, 
	mmmf.id as mmmf_id, 
	mmmf.naam as mmmf_naam,
	fffm.id as fffm_id, 
	fffm.naam as fffm_naam, 
	ffmm.id as ffmm_id, 
	ffmm.naam as ffmm_naam, 
	fmfm.id as fmfm_id, 
	fmfm.naam as fmfm_naam, 
	fmmm.id as fmmm_id, 
	fmmm.naam as fmmm_naam, 
	mmfm.id as mmfm_id, 
	mmfm.naam as mmfm_naam,  
	mffm.id as mffm_id, 
	mffm.naam as mffm_naam, 
	mfmm.id as mfmm_id, 
	mfmm.naam as mfmm_naam, 
	mmmm.id as mmmm_id, 
	mmmm.naam as mmmm_naam 
	FROM ".$xoopsDB->prefix("stamboom")." d 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." f ON d.vader = f.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." m ON d.moeder = m.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." ff ON f.vader = ff.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." fff ON ff.vader = fff.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." ffm ON ff.moeder = ffm.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mf ON m.vader = mf.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mff ON mf.vader = mff.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mfm ON mf.moeder = mfm.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." fm ON f.moeder = fm.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." fmf ON fm.vader = fmf.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." fmm ON fm.moeder = fmm.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mm ON m.moeder = mm.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mmf ON mm.vader = mmf.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mmm ON mm.moeder = mmm.id 
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." ffff ON fff.vader = ffff.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." ffmf ON ffm.vader = ffmf.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." fmff ON fmf.vader = fmff.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." fmmf ON fmm.vader = fmmf.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mmff ON mmf.vader = mmff.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mfff ON mff.vader = mfff.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mfmf ON mfm.vader = mfmf.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mmmf ON mmm.vader = mmmf.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." fffm ON fff.moeder = fffm.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." ffmm ON ffm.moeder = ffmm.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." fmfm ON fmf.moeder = fmfm.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." fmmm ON fmm.moeder = fmmm.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mmfm ON mmf.moeder = mmfm.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mffm ON mff.moeder = mffm.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mfmm ON mfm.moeder = mfmm.id
	LEFT JOIN ".$xoopsDB->prefix("stamboom")." mmmm ON mmm.moeder = mmmm.id
	where d.id=$ID";
		
	$result = $xoopsDB->query($queryString);

	while ($row = $xoopsDB->fetchArray($result)) 
	{
		//crete array to count frequency (to select colour)
		count_item($freq, $row['d_id']);
		count_item($freq, $row['f_id']);
		count_item($freq, $row['m_id']);
		count_item($freq, $row['ff_id']);
		count_item($freq, $row['fm_id']);
		count_item($freq, $row['mf_id']);
		count_item($freq, $row['mm_id']);
		count_item($freq, $row['fff_id']);
		count_item($freq, $row['ffm_id']);
		count_item($freq, $row['fmf_id']);
		count_item($freq, $row['fmm_id']);
		count_item($freq, $row['mff_id']);
		count_item($freq, $row['mfm_id']);
		count_item($freq, $row['mmf_id']);
		count_item($freq, $row['mmm_id']);
		count_item($freq, $row['ffff_id']);
		count_item($freq, $row['ffmf_id']);
		count_item($freq, $row['fmff_id']);
		count_item($freq, $row['fmmf_id']);
		count_item($freq, $row['mfff_id']);
		count_item($freq, $row['mfmf_id']);
		count_item($freq, $row['mmff_id']);
		count_item($freq, $row['mmmf_id']);
		count_item($freq, $row['fffm_id']);
		count_item($freq, $row['ffmm_id']);
		count_item($freq, $row['fmfm_id']);
		count_item($freq, $row['fmmm_id']);
		count_item($freq, $row['mffm_id']);
		count_item($freq, $row['mfmm_id']);
		count_item($freq, $row['mmfm_id']);
		count_item($freq, $row['mmmm_id']);
		
		//create array for dog (and all parents)
		//selected dog
		$d['d']['name'] 		= stripslashes($row['d_naam']);
		$d['d']['id']			= $row['d_id'];
		$d['d']['roft']			= $row['d_roft'];
		$d['d']['col']			= "transparant";
		//father
		$d['f']['name'] 		= stripslashes($row['f_naam']);
		$d['f']['id']			= $row['f_id'];
		$d['f']['col']			= crcolour('f', $freq[$row['f_id']]);
		//mother
		$d['m']['name']	 		= stripslashes($row['m_naam']);
		$d['m']['id']			= $row['m_id'];
		$d['m']['col']			= crcolour('m', $freq[$row['m_id']]);
		//grandparents
			//father father
			$d['ff']['name'] 		= stripslashes($row['ff_naam']);
			$d['ff']['id']			= $row['ff_id'];
			$d['ff']['col']			= crcolour('f', $freq[$row['ff_id']]);
			//father mother
			$d['fm']['name'] 		= stripslashes($row['fm_naam']);
			$d['fm']['id']			= $row['fm_id'];
			$d['fm']['col']			= crcolour('m', $freq[$row['fm_id']]);
			//mother father
			$d['mf']['name'] 		= stripslashes($row['mf_naam']);
			$d['mf']['id']			= $row['mf_id'];
			$d['mf']['col']			= crcolour('f', $freq[$row['mf_id']]);
			//mother mother
			$d['mm']['name'] 		= stripslashes($row['mm_naam']);
			$d['mm']['id']			= $row['mm_id'];
			$d['mm']['col']			= crcolour('m', $freq[$row['mm_id']]);
		//great-grandparents
			//father father father
			$d['fff']['name'] 		= stripslashes($row['fff_naam']);
			$d['fff']['id']			= $row['fff_id'];
			$d['fff']['col']		= crcolour('f', $freq[$row['fff_id']]);
			//father father mother
			$d['ffm']['name'] 		= stripslashes($row['ffm_naam']);
			$d['ffm']['id']			= $row['ffm_id'];
			$d['ffm']['col']		= crcolour('m', $freq[$row['ffm_id']]);
			//father mother father
			$d['fmf']['name'] 		= stripslashes($row['fmf_naam']);
			$d['fmf']['id']			= $row['fmf_id'];
			$d['fmf']['col']		= crcolour('f', $freq[$row['fmf_id']]);
			//father mother mother
			$d['fmm']['name'] 		= stripslashes($row['fmm_naam']);
			$d['fmm']['id']			= $row['fmm_id'];
			$d['fmm']['col']		= crcolour('m', $freq[$row['fmm_id']]);
			//mother father father
			$d['mff']['name'] 		= stripslashes($row['mff_naam']);
			$d['mff']['id']			= $row['mff_id'];
			$d['mff']['col']		= crcolour('f', $freq[$row['mff_id']]);
			//mother father mother
			$d['mfm']['name'] 		= stripslashes($row['mfm_naam']);
			$d['mfm']['id']			= $row['mfm_id'];
			$d['mfm']['col']		= crcolour('m', $freq[$row['mfm_id']]);
			//mother mother father
			$d['mmf']['name'] 		= stripslashes($row['mmf_naam']);
			$d['mmf']['id']			= $row['mmf_id'];
			$d['mmf']['col']		= crcolour('f', $freq[$row['mmf_id']]);
			//mother mother mother
			$d['mmm']['name'] 		= stripslashes($row['mmm_naam']);
			$d['mmm']['id']			= $row['mmm_id'];
			$d['mmm']['col']		= crcolour('m', $freq[$row['mmm_id']]);
		//great-great-grandparents (fathers)
				//father father father
				$d['ffff']['name'] 		= stripslashes($row['ffff_naam']);
				$d['ffff']['id']			= $row['ffff_id'];
				$d['ffff']['col']		= crcolour('f', $freq[$row['ffff_id']]);
				//father father mother
				$d['ffmf']['name'] 		= stripslashes($row['ffmf_naam']);
				$d['ffmf']['id']			= $row['ffmf_id'];
				$d['ffmf']['col']		= crcolour('f', $freq[$row['ffmf_id']]);
				//father mother father
				$d['fmff']['name'] 		= stripslashes($row['fmff_naam']);
				$d['fmff']['id']			= $row['fmff_id'];
				$d['fmff']['col']		= crcolour('f', $freq[$row['fmff_id']]);
				//father mother mother
				$d['fmmf']['name'] 		= stripslashes($row['fmmf_naam']);
				$d['fmmf']['id']			= $row['fmmf_id'];
				$d['fmmf']['col']		= crcolour('f', $freq[$row['fmmf_id']]);
				//mother father father
				$d['mfff']['name'] 		= stripslashes($row['mfff_naam']);
				$d['mfff']['id']			= $row['mfff_id'];
				$d['mfff']['col']		= crcolour('f', $freq[$row['mfff_id']]);
				//mother father mother
				$d['mfmf']['name'] 		= stripslashes($row['mfmf_naam']);
				$d['mfmf']['id']			= $row['mfmf_id'];
				$d['mfmf']['col']		= crcolour('f', $freq[$row['mfmf_id']]);
				//mother mother father
				$d['mmff']['name'] 		= stripslashes($row['mmff_naam']);
				$d['mmff']['id']			= $row['mmff_id'];
				$d['mmff']['col']		= crcolour('f', $freq[$row['mmff_id']]);
				//mother mother mother
				$d['mmmf']['name'] 		= stripslashes($row['mmmf_naam']);
				$d['mmmf']['id']			= $row['mmmf_id'];
				$d['mmmf']['col']		= crcolour('f', $freq[$row['mmmf_id']]);
		//great-great-grandparents (mothers)
				//father father father
				$d['fffm']['name'] 		= stripslashes($row['fffm_naam']);
				$d['fffm']['id']			= $row['fffm_id'];
				$d['fffm']['col']		= crcolour('m', $freq[$row['fffm_id']]);
				//father father mother
				$d['ffmm']['name'] 		= stripslashes($row['ffmm_naam']);
				$d['ffmm']['id']			= $row['ffmm_id'];
				$d['ffmm']['col']		= crcolour('m', $freq[$row['ffmm_id']]);
				//father mother father
				$d['fmfm']['name'] 		= stripslashes($row['fmfm_naam']);
				$d['fmfm']['id']			= $row['fmfm_id'];
				$d['fmfm']['col']		= crcolour('m', $freq[$row['fmfm_id']]);
				//father mother mother
				$d['fmmm']['name'] 		= stripslashes($row['fmmm_naam']);
				$d['fmmm']['id']			= $row['fmmm_id'];
				$d['fmmm']['col']		= crcolour('m', $freq[$row['fmmm_id']]);
				//mother father father
				$d['mffm']['name'] 		= stripslashes($row['mffm_naam']);
				$d['mffm']['id']			= $row['mffm_id'];
				$d['mffm']['col']		= crcolour('m', $freq[$row['mffm_id']]);
				//mother father mother
				$d['mfmm']['name'] 		= stripslashes($row['mfmm_naam']);
				$d['mfmm']['id']			= $row['mfmm_id'];
				$d['mfmm']['col']		= crcolour('m', $freq[$row['mfmm_id']]);
				//mother mother father
				$d['mmfm']['name'] 		= stripslashes($row['mmfm_naam']);
				$d['mmfm']['id']			= $row['mmfm_id'];
				$d['mmfm']['col']		= crcolour('m', $freq[$row['mmfm_id']]);
				//mother mother mother
				$d['mmmm']['name'] 		= stripslashes($row['mmmm_naam']);
				$d['mmmm']['id']			= $row['mmmm_id'];
				$d['mmmm']['col']		= crcolour('m', $freq[$row['mmmm_id']]);
				
	}

	//add data to smarty template
	$xoopsTpl->assign('xoops_pagetitle', $d['d']['name']." -- mega pedigree");
	//assign dog(s)
	$xoopsTpl->assign("d", $d);
	$xoopsTpl->assign("male", "<img src=\"images/male.gif\">");
	$xoopsTpl->assign("female", "<img src=\"images/female.gif\">");		
	//assign extra display options
	$xoopsTpl->assign("unknown", "Unknown");
	$xoopsTpl->assign("f2", (strtr(_PED_MPED_F2, array( '[animalType]' => $moduleConfig['animalType'] ))));
	$xoopsTpl->assign("f3", (strtr(_PED_MPED_F3, array( '[animalType]' => $moduleConfig['animalType'] ))));
	$xoopsTpl->assign("f4", (strtr(_PED_MPED_F4, array( '[animalType]' => $moduleConfig['animalType'] ))));
	$xoopsTpl->assign("m2", (strtr(_PED_MPED_M2, array( '[animalType]' => $moduleConfig['animalType'] ))));
	$xoopsTpl->assign("m3", (strtr(_PED_MPED_M3, array( '[animalType]' => $moduleConfig['animalType'] ))));
	$xoopsTpl->assign("m4", (strtr(_PED_MPED_M4, array( '[animalType]' => $moduleConfig['animalType'] ))));
}

function crcolour($sex, $item)
{
	if ($item == '1')
	{
		$col = "transparant";	
	}
	elseif ($item == '2' && $sex == 'f')
	{
		$col = "#C8C8FF";	
	}
	elseif ($item == 3 && $sex == 'f')
	{
		$col = "#6464FF";	
	}
	elseif ($item == '4' && $sex == 'f')
	{
		$col = "#0000FF";	
	}
	elseif ($item == '2' && $sex == 'm')
	{
		$col = "#FFC8C8";	
	}
	elseif ($item == '3' && $sex == 'm')
	{
		$col = "#FF6464";	
	}
	elseif ($item == '4' && $sex == 'm')
	{
		$col = "#FF0000";	
	}
	else
	{
		$col = "transparant";	
	}
	return $col;
}

function count_item(&$freq, $item, $inc = 1) {
   if (! is_array($freq)) {
       $freq = array ();
   }
   $freq[$item] = (isset($freq[$item]) ? ($freq[$item] += $inc) : $inc);

   return true;
}

?>