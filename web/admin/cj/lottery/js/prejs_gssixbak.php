<?php
set_time_limit(0);
ini_set('max_execution_time','100');

include_once("../mysqli.php");
include_once("auto_class6.php");
include_once($_SERVER['DOCUMENT_ROOT']."/cache/website.php");
$gailv=$web_site['gailv'];

$zhong=0;
$summoney=0;
function preJs($qi,$codes){
	$hms		= $codes;
	$rs['ball_1']		= $hms[0];
	$rs['ball_2']		= $hms[1];
	$rs['ball_3']		= $hms[2];
	$rs['ball_4']		= $hms[3];
	$rs['ball_5']		= $hms[4];
	$rs['ball_6']		= $hms[5];
	$rs['ball_7']		= $hms[6];
	
	global $mysqli;
	global $zhong;
	global $summoney;
	$zhong=0;
	$summoney=0;
	//根据期数读取未结算的注单
	$sql1	= "select * from c_bet where type='五分六合彩' and js=0 and qishu=".$qi." order by addtime asc";
	$query1	= $mysqli->query($sql1);
	$sum	= $mysqli->affected_rows;
	//var_dump($sql1);
while($rows = $query1->fetch_array()){
	$summoney+=$rows['money'];
	//开始结算特码
	if($rows['mingxi_1']=='特码'){
		$dx		= Six_DaXiao($rs['ball_7']);
		$ds		= Six_DanShuang($rs['ball_7']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_7']);
		$hsds	= Six_HeShuDanShuang($rs['ball_7']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_7']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_7']);
		$bs		= Six_Bose($rs['ball_7']);
		$sx		= Get_ShengXiao($rs['ball_7']);	
		if($rs['ball_7']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				$zhong+=$rows['win'];;
			}else if($rows['mingxi_2']==$rs['ball_7']){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$zhong+=$rows['win'];;
			}else{
				
			}
		}else if($rows['mingxi_2']==$rs['ball_7'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			$zhong+=$rows['win'];;
			var_dump("enter");
			var_dump($rows['money']);
		}else{
			
		}
	}
	//开始结算正一
	if($rows['mingxi_1']=='正一'){
		$dx		= Six_DaXiao($rs['ball_1']);
		$ds		= Six_DanShuang($rs['ball_1']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_1']);
		$hsds	= Six_HeShuDanShuang($rs['ball_1']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_1']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_1']);
		$bs		= Six_Bose($rs['ball_1']);
		$sx		= Get_ShengXiao($rs['ball_1']);	
		if($rs['ball_1']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				//$zhong+=$rows['win'];;
				
			}else if($rows['mingxi_2']==$rs['ball_1']){
				$zhong+=$rows['win'];;
			}else{

			}
		}else if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			$zhong+=$rows['win'];;
			var_dump("one");
			var_dump($rows['money']);
		}else{

		}
	}
	//开始结算正二
	if($rows['mingxi_1']=='正二'){
		$dx		= Six_DaXiao($rs['ball_2']);
		$ds		= Six_DanShuang($rs['ball_2']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_2']);
		$hsds	= Six_HeShuDanShuang($rs['ball_2']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_2']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_2']);
		$bs		= Six_Bose($rs['ball_2']);
		$sx		= Get_ShengXiao($rs['ball_2']);	
		if($rs['ball_2']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				//$zhong+=$rows['win'];;
				
			}else if($rows['mingxi_2']==$rs['ball_2']){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$zhong+=$rows['win'];;
			}else{
				//注单未中奖，修改注单内容
				
			}
		}else if($rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$zhong+=$rows['win'];;
			var_dump("two");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
			
		}
	}
	//开始结算正三
	if($rows['mingxi_1']=='正三'){
		$dx		= Six_DaXiao($rs['ball_3']);
		$ds		= Six_DanShuang($rs['ball_3']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_3']);
		$hsds	= Six_HeShuDanShuang($rs['ball_3']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_3']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_3']);
		$bs		= Six_Bose($rs['ball_3']);
		$sx		= Get_ShengXiao($rs['ball_3']);	
		if($rs['ball_3']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				//$zhong+=$rows['win'];;
				
			}else if($rows['mingxi_2']==$rs['ball_3']){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$zhong+=$rows['win'];;
			
			}else{
				//注单未中奖，修改注单内容
				
			}
		}else if($rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$zhong+=$rows['win'];;
			var_dump("three");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
			var_dump("four");
			var_dump($rows['money']);
		}
	}
	//开始结算正四
	if($rows['mingxi_1']=='正四'){
		$dx		= Six_DaXiao($rs['ball_4']);
		$ds		= Six_DanShuang($rs['ball_4']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_4']);
		$hsds	= Six_HeShuDanShuang($rs['ball_4']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_4']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_4']);
		$bs		= Six_Bose($rs['ball_4']);
		$sx		= Get_ShengXiao($rs['ball_4']);	
		if($rs['ball_4']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				//$zhong+=$rows['win'];;
				
			}else if($rows['mingxi_2']==$rs['ball_4']){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$zhong+=$rows['win'];;
			}else{
				//注单未中奖，修改注单内容
			}
		}else if($rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$zhong+=$rows['win'];;
			var_dump("five");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算正五
	if($rows['mingxi_1']=='正五'){
		$dx		= Six_DaXiao($rs['ball_5']);
		$ds		= Six_DanShuang($rs['ball_5']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_5']);
		$hsds	= Six_HeShuDanShuang($rs['ball_5']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_5']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_5']);
		$bs		= Six_Bose($rs['ball_5']);
		$sx		= Get_ShengXiao($rs['ball_5']);	
		if($rs['ball_5']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				//$zhong+=$rows['win'];;
				
			}else if($rows['mingxi_2']==$rs['ball_5']){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$zhong+=$rows['win'];
			}else{
				//注单未中奖，修改注单内容
				
			}
		}else if($rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$zhong+=$rows['win'];;
			var_dump("six");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算正六
	if($rows['mingxi_1']=='正六'){
		$dx		= Six_DaXiao($rs['ball_6']);
		$ds		= Six_DanShuang($rs['ball_6']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_6']);
		$hsds	= Six_HeShuDanShuang($rs['ball_6']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_6']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_6']);
		$bs		= Six_Bose($rs['ball_6']);
		$sx		= Get_ShengXiao($rs['ball_6']);	
		if($rs['ball_6']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				//$zhong+=$rows['win'];;
				
			}else if($rows['mingxi_2']==$rs['ball_6']){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$zhong+=$rows['win'];;
			
			}else{
				//注单未中奖，修改注单内容
				
			}
		}else if($rows['mingxi_2']==$rs['ball_6'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$zhong+=$rows['win'];;
			var_dump("seven");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算正码
	if($rows['mingxi_1']=='正码'){
		$sx1		= Get_ShengXiao($rs['ball_1']);	
		$sx2		= Get_ShengXiao($rs['ball_2']);	
		$sx3		= Get_ShengXiao($rs['ball_3']);	
		$sx4		= Get_ShengXiao($rs['ball_4']);	
		$sx5		= Get_ShengXiao($rs['ball_5']);	
		$sx6		= Get_ShengXiao($rs['ball_6']);	
		if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$rs['ball_6'] || $rows['mingxi_2']==$sx1 || $rows['mingxi_2']==$sx2 || $rows['mingxi_2']==$sx3 || $rows['mingxi_2']==$sx4 || $rows['mingxi_2']==$sx5 || $rows['mingxi_2']==$sx6){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$zhong+=$rows['win'];;
			var_dump("eight");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
			
		}
	}
	//开始结算正码过关
	if($rows['mingxi_1']=='正码过关'){
		$mignxi_2_arr=explode("<hr />",$rows['mingxi_2']);
		$arr_num=count($mignxi_2_arr)-1;
		$win=0;
		for($i=0;$i<$arr_num;$i++){
			$mingxi2_arr=explode("|",$mignxi_2_arr[$i]);
			if(!Six_ZhengMaGuoGuang($rs['ball_'.Six_ZhengMaToNum($mingxi2_arr[0])],$mingxi2_arr[1])){$win=0;break;}
			else{$win=1;}
		}
		if($win){
			$zhong+=$rows['win'];;
			var_dump("nine");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算总和
	if($rows['mingxi_1']=='总和'){
		$zhdx = Six_ZongHeDaXiao($rs['ball_1']+$rs['ball_2']+$rs['ball_3']+$rs['ball_4']+$rs['ball_5']+$rs['ball_6']+$rs['ball_7']);
		$zhds = Six_ZongHeDanShuang($rs['ball_1']+$rs['ball_2']+$rs['ball_3']+$rs['ball_4']+$rs['ball_5']+$rs['ball_6']+$rs['ball_7']);
		if($rows['mingxi_2']==$zhdx || $rows['mingxi_2']==$zhds){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$zhong+=$rows['win'];;
			var_dump("ten");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
			
		}
	}
	//开始结算一肖
	if($rows['mingxi_1']=='一肖'){
		if($rows['mingxi_2']==Get_ShengXiao($rs['ball_1']) || $rows['mingxi_2']==Get_ShengXiao($rs['ball_2']) || $rows['mingxi_2']==Get_ShengXiao($rs['ball_3']) || $rows['mingxi_2']==Get_ShengXiao($rs['ball_4']) || $rows['mingxi_2']==Get_ShengXiao($rs['ball_5']) || $rows['mingxi_2']==Get_ShengXiao($rs['ball_6']) || $rows['mingxi_2']==Get_ShengXiao($rs['ball_7'])){
			//如果投注内容等于第一球开奖号码，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("twelf");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算尾数
	if($rows['mingxi_1']=='尾数'){
		if($rows['mingxi_2']==Six_WeiShu($rs['ball_1']) || $rows['mingxi_2']==Six_WeiShu($rs['ball_2']) || $rows['mingxi_2']==Six_WeiShu($rs['ball_3']) || $rows['mingxi_2']==Six_WeiShu($rs['ball_4']) || $rows['mingxi_2']==Six_WeiShu($rs['ball_5']) || $rows['mingxi_2']==Six_WeiShu($rs['ball_6']) || $rows['mingxi_2']==Six_WeiShu($rs['ball_7'])){
			//如果投注内容等于第一球开奖号码，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("thirteen");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算全中
	if($rows['mingxi_1']=='四全中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
		}
		if($win>=4){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("fourteen");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	if($rows['mingxi_1']=='三全中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
		}
		if($win>=3){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("fifteen");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	if($rows['mingxi_1']=='三中二'){
		$zall=100;
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
		}
		if($win==2){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("sixteen");
			var_dump($rows['money']);
		}elseif($win>2){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("seventeen");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	if($rows['mingxi_1']=='二全中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
		}
		if($win>=2){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("eighteen");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	if($rows['mingxi_1']=='二中特'){
		$zall=51;
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=$win2=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
			if(intval($val)==intval($rs['ball_7'])){$win2++;}
		}
		if($win>=2){
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("ninteen");
			var_dump($rows['money']);
		}elseif($win1>=1){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("twenty");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	if($rows['mingxi_1']=='特串'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_7'])){$win++;}
		}
		if($win>=2){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("twenty-one");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	if($rows['mingxi_1']=='合肖'){
		if($rs['ball_7']==49){
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("twenty-two");
			var_dump($rows['money']);
		}else{
			$sx		= Get_ShengXiao($rs['ball_7']);	
			if(strpos($rows['mingxi_2'],$sx)!==false){
				//注单中奖，给会员账户增加奖金
				$zhong+=$rows['win'];;
				var_dump("twenty-three");
			var_dump($rows['money']);
			}else{
				//注单未中奖，修改注单内容
			}
		}
	}
	//开始结算生肖连
	if($rows['mingxi_1']=='二肖连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=2){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("twenty-four");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
			
		}
	}
	if($rows['mingxi_1']=='三肖连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		//echo "<p>======</p>";
		if($win>=3){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("twenty-five");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	if($rows['mingxi_1']=='四肖连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=4){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("twenty-six");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	if($rows['mingxi_1']=='五肖连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=5){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("twenty-seven");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算尾数连
	if($rows['mingxi_1']=='二尾连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=2){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("twenty-eight");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	if($rows['mingxi_1']=='三尾连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=3){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("twenty-nine");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	if($rows['mingxi_1']=='四尾连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=4){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("thirty");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	if($rows['mingxi_1']=='五尾连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=5){			
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];;
			var_dump("thirty-one");
			var_dump($rows['money']);
		}else{
			//注单未中奖，修改注单内容
		}
	}
	if($rows['mingxi_1']=='五不中' || $rows['mingxi_1']=='六不中' || $rows['mingxi_1']=='七不中' || $rows['mingxi_1']=='八不中' || $rows['mingxi_1']=='九不中' || $rows['mingxi_1']=='十不中' || $rows['mingxi_1']=='十一不中' || $rows['mingxi_1']=='十二不中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;break;}
			if(intval($val)==intval($rs['ball_2'])){$win++;break;}
			if(intval($val)==intval($rs['ball_3'])){$win++;break;}
			if(intval($val)==intval($rs['ball_4'])){$win++;break;}
			if(intval($val)==intval($rs['ball_5'])){$win++;break;}
			if(intval($val)==intval($rs['ball_6'])){$win++;break;}
			if(intval($val)==intval($rs['ball_7'])){$win++;break;}
		}
		if($win>0){
			//注单未中奖，修改注单内容	
		}else{
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
			var_dump("thirty-two");
			var_dump($rows['money']);
		}
	}

	}
	
	//var_dump($codes);
	//var_dump("zhong=".$zhong);	
	//var_dump("sumnoney=".$summoney);
	global $gailv;
	if($zhong==0 || $summoney==0){
		return false;
	}else{
		$abc=floor($zhong)/floor($summoney);
		if($abc==0.5){
			return false;
		}else if($abc > ($gailv/100)){
			return true;
		}else{
			return false;
		}
	}
}
