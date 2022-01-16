<?php

//betadan indexe aktarırken kolaylık olsun diye $klk argumanı kullanalım
$klk='index';//bunu index yapman yeterli aktarırken
// renkleri ayarla
include("renkler.php");
$renkd=$renk2;

?>
<html>

<head>
<title>Hayatı Önde Keşfedin</title>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<meta charset="UTF-8"> 
<?php include($klk."/info1.php") ?>
<link rel="stylesheet" href="css/style.css">
<script src="js/slider.js" type="text/javascript"></script>
<link rel="shortcut icon" href="/unnamed.ico" type="image/x-icon" >
<style>
#slider {
    width:700px;
    height:306px;
    }	
    
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
    position: fixed;
    top: 0;
  width: 100%;
  height: 30px;
}



.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 5px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 3px;
  margin-top: 2px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 3px;
  margin-top: 2px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

.flex-container {
  display: flex;
  flex-wrap: wrap;
  background-color: <?php echo $renk3;?>;
}

.flex-container > div {
  background-color: <?php echo $renk2;?>;
  width: 213px;
  margin: 10px;
  text-align: left;
  line-height: 32px;
  font-size: 16px;
}

</style>
</head>

<body background="resimler/fon/b6.jpg">

<div class="topnav">
  <a class="active" href="index.php">Ana Sayfa</a>
  <a href="elek.php">Elek</a> 
  <a href="about.php">Hakkımızda</a>
  <a href="yeni.php?T=contact">İletişim</a>

  <div class="search-container">
    <form action="/action_page.php">
      <input type="text" placeholder="Search.." name="search">
      <button name="form1" type="submit">Submit</button>
    </form>
  </div>
</div>


 <table border="0" width="100%">
<tr align="center">  
 <td>

<?php if ($klk=='beta') echo '<br><br><font face="Tahoma" color="maroon" size="2">&nbsp;&nbsp;Uyarıyoruz: Beta sürümümüz düzgün çalışmayabilir. Karşılaştığınız sorunları, fikirlerinizi, tavsiyelerinizi, olumlu olumsuz her türlü görüş ve düşüncelerinizi <a href="/yeni.php?T=contact">bize yazabilirsiniz.</a> İlginizden dolayı teşekkürler.</font><br>'; 

include("conn.php");


if (isset($_GET['sil']))
{	setcookie("harman",'');
	echo '<meta http-equiv="refresh" content="0;URL=/'.$klk.'.php?page='.$_GET["page"].'">';
}

$vi='';$a='';$t='';$b='';
if (isset($_GET['sir'])) {
if ( $_GET["sir"]=='Tamam'){

  $a='SELECT Id FROM words WHERE filter  LIKE \'%.'.$_GET["list"].'.%\' ORDER BY RAND()';

$t=$a;
	$sorgu = $db->query("$t ");
		if($sorgu->rowCount() > 0) {
			$kullanicilar = $sorgu->fetchAll();
		foreach($kullanicilar as $kullanici) { $vi=$vi .'.'.$kullanici["Id"];  }
		}else {
			echo "Hiç Veri Bulunamadı.";exit;
		}		

//-------------------------------------------------çerez kayıt
setcookie("harman", $vi.'.');//echo $_GET["b"];exit;
setcookie("baslik", $_GET["b"]);


echo '<meta http-equiv="refresh" content="0;URL=/'.$klk.'.php">';
}}



