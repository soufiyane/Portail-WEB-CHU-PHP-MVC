<?php
header('Content-type: text/html; charset=iso-8859-1');
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header ('Cache-Control: no-cache, must-revalidate');
header ('Pragma: no-cache');
?>

<html>
<!--
 - Date de création : 29/09/2008
 - Nom : index.php
 - Application : Smooth 3D Camembert, version 4.1, démo "php"
 - Auteur : opossum_farceur
 - Object : Camembert, 3D, Antialiasing, Bresenham, Statistiques
 - Adresse : http://michel.vanthodiep.free.fr/smooth3dcamembert/index.php
 - Testé avec : IE7, FF3
-->
<head>
<title></title>
<meta Http-Equiv="Cache-Control" Content="no-cache">
<meta Http-Equiv="Pragma" Content="no-cache">
<meta Http-Equiv="Expires" Content="0"> 

<style type="text/css">
	body {background-color:#EEEEEE; font-family:verdana;}

	table.table1 {
		border-top:1px solid #808080; border-right:1px solid white;
		border-bottom:1px solid white; border-left:1px solid #808080;
	}
	td.td1 {
		border-top:1px solid white; border-right:1px solid #808080;
		border-bottom:1px solid #808080; border-left:1px solid white;
		font-size:14px; text-align:justify;
	}
	th {font-size:24px; padding-top:0px; padding-bottom:0px;}

	div {float:right; margin-left:20px; margin-bottom:10px;}
	table.table2 {background-color:gainsboro; border:1px solid #999999;}
	td.td2 {width:50%; font-size:12px; font-style:italic; text-align:center;}
	select {background-color:white; font-family:Verdana; font-size:12px;}

	p {margin-top:0px;}
	li {text-align:left; list-style-image:url(docs/puce.gif); vertical-align:bottom;}

	a {color:blue;}
	a:hover {color:red;}
</style>

</head>

<body><center>
<table class="table1" cellspacing="2" cellpadding="20">
<tr><td class="td1">

<table width="100%"><tr>
<th><img src="docs/mouse1.gif"/></th>
<th>Dis, tu veux un camembert?</th>
<th><img src="docs/mouse2.gif"/></th>
</tr></table>

</td></tr>

<tr><td class="td1">

<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////

function arr2str($src)			# convertit le tableau de données en une chaîne de caractères
{										# Séparateurs : ",," et ","
	for ($i=0,$n=count($src);$i<$n;$i++) {
		$src[$i][2]=rawurlencode($src[$i][2]);		# pour un traitement correct de caractères comme #
		$temp[$i]=implode(',',$src[$i]);
	}
	return implode(',,',$temp);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

$server='camembert.php';
$classarr=array('aabasic','aagradient','aaimage');
$title='';

$arr=array(
#			donnée	couleur		légende 					xploded
	array(1607,		0xB94BB9,	'Agents non formés',			0),
	array(430,		0x4BB9B9,	"Agents formés",			0),
);

$sizearr=array(1=>345,2=>450,3=>600);
$ajax=false;

if (isset($_POST['class'])) {
	$class=$_POST['class'];
	$size=$_POST['size'];
}
else {			# valeurs par défaut
	$class='aagradient';
	$size=2;		# 1 : small, 2 : medium, 3 : large
}

/* formulaire */
echo '<div>';

echo '<form name="F" method="post" action="',$_SERVER['PHP_SELF'],'">';
echo '<table class="table2" width="',$sizearr[$size],'"><tr>';

echo '<td class="td2">class&nbsp;&nbsp;<select name="class" onchange="document.F.submit();">';
foreach ($classarr as $value) 
	echo '<option value="',$value,(($value==$class)? '" selected="selected">' : '">'),$value,'</option>';	 
echo '</select></td>';

echo '<td class="td2">size&nbsp;&nbsp;<select name="size" onchange="document.F.submit();">';
foreach ($sizearr as $key=>$value) 
	echo '<option value="',$key,(($key==$size)? '" selected="selected">' : '">'),$key,'</option>'; 
echo '</select></td>';

echo '</tr></table>';
echo '</form>';

/* camembert */
$str=arr2str($arr);

switch ($class) {
	case 'aabasic':						# exemple avec fond uni
		$bgcolor=0xEFFAFF;				# couleur du fond
		echo '<img src="',$server,'?class=aabasic&title=',$title,'&str=',$str,'&size=',$size,
			'&ajax=',$ajax,'&bg1=',$bgcolor,'"/>';
		break;
	case 'aagradient':					# exemple avec dégradé
		$topcolor=0xFFFF00;				# couleur du haut
		$bottomcolor=0x00FFFF;			# couleur du bas
		echo '<img src="',$server,'?class=aagradient&title=',$title,'&str=',$str,'&size=',$size,
			'&ajax=',$ajax,'&bg1=',$topcolor,'&bg2=',$bottomcolor,'"/>';
		break;
	case 'aaimage':						# exemple avec image
		$path='docs/clouds.png';		# chemin du fichier (formats gif, jpg et png supportés)
		echo '<img src="',$server,'?class=aaimage&title=',$title,'&str=',$str,'&size=',$size,
			'&ajax=',$ajax,'&bg1=',$path,'"/>';
		break;
}
echo '</div>';
?>

<!-- blabla -->
<p><b>C</b>es données, "récoltées" sur <a href="http://www.phpcs.com">CodeS-SourceS</a> le 
07/08/2006, montrent la répartition par langage des sources publiées sur ce site.</p>

<p><b>C</b>ertains langages, crédités d'un nombre de sources inférieur à 1000, sont rangés dans la 
rubrique "Divers".<br/>
Il s'agit, dans l'ordre :<br/>
ASP, Graphisme, Assembleur, Python, SQL, Cold Fusion, FoxPro, PDA/PocketPC.</p>

<p><b>T</b>rônant, sans contestation possible, sur la plus haute marche du podium, Visual Basic confirme 
l'emprise des produits MicroSoft (alias la "Pieuvre") dans tous les domaines liés à l'informatique. 
Etonnant cependant qu'ASP, qui est un dérivé du Basic, soit situé lui aux antipodes de ce classement.</p>

<p><b>L</b>oin derrière, C/C++, le nez dans le guidon, s'accroche farouchement à une deuxième place 
amplement méritée, d'autant que la plupart des langages du peloton (Delphi mis à part), lui sont 
redevables de sa syntaxe. Malgré le nombre important de compilateurs existants (dont certains "gratuits" 
et d'une très grande qualité), les "développeurs" semblent désormais préférer se tourner vers des langages 
moins typés et d'accès plus immédiat.</p>

<p><b>E</b>n troisième position, Delphi, vaisseau Amiral de la maison Borland, est nostalgique d'une 
époque glorieuse où Pascal (avec le célèbre TurboPascal) rivalisait avec C/C++.</p>

<p><b>V</b>oilà, à vous de commenter davantage ces résultats, ceux-ci étant, comme toutes statistiques 
dignes de ce nom, sujets à controverses et interprétations hasardeuses.<br/><br/>
<b>B</b>on Dev...</p>
</td></tr>

<!-- liens -->
<tr><td class="td1">
<b>Q</b>uelques documents m'ayant été de la plus grande utilité :<br/>
<ul>
<li/><a href="http://www.lri.fr/~mbl/ENS/IG2/cours1/AntiAliassage.pdf">
	http://www.lri.fr/~mbl/ENS/IG2/cours1/AntiAliassage.pdf</a><br/><br/>

<li/><a href="http://homepage.smc.edu/kennedy_john/BELIPSE.PDF">
	http://homepage.smc.edu/kennedy_john/BELIPSE.PDF</a><br/><br/>

<li/><a href="http://perception.inrialpes.fr/people/Boyer/Teaching/RICM/c2.pdf">
	http://perception.inrialpes.fr/people/Boyer/Teaching/RICM/c2.pdf</a><br/><br/>

<li/><a href="http://www2.ift.ulaval.ca/~Dupuis/Infographie/Chap.%201%20-%20Concepts%20de%20base%20en%20infographie/Chap.%20I%20Exercices%20resolus.pdf">
	http://www2.ift.ulaval.ca/~Dupuis/Infographie/Chap. 1 - Concepts de base en infographie/Chap. I Exercices resolus.pdf</a><br/><br/>

<li/><a href="http://www.mini.pw.edu.pl/~kotowski/Grafika/RasterDrawing/Index.html">
	http://www.mini.pw.edu.pl/~kotowski/Grafika/RasterDrawing/Index.html</a><br/>
</ul>

</td></tr>
</table>

</center></body></html>