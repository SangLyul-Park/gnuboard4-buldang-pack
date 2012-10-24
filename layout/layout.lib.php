<?
// $mnb�� �̸��� ����ϴ�
function mnb_name($menu, $mnb) {
    foreach ($menu as $item) {
        if ($item[id] == $mnb)
            return $item[name];
    }
}

// $mnb�� ��� �մϴ�.
function print_mnb($menu) {
    global $g4, $mnb;

    echo "<ul style='display:block;'>";
    foreach ($menu as $item) {
        if ($item['hidden'])
            continue;
        $class = "";
        // ��â ������ ���, $item[new] = 1
        if ($mnb == $item[id])
            $class = " class='active' ";
        else
            $class = "";
        if ($item['new'] == 1)
            $target = "target=new";
        else
            $target = "";

        if ($item['href'])
            echo "<li $class><a href='$item[href]' $target><span>$item[name]</span></a></li>";
        else
            echo "<li $class><a href='$g4[url]?mnb=$item[id]' $target><span>$item[name]</span></a></li>";
    }
    echo "</ul>";
}

// $snb�� ��� �մϴ�.
function print_snb($menu, $title) {
    global $g4, $snb, $mnb, $snb_indent;

    // $snb�� �������, �׳� return
    if ($menu == "" || count($menu) == 0)
        return;

    // ������ indent style�� ������ �ݴϴ�.
    $ul_style = "style='$snb_indent'";

    echo "<ul><li class='active'>";
    echo "<a href='#'><span $ul_style>$title</span><span class='i'></span></a>";
    echo "<ul style='display:block;'>";
    foreach ($menu as $item) {

        // style ���� ������ $snb_style�� ����
        $snb_style = " style='" . $snb_indent . $item[style] . "' ";

        // ��â ������ ���, $item[new] = 1
        $class = "";
        if ($snb == $item[id] && $item['new'] !== 1)
            $class = " class='active' ";

        // bar�ΰ�쿡�� �� ��~ �׾��ְ� ��������
        if ($item['type'] == "bar") {
            if ($item['style'])
                $hstyle = " style='" . $item['style'] . "' ";

            echo "<li $class><hr $hstyle></li>";
            continue;
        }
        
        //  �߰��� $item[name]�� ������ �Խ��� ������ �о ä���ش�.
        if ($item[name] == "") {
            $bo = get_board($item[id], "bo_subject");
            $item['name'] = strip_tags($bo[bo_subject]);
        }

        // item['img']�� �Ӽ��� ������... �̸���� �̹����� ���
        if ($item['img']) {
            $itname = "<img src='$item[img]' style='vertical-align:middle;' alt=''>";
        } else {
            $itname = $item['name'];
        }
        
        if ($item['new'] == '1')
            echo "<li><a href='$item[href]' alt='$item[name]' target=new><span $snb_style $indent>$itname</span></a></li>";
        else {
            // href�� ������ �⺻���� �Խ��� ���̺��� ���� �̸����� ������ �ش�.
            if (trim($item['href']) == "") {
                $item[href] = $g4['bbs_path'] . "/board.php?bo_table=" . $item[id];
            }
            // ?�� href�� ������, �׳� ���α׷��̴ϱ� �ڿ� ?�� �ٿ��ش�.
            if (substr_count($item[href], "?") > 0)
                echo "<li $class><a href='$item[href]&snb=$item[id]&mnb=$mnb' alt='$item[name]'><span $snb_style $indent>$itname</span></a></li>";
            else
                echo "<li $class><a href='$item[href]?snb=$item[id]&mnb=$mnb' alt='$item[name]'><span $snb_style $indent>$itname</span></a></li>";
        }
    }
    echo "</ul>";
    echo "</li></ul>";
}

