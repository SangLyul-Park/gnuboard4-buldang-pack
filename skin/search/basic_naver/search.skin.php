<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<script type="text/javascript" src="<?="$g4[path]/js/suggest.js"?>"></script>

<!-- <table width="95%"  border="0" cellspacing="0" cellpadding="0" align="center"> -->
<table width="95%"  border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td width="24"><img src="<?=$search_skin_path?>/img/searchbg_01.gif"></td>
<!--    <td background="<?=$search_skin_path?>/img/searchbg_02.gif"><table align=center width=95% cellpadding=2 cellspacing=0 height="50"> -->
    <td background="<?=$search_skin_path?>/img/searchbg_02.gif"><table width=95% cellpadding=2 cellspacing=0 height="50">
      <form name=fsearch method=get action="javascript:fsearch_submit(document.fsearch);"  autocomplete="off">
        <input type="hidden" name="srows" value="<?=$srows?>">
        <tr>
<!--          <td align=center  height="25"> -->
          <td height="25">
		  
		  <?=$group_select?>
                <script language="JavaScript">document.getElementById("gr_id").value = "<?=$gr_id?>";</script>
                <select name=sfl class=select>
                  <option value="wr_subject||wr_content">����+����</option>
                  <option value="wr_subject">����</option>
                  <option value="wr_content">����</option>
                  <option value="mb_id">ȸ�����̵�</option>
                  <option value="wr_name">�̸�</option>
                </select>
                <input type=text name=stx maxlength=20 required itemname="�˻���" value='<?=$text_stx?>'>
                <input name="image" type=image src="<?=$search_skin_path?>/img/search_btn.gif"  align="absmiddle" width="60" height="25" border=0>
                
				<script language="javascript">
        document.fsearch.sfl.value = "<?=$sfl?>";
       
        function fsearch_submit(f)
        {
            /*
            // �˻��� ���� ���ϰ� �ɸ��� ��� �� �ּ��� �����ϼ���.
            var cnt = 0;
            for (var i=0; i<f.stx.value.length; i++)
            {
                if (f.stx.value.charAt(i) == ' ')
                    cnt++;
            }

            if (cnt > 1)
            {
                alert("���� �˻��� ���Ͽ� �˻�� ������ �Ѱ��� �Է��� �� �ֽ��ϴ�.");
                f.stx.select();
                f.stx.focus();
                return;
            }
            */
            
            f.action = "";
            f.submit();
        }
        </script>
          </td>
        </tr>
        <tr>
<!--      <td align=center> ������ &nbsp; -->
          <td > ������ &nbsp;
                <input type="radio" name="sop" value="or" <?=($sop == "or") ? "checked" : "";?>>
            OR &nbsp;
                <input type="radio" name="sop" value="and" <?=($sop == "and") ? "checked" : "";?>>
            AND </td>
        </tr>
      </form>
    </table></td>
    <td width="23"><img src="<?=$search_skin_path?>/img/searchbg_03.gif"></td>
  </tr>
</table>

<!------------�˻����κг�-------------->
<p>


<!-- <table align=center width=95% cellpadding=2 cellspacing=0> -->
<table width=95% cellpadding=2 cellspacing=0>
<tr>
    <td style='word-break:break-all;' class=search>

        <? 
        if ($stx) 
        { 
            echo "<b>�˻��� ����Ʈ</b> (<b>{$board_count}</b>���� ����Ʈ, <b>".number_format($total_count)."</b>���� �Խñ�, <b>".number_format($page)."/".number_format($total_page)."</b> ������)";
            if ($board_count)
            {
                echo "<ul><ul style='line-height:130%;'>";
                if ($onetable)
                    echo "<img src='$search_skin_path/img/icon_folder2.gif' border='0' align='absmiddle'>&nbsp;<a href='?$search_query&gr_id=$gr_id'>��ü�Խ��� �˻�</a>";
                //echo "<img src='$search_skin_path/img/icon_folder2.gif' border='0' align='absmiddle'>&nbsp;";
				echo $str_board_list;
                echo "</ul></ul>";
            }
            else
            {
                echo "<ul style='line-height:130%;'><li><b>�˻��� �ڷᰡ �ϳ��� �����ϴ�.</b></ul>";
            }
        }
        ?>

        <? 
        $k=0;
        for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) 
        { 
            echo "<img src='$search_skin_path/img/icon_folder2.gif' border='0' align='absmiddle'>&nbsp;<b><a href='./board.php?bo_table={$search_table[$idx]}&{$search_query}'><u>{$bo_subject[$idx]}</u></a>������ �˻����</b>";
            $comment_href = "";
            for ($i=0; $i<count($list[$idx]) && $k<$rows; $i++, $k++) 
            {   
        				$content = cut_str(trim(strip_tags($list[$idx][$i][wr_content])),300,"��");
                $content = search_font($stx, $content);
                echo "<ul><ul style='line-height:130%;'> <img src='$search_skin_path/img/icon_list.gif' border='0' align='absmiddle'>";
                if ($list[$idx][$i][wr_is_comment]) 
                {
                    echo "<font color=999999>[�ڸ�Ʈ]</font> ";
                    $comment_href = "#c_".$list[$idx][$i][wr_id];
                }
                echo "<a href='{$list[$idx][$i][href]}{$comment_href}'><u>";
                echo $list[$idx][$i][subject];
                echo "</u></a> [<a href='{$list[$idx][$i][href]}{$comment_href}' target=_blank>��â</a>]<br>";
				echo $content;
                echo "<br><font color=#999999>{$list[$idx][$i][wr_datetime]}</font>&nbsp;&nbsp;&nbsp;";
                echo $list[$idx][$i][name];
                echo "</ul></ul>";
            }
        }
        ?>

<!--        <p align=center><?=$write_pages?> -->
        <p ><?=$write_pages?>

</td></tr></table>

<script language="JavaScript"> 
    document.fsearch.stx.obj = sug_set_properties(document.fsearch.stx, '<?=$search_skin_path?>/suggest_search.php', true, false, true); 
</script> 
