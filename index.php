<?php

include 'if/common.php';
if($conf['txprotect'] == 1)
    include_once(SYSTEM_ROOT."txprotect.php");
if($conf['CC_Defender'] == 1){
    define('CC_Defender', 1); //防CC攻击开关(1为session模式)
    include_once SYSTEM_ROOT.'security.php';

}
if(empty($fpj) || $fpj != "af0fb79757161256f2ee013df6a837d8"){
    exit("DOING?");
}
$checkcip_row = $DB->get_row("select * from if_blacklist where data = '".real_ip()."' and type = 2");

if($checkcip_row){
    sysmsg("抱歉，您已列入本站黑名单，无法使用本站!");
}

if(!empty($_GET['tp']) && !empty($_GET['action'])){
    $tp = $_GET['tp'];
    $action = $_GET['action'];
    include 'template/'.$tp.'/'.$action.".php";
    exit();
}

if(!empty($conf['view']) && $conf['view'] != ""){
    $t = $conf['view'];
 
}else{
    $t = "default";
}
include 'template/'.$t.'/index.php';