// �ƹ��͵� ���� �ȵ� ��, $bo_table�̳� ���α׷� �̸�����, $mnb, $snb�� ã���ش� - �ֽű��̳� �α�� ������ �����Դϴ�.
// �׷��� ���� �޴��� ���� �� �����ϰ� ������ ���ڴ� ������ �Ʒ� �ڵ带 ����� �˴ϴ�.
// ����, �׷����� ������ ��������� ���ϴ�.
if ($mnb == "" || $snb == "") {
    foreach ($mnb_arr as $item) {
        // ��â �ߴ°Ŵ� ���� ���Ѿ� �Ѵ�.
        if ($item['new'] !== '1' && $snb_arr[$item[id]]) {
            foreach ($snb_arr[$item[id]] as $sub_item) {
                // ��â �ߴ°Ŵ� ���� ���Ѿ� �Ѵ�.
                if ($sub_item['new'] !== '1') {
                    // parse_url�� �ؼ�, query�� ���� ã���ϴ�.
                    $u_item = parse_url($sub_item['href']);
                    // �㿡�� &�� explode ���ݴϴ�. ���ں��� �߶�� ����� �񱳸� ����.
                    if (trim($u_item['query']) == "") {
                        $u_array = array();
                        contine;
                    } else {
                        $u_array = explode("&", $u_item['query']);
                    }

                    if ($bo_table == "") {
                        // $bo_table�� ���� ����. �׷� �����ұ�? Ȥ�� Ư���� ���α׷� �̸��� �ƴұ�?
                        if ($sub_item['href'] && strstr($sub_item['href'], "$_SERVER[SCRIPT_NAME]")) {
                            $mnb = $item['id'];
                            $snb = $sub_item['id'];
                        }
                    } else {
                        // href�� ���� ������, href�� ������ذŴϱ�, �װŴ� ������ �Խ����̴�.
                        // ��? �׷��� href�� ���� �ִٱ�?
                        // �׷���, �迭�� �ִ��� ã�ƺ���~ ����ī. �� ���� ����� �ְ�����... ������ �ȳ���.
                        if (($sub_item['href'] == "" && $bo_table == $sub_item['id']) || $u_array && in_array("bo_table=$bo_table" , $u_array)) {
                            $mnb = $item['id'];
                            $snb = $sub_item['id'];
                        }
                    }
                }
            }
        }
    }
    
    // $mnb, $snb�� $qtr�� �־����¡... ����
    $qstr .= '&mnb=' . urlencode($mnb);
    $qstr .= '&snb=' . urlencode($snb);
}

// $mnb�� ������, �Խ��� ����� �߷� ���ϴ�. �ֽű� ���鶧 ��������.
function get_snb_list($menu) {
    global $g4, $mnb, $snb;

    $snb_list = array();
    
    if (!$menu)
        return;
    foreach ($menu as $item) {
        if ($item['new'] == '1' || $item['hidden'] == '1' || $item['type'] == 'bar')
            // ��â���� �ߴ°Ŵ� ǥ���� ���� ����
            continue;
        else {
            if (trim($item['href']) == "")
                // href�� ������ �⺻���� �Խ��� ���̺��� ���� �̸����� ������ �ִϱ�, �Խ����̶�����.
                $snb_list[] = $item[id];
            else {
                // url���� board.php?bo_table=�� �������� �Խ������� ����
                // parse_url�� �ؼ�, query�� ���� ã���ϴ�.
                $u_item = parse_url($item['href']);
                if (trim($u_item['query']) == "") {
                    // ���? query�� ����? �׷� �н�
                    contine;
                } else {
                    // ���� &�� ������ �߶�. �ȱ׷��� ���� �� �ְŵ�.
                    $u_array = explode("&", $u_item['query']);
                    // �迭�� �ִ��� ã�ƺ���~ �׷���, id�� bo_table�� �ٸ� �� �ִٴ°�...
                    // loop�� ������ bo_table=�� �ִ°� ã��, �㿡 $bo_table�� �߷��� �Ѵ�.
                    foreach ($u_array as $t_array) {
                        $ex = explode("bo_table=", $t_array);
                        // explode �ߴµ�, �����ʿ� ���� ������, �װ� $bo_table
                        if ($ex[1]) {
                            $snb_list[] = $ex[1];
                        }
                    }
                }
            }
        }
    }

    return $snb_list;
}
?>
<!-- �ʿ��� css�� ��� ���Խ��� �ݴϴ� -->
<link rel="stylesheet" href="<?=$g4[layout_skin_path]?>/layout.css" type="text/css" />
<link rel="stylesheet" href="<?=$g4[layout_skin_path]?>/top_menu.css" type="text/css" />
<link rel="stylesheet" href="<?=$g4[layout_skin_path]?>/side_menu.css" type="text/css" />
<link rel="stylesheet" href="<?=$g4[layout_skin_path]?>/ui.css" type="text/css" />
<link rel="stylesheet" href="<?=$g4[layout_skin_path]?>/footer.css" type="text/css" />