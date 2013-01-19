<?
if (!defined('_GNUBOARD_')) exit;

// ��� �׷��� SELECT �������� ����
function get_banner_group_select($name, $selected='', $event='')
{
    global $g4, $is_admin, $member;

    $sql = " select bg_id, bg_subject from $g4[banner_group_table] a ";
    if ($is_admin == "group") {
        $sql .= " left join $g4[member_table] b on (b.mb_id = a.bg_admin)
                  where b.mb_id = '$member[mb_id]' ";
    }
    $sql .= " order by a.bg_id ";

    $result = sql_query($sql);
    $str = "<select name='$name' $event>";
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $str .= "<option value='$row[bg_id]'";
        if ($row[bg_id] == $selected) $str .= " selected";
        $str .= ">$row[bg_subject] ($row[bg_id])</option>";
    }
    $str .= "</select>";
    return $str;
}

// ��ʸ� �����´�
function get_banner($bg_id, $skin="basic", $bn_id="", $rows=0, $opt="")
{
    global $g4;

    // ��¥�� ������ �ݴϴ�.
    $sql_datetime = " and '$g4[time_ymdhis]' > bn_start_datetime and bn_end_datetime > '$g4[time_ymdhis]' ";

    // bc_id�� �����Ǹ� bc_id�� ���� �ɴϴ�. �ƴϸ� n���� ���� �ɴϴ�. �������� ����� rand �Դϴ�.
    if ($bn_id) {
        $sql = " select * from $g4[banner_table] where bg_id='$bg_id' and bn_id='$bn_id' and bn_use = '1' $sql_datetime ";
    } else {
        $sql = " select * from $g4[banner_table] where bg_id='$bg_id' and bn_use = '1' $sql_datetime order by rand() ";
        if ($rows)
            $sql .= "  limit 0, $rows ";
    }
    $result = sql_query($sql);

    $list = array();
    for ($i=0; $row = sql_fetch_array($result); $i++) {
        $list[$i][bg_id] = $bg_id;
        $list[$i][bn_id] = $row[bn_id];
        $list[$i][bn_target] = $row[bn_target];
        $list[$i][bn_url] = $row[bn_url];
        $list[$i][bn_subject] = $row[bn_subject];
        $list[$i][bn_image] = $row[bn_image];
    }

    $banner_skin_path = "$g4[path]/skin/banner/$skin";

    ob_start();
    include "$banner_skin_path/banner.skin.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>