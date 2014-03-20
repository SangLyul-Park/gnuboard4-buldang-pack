<?php
$sub_menu = "300910";
include_once('./_common.php');

if ($is_admin != 'super')
    alert_close('�ְ�����ڸ� ���� �����մϴ�.');

$g4['title'] = '�޴� �߰�';
include_once("$g4[path]/head.sub.php");

// �ڵ�
if($new == 'new' || !$code) {
    $code = base_convert(substr($code,0, 2), 36, 10);
    $code += 36;
    $code = base_convert($code, 10, 36);
}
?>

<div id="menu_frm" class="new_win" style="padding:20px;">
<div class="alert alert-info">
        <strong><font class="goog-text-highlight"><?php echo $g4['title']; ?></font></strong>
</div>

    <form name="fmenuform" id="fmenuform" role="form">

    <div class="new_win_desc">
        <label for="me_type">�����</label>
        <select name="me_type" id="me_type" class="form-control">
            <option value="">�����Է�</option>
            <option value="group">�Խ��Ǳ׷�</option>
            <option value="board">�Խ���</option>
            <!--<option value="content">�������</option>-->
        </select>
    </div>
    <div id="menu_result"></div>
    </form>

</div>

<script>
$(function() {
    $("#menu_result").load(
        "./menu_form_search.php"
    );

    $("#me_type").on("change", function() {
        var type = $(this).val();

        $("#menu_result").empty().load(
            "./menu_form_search.php",
            { type : type }
        );
    });

    $("#add_manual").live("click", function() {
        var me_name = $.trim($("#me_name").val());
        var me_link = $.trim($("#me_link").val());

        add_menu_list(me_name, me_link, "<?php echo $code; ?>");
    });

    $(".add_select").live("click", function() {
        var me_name = $.trim($(this).siblings("input[name='subject[]']").val());
        var me_link = $.trim($(this).siblings("input[name='link[]']").val());

        add_menu_list(me_name, me_link, "<?php echo $code; ?>");
    });
});

function add_menu_list(name, link, code)
{
    var $menulist = $("#menulist", opener.document);
    var ms = new Date().getTime();
    var sub_menu_class;
    <?php if($new == 'new') { ?>
    sub_menu_class = " class=\"td_category\"";
    <?php } else { ?>
    sub_menu_class = " class=\"td_category sub_menu_class\"";
    <?php } ?>

    var list = "<tr class=\"menu_list menu_group_<?php echo $code; ?>\">\n";
    list += "<td"+sub_menu_class+">\n";
    list += "<label for=\"me_name_"+ms+"\"  class=\"sr_only\">�޴�</label>\n";
    list += "<input type=\"hidden\" name=\"code[]\" value=\"<?php echo $code; ?>\">\n";
    list += "<input type=\"text\" name=\"me_name[]\" value=\""+name+"\" id=\"me_name_"+ms+"\" required class=\"required frm_input full_input\">\n";
    list += "</td>\n";
    list += "<td>\n";
    list += "<label for=\"me_link_"+ms+"\"  class=\"sr_only\">��ũ</label>\n";
    list += "<input type=\"text\" name=\"me_link[]\" value=\""+link+"\" id=\"me_link_"+ms+"\" required class=\"required frm_input full_input\">\n";
    list += "</td>\n";
    list += "<td class=\"td_mng\">\n";
    list += "<label for=\"me_target_"+ms+"\"  class=\"sr_only\">��â</label>\n";
    list += "<select name=\"me_target[]\" id=\"me_target_"+ms+"\">\n";
    list += "<option value=\"self\">������</option>\n";
    list += "<option value=\"blank\">�����</option>\n";
    list += "</select>\n";
    list += "</td>\n";
    list += "<td class=\"td_numsmall\">\n";
    list += "<label for=\"me_order_"+ms+"\"  class=\"sr_only\">����</label>\n";
    list += "<input type=\"text\" name=\"me_order[]\" value=\"0\" id=\"me_order_"+ms+"\" required class=\"required frm_input\" size=\"5\">\n";
    list += "</td>\n";
    list += "<td class=\"td_mngsmall\">\n";
    list += "<label for=\"me_use_"+ms+"\"  class=\"sr_only\">PC���</label>\n";
    list += "<select name=\"me_use[]\" id=\"me_use_"+ms+"\">\n";
    list += "<option value=\"1\">�����</option>\n";
    list += "<option value=\"0\">������</option>\n";
    list += "</select>\n";
    list += "</td>\n";
    list += "<td class=\"td_mngsmall\">\n";
    list += "<label for=\"me_mobile_use_"+ms+"\"  class=\"sr_only\">����ϻ��</label>\n";
    list += "<select name=\"me_mobile_use[]\" id=\"me_mobile_use_"+ms+"\">\n";
    list += "<option value=\"1\">�����</option>\n";
    list += "<option value=\"0\">������</option>\n";
    list += "</select>\n";
    list += "</td>\n";
    list += "<td class=\"td_mngsmall\">\n";
    <?php if($new == 'new') { ?>
    list += "<button type=\"button\" class=\"btn_add_submenu\">�߰�</button>\n";
    <?php } ?>
    list += "<button type=\"button\" class=\"btn_del_menu\">����</button>\n";
    list += "</td>\n";
    list += "</tr>\n";

    var $menu_last = null;

    if(code)
        $menu_last = $menulist.find("tr.menu_group_"+code+":last");
    else
        $menu_last = $menulist.find("tr.menu_list:last");

	if($menu_last.size() > 0) {
        $menu_last.after(list);
    } else {
        if($menulist.find("#empty_menu_list").size() > 0)
            $menulist.find("#empty_menu_list").remove();

        $menulist.find("table tbody").append(list);
    }

    $menulist.find("tr.menu_list").each(function(index) {
        $(this).removeClass("bg0 bg1")
            .addClass("bg"+(index % 2));
    });

    window.close();
}
</script>

<?php
include_once("$g4[path]/tail.sub.php");
?>