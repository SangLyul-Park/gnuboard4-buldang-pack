<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�
?>
<script type="text/javascript">
// ���ڼ� ����
var char_min = parseInt(<?=$write_min?>); // �ּ�
var char_max = parseInt(<?=$write_max?>); // �ִ�
</script>
<form role="form" class="form-horizontal" name="fwrite" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data">
<input type=hidden name=null> 
<input type=hidden name=w        value="<?=$w?>">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=wr_id    value="<?=$wr_id?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sfl      value="<?=$sfl?>">
<input type=hidden name=stx      value="<?=$stx?>">
<input type=hidden name=spt      value="<?=$spt?>">
<input type=hidden name=sst      value="<?=$sst?>">
<input type=hidden name=sod      value="<?=$sod?>">
<input type=hidden name=page     value="<?=$page?>">
<input type=hidden name=mnb      value="<?=$mnb?>">
<input type=hidden name=snb      value="<?=$snb?>">

<input type=hidden name=wr_subject value="wr_subject">

<?
// list.skin.php���� �о���� ��... bbs/write.php���� �����߽��ϴ�
if ($w == "") {
    $is_notice = false;

    if ($is_admin)
        $is_notice = true;
    $is_secret = $board[bo_use_secret];

    $is_mail = false;
    if ($config[cf_email_use] && $board[bo_use_email])
        $is_mail = true;
}

$option = "";
$option_hidden = "";
if ($is_notice || $is_secret || $is_mail) { 
    $option = "";
    if ($is_notice) {
        $option .= '<label class="checkbox-inline">';
        $option .= "<input type=checkbox name=notice value='1' $notice_checked>����";
        $option .= '</label>';
    }

    if ($is_secret) {
        if ($is_admin || $is_secret==1) {
            $option .= '<label class="checkbox-inline">';
            $option .= "<input type=checkbox value='secret' name='secret' $secret_checked>��б�";
            $option .= '</label>';
        } else {
            $option_hidden .= "<input type=hidden value='secret' name='secret'>";
        }
    }
    
    if ($is_mail) {
        $option .= '<label class="checkbox-inline">';
        $option .= "<input type=checkbox value='mail' name='mail' $recv_email_checked>�亯���Ϲޱ�";
        $option .= '</label>';
    }

      // hidden���� �Ѱܾ� �ϴ� �ɼ��� ��� �մϴ�.
			echo $option_hidden;
}
?>
<div class="container">
        <? if ($option) { ?>
        <div class="form-group">
            <div><?=$option?></div>
        </div>
        <?}?>

        <div class="form-group">
                <textarea class="form-control" id="wr_content" name="wr_content" style='width:100%; word-break:break-all;' rows=5 itemname="����" required 
                <? if ($write_min || $write_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?}?>><?=$content?></textarea>
                <? if ($write_min || $write_max) { ?><script language="javascript"> check_byte('wr_content', 'char_count'); </script><?}?>
                <span style="cursor: pointer;" onclick="textarea_decrease('wr_content', 5);"> <i class="fa fa-minus-square"></i> </span>
                &nbsp;<span style="cursor: pointer;" onclick="textarea_original('wr_content', 5);"> <i class="fa fa-circle-o"></i> </span>
                &nbsp;<span style="cursor: pointer;" onclick="textarea_increase('wr_content', 5);"> <i class="fa fa-plus-square"></i> </span>
                <? if ($write_min || $write_max) { ?><span id=char_count></span>����<?}?>

                <span class="pull-right" style="margin-top:5px;">
                    <button type="submit" class="btn btn-success" id="btn_submit">Write</button>
                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-default" href="<?=$list_href?>">List</a>
                </span>
        </div>
</div>
</form>

<script type="text/javascript">
function fwrite_submit(f) 
{
    if (document.getElementById('char_count')) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(document.getElementById('char_count').innerHTML);
            if (char_min > 0 && char_min > cnt) {
                alert("������ "+char_min+"���� �̻� ���ž� �մϴ�.");
                return false;
            } 
            else if (char_max > 0 && char_max < cnt) {
                alert("������ "+char_max+"���� ���Ϸ� ���ž� �մϴ�.");
                return false;
            }
        }
    }

    var subject = "";
    var content = "";
    $.ajax({
        url: "<?=$g4[bbs_path]?>/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("���� �����ܾ�('"+subject+"')�� ���ԵǾ��ֽ��ϴ�");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("���뿡 �����ܾ�('"+content+"')�� ���ԵǾ��ֽ��ϴ�");
        if (typeof(ed_wr_content) != "undefined") 
            ed_wr_content.returnFalse();
        else 
            f.wr_content.focus();
        return false;
    }

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/write_update.php';";
    else
        echo "f.action = './write_update.php';";
    ?>
    
    return true;
}
</script>