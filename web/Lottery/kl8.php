<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../cache/group_" . $_SESSION['gid'] . ".php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
if (intval($web_site['kl8']) == 1) {
    include('close_cp.php');
    exit();
}
$type = $_GET['t'];
if(empty($type)) {
    $type = '两面盘';
}
switch($type) {
    case '选一':
        $g_i = 1;
        break;
    case '选二':
        $g_i = 2;
        break;
    case '选三':
        $g_i = 3;
        break;
    case '选四':
        $g_i = 4;
        break;
    case '选五':
        $g_i = 5;
        break;
    default:
        $g_i = 0;
}
$kj = $_COOKIE['kj_money'];
$cp_zd = $pk_db['彩票最低'];
$cp_zg = $pk_db['彩票最高'];
if($cp_zd <= 0) {
    $cp_zd = 1;
}
if($cp_zg <= 0) {
    $cp_zg = 1000000;
}

?>


 </div>
 <!--
<div class="wrap">
    <ul class="lot-award mt5">
      <li class="logo"> <img src="http://www.98007.com/views/cpkj/images/kl8-logo.png" alt="" width="82" height="82"/> </li>
      <li class="currentAward">
    
        <div class="lot-nums">
          <p><img src="http://www.123456cp.com/style/images/loading2.gif" width="100" height="20" alt="载入中"><p> 
        </div>

<?php
//php开奖视频引用
echo "<a href='http://www.98007.com/video/bjkl8/index.html'>官方开奖视频</a>"
?>
    <p><img src="http://www.123456cp.com/style/images/loading2.gif" width="100" height="20" alt="载入中"><p> 
	-->
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.cookie.js"></script>
    <script type="text/javascript" src="../js/form.min.js"></script>
    <script type="text/javascript" src="../js/marquee.js"></script>
    <script type="text/javascript" src="../js/flash.js"></script>
    <script type="text/javascript" src="../js/layer.js"></script>
    <script type="text/javascript" src="js/kl8.js"></script>
    <link type="text/css" rel="stylesheet" href="css/ssc.css"/>
    <script type="text/javascript">
        if (self == top) {
            top.location = '/main.php';
        }
        var islg =<?=$uid ? 1 : 0?>;
    </script>
