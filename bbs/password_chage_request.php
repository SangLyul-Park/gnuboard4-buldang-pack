<?
include_once("./_common.php");

// ��ȸ���� ������ �� ���� ��
if (!$is_member) 
    alert("�������� ���� �Դϴ�. �����ڿ��� �����Ͻñ� �ٶ��ϴ�.");
include_once("$g4[path]/head.php");
?>

<table width=90% align=center>
<tr><td align=center>
<b>�������� ���� ��û</b>
</td></tr>

<tr><td height=10></td></tr>

<tr><td align=left>
<b>�ֱ����� ��������(��й�ȣ) ������ ���������� ��Ű�� �⺻ ���� �Դϴ�.</b>
<br><br>
<li>��й�ȣ�� ���ӵǴ� ����, ���� �� ���νŻ����� (���̵�, ������� ��)�� �ϴ� ���� ���ؾ� �մϴ�.
<br>
<li>����ϴ� ����Ʈ���� ��й�ȣ�� �ٸ��� �ϴ� ���� �ٶ��� �մϴ�.
<br>
<li>PC����� ������ҿ����� �ݵ�� �α׾ƿ� �ؾ� �մϴ�.
<br>
<li>��й�ȣ�� ���� Ÿ�ΰ� ������ �ϸ� �ȵ˴ϴ�.
</td></tr>

<tr><td height=10></td></tr>

<tr><td align=center>
<b>
<a href="<?=$g4[bbs_path]?>/member_confirm.php?url=register_form.php" onfocus="this.blur()">
��������(��й�ȣ) �����Ϸ� ����
</a>
</b>
</td></tr>
</table>

<?
include_once("$g4[path]/tail.php");
?>
