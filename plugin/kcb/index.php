<? 
include_once("./_common.php");

if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

$g4[title] = "KCB(�ڸ���ũ�������) - okname ��������";
include_once("./_head.php");
include_once("./nc.config.php");
?>
<div class="panel panel-default">
<div class="panel-heading">
    <strong>KCB ����Ȯ��</strong>
    <span class="pull-right"><a href="http://okname.allcredit.co.kr/" target=_new>kcb okname</a></span>
</div>
<div class="panel-body">
    <? if ($member['mb_id'] == "") { ?>
				<p>ȸ����� ���� �Դϴ�. <a href='<?=$g4[bbs_path]?>/login.php?<?=$qstr?>&url=<?=urlencode("$_SERVER[PHP_SELF]")?>'>�α���</a> �Ͻ��� �̿����ּ���.</p>
    <? } else { ?>
        <? if ($okname_me) { ?>
            <? if ($member[mb_realcheck] !== "0000-00-00 00:00:00") { ?>
                <p><?=$member[mb_realcheck]?> �� ���������� �����̽��ϴ�.</p>
 	        	<? } else { ?>
    		    	  <p>���������� �����÷��� <a href="javascript:popup_real();"><strong>�̰�</strong></a>�� Ŭ�����ּ���.</p>
       			<? } ?>
        <? } ?>
    <? } ?>
</div>
<div class="panel-footer">
	<ul>
		<li>�ٸ� ����� ���������� �����ϴ� ���� ����� ���������� ���� ������ ���� <strong>3�� ������ ¡���Ǵ� 1õ���� ������ ����</strong>�� ó���� �� �ֽ��ϴ�.</li>
		<li>����Ȯ���� <a href="http://okname.allcredit.co.kr/" target=_new>KCB(�ڸ���ũ�������, OK Name)</a>�� ����Ȯ�� ���񽺷� �̷�� ���ϴ�.</li>
		<li>����Ȯ���� ���� �ֹι�ȣ�� �䱸���� �ʽ��ϴ�.</li>
		<li>���������� ���� ���Ǵ� ����Ʈ�� ��� �Ǵ� KCB�� �Ǹ�Ȯ�� �ݼ���(T.02-708-1000)�� �Ͻø� �˴ϴ�.</li>
	</ul>
</div>
</div>
<p>���������� �����÷��� <a href="javascript:popup_real();"><strong>�̰�</strong></a>�� Ŭ�����ּ���.</p>
<?
include_once("./_tail.php"); 
?>