</head>
<body>
    <!--内容开始-->
    <?php
        $sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 5";
        $query = $mysqli->query($sql);
        $list = '';
        while($rs = $query->fetch_array()) {
            $list .= $rs['msg'] . ' | ';
        }
    ?>
    <div class="gonggao">
        <div class="list" onclick="gonggao()">
            <div id="gg"><?=$list?></div>
        </div>
        <div class="more"><a title="查看更多" href="javascript:gonggao();"></a></div>
    </div>
    <div class="news">
        <ul>
            <?php
                $query->data_seek(0);
                $i = 1;
                while($rs = $query->fetch_array()) {
                    ?>
                    <li>[<?=$i?>] <?=$rs['msg']?></li>
                    <?php
                    $i++;
                }
            ?>
        </ul>
    </div>
    <table cellspacing="0" cellpadding="0" border="0" class="gm_t1">
        <tr>
            <td><span class="sy_n">今天输赢：</span><span id="user_sy" class="sy_n">0.00</span>
                <input id="gm_mode" type="hidden" value="kl8" />
                <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
                <input id="cp_min" type="hidden" value="<?=$cp_zd?>" />
                <input id="cp_max" type="hidden" value="<?=$cp_zg?>" />
            </td>
            <td align="right">
                <table cellspacing="0" cellpadding="0" border="0" class="kj">
                    <tr>
                        <td><span id="numbers">000000</span>期开奖</td>
                        <td id="open_num" class="kl8"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table cellspacing="0" cellpadding="0" border="0" class="gm_t2">
        <tr>
            <td><strong>北京快乐8</strong> <span id="open_qihao" class="qihao">000000</span>期 <span class="gm_type"><?=$type?></span></td>
            <td align="right">距离封盘：<span id="fp_time">00:00</span></td>
            <td align="right">距离开奖：<span id="kj_time" class="kj_time">00:00</span></td>
            <td align="right"><span id="rf_time">0秒</span></td>
        </tr>
    </table>
    <div class="touzhu">
        <form name="orders" id="orders" action="order/order.php?type=1" method="post" target="OrderFrame">
            <?php if($type == '两面盘') { ?>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                    <tr class="tit">
                        <td>选项</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>选项</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>选项</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>选项</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">总和大</td>
                        <td class="bian_td_odds" id="ball_6_h1"></td>
                        <td class="bian_td_inp" id="ball_6_t1"></td>
                        <td class="bian_td_qiu">总和小</td>
                        <td class="bian_td_odds" id="ball_6_h2"></td>
                        <td class="bian_td_inp" id="ball_6_t2"></td>
                        <td class="bian_td_qiu">总和单</td>
                        <td class="bian_td_odds" id="ball_6_h3"></td>
                        <td class="bian_td_inp" id="ball_6_t3"></td>
                        <td class="bian_td_qiu">总和双</td>
                        <td class="bian_td_odds" id="ball_6_h4"></td>
                        <td class="bian_td_inp" id="ball_6_t4"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">总和810</td>
                        <td class="bian_td_odds" id="ball_6_h5"></td>
                        <td class="bian_td_inp" id="ball_6_t5"></td>
                        <td class="bian_td_qiu">上盘</td>
                        <td class="bian_td_odds" id="ball_7_h1"></td>
                        <td class="bian_td_inp" id="ball_7_t1"></td>
                        <td class="bian_td_qiu">中盘</td>
                        <td class="bian_td_odds" id="ball_7_h2"></td>
                        <td class="bian_td_inp" id="ball_7_t2"></td>
                        <td class="bian_td_qiu">下盘</td>
                        <td class="bian_td_odds" id="ball_7_h3"></td>
                        <td class="bian_td_inp" id="ball_7_t3"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">奇盘</td>
                        <td class="bian_td_odds" id="ball_8_h1"></td>
                        <td class="bian_td_inp" id="ball_8_t1"></td>
                        <td class="bian_td_qiu">和盘</td>
                        <td class="bian_td_odds" id="ball_8_h2"></td>
                        <td class="bian_td_inp" id="ball_8_t2"></td>
                        <td class="bian_td_qiu">偶盘</td>
                        <td class="bian_td_odds" id="ball_8_h3"></td>
                        <td class="bian_td_inp" id="ball_8_t3"></td>
                        <td colspan="3"></td>
                    </tr>
                </table>
            <?php } elseif($type == '选一' || $type == '选二' || $type == '选三' || $type == '选四' || $type == '选五') { ?>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10 kl8">
                    <tr class="tit">
                        <td>号码</td>
                        <td>赔率</td>
                        <td><?=$g_i > 1 ? '选择' : '金额'?></td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td><?=$g_i > 1 ? '选择' : '金额'?></td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td><?=$g_i > 1 ? '选择' : '金额'?></td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td><?=$g_i > 1 ? '选择' : '金额'?></td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td><?=$g_i > 1 ? '选择' : '金额'?></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h1"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t1"></td>
                        <td class="bian_td_qiu"><em class="n_17"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h17"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t17"></td>
                        <td class="bian_td_qiu"><em class="n_33"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h33"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t33"></td>
                        <td class="bian_td_qiu"><em class="n_49"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h49"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t49"></td>
                        <td class="bian_td_qiu"><em class="n_65"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h65"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t65"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h2"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t2"></td>
                        <td class="bian_td_qiu"><em class="n_18"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h18"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t18"></td>
                        <td class="bian_td_qiu"><em class="n_34"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h34"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t34"></td>
                        <td class="bian_td_qiu"><em class="n_50"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h50"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t50"></td>
                        <td class="bian_td_qiu"><em class="n_66"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h66"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t66"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h3"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t3"></td>
                        <td class="bian_td_qiu"><em class="n_19"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h19"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t19"></td>
                        <td class="bian_td_qiu"><em class="n_35"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h35"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t35"></td>
                        <td class="bian_td_qiu"><em class="n_51"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h51"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t51"></td>
                        <td class="bian_td_qiu"><em class="n_67"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h67"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t67"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h4"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t4"></td>
                        <td class="bian_td_qiu"><em class="n_20"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h20"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t20"></td>
                        <td class="bian_td_qiu"><em class="n_36"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h36"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t36"></td>
                        <td class="bian_td_qiu"><em class="n_52"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h52"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t52"></td>
                        <td class="bian_td_qiu"><em class="n_68"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h68"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t68"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h5"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t5"></td>
                        <td class="bian_td_qiu"><em class="n_21"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h21"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t21"></td>
                        <td class="bian_td_qiu"><em class="n_37"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h37"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t37"></td>
                        <td class="bian_td_qiu"><em class="n_53"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h53"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t53"></td>
                        <td class="bian_td_qiu"><em class="n_69"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h69"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t69"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h6"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t6"></td>
                        <td class="bian_td_qiu"><em class="n_22"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h22"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t22"></td>
                        <td class="bian_td_qiu"><em class="n_38"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h38"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t38"></td>
                        <td class="bian_td_qiu"><em class="n_54"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h54"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t54"></td>
                        <td class="bian_td_qiu"><em class="n_70"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h70"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t70"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h7"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t7"></td>
                        <td class="bian_td_qiu"><em class="n_23"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h23"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t23"></td>
                        <td class="bian_td_qiu"><em class="n_39"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h39"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t39"></td>
                        <td class="bian_td_qiu"><em class="n_55"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h55"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t55"></td>
                        <td class="bian_td_qiu"><em class="n_71"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h71"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t71"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h8"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t8"></td>
                        <td class="bian_td_qiu"><em class="n_24"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h24"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t24"></td>
                        <td class="bian_td_qiu"><em class="n_40"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h40"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t40"></td>
                        <td class="bian_td_qiu"><em class="n_56"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h56"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t56"></td>
                        <td class="bian_td_qiu"><em class="n_72"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h72"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t72"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h9"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t9"></td>
                        <td class="bian_td_qiu"><em class="n_25"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h25"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t25"></td>
                        <td class="bian_td_qiu"><em class="n_41"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h41"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t41"></td>
                        <td class="bian_td_qiu"><em class="n_57"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h57"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t57"></td>
                        <td class="bian_td_qiu"><em class="n_73"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h73"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t73"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_10"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h10"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t10"></td>
                        <td class="bian_td_qiu"><em class="n_26"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h26"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t26"></td>
                        <td class="bian_td_qiu"><em class="n_42"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h42"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t42"></td>
                        <td class="bian_td_qiu"><em class="n_58"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h58"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t58"></td>
                        <td class="bian_td_qiu"><em class="n_74"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h74"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t74"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_11"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h11"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t11"></td>
                        <td class="bian_td_qiu"><em class="n_27"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h27"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t27"></td>
                        <td class="bian_td_qiu"><em class="n_43"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h43"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t43"></td>
                        <td class="bian_td_qiu"><em class="n_59"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h59"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t59"></td>
                        <td class="bian_td_qiu"><em class="n_75"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h75"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t75"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_12"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h12"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t12"></td>
                        <td class="bian_td_qiu"><em class="n_28"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h28"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t28"></td>
                        <td class="bian_td_qiu"><em class="n_44"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h44"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t44"></td>
                        <td class="bian_td_qiu"><em class="n_60"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h60"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t60"></td>
                        <td class="bian_td_qiu"><em class="n_76"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h76"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t76"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_13"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h13"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t13"></td>
                        <td class="bian_td_qiu"><em class="n_29"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h29"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t29"></td>
                        <td class="bian_td_qiu"><em class="n_45"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h45"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t45"></td>
                        <td class="bian_td_qiu"><em class="n_61"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h61"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t61"></td>
                        <td class="bian_td_qiu"><em class="n_77"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h77"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t77"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_14"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h14"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t14"></td>
                        <td class="bian_td_qiu"><em class="n_30"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h30"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t30"></td>
                        <td class="bian_td_qiu"><em class="n_46"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h46"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t46"></td>
                        <td class="bian_td_qiu"><em class="n_62"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h62"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t62"></td>
                        <td class="bian_td_qiu"><em class="n_78"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h78"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t78"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_15"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h15"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t15"></td>
                        <td class="bian_td_qiu"><em class="n_31"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h31"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t31"></td>
                        <td class="bian_td_qiu"><em class="n_47"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h47"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t47"></td>
                        <td class="bian_td_qiu"><em class="n_63"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h63"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t63"></td>
                        <td class="bian_td_qiu"><em class="n_79"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h79"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t79"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_16"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h16"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t16"></td>
                        <td class="bian_td_qiu"><em class="n_32"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h32"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t32"></td>
                        <td class="bian_td_qiu"><em class="n_48"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h48"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t48"></td>
                        <td class="bian_td_qiu"><em class="n_64"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h64"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t64"></td>
                        <td class="bian_td_qiu"><em class="n_80"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h80"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t80"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td colspan="15" class="info">赔率提示：<span id="note_p">-</span></td>
                    </tr>
                </table>
            <?php } ?>
            <div class="tool">
                <div class="wrap">
                    <div class="kuaisu">
                        <label>快速金额</label>
                        <input id="kj_money"<?=$g_i > 1 ? ' name="ball_xx"' : ''?> class="kj_inp" type="text" value="<?=$kj > 0 ? $kj : ''?>" />
                        <a href="javascript:void(0);" onclick="kjNum('d');">删除</a>
                        <a href="javascript:void(0);" onclick="kjNum('s');">保存</a>
                        <input id="qi_num" type="hidden" name="qi_num" value=""/>
                    </div>
                    <button type="button" title="<?=$g_i > 1 ? '重选' : '重填'?>" onclick="formReset();"><?=$g_i > 1 ? '重选' : '重填'?></button>
                    <button type="button" title="下注" onclick="order();" class="ml10">下注</button>
                </div>
            </div>
        </form>
    </div>
    <div id="play_sound"></div>
    <?php include_once('r_bar.php') ?>
    <script type="text/javascript">
        loadinfo(<?=$g_i?>);
        rf_time(90);
        $("#gg").liMarquee({
			circular: false
		});
    </script>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>