<?
$sub_menu = "900100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "SMS �⺻����";

$sms4[cf_ip] = '115.68.47.4';

if ($sms4[cf_id] && $sms4[cf_pw])
{
    $res = get_sock("http://www.smshub.co.kr/web_module/point_check.html?sms_id=$sms4[cf_id]&sms_pw=$sms4[cf_pw]");
    $res = explode(';', $res);
    $userinfo = array(
        'code'      => $res[0], // ����ڵ�
        'coin'      => $res[1], // �� �ܾ� (�������� �ش�)
        'gpay'      => $res[2], // ���� �Ǽ� �� ������ ǥ�� (�������� �ش�)
        'payment'   => 'A'  // ����� ǥ��, A:������, ������
    );
}

include_once("../admin.head.php");

?>

<form name=fconfig method=post action='./config_update.php'  enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=cf_ip value='<?=$sms4[cf_ip]?>'>

<table cellpadding=0 cellspacing=0 width=100% border=0>
<colgroup width=20%></colgroup>
<colgroup width=80% bgcolor=#FFFFFF></colgroup>
<tr class='ht'>
    <td colspan=2 align=left><?=subtitle($g4[title])?></td>
</tr>
<tr><td colspan=2 height=2 bgcolor=#CCCCCC></td></tr>
<tr class=ht>
	<td>SMSHUB ���� ��û</td>
	<td><a href='http://www.smshub.co.kr/rankup_module/rankup_member/member_article_r.html' target=_blank>http://www.smshub.co.kr/rankup_module/rankup_member/member_article_r.html</a></td>
</tr>
<tr class=ht>
	<td>SMSHUB ȸ�����̵�</td>
	<td>
		<input type=text name=cf_id value='<?=$sms4[cf_id]?>' size=20 class=ed required itemname='SMSHUB ȸ�����̵�'>
		<?=help("SMSHUB���� ����Ͻô� ȸ�����̵� �Է��մϴ�.");?>	</td>
</tr>
<tr class=ht>
	<td>SMSHUB �н�����</td>
	<td>
		<input type=password name=cf_pw class=ed value='<?=$sms4[cf_pw]?>' required itemname='SMSHUB �н�����'>
		<?=help("SMSHUB���� ����Ͻô� �н����带 �Է��մϴ�.")?>
        <? if (!$sms4[cf_pw]) { ?>  &nbsp; ���� �н����尡 �ԷµǾ� ���� �ʽ��ϴ�.	<?}?> </td>
</tr>
<tr class=ht>
	<td>ĳ�� �ܾ�</td>
	<td>
		<?=number_format($userinfo[coin])?> ĳ��.
        <input type=button class=btn1 value='ĳ������' onclick="window.open('http://www.smshub.co.kr/rankup_module/rankup_member/login_r.html','smshub_payment','')">
    </td>
</tr>
<tr class=ht>
	<td>�Ǽ��� �ݾ�</td>
	<td>
		<?=number_format($userinfo[gpay])?> ĳ��.
    </td>
</tr>
<tr class=ht>
	<td>ȸ�Ź�ȣ</td>
	<td>
		<input type=text name=cf_phone value='<?=$sms4[cf_phone]?>' size=20 class=ed required telnumber itemname='ȸ�Ź�ȣ'>
		<?=help("������ �Ǵ� �����ôº��� �ڵ�����ȣ�� �Է��ϼ���.<br><br>��) 010-123-4567");?>	</td>
	</td>
</tr>
<tr class=ht>
	<td>MYSQL USER</td>
	<td><?=$mysql_user?></td>
</tr>
<tr class=ht>
	<td>MYSQL DB</td>
	<td><?=$mysql_db?></td>
</tr>
<tr class=ht>
	<td>���� IP</td>
	<td><?=$_SERVER[SERVER_ADDR]?></td>
</tr>

<tr class=ht>
	<td>ȸ���� ��������</td>
	<td>
        <input type="checkbox" name=cf_member <?if ($sms4[cf_member]) echo 'checked'?>> ���
		<?=help("��뿡 üũ�ϸ� ȸ������ ���������� �����մϴ�.");?>
	</td>
</tr>
<tr class=ht>
	<td>�������۰��� ����</td>
	<td>
        <select name=cf_level>
        <? for ($i=1; $i<=10; $i++) { ?>
        <option value='<?=$i?>' <?if ($sms4[cf_level] == $i) echo 'selected';?> > <?=$i?> </option>
        <? } ?>
        </select>
        ���� �̻�
		<?=help("���������� ������ ȸ�������� �������ּ���.");?>
	</td>
</tr>
<tr class=ht>
	<td>�������� ���� ����Ʈ</td>
	<td>
		<input type=text name=cf_point value='<?=$sms4[cf_point]?>' size=10 class=ed required itemname="ȸ�� �������� ����Ʈ"> ����Ʈ
		<?=help("ȸ���� ���ڸ� �����ҽÿ� ������ ����Ʈ�� �Է����ּ���. 0�̸� ����Ʈ�� �������� �ʽ��ϴ�.");?>
	</td>
</tr>

<tr class=ht>
	<td>�������� �Ϸ����� ���� </td>
	<td>
		<input type=text name=cf_day_count value='<?=$sms4[cf_day_count]?>' size=10 class=ed required itemname="ȸ�� ���� �Ϸ����� ����"> ��
		<?=help("ȸ���� �Ϸ翡 ������ �ִ� ���� ������ �Է����ּ���. 0�̸� �������� �ʽ��ϴ�.");?>
	</td>
</tr>

<tr><td colspan=2 height=1 bgcolor=#CCCCCC></td></tr>
</table>

<p align=center>
	<input type=submit class=btn1 accesskey='s' value='  Ȯ  ��  '>
</p>

</form>


<?
include_once("../admin.tail.php");
?>