if (isset($_GET['aks'])) {
if ( $_GET["aks"]=='Harmanla'){
	//

	if (isset($_GET['d1'])) {if ( $_GET["d1"]=='1')
    {$a='SELECT Id FROM words WHERE pattern  LIKE \'0%\' OR pattern  LIKE \'1%\' UNION'.' '.$a; $b="Tek sesli sözcükler"; 
    }}
	
  if (isset($_GET['d2'])) {if ( $_GET["d2"]=='2')
    {$a='SELECT Id FROM words WHERE pattern  LIKE \'2%\' OR pattern  LIKE \'3%\' UNION'.' '.$a; $b="İki sesli sözcükler";
    }}
	
  if (isset($_GET['d3'])) {if ( $_GET["d3"]=='3')
    {$a='SELECT Id FROM words WHERE pattern  LIKE \'4%\' OR pattern  LIKE \'5%\' OR pattern  LIKE \'6%\' OR pattern  LIKE \'7%\' UNION'.' '.$a;$b="Üç sesli sözcükler"; 
    }}
	
  if (isset($_GET['d4'])) {if ( $_GET["d4"]=='4')
    {$a='SELECT Id FROM words WHERE pattern  LIKE \'8%\'  UNION'.' '.$a; $b="Dört sesli sözcükler";
    }}

	
  if (isset($_GET['d5'])) {if ( $_GET["d5"]=='5')
    {$a='SELECT Id FROM words WHERE Id BETWEEN 262 AND 328 UNION'.' '.$a; $b="Okunmayan harfi olan sözcükler";
    }}
	
  if (isset($_GET['d6'])) {if ( $_GET["d6"]=='6')
    {$a='SELECT Id FROM words WHERE turtel  LIKE \'%θ%\' OR turtel LIKE \'%δ%\'  UNION'.' '.$a;$b="İki tür TH okunuşu";
    }}
	
  if (isset($_GET['d7'])) {if ( $_GET["d7"]=='7')
    {$a='SELECT Id FROM words WHERE Id BETWEEN 361 AND 392 UNION'.' '.$a; $b="W, V benzer sesli sözcükler"; 
    }}
	
  if (isset($_GET['d8'])) {if ( $_GET["d8"]=='8')
    {$a='SELECT Id FROM words WHERE Id BETWEEN 393 AND 414 UNION'.' '.$a; $b="'oo' kısa uzun okunan sözcükler";  
    }}
	

	if ($a) {$t = substr($a, 0, -7).' '.'ORDER BY RAND()';}
	$sorgu = $db->query("$t ");
		if($sorgu->rowCount() > 0) {
			$kullanicilar = $sorgu->fetchAll();
		foreach($kullanicilar as $kullanici) { $vi=$vi .'.'.$kullanici["Id"];  }
		}else {
			echo "Hiç Veri Bulunamadı.";exit;
		}		
	
//-------------------------------------------------çerez kayıt
setcookie("harman", $vi.'.');
setcookie("baslik", $b);
echo '<meta http-equiv="refresh" content="0;URL=/'.$klk.'.php">';
}
}

if (isset($_GET['aks2'])) {
if ( $_GET["aks2"]=='Hepsini Harmanla'){

$t ='SELECT Id FROM words ORDER BY RAND()';$b='Tüm Sözcükler';
	$sorgu = $db->query("$t ");
		if($sorgu->rowCount() > 0) {
			$kullanicilar = $sorgu->fetchAll();
		foreach($kullanicilar as $kullanici) { $vi=$vi .'.'.$kullanici["Id"];  }
		}else {
			echo "Hiç Veri Bulunamadı.";exit;
		}		
	
//-------------------------------------------------çerez kayıt
setcookie("harman", $vi.'.');
setcookie("baslik", $b);
echo '<meta http-equiv="refresh" content="0;URL=/'.$klk.'.php">';
}}


//buraya out işlemi yapalım
if (isset($_GET['out']))
{
$cim=".".$_GET["out"].".";
$cime=$_COOKIE["harman"];
$parcala = explode($cim, $cime);
	//if($parcala[0])
$yeni=$parcala[0].'.'.$parcala[1];
//echo 'öncesi'.$_COOKIE["harman"].'<br>anahtar'.$cim.'<br>sonrası'.$yeni;
//*********
setcookie("harman", $yeni);
echo '<meta http-equiv="refresh" content="0;URL=/'.$klk.'.php?page='.$_GET["page"].'">';
}
 include($klk."/info2.php");
 include($klk."/info3.php");
?>

