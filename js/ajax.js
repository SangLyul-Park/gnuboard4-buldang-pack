function clipboard_trackback(str) 
{
    if (g4_is_gecko)
        prompt("�� ���� �����ּ��Դϴ�. Ctrl+C�� ���� �����ϼ���.", str);
    else if (g4_is_ie) {
        window.clipboardData.setData("Text", str);
        alert("�Խñ� �ּҰ� ����Ǿ����ϴ�.\n\n" + str + " ");
    }
}

jQuery.trackback_send_server = function(url){
    $.post(g4_path + "/" + g4_bbs + '/tb_token.php', function(data) {
        if (g4_is_gecko)
            prompt("Ctrl+C�� ���� �Ʒ� �ּҸ� �����ϼ���. �� �ּҴ� ������ ���� ���Ͽ� �ѹ��� ��� �����մϴ�.", url+"/"+data);
        else if (g4_is_ie) {
            window.clipboardData.setData("Text", url+"/"+data);
            alert("trackback �ּҰ� ����Ǿ����ϴ�. �� �ּҴ� ������ ���� ���Ͽ� �ѹ��� ��� �����մϴ�.\n\n"+url+"/"+data);
        }
    });
}
