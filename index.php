<?
include_once("./_common.php");

$g4['title'] = "";
include_once("./_head.php");

include_once("$g4[path]/lib/popup.lib.php");        // �˾�

// �˾����
echo popup("","test");

switch ($mnb) {
    case ''     : include_once("$g4[path]/index.main.php"); break;  // $mnb==""�� �����϶���°���.
    default     : include_once("$g4[path]/index.mnb.php"); break;
}

include_once("./_tail.php");
?>