<?php
if(isset($_COOKIE["harman"])){ 

$cook= $_COOKIE["harman"];
$cook=substr($cook, 0, -1);  
                                                                                                                                                                                                 

if(isset($_GET["page"])){ $simdi=$_GET["page"];}else{ $simdi=1;}

$r=1; 
$i=0; 
$ii=($simdi-1)*12;
//şimdi burada olayı çözeceğiz inşallah
$kayiphatasi =substr_count($cook, '.')-$ii;
//echo $ii.'ya '.substr_count($cook, '.').'tehlikeli sayı bir'.$kayiphatasi;//ve problem çözülmüştür arkadaşlar
if(($kayiphatasi==0)and($cook)) {
//$ii=-1+($simdi-2)*12;
  
?>
	<meta http-equiv="refresh" content="1; URL=/<?php echo $klk; ?>.php?page=<?php echo $simdi-1;?>">
<?php
}
} else {?>
<table border="1" width="90%" style="border-width: 0px">
	<tr>
		<td style="border-style: none; border-width: medium">

<p><span style="font-weight: 400"><font size="8" face="Tahoma" color="#800000">Merhaba!</font></span><br><br>
<font size="4" face="Tahoma" color="#800000">Yukarıda, Konu anlatımı veya alıştırmalar menüsünden 
istediğiniz bölümü seçerek çalışma listesi oluşturabilirsiniz. <br>Ayrıntılı bilgi için S.S.S (Sık Sorulan Sorular) menüsünden 'Nasıl Çalışmalıyım' bölümünü inceleyebilirsiniz.</font></p><br>
<div class="flex-container">
<table border="1" width="100%" style="border-width: 0px" cellspacing="4">
	<tr>
		<td style="border-style: none; border-width: medium">
<p align="justify"><font face="Tahoma" color="#800000">Bu sitede çerezler (cookies, bir çeşit 
kayıt deposu) kullanılmıştır. Devam eden kullanıcılarımız çerez 
kullanımını onayladığı anlamına gelir. Bu uyarı sadece bilgilendirme amaçlı olup hiç bir şekilde 3. kişilerle paylaşılmamaktadır. Çerez kayıtlarına, interaktif bir site yapabilmek için ihtiyaç duyduk. Diğer türlü login işlemi yapmak zorunda kalacaktık. Böylece bilgileriniz sadece sizin bilgisayarınızda tutulmuş olacaktır.</font></p>
</td>
	</tr>
</table>
</div>
</td>
	</tr>
</table>
<?php
exit;}
?> 

 <table border="0" width="90%" cellspacing="1" cellpadding="2">
<tr height="80" align="center"  valign="middle">  
 <td colspan="8">&nbsp;<img src="pattern.jpg" alt=""/></td></tr>
<tr height="10" align="left"  valign="middle">  
 <td colspan="8">&nbsp;<b><?php echo $_COOKIE["baslik"];?></b></td></tr>
<tr bgcolor="<?php echo $renk1;?>" align="center">
 <td><b><font face="Palatino Linotype" color="#FFFFFF">n.[sil] </font></b>
 </td><td width="12%"><b><font face="Palatino Linotype" color="#FFFFFF">kelime
	</font></b>
 </td><td width="5%"><b><font face="Palatino Linotype" color="#FFFFFF">link_1
	</font></b>
 </td><td width="5%"><b><font face="Palatino Linotype" color="#FFFFFF">link_2
	</font></b>
 </td><td width="5%"><b><font face="Palatino Linotype" color="#FFFFFF">link_3
	</font></b>
 </td><td width="5%"><b><font face="Palatino Linotype" color="#FFFFFF">link_4
	</font></b>
 </td><td width="40%"><b><font face="Palatino Linotype" color="#FFFFFF">açıklamalar
	</font></b>
 </td><td  width="8%"><b><font face="Palatino Linotype" color="#FFFFFF">link_5<sup>(new)</sup>
	</font></b>
 </td>
