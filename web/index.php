<?php
ob_start(); 

/* filtrowanie zmiennych */
foreach($_GET as $k=>$v)
    $get[$k] = (preg_match("/[0-9a-z_]+/",$v) ? stripslashes(htmlspecialchars(strip_tags($v))): '');

/* koniec filtrowania zmiennych */


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>BLUEROSE najlepsza mafijna bojówka</title>
	<link rel="Stylesheet" type="text/css" href="style.css" />

</head>

<body>
	<center>
	<div id= "content">
		<div id="logo1">
		</div>
		<div id="logo2">
		</div>		
		<div id="menu">			
			<ul>
			<li><a href="index.php?strona=statystyki">Statystyki</a></li>
			<li><a href="index.php?strona=zbiorki">Zbiórki</a></li>
			<li><a href="index.php?strona=ranking">Ranking</a></li>			
			<li><a href="index.php?strona=partia">Partia</a></li>
			<li><a href="index.php?strona=dolacz">Dołącz do nas</a></li>
			<li><a href="index.php?strona=dof">Dofinansowanie</a></li>
			<li><a href="index.php?strona=download">Do pobrania</a></li>			
			<li><a href="index.php?strona=funrose">Strefa FUNrose</a></li>
			<li><a href="#">LOGOWANIE</a></li>
			</ul>
		</div>
		
		
		<div id="prawa_strona">
			<!-- Tutaj jest wstawiana treść z plików zewnętrznych -->
			<?php 
	
			if(isset($get) and file_exists('./dane/'.$get['strona'].'.html') ){
			include'./dane/'.$get['strona'].'.html'; 			
			}else{
		    include"./dane/home.html";
			}
	
	
	
			?>
		</div> 
		
    
	<div class="both"></div>
	<div id="stopka">
	Copyright @BLUEROSE
</div>


</body>
</html>
<?php  ob_end_flush(); ?> 
