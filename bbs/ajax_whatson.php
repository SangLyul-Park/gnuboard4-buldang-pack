<?
include_once("_common.php");

$w = preg_match("/^[a-zA-Z0-9_]+$/", $w) ? $w : "";
$wo_in = (int) $wo_id;
$mb_id = $member[mb_id];
$head = (int) $head;
$page = (int) $page;
$rows = (int) $rows;
$check = (int) $check;
$url_prev = strip_tags($url_prev);

switch($w) {
  case 'd' :
      $sql = " delete from $g4[whatson_table] where wo_id = '$wo_id' and mb_id = '$mb_id' ";
      sql_query($sql);

      $url = "$g4[bbs_path]/whatson.php?head=$head&page=$page&check=$check&rows=$rows";
      if ($url_prev)
          $url = $url_prev . $url;

      goto_url("$url");
      exit;
  case 'r' :
      // �̽������� �Լ�~�� ���� �״�� �ִ��� Ȯ���� �ʿ䰡 �ֽ��ϴ�.
      // �ڸ�Ʈ�� ���, ����� ���� �ʹ� ���Ƽ� �Լ��� ó���� ���ϰ�, ��Ÿ ������ ���� �������⵵ �ϰŵ��.
      $sql = " select * from $g4[whatson_table] where wo_id = '$wo_id' and mb_id = '$mb_id' ";
      $wo = sql_fetch($sql);

      $tmp_write_table = $g4['write_prefix'] . $wo[bo_table];  // �Խ��� ���̺� ��ü�̸�

      // ������ �Լ�~�� ������ �����ϴ����� Ȯ��
      $sql = " select * from $tmp_write_table where wr_id='$wo[wr_id]' ";
      $wr_result = sql_fetch($sql);
      
      if (!$wr_result[wr_id])
          sql_query(" delete from $g4[whatson_table] where wo_id = '$wo_id' and mb_id = '$mb_id' ");

      // �ڸ�Ʈ�� ���, ������ �ڸ�Ʈ�� �ִ��� Ȯ��
      if ($wo['comment_id']) {
          $sql = " select * from $tmp_write_table where wr_id='$wo[comment_id]' ";
          $co_result = sql_fetch($sql);

          if (!$co_result[wr_id])
              sql_query(" delete from $g4[whatson_table] where wo_id = '$wo_id' and mb_id = '$mb_id' ");
      }

      $sql = " update $g4[whatson_table] set wo_status=1 where wo_id = '$wo_id' and mb_id = '$mb_id' ";
      sql_query($sql);

      echo "000";
  default :
}
?>