<?php
$dizi = explode (".",$cook);   

                                                                                                                                                                                  
foreach($dizi as $d) {



if($i > $ii && $i <=($ii+12)) {
   
                      $r=$r+1;                                                                                                                                                         
	

	$kullanici = $db->query("SELECT * FROM words where Id='$d'")->fetch(); 
                                                                                                                                  
?></tr>
<tr bgcolor="<?php echo $renkd;?>" align="center"> 
<td  width="5%">
<?php 
echo '<font face="Tahoma" color="maroon" size="3"  title="'.$d.'">'.$i.'&nbsp;</font>'; 
echo '<a title="Klikleyerek '.$i.'.satırı silebilirsiniz !!!" href="/'.$klk.'.php?page='.$simdi.'&out='.$d.'">[&#x2714;]</a>';
?>                                                                                                                                                       
	</td>
<td>
<font face="Tahoma" color="maroon" size="3" title="<?php echo $kullanici["turtel"].' : '.$kullanici["pattern"].'   
		           ('.$kullanici["anlami"].')'; ?>">
<?php echo $kullanici["asli"];?>
<font face="Tahoma" color="maroon" size="2">
<?php if ($kullanici["tur"]=='.'){}else{echo ' <sup>['.$kullanici["tur"].']</sup>';}  ?>
</font></font>
  </td><td> 
<font face="Tahoma" color="maroon" size="2" >  
<a href="https://www.dictionary.com/browse/<?php echo $kullanici["asli"]; ?>" target="_blank">dictionary</a>
</font>
</td><td>
<font face="Tahoma" color="maroon" size="2" >
<?php if(strstr($kullanici["tur"],"*")){ 
?>
<a href="https://www.google.com/search?q=<?php echo $kullanici["asli"]; ?>+pronunciation" target="_blank">find</a>
<?php }else{
?>
<a href="https://www.google.com/search?q=<?php echo $kullanici["asli"]; ?>+pronunciation" target="_blank">practice</a>
<?php }
?>
</font>                                                        
  </td><td> 
<font face="Tahoma" color="maroon" size="2" >  
<a href="https://youglish.com/pronounce/<?php echo $kullanici["asli"]; ?>/english?" target="_blank">youglish</a>
</font>
</td><td> 
<font face="Tahoma" color="maroon" size="2" > 
 
<a href="https://translate.google.com.tr/?sl=en&tl=tr&text=<?php echo $kullanici["asli"]; ?>&op=translate" target="_blank">tr_translate</a>
</font>
</td><td>

<?php include($klk."/aciklama.php");
?>

</td><td  width="8%">
  <?php if(isset($kullanici["dls_link"])){?>
  <font face="Tahoma" color="maroon" size="3" >  
<a href="/elek.php?orn=<?php echo $kullanici["Id"]; ?>&dil=enod" target="_blank">dls</a>
</font>
<?php }?>
</td>
</tr>                                                                                                                                                                                                   
  <?php
if ($renkd==$renk2) $renkd=$renk3; else $renkd=$renk2;                                                                                                                                                                                                       
}$i++;

}
                                                                                                                                                                                                       
?> 
<tr bgcolor="#FFFFFF" height="80" align="center"  valign="middle">  
 <td colspan="30">

 
<?php 
if ($r) {$i=$i-1;
//echo '&nbsp;&nbsp;sayfa '.$simdi.'\'desiniz.&nbsp;';
echo '&nbsp;&nbsp;';
//--------------------------------------------------- sayfa sayıları girilecek
$sayfasayisi=ceil($i/12);//echo '<p>'.$sayfasayisi.'/'.$i.'<p>';
$sayi=1;
while($sayi<=$sayfasayisi){
	if ($sayi==$simdi) {echo '<b>&nbsp;>>';}
echo '<a href="/'.$klk.'.php?page='.$sayi.'">[s.-'.$sayi.']</a>';
	if ($sayi==$simdi) {echo '<<</b>&nbsp;';}
   $sayi++;
}
echo '<font face="Tahoma" color="maroon" size="3"><br>&nbsp;&nbsp;(... toplam '.$i.' kelime seçtiniz.)</font>';
//---------------------------------------------------
}
//$sorgu->close();
//$baglanti->close();
?> 
</td></tr>
</table>
<br>
<br><br>
</td></tr>
</table>
</body>
</html>
