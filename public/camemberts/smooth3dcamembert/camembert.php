<?php
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header ('Cache-Control: no-cache, must-revalidate');
header ('Pragma: no-cache');

/*
 - Date de cr�ation : 29/09/2008
 - Nom : camembert.php
 - Application : Smooth 3D Camembert, version 4.1
 - Auteur : opossum_farceur
 - Object : Camembert, 3D, Antialiasing, Bresenham, Statistiques
 - Test� avec : IE7, FF3
*/

define('coef',M_PI/180);

#########################################################################################################

abstract class smooth3dcamembert 
{
	private $textcolor;
	private $a,$b,$cx,$cy,$aa,$bb,$aabb;			# ellipse
	private $sort,$ellipse;								# tableaux
	private $color,$shade,$angle,$xploded,$legend,$value;
	private $e,$quarter,$pivot;						# autres
	private $num,$linecolor;							# algorithme de Gupta-Sproull
	
	protected $img;

// constructeur /////////////////////////////////////////////////////////////////////////////////////////

public function __construct($title,$str,$size,$ajax,$bg1,$bg2=0)
{
	$start=microtime(true);								# d�clenchement chronom�trage
	
	if (!isset($title)) throw new Exception('Argument "title" attendu...');
	if (!isset($str)) throw new Exception('Argument "str" attendu...');
	if (!isset($size)) throw new Exception('Argument "size" attendu...');
	if (!isset($ajax)) throw new Exception('Argument "ajax" attendu...');
	if (!isset($bg1)) throw new Exception('Argument "bg1" attendu...');

	switch ($size) {
		case 1:	$width=345; break;					# small 	: 345 x 224
		case 2:	$width=490; break;					# medium	: 450 x 292
		case 3:	$width=600; break;					# large	: 600 x 390
		default:	$width=490; $size=2;					# "medium" si valeur erron�e
	}
	# constantes (les indications num�riques en commentaires concernent la size 3)
	//$head=$width/15;										# r�serv�s pour le titre : 40
	$head=0;
	//$height=6*$width/12+$head;							# 390 
	//$w=8*$width/15;										# grand axe horizontal : 320
	//$h=$w/2;											# petit axe vertical : 160
	$height      = 420; # hauteur de l'image
	//$centre_x    = 200; # poisition X du centre du camembert
	//$centre_y    = 85; # poisition Y du centre du camembert
	$w = 225; # largeur du camembert
	$h = 175; # hauteur du camembert
	$font='docs/verdana.ttf';							# chemin de la police de caract�res
	$tempfile='~temp.png';
	
	# attributs calcul�s
	$this->a=round($w/2);								# 1/2 grand axe : 160
	$this->b=round($h/2);								# 1/2 petit axe : 80
	$this->e=round($w/17);								# "�paisseur" du camembert : 80
	$this->cx=round($width/2);							# abscisse et ordonn�e du "centre" du camembert (300)
	//$this->cy=round(($height+$head-$this->e)/2);	# 175
	//$this->cx=200;						# abscisse et ordonn�e du "centre" du camembert (300)
	$this->cy=95-$head;	# 175
	
	$this->aa=$this->a*$this->a;
	$this->bb=$this->b*$this->b;
	$this->aabb=$this->aa*$this->bb;
	
	# attributs renseign�s en cours de route
	$this->sort=array();
	$this->ellipse=array();
	
	$this->color=array();
	$this->shade=array();
	$this->angle=array();
	$this->xploded=array();
	$this->legend=array();
	$this->value=array();
	# antialiasing ligne droite
	$this->num=10;											# � choisir pair
	$this->linecolor=array();							# taille du tableau : 1+3/2*$this->num, soit 16 (suffisant)
	
	# pr�liminaires
	$this->img=imagecreatetruecolor($width,$height);
	$rgb=$this->hex2rgb(0x000000);					# noir : couleur du texte et des lignes
	$this->textcolor=imagecolorallocate($this->img,$rgb[0],$rgb[1],$rgb[2]);
	$this->mybackground($width,$height,$bg1,$bg2);		# impl�mentation dans les classes d�riv�es
	$this->mytitle($width,$title,$font,3*$size+7);
	$this->aaellipse();
	$this->gupta_sproull($rgb);
	$specialcase=$this->init($this->str2arr($str));
	
	# trac�s
	$this->aadraw($font,$size+6,$specialcase);
	
	# temps d'ex�cution
	$time=round(1000*(microtime(true)-$start));
	//imagettftext($this->img,$size+6,0,8,$height-8,$this->textcolor,$font,'time : '.$time.'ms');

	# sortie
	if ($ajax) {											# sortie adapt�e � un traitement "ajax"
		imagepng($this->img,$tempfile);
		echo $tempfile,'?',mt_rand();					# r�soud efficacement les probl�mes de cache
	}
	else {													# sortie traditionnelle, � la "vol�e"
		header('Content-type: image/png');
		imagepng($this->img);
	}

	imagedestroy($this->img);
}

// convertit une cha�ne pass�e en argument en tableau ///////////////////////////////////////////////////

private function str2arr($src)
{
	$dst=explode(',,',$src);
	for ($j=0,$n=count($dst);$j<$n;$j++) {
		$dst[$j]=explode(',',$dst[$j]);
		$dst[$j][2]=stripslashes(rawurldecode($dst[$j][2]));
	}
	return $dst;
}

// mise en place du titre ///////////////////////////////////////////////////////////////////////////////

private function mytitle($width,$title,$font,$titlefontsize)
{
	$rect=imagettfbbox($titlefontsize,0,$font,$title);
	$w=$rect[2]-$rect[0];
	$h=$rect[1]-$rect[7];

	imagettftext($this->img,$titlefontsize,0,($width-$w)/2,7*$h/4,$this->textcolor,$font,$title);
}

// � partir de l'angle donn� en argument retourne l'index correspondant du tableau de l'ellipse /////////

private function index($v)
{	# formulation du sinus � partir du cosinus, en principe + rapide, mais bon...
	$cosv=cos(coef*$v);
	$sinv= ($v>180)? -sqrt(1-$cosv*$cosv) : sqrt(1-$cosv*$cosv);
	$x=round($this->a*abs($cosv));
	$y=round($this->b*abs($sinv));

	$case=floor($v/90);
	$p=($case+$case%2)*$this->quarter;
	$sign= ($case%2)? -1 : 1;
	$q= ($this->aa*$y-$this->bb*$x<0)? $y : $this->quarter-$x;

	return $p+$sign*$q;
}

// traitement des donn�es fournies dans le tableau //////////////////////////////////////////////////////

private function init($arr)
{	# calcul de la somme des donn�es
	for ($j=$sum=0,$n=count($arr);$j<$n;$j++) $sum+=$arr[$j][0];
	# analyse du tableau
	for ($j=$k=$v1=0;$j<$n;$j++) if ($arr[$j][0]) {	# cas non trait� si donn�e nulle
		# traitement des angles
		$v2=$v1+$arr[$j][0]*360/$sum;
		if ($v1<=270 && $v2>=270) $first=$k;
		if ($v1<=90 && $v2>=90) $last=$k;
		$this->angle[$k]=$v2;
		# stockage des couleurs, calcul de leur version sombre (allocation ult�rieure)
		$this->color[$k]=$arr[$j][1];
		list($red,$green,$blue)=$this->hex2rgb($this->color[$k]);
		$this->shade[$k]=(max(0,$red-50)<<16)|(max(0,$green-50)<<8)|(max(0,$blue-50)<<0);
		# pr�paration du texte
		$this->legend[$k]=$arr[$j][2].' ('.$arr[$j][0].' soit '.number_format(100*$arr[$j][0]/$sum,2,',','').'%)';
		$this->value[$k]=$arr[$j][0];
		$this->xploded[$k]=$arr[$j][3];

		$v1=$v2;
		$k++;
	}

	$m=count($this->value);		# diff�rent de $n si une ou plusieurs donn�e(s) sont nulles
	if ($first!=$last) {
		for ($j=0,$k=$first;$k!=$last;$j++,$k=($k+1)%$m) $this->sort[$j]=$k;
		$this->pivot=$j;
		for ($k=$first-1;$k>=$last;$j++,$k--) $this->sort[$j]=$k;

		return false;
	}
	else {	# cas particulier pr�occupant : une grosse portion pr�sente � la fois � 12h et � 18h,...
				# celle-ci est consid�r�e comme derni�re et comme pivot
		for ($j=0,$k=($first+1)%$m;$j<$m;$j++,$k=($k+1)%$m) $this->sort[$j]=$k;
		$this->pivot=$m-1;
		# mise en place du panneau 2 de la derni�re portion (origine du code : m�thode "aadraw()")
		$j=$this->sort[$m-1];
		$xploded=$this->xploded[$j];
		if ($this->xploded[$this->sort[0]] || $xploded) {
			$shade=$this->allocate($this->shade[$j]);
			$v1= ($j)? $this->angle[$j-1] : 0;
			$v2=$this->angle[$j];
			$vm=($v1+$v2)/2;
			if ($xploded) {
				$ox=round($this->cx+$this->a*cos(coef*$vm)/6);				# a/6, b/6 : "offsets" des portions
				$oy=round($this->cy+$this->b*sin(coef*$vm)/6);
			}
			else {
				$ox=$this->cx;
				$oy=$this->cy;
			}
			$index2=$this->index($v2);
			$x2=$ox+$this->ellipse[$index2]['x'];
			$y2=$oy+$this->ellipse[$index2]['y'];

			imageline($this->img,$ox,$oy,$ox,$oy+$this->e,$shade);
			imageline($this->img,$x2,$y2,$x2,$y2+$this->e,$shade);
			$this->borderline($ox,$oy,$x2,$y2,0,$null,$shade);				# ligne du haut
			$this->borderline($x2,$y2+$this->e,$ox,$oy+$this->e,1,$backup2,$shade);	# ligne du bas

			if ($x2-$ox>1) imagefilltoborder($this->img,round(($ox+$x2)/2),round(($oy+$y2+$this->e)/2),$shade,$shade);
			$this->borderline($x2,$y2+$this->e,$ox,$oy+$this->e,2,$backup2);			# aa ligne du bas
		}
		return true;
	}
}

// calcul des 16 tons de gris utiles au dessin des lignes droites antialiass�es /////////////////////////

private function gupta_sproull($rgb)
{	# cette fonction cr�e une table allant de 0 � 1.5*$this->num
	$col=array();
	$numdiv2=$this->num/2;
	# calcul du volume interceptant chaque colonne, i et j parcourent un quart du c�ne
	for ($i=$this->num,$total=0;$i>=0;$i--) {
		for ($j=$this->num,$k=0,$ii=$i*$i;$j>=0;$j--) {
			$d=sqrt($ii+$j*$j);
			if ($d<$this->num) $k+=$this->num-$d;
		}
		$col[$this->num-$i]=2*$k;
		$total+=4*$k;
	}
	# calcul de la table : 1ere partie correspondant � une intersection d'�paisseur inf�rieure � 1
	$max=$this->num+$numdiv2;
	for ($i=$k=0;$i<=$this->num;$i++) {
		$k+=$col[$i];
		$this->linecolor[$max-$i]=
			imagecolorexactalpha($this->img,$rgb[0],$rgb[1],$rgb[2],round(127*(1-$k/$total)));
	}
	# calcul de la table : 2eme partie correspondant � une intersection d'�paisseur sup�rieure � 1
	for ($i=1;$i<=$numdiv2;$i++) {
		$k+=$col[$this->num-$i]-$col[$i];
		$this->linecolor[$numdiv2-$i]=
			imagecolorexactalpha($this->img,$rgb[0],$rgb[1],$rgb[2],round(127*(1-$k/$total)));
	}
}

// "allume" le pixel avec une intensit� fonction de la distance � la droite /////////////////////////////

private function plot($x,$y,$d)
{
	if ($d<0) $d=-$d;
	if ($d>1.5) return;						# rien � allumer si le pixel est trop loin
	imagesetpixel($this->img,$x,$y,$this->linecolor[round($d*$this->num)]);
}

// trac� de droite "antialiass�e" ///////////////////////////////////////////////////////////////////////

private function aaline($x1,$y1,$x2,$y2)
{
	$dx=abs($x2-$x1);
	$dy=abs($y2-$y1);
	$incj= (($x2-$x1)*($y2-$y1)>0)? 1 : -1;
	$K=1/(2*sqrt($dx*$dx+$dy*$dy));

	if ($dx>$dy) {								# tendance "horizontale"
		if ($x2>$x1) {
			$y=$y1;
			$begin=$x1;
			$end=$x2;
		}
		else {
			$y=$y2;
			$begin=$x2;
			$end=$x1;
		}

		$p=2*$dy;
		$delta=$dx;
		$incx=0;
		$incy=$incj;
		$i=&$x;
		$j=&$y;
	}
	else {										# tendance "verticale"
		if ($y2>$y1) {
			$x=$x1;
			$begin=$y1;
			$end=$y2;
		}
		else {
			$x=$x2;
			$begin=$y2;
			$end=$y1;
		}

		$p=2*$dx;
		$delta=$dy;
		$incx=$incj;
		$incy=0;
		$i=&$y;
		$j=&$x;
	}
	# tronc commun
	for ($i=$begin,$e=$p-$delta,$q=$e-$delta,$D=0,$R=2*$K*$delta;$i<=$end;$i++) {
		$this->plot($x,$y,$D);
		$this->plot($x+$incx,$y+$incy,$R-$D);
		$this->plot($x-$incx,$y-$incy,$R+$D);
		if ($e>=0) {
			$D=$K*($e-$delta);
			$j+=$incj;
			$e+=$q;
		}
		else {
			$D=$K*($e+$delta);
			$e+=$p;
		}
	}
}

// traitement de l'aa des "bordures" ///////////////////////////////////////////////////////////////////

private function borderline($x1,$y1,$x2,$y2,$mode,&$backup,$mycolor=0)
{	
	$dx=$x2-$x1;
	$dy=$y2-$y1;
	$incj= ($dx*$dy>0)? 1 : -1;
	if ($mode==1) $backup=array();
	elseif ($mode==2) $const=$dx*$y1-$dy*$x1;

	if (abs($dx)>abs($dy)) {				# tendance "horizontale"
		if ($dx>0) {
			$y=$y1;
			$begin=$x1;
			$end=$x2;
		}
		else {
			$y=$y2;
			$begin=$x2;
			$end=$x1;
		}

		$p=2*abs($dy);
		$e=$p-abs($dx);
		$q=$e-abs($dx);
		$i=&$x;
		$j=&$y;
	}
	else {										# tendance "verticale"
		if ($dy>0) {
			$x=$x1;
			$begin=$y1;
			$end=$y2;
		}
		else {
			$x=$x2;
			$begin=$y2;
			$end=$y1;
		}

		$p=2*abs($dx);
		$e=$p-abs($dy);
		$q=$e-abs($dy);
		$i=&$y;
		$j=&$x;
	}
	# tronc commun
	for ($i=$begin,$t=0;$i<=$end;$i++,$t++) {							# $mode==0 : affichage du pixel
		if ($mode==1) $backup[]=imagecolorat($this->img,$x,$y);	# $mode==1 : sauvegarde + affichage du pixel
		elseif ($mode==2) {													# $mode==2 : antialiasing du pixel
			for ($f=$x-0.2,$g1=$y-0.2,$g3=$y+0.2,$alpha=0;$f<=$x+0.2;$f+=0.2) {
				$k=$const+$dy*$f;
				for ($g=$g1;$g<=$g3;$g+=0.2) if ($dx*$g>$k) $alpha++;
			}
			$rgb=imagecolorsforindex($this->img,$backup[$t]);
			$mycolor=imagecolorexactalpha($this->img,$rgb['red'],$rgb['green'],$rgb['blue'],11*$alpha+28);
		}

		imagesetpixel($this->img,$x,$y,$mycolor);						# modes 0, 1 et 2

		if ($e>=0) {
			$j+=$incj;
			$e+=$q;
		}
		else $e+=$p;
	}
}

// trac� du camembert ///////////////////////////////////////////////////////////////////////////////////

private function aadraw($font,$fontsize,$specialcase)
{
        $tabperso1=array();
        $tabperso2=array();
	$dy=-$this->e/2;						# "centre" du camembert � celui de l'ellipse "englobante" : -40
	$d1=2*$fontsize-6;						# 8,10,12 (fontsize : 7,8,9)
	$d2=3*$fontsize-11;						# 10,13,16
	$A=$this->a*37/32;						# 1/2 grand axe de l'ellipse "englobante" : 185
	$B=$this->a*27/32;						# 1/2 petit axe de l'ellipse "englobante" : 135
	$AA=$A*$A;
	$BB=$B*$B;
	$condition=($specialcase && $this->xploded[$this->sort[$this->pivot]]);

	# "grande boucle"
	for ($i=0,$m=count($this->sort);$i<$m;$i++) {
            
            //RAJOUT PERSO POUR AFFICHAGE DES LEGENDES DANS L'ORDRE RENTRE.
            $tabperso1[$i]= $this->legend[$i];
            $tabperso2[$i]= $this->color[$i];
            
		$j=$this->sort[$i];					# indice de la portion qui va �tre trait�e

		# initialisations
		$color=$this->allocate($this->color[$j]);
		$shade=$this->allocate($this->shade[$j]);
		$v1= ($j)? $this->angle[$j-1] : 0;
		$v2=$this->angle[$j];
		$vm=($v1+$v2)/2;
		$index1=$this->index($v1);
		$index2=$this->index($v2);
		$xploded=$this->xploded[$j];
                //RAJOUT PERSO POUR EVITER LE XPLODE
		$xploded=0;
		$flag1=$flag2=0;

		if ($xploded) {
			$px=$this->a*cos(coef*$vm);
			$py=$this->b*sin(coef*$vm);
			$ox=round($this->cx+$px/6);	# $ox et $oy, coordonn�es du "centre" de la portion
			$oy=round($this->cy+$py/6);
		}
		else {
			$px=5*$this->a*cos(coef*$vm)/6;
			$py=5*$this->b*sin(coef*$vm)/6;
			$ox=$this->cx;
			$oy=$this->cy;
		}
		# d�termine les coordonn�es des 2 extr�mit�s de chaque secteur
		$x1=$ox+$this->ellipse[$index1]['x'];
		$y1=$oy+$this->ellipse[$index1]['y'];
		$x2=$ox+$this->ellipse[$index2]['x'];
		$y2=$oy+$this->ellipse[$index2]['y'];
		$gx=round($this->cx+$px);			# $gx et $gy, coordonn�es d'un point situ� sur la "bissectrice"
		$gy=round($this->cy+$py);

		# d�grad�s "paravent" vertical + antialiasing secteur du bas
		if ($v1<180) $this->fillgradient($j,$v1,$v2,$index1,$index2,$ox,$oy);

		# d�termine l'�tat (explos� ou non) des portions situ�es sur les flancs 1 et 2 de la portion en cours
		switch ($i) {			
			case $m-1:break;
			case 0:									# cas ($i==0 && $i==$m-1) d�j� �cart�
				$flag1=$this->xploded[$this->sort[$this->pivot]];
				$flag2=$this->xploded[$this->sort[($i==$this->pivot-1)? $m-1 : 1]];
				break;
			case $this->pivot-1:$flag2=$this->xploded[$this->sort[$m-1]];break;
			default:
				if ($i>=$this->pivot) $flag1=$this->xploded[$this->sort[$i+1]];	# le panneau 2 est cach�
				else $flag2=$this->xploded[$this->sort[$i+1]];							# le panneau 1 est cach�
				break;
		}
		
		# d�termine les "panneaux" lat�raux de la portion en cours � dessiner
		$panel1=(($xploded | $flag1)&& $v1>90 && $v1<270);
		# note : si ($i==$m-1), on a $flag2=0		
		$panel2=(($xploded | $flag2)&&($v2<90 ||($v2>270 &&!($specialcase && $i==$m-1))));	# ouf!
		
		# dessine les "panneaux" lat�raux
		if ($panel1) {
			imageline($this->img,$x1,$y1,$x1,$y1+$this->e,$shade);
			imageline($this->img,$ox,$oy,$ox,$oy+$this->e,$shade);
			$this->borderline($x1,$y1,$ox,$oy,0,$null,$shade);				# ligne du haut, "backup" inutile
			$this->borderline($ox,$oy+$this->e,$x1,$y1+$this->e,1,$backup1,$shade);		# ligne du bas

			if ($ox-$x1>1)
				imagefilltoborder($this->img,round(($ox+$x1)/2),round(($oy+$y1+$this->e)/2),$shade,$shade);
			$this->borderline($ox,$oy+$this->e,$x1,$y1+$this->e,2,$backup1);				# aa ligne du bas
			if ($v1<180) imageline($this->img,$x1,$y1,$x1,$y1+$this->e,$color);			# s�paration verticale
		}
		if ($panel2) {
			imageline($this->img,$ox,$oy,$ox,$oy+$this->e,$shade);
			if ($v1<180 || $v2>270) imageline($this->img,$x2,$y2,$x2,$y2+$this->e,$shade);
			$this->borderline($ox,$oy,$x2,$y2,0,$null,$shade);				# ligne du haut, "backup" inutile
			$this->borderline($x2,$y2+$this->e,$ox,$oy+$this->e,1,$backup2,$shade);		# ligne du bas
																						
			if ($x2-$ox>1) 
				imagefilltoborder($this->img,round(($ox+$x2)/2),round(($oy+$y2+$this->e)/2),$shade,$shade);
			$this->borderline($x2,$y2+$this->e,$ox,$oy+$this->e,2,$backup2);				# aa ligne du bas
			if ($v2<90) imageline($this->img,$x2,$y2,$x2,$y2+$this->e,$color);			# s�paration verticale
		}
		if ($panel1 && $panel2) imageline($this->img,$ox,$oy,$ox,$oy+$this->e,$color);# s�paration verticale

		# dessine le dessus de la portion
		for ($k=$index1,$backup0=array();$k<=$index2;$k++) {
			$xk=$ox+$this->ellipse[$k]['x'];
			$yk=$oy+$this->ellipse[$k]['y'];
			$backup0[]=imagecolorat($this->img,$xk,$yk);
			imagesetpixel($this->img,$xk,$yk,$color);
		}		
		# d�termine les conditions d'antialiasing des "rayons"
		$mode1= ($xploded || $panel1 ||($i && $i<$this->pivot)||($i==$m-1)||(!$i && $condition))? 1 : 0;
		$mode2= ($xploded || $panel2 ||($i>=$this->pivot))? 1 : 0;
		# trac� des "rayons"
		$this->borderline($ox,$oy,$x1,$y1,$mode1,$backup1,$color);				# centre -> extr�mit�
		$this->borderline($x2,$y2,$ox,$oy,$mode2,$backup2,$color);				# extr�mit� -> centre
		# "remplissage" du secteur en partant du "germe"
		imagefilltoborder($this->img,$gx,$gy,$color,$color);
		# correction du d�faut du "secteur trop �troit" (correction en-dessous de 20�)
		if ($v2-$v1<20) imageline($this->img,$ox,$oy,$gx,$gy,$color);
		# antialiasing secteur ellipse du haut
		$this->aaarc($index1,$index2,$ox,$oy,$backup0);
		# antialiasing des "rayons" du secteur elliptique						
		if ($mode1) $this->borderline($ox,$oy,$x1,$y1,2,$backup1);			
		if ($mode2) $this->borderline($x2,$y2,$ox,$oy,2,$backup2);
		
		# traitement des l�gendes
		$ka=$AA*$py*$py+$BB*$px*$px;
		$kb=$AA*$dy*$px*$py;
		$kc=$AA*$px*$px*($dy*$dy-$BB);

			$root=(-$kb+sqrt($kb*$kb-$ka*$kc))/$ka;
			$qx=round($this->cx+$root);
			$qy=round($this->cy+$root*$py/$px);

			//$this->aaline($gx,$gy,$qx,$qy);
			//$this->aaline($qx+1,$qy,$qx+$d1,$qy);
			//echo $color;
//			imagefilledrectangle($this->img, 5, 210-$fontsize+$y, 15, 210-$fontsize+$y+9, $color); # petit carre de couleur
//			//imagestring($this->img, 2, $x+15, $y-2, $this->tabNom[$i]. ' ('.$this->tabVal[$i].' soit '.round(($this->tabVal[$i] * 100) / $this->tot,1).'%)', $noir); # texte
//			$taille=75;
//                        if(strlen($this->legend[$j])<$taille){
//                        imagettftext($this->img,$fontsize,0,20,218-$fontsize+$y,$this->textcolor,$font,
//				$this->legend[$j]);
//			//imagettftext($this->img,$fontsize,0,40,200+1+$fontsize+$y,$this->textcolor,$font,
//				//$this->value[$j]);
//				$y+=15;
//                        }else{
//                            $chaine = $this->legend[$j];
//                            $lg_max = $taille; //nombre de caract�res autoris�
//                            $chaine = substr($chaine, 0, $lg_max);
//                            $last_space = strrpos($chaine, " ");
//                            $debut = substr($chaine, 0, $last_space);
//                            $fin=substr($this->legend[$j], $last_space);
////                            $debut=substr($this->legend[$j], 0, 70);
////                            $fin=substr($this->legend[$j], 70);
//                            imagettftext($this->img,$fontsize,0,20,218-$fontsize+$y,$this->textcolor,$font,
//			    $debut);
//                            $y+=15;
//                            imagettftext($this->img,$fontsize,0,20,218-$fontsize+$y,$this->textcolor,$font,
//                            $fin);
//                            $y+=15;
//                        }
				$total+=$this->value[$j];
	}
        //PERMET D'AFFICHER LES LEGENDES DANS L'ORDRE RENTRE
        $k=0;
        foreach ($tabperso1 as $value) {
            $color=$this->allocate($tabperso2[$k]);
            imagefilledrectangle($this->img, 5, 210-$fontsize+$y, 15, 210-$fontsize+$y+9, $color); # petit carre de couleur
            $taille=75;
                        if(strlen($value)<$taille){
                        imagettftext($this->img,$fontsize,0,20,218-$fontsize+$y,$this->textcolor,$font,
				$value);
			//imagettftext($this->img,$fontsize,0,40,200+1+$fontsize+$y,$this->textcolor,$font,
				//$this->value[$j]);
				$y+=15;
                        }else{
                            $chaine = $value;
                            $lg_max = $taille; //nombre de caract�res autoris�
                            $chaine = substr($chaine, 0, $lg_max);
                            $last_space = strrpos($chaine, " ");
                            $debut = substr($chaine, 0, $last_space);
                            $fin=substr($value, $last_space);
                            imagettftext($this->img,$fontsize,0,20,218-$fontsize+$y,$this->textcolor,$font,
			    $debut);
                            $y+=15;
                            imagettftext($this->img,$fontsize,0,20,218-$fontsize+$y,$this->textcolor,$font,
                            $fin);
                            $y+=15;
                        }
                        $k++;
        }
	imagettftext($this->img,$fontsize,0,20,218-$fontsize+$y+15,863255,$font,
				"Nombre d'incidents total: ".$total);
}

// traitement des parties verticales courbes du camembert //////////////////////////////////////////////
				
private function fillgradient($j,$v1,$v2,$index1,$index2,$ox,$oy)	
{
	$grease=90;						# quantit� � soustraire des couleurs du tableau pour les assombrir
	$n=$this->b*9/8;				# choisir 9/8 > 1 pour que le d�grad� le + clair soit + fonc� que color
	$backup=array();
	$gradient=array();
	
	list($r2,$g2,$b2)=$this->hex2rgb($this->color[$j]);
	$r1=max(0,$r2-$grease);
	$g1=max(0,$g2-$grease);
	$b1=max(0,$b2-$grease);
		
	$incr=($r2-$r1)/$n;
	$incg=($g2-$g1)/$n;
	$incb=($b2-$b1)/$n;
	
	$end= ($v2<180)? $index2 : 2*$this->quarter;			# le traitement s'arr�te � 180�
	# calcul des d�grad�s utilis�s et sauvegarde de la couleur du point du secteur elliptique
	for ($k=$index1,$const=$oy+$this->e;$k<=$end;$k++) {
		$y=$this->ellipse[$k]['y'];	
		if (!isset($gradient[$y])) 	# l'intensit� du d�grad� est fonction de l'ordonn�e de l'ellipse
			$gradient[$y]=imagecolorallocate($this->img,$r1+$incr*$y,$g1+$incg*$y,$b1+$incb*$y);
		$backup[]=imagecolorat($this->img,$ox+$this->ellipse[$k]['x'],$y+$const);
	}
	# 3 cas de figures � envisager pour que les d�grad�s soient correctement rendus
	if ($v2<=90) for ($k=$index1;$k<=$end;$k++) {		# portion � "droite" : trac�s de droite � gauche
		$xk=$ox+$this->ellipse[$k]['x'];
		$y=$this->ellipse[$k]['y'];
		$yk=$oy+$y;
		imageline($this->img,$xk,$yk,$xk,$yk+$this->e,$gradient[$y]);				
	}
	else if ($v1>=90) for ($k=$end;$k>=$index1;$k--) {	# portion � "gauche" : trac�s de gauche � droite
		$xk=$ox+$this->ellipse[$k]['x'];
		$y=$this->ellipse[$k]['y'];
		$yk=$oy+$y;
		imageline($this->img,$xk,$yk,$xk,$yk+$this->e,$gradient[$y]);				
	}	
	else {	# cas de la portion "� cheval" sur 90� -> d�composition des trac�s en 2 boucles
		for ($k=$index1,$oldy=-1;$k<=$end;$k++,$oldy=$y) {
			$y=$this->ellipse[$k]['y'];
			if ($y==$oldy) break;
			$yk=$oy+$y;
			$xk=$ox+$this->ellipse[$k]['x'];
			imageline($this->img,$xk,$yk,$xk,$yk+$this->e,$gradient[$y]);				
		}
		
		for ($gpoint=$k,$k=$end;$k>=$gpoint;$k--) {
			$xk=$ox+$this->ellipse[$k]['x'];
			$y=$this->ellipse[$k]['y'];
			$yk=$oy+$y;
			imageline($this->img,$xk,$yk,$xk,$yk+$this->e,$gradient[$y]);				
		}
	}
	
	# antialising du secteur elliptique	
	$this->aaarc($index1,$end,$ox,$oy+$this->e,$backup);
}

// antialiasing d'un secteur elliptique /////////////////////////////////////////////////////////////////

private function aaarc($begin,$end,$dx,$dy,&$backup)
{	# note : �� marche tr�s bien aussi avec "$this->hex2rgb" � la place de "imagecolorsforindex"
	for ($j=$begin,$i=0;$j<=$end;$j++,$i++) {
		$rgb=imagecolorsforindex($this->img,$backup[$i]);
		$mix=imagecolorexactalpha($this->img,$rgb['red'],$rgb['green'],$rgb['blue'],$this->ellipse[$j]['alpha']);
		imagesetpixel($this->img,$dx+$this->ellipse[$j]['x'],$dy+$this->ellipse[$j]['y'],$mix);
	}
}

// calcul de la transparence du point, int�gration de l'enregistrement au tableau ///////////////////////

private function add($x,$y)
{	# 9 �chantillons sont suffisants
	for ($f=$x-0.2,$g1=$y-0.2,$g3=$y+0.2,$alpha=0;$f<=$x+0.2;$f+=0.2) {
		$k=$this->aabb-$this->bb*$f*$f;
		for ($g=$g1;$g<=$g3;$g+=0.2) if ($this->aa*$g*$g<$k) $alpha++;
	}
	return array('x'=>$x,'y'=>$y,'alpha'=>11*$alpha+28);
}

// calcul d'un quart de l'ellipse, g�n�ralisation � l'ellipse enti�re ///////////////////////////////////

private function aaellipse()
{
	$temp=array();

	for ($x=0,$y=$this->b,$e=4*$this->bb+$this->aa*(1-4*$y);$this->bb*$x<$this->aa*$y;$x++) {
		$temp[2][]=$this->add($x,$y);		# octant n�2
		$e+= ($e<0)? $this->bb*(8*$x+12) : $this->bb*(8*$x+12)+8*$this->aa*(1-$y--);
	}

	for ($x=$this->a,$y=0,$e=4*$this->aa+$this->bb*(1-4*$x);$this->aa*$y<$this->bb*$x;$y++) {
		$temp[1][]=$this->add($x,$y);		# octant n� 1
		$e+= ($e<0)? $this->aa*(8*$y+12) : $this->aa*(8*$y+12)+8*$this->bb*(1-$x--);
	}
	
	# on remet tout dans l'ordre qui convient
	$this->ellipse=array_merge($temp[1],array_reverse($temp[2]));
	
	# g�n�ralisation aux 3 autres quadrants
	for ($i=0,$n=count($this->ellipse),$p=2*$n-2,$q=4*$n-4;$i<$n;$i++) {
		$x=$this->ellipse[$i]['x'];
		$y=$this->ellipse[$i]['y'];
		$alpha=$this->ellipse[$i]['alpha'];
		$this->ellipse[$p-$i]=array('x'=>-$x,'y'=>$y,'alpha'=>$alpha);
		$this->ellipse[$p+$i]=array('x'=>-$x,'y'=>-$y,'alpha'=>$alpha);
		$this->ellipse[$q-$i]=array('x'=>$x,'y'=>-$y,'alpha'=>$alpha);
	}
	
	$this->quarter=(count($this->ellipse)-1)/4;
}

// alloue une couleur ///////////////////////////////////////////////////////////////////////////////////

protected function allocate($hex)
{
	list($red,$green,$blue)=$this->hex2rgb($hex);
	return imagecolorallocate($this->img,$red,$green,$blue);
}

// "splite" une couleur en ses 3 composantes ////////////////////////////////////////////////////////////

protected function hex2rgb($hex)
{
	return array(($hex>>16)& 0xFF,($hex>>8)& 0xFF,$hex & 0xFF);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

abstract protected function mybackground($width,$height,$bg1,$bg2=0);

/////////////////////////////////////////////////////////////////////////////////////////////////////////

}

#########################################################################################################

class aabasic extends smooth3dcamembert
{

/////////////////////////////////////////////////////////////////////////////////////////////////////////

protected function mybackground($width,$height,$bg1,$bg2=0)
{	
	imagefill($this->img,0,0,$this->allocate($bg1));	# $width et $height ici inutiles!
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

}

#########################################################################################################

class aagradient extends smooth3dcamembert
{	# note : certains d�grad�s exigent, pour �tre affich�s correctement, 24 bits de couleur 

/////////////////////////////////////////////////////////////////////////////////////////////////////////

function __construct($title,$str,$size,$ajax,$bg1,$bg2)
{
	if (!isset($bg2)) throw new Exception('Argument "bg2" attendu...');
	parent::__construct($title,$str,$size,$ajax,$bg1,$bg2);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

protected function mybackground($width,$height,$bg1,$bg2=0)
{
	$w=$width-1;
	$h=$height-1;

	list($r1,$g1,$b1)=$this->hex2rgb($bg1);
	list($r2,$g2,$b2)=$this->hex2rgb($bg2);
	$incr=($r2-$r1)/$h;
	$incg=($g2-$g1)/$h;
	$incb=($b2-$b1)/$h;
														# approximations �quivalentes � "floor()"
	for ($j=0;$j<=$h;$j++,$r1+=$incr,$g1+=$incg,$b1+=$incb) 
		imageline($this->img,0,$j,$w,$j,imagecolorallocate($this->img,$r1,$g1,$b1));
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////	

}

#########################################################################################################

class aaimage extends smooth3dcamembert
{

/////////////////////////////////////////////////////////////////////////////////////////////////////////	

protected function mybackground($width,$height,$bg1,$bg2=0)
{														# formats support�s : gif, png, jpg
	$foo=array('gif'=>'imagecreatefromgif','png'=>'imagecreatefrompng','jpg'=>'imagecreatefromjpeg');

	$bgimage=$foo[strtolower(substr(strrchr($bg1,'.'),1))]($bg1);
	imagecopy($this->img,$bgimage,0,0,0,0,$width,$height);
	imagedestroy($bgimage);						# avec size 1 et size 2, l'image est tronqu�e,...
}														# le redimensionnement n'�tant pas pr�vu

/////////////////////////////////////////////////////////////////////////////////////////////////////////

}

#########################################################################################################

if (isset($_GET['class'])) $class=$_GET['class'];
else die('@Argument "class" attendu...');	# caract�re de signalisation d'erreur : @

$title=$_GET['title'];
$str=$_GET['str'];
$size=$_GET['size'];
$ajax=$_GET['ajax'];
$bg1=$_GET['bg1'];
$bg2=$_GET['bg2'];

try {
	switch ($class) {
		case 'aabasic':	$aabasic=new aabasic($title,$str,$size,$ajax,$bg1);break;
		case 'aagradient':$aagradient=new aagradient($title,$str,$size,$ajax,$bg1,$bg2);break;
		case 'aaimage':	$aaimage=new aaimage($title,$str,$size,$ajax,$bg1);break;
	}
}
catch (Exception $e) {			
	echo '@',$e->getMessage();					# ce message n'apparait qu'en cas de transmission avec "ajax"
}
?>