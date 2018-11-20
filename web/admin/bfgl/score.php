<?php
include_once("../common/login_check.php");
check_quanxian("bfgl");
include_once("../../include/mysqlis.php");
$page_date	=	date("m-d");
$page_date2	=	date("Y-m-d");
if(isset($_GET["select_ball"])){
	$select_ball	=	$_GET["select_ball"];
}else{
	$select_ball	=	"FT";
}

if(isset($_GET["date"])){
	$page_date	=	$_GET["date"];
	$page_date2	=	date("Y-").$_GET["date"];
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>录入比分</title>
<meta http-equiv="Cache-Control" content="max-age=8640000" />
<link rel="stylesheet" href="../images/control_main.css" type="text/css">
<style type="text/css">
<!--
.STYLE3 {color: #FF0000; font-weight: bold; }
.STYLE4 {
	color: #FF0000;
	font-size: 12px;
}
-->
</style>
<script language="javascript" src="../../js/jquery.js"></script>
<script language="javascript">
function gopage(url){
	location.href = url;
}
function re_load(){
	location.reload();
}

function check(){
    var len = document.form1.elements.length;
	var num = false;
    for(var i=0;i<len;i++){
		var e = document.form1.elements[i];
        if(e.checked && e.name=='mid[]'){
			num = true;
			break;
		}
    }
	if(num){
		var action = $("#s_action").val();
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}else{
			if(action=="2") document.form1.action="ft_list.php";
			if(action=="1") document.form1.action="ft_shangbanchang_list.php";
			if(action=="3") document.form1.action="ft_shangbanchang_list_re.php";
			if(action=="4") document.form1.action="ft_nullity.php";
		}
	}else{
        alert("您未选中任何复选框");
        return false;
    }
}
var mids = "";

function check_mid(mid){
	if(mid.checked){
		mids+=mid.value+","
	}else{
		var m = mids.split(",");
		mids = "";
		for(var i=0; i<m.length; i++){
			if(m[i] != mid.value && m[i] != ""){
				mids+=m[i]+",";
			}
		}
	}
}

function checkbk(){
	if(mids != ""){
		var action = $("#b_action").val();
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}else{
			if(action=="1") window.location.href="lq_list.php?mid="+mids;
			if(action=="2") window.location.href="lq_list_quxiao.php?mid="+mids;
		}
		return false;
	}else{
        alert("您未选中任何复选框");
        return false;
    }
}

function ckall(){
    for (var i=0;i<document.form1.elements.length;i++){
	    var e = document.form1.elements[i];
		if (e.name != 'checkall') e.checked = document.form1.checkall.checked;
	}
}

function set_bf(myself){
	var str = myself.name+"$"+myself.value+"$"+"<?=$page_date?>"
	$.get("set_lq_bf.php",{value:str},function(date){
		if(date != ""){
			alert(date);
		}
	});
	
}

function zqlrbf(zqmid,fid){
	var md = "<?=$page_date?>";
	var a = "mi"+zqmid;
	var b = "ti"+zqmid;
	var c = "mih"+zqmid;
	var d = "tih"+zqmid;
	var m = $("#"+a).val();
	var t = $("#"+b).val();
	var l = $("#"+c).val();
	var n = $("#"+d).val();
	
	$.post(
		"zqlr.php",
		{r:Math.random(),value:m+"|||"+t+"|||"+l+"|||"+n+"|||"+md+"|||"+zqmid},
		function(date){
			if(date == 0){
				alert("请输入上半场比分！");
				$("#"+a).val("");
				$("#"+b).val("");
			}else if(date==3){
				alert("系统没有查找到您要结算的赛事！")
			}else if(date==1){
				ftbf(m,t,1,fid);
			}else if(date==2){
				ftbf(l,n,2,fid);
			}
		}
	);
}

