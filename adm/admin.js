function check_all(f)
{
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}

function btn_check(f, act)
{
    if (act == "update") // ���ü���
    { 
        f.action = list_update_php;
        str = "����";
    } 
    else if (act == "delete") // ���û���
    { 
        f.action = list_delete_php;
        str = "����";
    } 
    else
        return;

    var chk = document.getElementsByName("chk[]");
    var bchk = false;

    for (i=0; i<chk.length; i++)
    {
        if (chk[i].checked)
            bchk = true;
    }

    if (!bchk) 
    {
        alert(str + "�� �ڷḦ �ϳ� �̻� �����ϼ���.");
        return;
    }

    if (act == "delete")
    {
        if (!confirm("������ �ڷḦ ���� ���� �Ͻðڽ��ϱ�?"))
            return;
    }

    f.submit();
}

function member_group_update(str, uid, type) 
{ 
var f = document.fmemberG_list; 

var orign_group = f.elements["groupName_["+type+"]"].value; 

if (orign_group != str) 
{ 
if (!confirm('\n�̹� ȸ���� ���Ե� �׷��� ��Ī�� ���Ƿ� ������ ���\n\n�ش�׷��� ȸ���鿡�� ȥ���� �� �� �ֽ��ϴ�.\n\n�׷��� �׷��Ī�� �����Ͻðڽ��ϱ�?              \n')) 
{ 
return false; 
} 
} 
else { 
if (!confirm('������ ���� �����Ͻðڽ��ϱ�? \n')) 
{ 
return false; 
} 
} 

location.href = "./memberGroup_form_update.php?w=u&gl_id=" + uid + "&gl_name=" + orign_group; 

} 
