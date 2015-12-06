<?php 
require 'connectdb_monograph.php'; 
session_start();
mysqli_query($link,"SET NAMES utf8");
?>



<HTML>
<HEAD>

<style type="text/css">
<!--
body {
	background-color: #666666;
}

td { font-size: 10pt; }

a:link, a:visited {
color: #666666;
text-decoration: none;
}

a:active, a:hover {
color: #FF3333;
text-decoration: underline;
}

.title {
	background-color: #FFCC00;
	font-size: 12pt;
	font-weight: bold;
}

.style13 {
	font-weight: bold;
	font-size: 10pt;
	color: #333333;
}
.style15 {font-size: 10pt}
.style20 {color: #333333}
.style21 {color: #FFFFFF}
.style23 {
	font-size: 10pt;
	font-weight: bold;
	color: #FFFFFF;
}
.style25 {color: #000000}

.subtitle {
	background-image: url(./image/bg_subtitle.gif);
	color: #FFFFFF;
	font-weight: bold;
	height: 35px;
	letter-spacing: 5px;
	padding-top: 10px;
	text-align: center;
}

/* 最新消息 */
.newstr1 {
	background-color: #F2F2F2;
}
.newstr2 {
	background-color: #FFFFFF;
}
.newsdate {
	border-bottom: #CCCCCC 1px solid;
	color: #3399CC;
	font-family: Arial;
	text-align: center;
	width: 100px;
}
.news {
	border-bottom: #CCCCCC 1px solid;
	height: 25px;
	width: 400px;
}
.news div {
	float: left;
	padding-right: 6px;
}
.newsmore {
	background-color: #D9D9D9;
	height: 25px;
	padding-right: 15px;
	text-align: right;
}

/* 功能選單 */
.menu {
	height: 75px;
}

/* 關於網頁 */
.about {
	border-bottom: #CCCCCC 1px solid;
	color: #006699;
	height: 40px;
	text-align: center;
}
.copyright {
	background-color: #D9D9D9;
	color: #999999;
	font-family: Arial;
	height: 25px;
	text-align: center;
}
-->
</style>
<title>國立高雄第一科技大學資訊管理系專題檢索系統</title><BODY>
<?php
   
  $SQL = "Select N_ID from announce"; //針對DATE部份做處理
  $datalist=mysqli_query($link,$SQL);    
  $fieldnum=mysqli_num_fields($datalist); //有幾個欄位   
  $y=0;//另一註標給陣列year_field與month_field用
  $nid_field=array();//定義另一空陣列記錄年度$year_field 
  
  while ($fielddatas=mysqli_fetch_array($datalist))//輸出欄位資料
  {   
   for ($x=0;$x<$fieldnum;$x++)//輸出欄位資料 
   {
    $nid_field[$y]=$fielddatas[$x]; //取年度使用substr函數 	
	$y++;
   } 
  }		  
  

//排序程式
usort($nid_field, 'cmp');//排序函數連到cmp排序函數

function cmp($a,$b) //自訂排序函數cmp
{
if ($a == $b) return 0;
return ($a > $b) ? -1 : 1; //用 > 是大到小排序
}

$ntitle_field=array();//定義另一空陣列記錄年度$year_field 
$date_field=array();
for($x=0;$x<=4;$x++)
{
	$sql_list="select N_ID,N_TITLE,DATE from announce where N_ID='$nid_field[$x]'";
	$title_list=mysqli_query($link,$sql_list);    
	while($row=mysqli_fetch_array($title_list)){
		$id_field[$x]=$row['N_ID'];
		$ntitle_field[$x]=$row['N_TITLE'];
		$date_field[$x]=$row['DATE'];
	}
}

function hotnews($newsdate) {
$nowdate = getdate();
$newsmon = (substr($newsdate,0,4) - 2000) * 12 + substr($newsdate,5,2);
$nowmon = ($nowdate['year'] - 2000) * 12 + $nowdate['mon'];
if(($nowmon - $newsmon) < 1)
	echo '<div><img src="./image/hotnews.gif"></div>';
if(!$newsdate)
	echo '&nbsp;';
}
?>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="282" rowspan="8" class="title">
      <p align="center">國立高雄第一科技大學</p>
      <p align="center">資訊管理系</p>
      <p align="center">專題檢索系統</p>
  	</td>
    <td width="9" rowspan="13">&nbsp;</td>
    <td width="500" height="20" colspan="2"><div align="center"><a href="zzzzz/index_admin.php"><img src="./image/up_.jpg" width="374" height="20" border="0"></a></div></td>
    <td width="9" rowspan="13">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="subtitle">~最新消息~</td>
  </tr>
  <tr class="newstr1">
    <td class="newsdate"><?php if($date_field[0]) echo  substr($date_field[0],0,10); else echo '&nbsp;' ?></td>
    <td class="news"><?php hotnews($date_field[0]); ?><div><a href="./announce/announce_content_choice.php?id=<?php echo $id_field[0]; ?>" target="_blank"><?php echo $ntitle_field[0]; ?></a></div></td>
  </tr>
  <tr class="newstr2">
    <td class="newsdate"><?php if($date_field[1]) echo  substr($date_field[1],0,10); else echo '&nbsp;' ?></td>
    <td class="news"><?php hotnews($date_field[1]); ?><div><a href="./announce/announce_content_choice.php?id=<?php echo $id_field[1]; ?>" target="_blank"><?php echo $ntitle_field[1]; ?></a></div></td>
  </tr>
  <tr class="newstr1">
    <td class="newsdate"><?php if($date_field[2]) echo  substr($date_field[2],0,10); else echo '&nbsp;' ?></td>
    <td class="news"><?php hotnews($date_field[2]); ?><div><a href="./announce/announce_content_choice.php?id=<?php echo $id_field[2]; ?>" target="_blank"><?php echo $ntitle_field[2]; ?></a></div></td>
  </tr>
  <tr class="newstr2">
    <td class="newsdate"><?php if($date_field[3]) echo  substr($date_field[3],0,10); else echo '&nbsp;' ?></td>
    <td class="news"><?php hotnews($date_field[3]); ?><div><a href="./announce/announce_content_choice.php?id=<?php echo $id_field[3]; ?>" target="_blank"><?php echo $ntitle_field[3]; ?></a></div></td>
  </tr>
  <tr class="newstr1">
    <td class="newsdate"><?php if($date_field[4]) echo  substr($date_field[4],0,10); else echo '&nbsp;' ?></td>
    <td class="news"><?php hotnews($date_field[4]); ?><div><a href="./announce/announce_content_choice.php?id=<?php echo $id_field[4]; ?>" target="_blank"><?php echo $ntitle_field[4]; ?></a></div></td>
  </tr>
  <tr>
    <td colspan="2" class="newsmore">》<a href="announce/announce_content_all.php" target="_blank">更多消息</a></td>
  </tr>
  <tr>
    <td height="215" rowspan="5"><img src="./image/le_.jpg" width="282" height="215"></td>
    <td colspan="2" class="subtitle">~功能選單~</td>
  </tr>
  <tr class="newstr1">
    <td colspan="2" class="menu">
	<?php if (@$_SESSION["user-checkok"]=="yes"){ ?>            
		    <div align="center">
		    	<span class="style15">
			 	<a href="./announce/announce_content_all.php" target="_blank">| 最新消息</a> | <br>
			 	<a href="http://video103.mis.nkfust.edu.tw/" target="_blank">| 103專題競賽各組影片</a> |
			 	<a href="http://video.mis.nkfust.edu.tw/" target="_blank">102專題競賽各組影片</a> |  <br>
			 	<a href="zzzzz/search_user_interface.php">| 檢索系統</a> | 
			 	<a href="monograph_directions/index.htm" target="_blank">論文繳交說明</a> | 
             	<a href="upload/upload.php">文件上傳</a> | 
             	<a href="zzzzz/logout.php">登出</a>
             	</span>	        
            </div>	     
	     <?php }elseif (@$_SESSION["ad-checkok"]=="yes") { ?>	        
		     <div align="center">
			   <p class="style15">			 
			       <a href="zzzzz/insert_newgroup_interface.php">新增專題組別</a> | 
			       <a href="zzzzz/modify_search_interface.php">修改專題組資料</a> | 
                   <a href="announce/add.php">佈告管理</a> | <a href="print/index.php" target="_blank"> 列印報表 </a></p>
			   <p class="style15"><a href="upload_check/upload_check.php">確認文件上傳</a> | <a href="zzzzz/token_change_interface.php">權限設定</a> | <a href="phpMyBackupPro/phpMyBackupPro/index.php" target="_blank">資料庫備份</a> | <a href="zzzzz/logout.php">登出</a>               </p>
		     </div>
	 
		  <?php } else { ?>		  
		     <div align="center">			       
			    | <a href="zzzzz/no_search_interface.php">專題查詢</a> |

               <a href="zzzzz/index.php">學生登入</a> | </div>	
    <?php } ?>	</td>
  </tr>
  <tr>
    <td colspan="2" class="subtitle">~關於網頁~</td>
  </tr>
  <tr class="newstr1">
    <td colspan="2" class="about">系統設計：Reiny , Stanley&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 網頁修改：Yi-Sheng&nbsp;&nbsp;&nbsp;網頁維護：資管系網路組</td>
  </tr>
  <tr>
    <td colspan="2" class="copyright">&copy; 2005 by NKFUST Information Management. All Rights Reserved</td>
  </tr>
</table>
</BODY>
</HTML>