function ftbf(m,t,p,d){
	if(p == 1){     //////全场
		var mid = document.getElementsByName("mi"+d)
		var tid = document.getElementsByName("ti"+d)
	}else{
		var mid = document.getElementsByName("mh"+d)
		var tid = document.getElementsByName("th"+d)
	}
	for(var i=0; i<mid.length; i++){
		mid[i].value = m;
		tid[i].value = t;
	}
}
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" vlink="#0000FF" alink="#0000FF">
 
  <table width="800" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="770">&nbsp;线上数据 - <font color="#CC0000">比分审核&nbsp;</font>&nbsp;&nbsp;&nbsp;日期: 
        <select id="DropDownList1" onChange="javascript:gopage(this.value)" name="DropDownList1">
      <? for ($i=0;$i<=10;$i++){
	   $s=strtotime("-$i day");
	   $date=date("m-d",$s);
	    ?>
        <option value="<?=$_SERVER['PHP_SELF']?>?select_ball=<?=$select_ball?>&amp;date=<?=$date?>" <?if ($page_date==$date)echo  "selected";?>>
		<?=$date?>
         </option>
  <?}?>
      </select>
        赛事: 
        <select class="za_select" name="select_ball" onChange="javascript:location.href=this.value;">
          　<option value="score.php?select_ball=FT&date=<?=$page_date?>" <?if($select_ball=="FT") echo "selected";?>>足球</option>
			<option value="score.php?select_ball=BK&date=<?=$page_date?>" <?if($select_ball=="BK") echo "selected";?>>篮球</option>
        </select>
      -- 管理模式:WEB页面 -- <a href="javascript:history.go( -1 );">回上一页</a></td>                
      <td width="30"> </td> 
    </tr> 
  </table> 
  <table width="774" border="0" cellspacing="0" cellpadding="0"> 
    <tr>  
      <td width="774" height="4"></td> 
    </tr> 
    <tr> 
      <td ></td> 
    </tr> 
  </table>
  <? if($select_ball=="FT"){?>
<form id="form1" name="form1" method="post" action="ft_list.php" onSubmit="return check();">
  <div style="width:900px; padding-bottom:5px;">
    <div style="float:left;"><span class="STYLE3">足球 </span>-- <a href="score_yjs.php?select_ball=FT&date=<?=$page_date?>">进入&gt;&gt;已结算</a></div>
    <div style="float:right;"><span class="STYLE4">相关操作：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="2">结算全场</option>
        <option value="1">结算上半场</option>
        <option value="3">重新结算上半场</option>
        <option value="4" style="color:#FF0000;">设为无效</option>
      </select>
      <input type="submit" name="Submit2" value="执行"/></div></div>
  <table   border="0" cellspacing="1" cellpadding="0"  bgcolor="006255" width="900" height="41">
    <tr class="m_title_ft"> 
      <td width="190" height="18" align="middle"> 
       <?=$page_date?> </td>
      <td align="middle" width="50">时间</td>
      <td align="middle" width="210">主场队伍</td>
      <td align="middle" width="210">客场队伍</td>
      <td align="middle" width="100">上半场</td>
      <td align="middle" width="100">全场比分</td>
      <td align="middle" width="32"><label>
        <input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/>
      </label></td>
    </tr>
    <?php
	$sql		=	"SELECT ID,Match_ID, Match_Date, Match_Time, Match_Master, Match_Guest,Match_MasterID, Match_GuestID,Match_Name,MB_Inball,TG_Inball,MB_Inball_HR,TG_Inball_HR,match_sbjs FROM Bet_Match where match_js=0 and (match_date='$page_date' or match_date='$page_date2') order by  Match_CoverDate,iPage,match_name,Match_Master,iSn desc";
    $query		=	$mysqlis->query($sql);
	$arr_bet	=	array();
	while($rows	=	$query->fetch_array()){
		if($rows["match_sbjs"]>0) $bgcolor="#FF9999";
		else $bgcolor="#ffffff";
		
		$arr     = explode('[上半',$rows["Match_Master"]);
		if(!in_array($rows["Match_Master"],$arr_bet)) $arr_bet[$rows["Match_ID"]] = $rows["Match_Master"];

		$ftid = array_search($rows["Match_Master"],$arr_bet);
		$couarr  = count($arr);
		if($couarr>1){
		  
		}else{
	 ?>
    <tr style="background-color:#ffffff"   align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'"> 
      <td width="190"><?=$rows["Match_ID"]?><br/>
      <?=$rows["Match_Name"]?></td>
      <td width="50"><?=$rows["Match_Time"]=='45.5' ? '中埸' : $rows["Match_Time"]?></td>
      <td width="210"><div align="right" style="padding-right:5px;"><?=$rows["Match_Master"]?></div></td>
      <td width="210"><div align="left" style="padding-left:5px;"><?=$rows["Match_Guest"]?></div></td>
     <td width="100"> 
        <input name="<?="mh".$ftid;?>" type="text" class="zqinput" id="mih<?=$rows["Match_ID"]?>" value="<?=$rows["MB_Inball_HR"]?>"  style="width:30px; background-color:<?=$bgcolor?>;" maxlength="5" />&nbsp;&nbsp;<input name="<?="th".$ftid;?>" type="text" class="zqinput" id="tih<?=$rows["Match_ID"]?>" onChange="zqlrbf(<?=$rows["Match_ID"]?>,<?=$ftid?>)" value="<?=$rows["TG_Inball_HR"]?>" style="width:30px; background-color:<?=$bgcolor?>;" maxlength="5" />
      </td>
      <td width="100"><input name="<?="mi".$ftid;?>" type="text" class="zqinput" id="mi<?=$rows["Match_ID"]?>" value="<?=$rows["MB_Inball"]?>" style="width:30px;" maxlength="5" />&nbsp;&nbsp;<input name="<?="ti".$ftid;?>" type="text"class="zqinput"  id="ti<?=$rows["Match_ID"]?>" onChange="zqlrbf(<?=$rows["Match_ID"]?>,<?=$ftid?>)" value="<?=$rows["TG_Inball"]?>" style="width:30px;" maxlength="5" />      </td>
     <td width="32"><input name="mid[]" type="checkbox" id="mid[]" value="<?=$rows["Match_ID"]?>" /></td> 
    </tr>
    <?php } }?>
</table>
</form>
	<?php }?>
	 <? if($select_ball=="BK"){?>
<span class="STYLE3">篮球</span>
  -- <a href="score_yjs.php?select_ball=BK&date=<?=$page_date?>">进入&gt;&gt;已结算</a><br>
  <table width="900"   height="41" border="0" cellpadding="0" cellspacing="1"  bgcolor="006255" class="m_tab" id="glist_table">
    <tr class="m_title_ft"> 
      <td width="109" height="18" align="middle"><?=$page_date?></td>
      <td align="middle" width="50">时间</td>
      <td align="middle" width="140">主场队伍</td>
      <td align="middle" width="40">全场分</td>
      <td align="middle" width="140">客场队伍</td>
      <td align="middle" width="40">第一节</td>
      <td align="middle" width="40">第二节</td>
      <td align="middle" width="40">第三节</td>
      <td align="middle" width="40">第四节</td>
      <td align="middle" width="40">上半场</td>
      <td align="middle" width="40">下半场</td>
      <td align="middle" width="40">加时</td>
      <td align="middle" width="40">结算分</td>
      <td align="middle" width="40">比分</td>
      <td align="middle" width="45">操作</td>
    </tr>
	<?php
	$sql		=	"select   Match_ID, Match_Date, Match_Time, Match_Master, Match_Guest,Match_MasterID,Match_GuestID,Match_Name,MB_Inball_1st,TG_Inball_1st,MB_Inball_2st,TG_Inball_2st,MB_Inball_3st,TG_Inball_3st,MB_Inball_4st,TG_Inball_4st,MB_Inball_HR,	TG_Inball_HR,MB_Inball_ER,TG_Inball_ER,MB_Inball,TG_Inball,MB_Inball_Add,TG_Inball_Add ,MB_Inball_OK,TG_Inball_OK,match_js from  lq_match where  match_js=0 and (match_Date='$page_date' or match_date='$page_date2') order by match_coverdate,match_id asc";
	$query		=	$mysqlis->query($sql);
	while($rows	=	$query->fetch_array()){
	?>
	    <tr class="m_cen" align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
      <td width="109" height="18" align="middle"><?=$rows["Match_ID"]?>
        <br/>
        <?=$rows["Match_Name"]?></td>
      <td align="middle" width="50"><?=$rows["Match_Time"]?></td>
      <td align="left" width="140"><?=$rows["Match_Master"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball"]?>
        <br />
        <?=$rows["TG_Inball"]?></td>
      <td align="left" width="140"><?=$rows["Match_Guest"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball_1st"]?>
        <br />
        <?=$rows["TG_Inball_1st"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball_2st"]?>
        <br />
        <?=$rows["TG_Inball_2st"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball_3st"]?>
        <br />
        <?=$rows["TG_Inball_3st"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball_4st"]?>
        <br />
        <?=$rows["TG_Inball_4st"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball_HR"]?>
        <br />
        <?=$rows["TG_Inball_HR"]?></td>
      <td align="middle" width="40"><?=$rows["MB_Inball_ER"]?>
        <br />
        <?=$rows["TG_Inball_ER"]?></td>
      <td align="middle" width="40"><? if ($rows["MB_Inball_Add"]>0) echo $rows["MB_Inball_Add"]; ?>
        <br />
        <? if ($rows["TG_Inball_Add"]>0) echo $rows["TG_Inball_Add"];?></td>
      <td align="middle" width="40"><? if ($rows["MB_Inball_OK"]>0) echo $rows["MB_Inball_OK"]; ?>
        <br />
        <? if ($rows["TG_Inball_OK"]>0) echo $rows["TG_Inball_OK"];?></td>
      <td align="middle" width="40"><a href="set_lq_score.php?mid=<?=$rows["Match_ID"]?>">录入</a></td>
      <td align="middle" width="45"><? if(($rows["match_js"]==0)&&($rows["MB_Inball_HR"]!='')){?>
        <A href="lq_list.php?mid=<?=$rows["Match_ID"]?>&MB_Inball=<?=$rows["MB_Inball_OK"]?>&TG_Inball=<?=$rows["TG_Inball_OK"]?>&js=1">结算</A>
        <?}else if($rows["match_js"]==1){?>
        <a onClick="return confirm('确定重新结算？')" href="re_jiesuan.php?page=bk&mid=<?=$rows["Match_ID"]?>">重新结算</a>
        <?}?></td>
    </tr>
	<? }?>
</table>
  <? } ?>
  <br>
</body>
</html>