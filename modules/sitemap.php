<?
include_once("./_common.php");
include_once("$g4[path]/lib/sitemap.lib.php");

include_once("$g4[path]/_head.php");

if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

echo sitemap();

include_once("$g4[path]/_tail.php");
?>
