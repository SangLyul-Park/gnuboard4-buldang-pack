<table width=<?=$table_width?> border="0" cellspacing="0" cellpadding="0">

<tr> 
    <td width="185"></td>
    <td height="10" align=left>
    </td>
</tr>

<?
if ($kind == 'write' && $config[cf_memo_send_point]) { // ���������� + ����Ʈ ������ ���� ���� �޽����� ��� �մϴ�. ?>
<tr>
    <td width="185"></td>
    <td height="20" align=left><span class="style10">
        <?
        echo "* ���� ������ ȸ���� ".number_format($config[cf_memo_send_point])."���� ����Ʈ�� �����մϴ�.";
        ?>
    </span></td>
</tr>
<? } ?>

<? if ($kind == "write") { // ���� �϶��� �޽����� ��� �մϴ�. ?>
<tr> 
    <td width="185"></td>
    <td height="20" align=left>
    <span class="style10">
    * �������� ���� �߼۽� �ĸ�(,)�� ���� �մϴ�.
    </span></td>
</tr>
<? if ($config[cf_memo_use_file] && $config[cf_memo_file_size]) { ?>
<tr> 
    <td width="185"></td>
    <td height="20" align=left>
    <span class="style10">
    * ÷�ΰ����� ������ �ִ� �뷮�� <?=$config[cf_memo_file_size]?>M(�ް�) �Դϴ�.
    </span></td>
</tr>
<? } ?>
<? } ?>

<? if ($kind == "send") { // ���������� �϶��� �޽����� ��� �մϴ�. ?>
<tr> 
    <td width="185"></td>
    <td height="20" align=left>
    <span class="style10">
    * <font color='red'>���� ���� ������ �����ϸ�, �߽��� ���(������ �����Կ��� ����) �˴ϴ�.</font>
    </span></td>
</tr>
<? } ?>

<? if ($kind == "send" || $kind == "recv") { // ���������� �϶��� �޽����� ��� �մϴ�. ?>
<tr> 
    <td width="185"></td>
    <td height="20" align=left>
    <span class="style10">
    * �������� ���� ������ <?=$config[cf_memo_del]?>�� �� �����ǹǷ� �߿��� ������ �����Ͻñ� �ٶ��ϴ�.
    </span></td>
</tr>
<? } ?>

</table>
