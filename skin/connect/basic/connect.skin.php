<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<style type="text/css">
/*
박스 
http://html.nhndesign.com/uio_factory/ui_pattern/box/1

이미지 없슴
.section .hx{margin:0;padding:10px 0 7px 9px;border:1px solid #fff;background:#f7f7f7;font-size:12px;line-height:normal;color:#333}
*/
.section{position:relative;border:1px solid #e9e9e9;background:#fff;font-size:12px;line-height:normal;*zoom:1}
.section .hx{margin:0;padding:10px 0 7px 9px;border:1px solid #fff;background:#f7f7f7;font-size:12px;line-height:normal;color:#333}
.section .tx{padding:10px;border-top:1px solid #e9e9e9;color:#666}
.section .section_more{position:absolute;top:9px;right:10px;font:11px Dotum, 돋움, Tahoma;color:#656565;text-decoration:none !important}
.section .section_more span{font:14px/1 Tahoma;color:#6e89aa}
</style>

<div class="section">
	<div class="hx"><a href='<?=$g4['bbs_path']?>/current_connect.php'><strong>현재접속자</strong> : <?=$row['total_cnt']?> (회원 <?=$row['mb_cnt']?>)</a></div>
</div>