<?php

include_once "../../mainfile.php";
include_once XOOPS_ROOT_PATH.'/modules/animal/include/functions.php';
if(isset($_GET['dogid']))
{	$dogid = $_GET['dogid']; }
else { $dogid = 0; }

function PrintPage()
{
	global $xoopsConfig, $xoopsModule, $dogid, $xoopsDB;
	
	//create data and variables
	$queryString = "
	SELECT d.id as d_id, 
	d.naam as d_naam, 
	d.roft as d_roft, 
	d.foto as d_foto,
	f.id as f_id, 
	f.naam as f_naam, 
	f.foto as f_foto,
	m.id as m_id, 
	m.naam as m_naam,
	m.foto as m_foto,
	ff.id as ff_id, 
	ff.naam as ff_naam, 
	ff.foto as ff_foto, 
	mf.id as mf_id, 
	mf.naam as mf_naam,
	mf.foto as mf_foto,
	fm.id as fm_id, 
	fm.naam as fm_naam,
	fm.foto as fm_foto,
	mm.id as mm_id, 
	mm.naam as mm_naam,
	mm.foto as mm_foto,
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
	mmm.naam as mmm_naam 
	FROM ".$xoopsDB->prefix("mod_pedigree_tree")." d
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." f ON d.vader = f.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." m ON d.moeder = m.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." ff ON f.vader = ff.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." fff ON ff.vader = fff.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." ffm ON ff.moeder = ffm.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." mf ON m.vader = mf.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." mff ON mf.vader = mff.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." mfm ON mf.moeder = mfm.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." fm ON f.moeder = fm.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." fmf ON fm.vader = fmf.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." fmm ON fm.moeder = fmm.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." mm ON m.moeder = mm.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." mmf ON mm.vader = mmf.id
	LEFT JOIN ".$xoopsDB->prefix("mod_pedigree_tree")." mmm ON mm.moeder = mmm.id
	where d.id=$dogid";
		
	$result = $xoopsDB->query($queryString);
	while ($row = $xoopsDB->fetchArray($result)) 
	{

	
	    echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	    <html><head>
	    <meta http-equiv="Content-Type" content="text/html" />
	    <meta name="AUTHOR" content="'.$xoopsConfig['sitename'].'" />
	    <meta name="COPYRIGHT" content="Copyright (c) 2001 by '.$xoopsConfig['sitename'].'" />
	    <meta name="GENERATOR" content="Animalpedigree.com pedigree database" />
	    </head>
	    <body bgcolor="#ffffff" text="#000000" onload="window.print()">
	    <table border="0" width="640">
	    	<tr>
	    		<td>';
	    		$male = "<img src=\"http://www.pygmygoats.animalpedigree.com/modules/animal/images/male.gif\">";
	    		$female = "<img src=\"http://www.pygmygoats.animalpedigree.com/modules/animal/images/female.gif\">";
	    		if ($row['d_roft'] == 0)
	    		{ $gender = $male; }
	    		else { $gender = $female; }
	    		
	    		
	    		echo'
	    		<table width="100%" cellspacing="2" border="2">
					<!-- header (dog name) -->
					<tr>
						<th colspan="4" style="text-align:center;">
							'.stripslashes($row['d_naam']);
							echo '
						</th>
					</tr>
					<tr>
						<!-- selected dog -->
						<td width="25%" rowspan="8">
							'.$gender.stripslashes($row['d_naam']);
							if ($row['d_foto'] != '')
							{ echo '<br /><img src="/modules/animal/images/thumbnails/'.$row['d_foto'].'_150.jpeg" width="150">'; }
							echo '
						</td>
						<!-- father -->
						<td width="25%" rowspan="4">
							'.$male.stripslashes($row['f_naam']);
							if ($row['f_foto'] != '')
							{ echo '<br /><img src="/modules/animal/images/thumbnails/'.$row['f_foto'].'_150.jpeg" width="150">'; }
							echo '
						</td>
						<!-- father father -->
						<td width="25%" rowspan="2">
							'.$male.stripslashes($row['ff_naam']);
							if ($row['ff_foto'] != '')
							{ echo '<br /><img src="/modules/animal/images/thumbnails/'.$row['ff_foto'].'_150.jpeg" width="150">'; }
							echo '
						</td>
						<!-- father father father -->
						<td width="25%">
							'.$male.stripslashes($row['fff_naam']).'
						</td>
					</tr>
					<tr>
						<!-- father father mother -->
						<td width="25%">
							'.$female.stripslashes($row['ffm_naam']).'
						</td>
					</tr>
					<tr>
						<!-- father mother -->
						<td width="25%" rowspan="2">
							'.$female.stripslashes($row['fm_naam']);
							if ($row['fm_foto'] != '')
							{ echo '<br /><img src="/modules/animal/images/thumbnails/'.$row['fm_foto'].'_150.jpeg" width="150">'; }
							echo '
						</td>
						<!-- father mother father -->
						<td width="25%">
							'.$male.stripslashes($row['fmf_naam']).'
						</td>
					</tr>
					<tr>
						<!-- father mother mother -->
						<td width="25%">
							'.$female.stripslashes($row['fmm_naam']).'
						</td>
					</tr>
					<tr>
						<!-- mother -->
						<td width="25%" rowspan="4">
							'.$female.stripslashes($row['m_naam']);
							if ($row['m_foto'] != '')
							{ echo '<br /><img src="/modules/animal/images/thumbnails/'.$row['m_foto'].'_150.jpeg" width="150">'; }
							echo '
						</td>
						<!- mother father -->
						<td width="25%" rowspan="2">
							'.$male.stripslashes($row['mf_naam']);
							if ($row['mf_foto'] != '')
							{ echo '<br /><img src=/modules/animal"/images/thumbnails/'.$row['mf_foto'].'_150.jpeg" width="150">'; }
							echo '
						</td>
						<!-- mother father father -->
						<td width="25%">
							'.$male.stripslashes($row['mff_naam']).'
						</td>
					</tr>
					<tr>
						<!-- mother father mother -->
						<td width="25%">
							'.$female.stripslashes($row['mfm_naam']).'
						</td>
					</tr>
					<tr>
						<!-- mother mother -->
						<td width="25%" rowspan="2">
							'.$female.stripslashes($row['mm_naam']).'
						</td>
						<!-- mother mother father -->
						<td width="25%">
							'.$male.stripslashes($row['mmf_naam']).'
						</td>
					</tr>
					<tr>
						<!-- mother mother mother -->
						<td width="25%">
							'.$female.stripslashes($row['mmm_naam']).'
						</td>
					</tr>
					<!-- footer (dog url) -->
					<tr>
						<th colspan="4" style="text-align:center;">
							<a href="'.XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/pedigree.php?pedid='.$dogid.'">'.XOOPS_URL.'/modules/animal/pedigree.php?pedid='.$dogid.'</a>
						</th>
					</tr>
				</table>
	    		
	    		
	    		
	    		</td>
	    	</tr>
	    </table>
	    </body>
	    </html>
	    ';
	}
}

PrintPage();
?>