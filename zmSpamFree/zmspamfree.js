if (typeof(ZM_SPAMFREE_JS) == 'undefined') { // �ѹ��� ����
    var ZM_SPAMFREE_JS = true;

if (typeof g4_path == 'undefined')
    alert('g4_path ������ ������� �ʾҽ��ϴ�. zmSpamFree/zmspamfree.js');

// ȸ�� form���� ĸí�� üũ�Ѵ�.
function checkFrm() {

    zsfCode = $('#wr_key').val();
    zsfCode = $.trim(zsfCode);

    // ���Թ����ڵ尪�� ���� ���
    if (!zsfCode) {
        alert ("���Թ����ڵ�(Captcha Code)�� �Է��� �ּ���.");
        $('#wr_key').focus();
        return false;
    }

    // AJAX�� �̿��� ���Թ����ڵ� �˻�
    url = g4_path + '/zmSpamFree/zmSpamFree.php';
    send = 'zsfCode='+zsfCode;
    
    $.ajax({
        type: 'POST',
        url: url,
        data: send,
        cache: false,
        async: false,
        success: function(result) {

            result      = result.split(',');
            zsfResult   = result[0];
            
            // 0�� ��쿡�� ���δ� undefined.
            if (typeof(zsfResult) == 'undefined')
                zsfResult = 0;

            // �˻������� ����(0)�� ���
            if (zsfResult < 1) {
                changeZsfImg('retry');	// İí �̹��� ���� �ٲ�
                check_value = false;
            } else {
                check_value = true;
                // �Է� ���� session�� ����� �Ӵϴ�.
            }

            }
    });

    // �˻��� ���� ������ �ݴϴ�.
    return check_value;

}

// ���Թ����ڵ� �̹����� ���ο� ������ �ٲ�
function changeZsfImg(changer) {
    $('#zsfImg').attr('src',g4_path + '/zmSpamFree/zmSpamFree.php?re&zsfimg=' + new Date().getTime());

    $('#wr_key').val('');
    if (changer !== 'initial')
        $('#wr_key').focus();
}

$(document).ready( function() {
    // ĸ�� �̹����� �Ӽ��� ������ �ݴϴ�.
    $('#zsfImg').attr('align', 'absmiddle');
    $('#zsfImg').attr('alt', '���⸦ Ŭ���� �ּ���.');
    $('#zsfImg').attr('title', 'Ŭ���Ͻø� �ٸ� ������ �ٲ�ϴ�. SpamFree.kr');
    
    // ĸí�Է�â�� autocomplete�� off �մϴ�.
    $('#wr_key').attr('autocomplete', 'off');

    // ĸí �̹����� ������ ������ ������ �ݴϴ�.
    $('#zsfImg').click( function() {
            changeZsfImg();
    });

    // �⺻ ĸí �̹����� �÷��ݴϴ�.
    changeZsfImg('initial');
});

}
