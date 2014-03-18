<?php
include_once('./_common.php');

header("Content-Type: text/html; charset=$g4[charset]");

if ($is_admin != 'super')
    die('�ְ�����ڸ� ���� �����մϴ�.');

switch($type) {
    case 'group':
        $sql = " select gr_id as id, gr_subject as subject
                    from $g4[group_table]
                    order by gr_id ";
        break;
    case 'board':
        $sql = " select bo_table as id, bo_subject as subject
                    from $g4[board_table]
                    order by bo_table ";
        break;
        /*
    case 'content':
        $sql = " select co_id as id, co_subject as subject
                    from $g4[content_table]
                    order by co_id ";
        break;
    */
    default:
        $sql = '';
        break;
}
?>

<?php
if($sql) {
    $result = sql_query($sql);

    for($i=0; $row=sql_fetch_array($result); $i++) {
        if($i == 0) {
?>
<table class="table table-hover">
        <thead>
        <tr>
        <th scope="col">����</th>
        <th scope="col">����</th>
        </tr>
        </thead>
        <tbody>
<?php }
        switch($type) {
            case 'group':
                $link = $g4[bbs_path].'/group.php?gr_id='.$row['id'];
                break;
            case 'board':
                $link = $g4[bbs_path].'/board.php?bo_table='.$row['id'];
                break;
            /*
            case 'content':
                $link = $g4[bbs_path].'/content.php?co_id='.$row['id'];
                break;
            */
            default:
                $link = '';
                break;
        }
?>

    <tr>
        <td><?php echo $row['subject']; ?></td>
        <td>
            <input type="hidden" name="subject[]" value="<?php echo preg_replace('/[\'\"]/', '', $row['subject']); ?>">
            <input type="hidden" name="link[]" value="<?php echo $link; ?>">
			<button type="button" name="act_button" class="btn btn-success"><span class="sr-only"><?php echo $row['subject']; ?> </span>����</button>
        </td>
    </tr>

<?php } ?>
        </tbody>
      </table>
</div>


<div>
    <button type="button" class="btn btn-default" onclick="window.close();">â�ݱ�</button>
</div>

<?php } else { ?>

<div>
    <table class="table table-hover">
    <colgroup>
        <col>
        <col>
    </colgroup>
    <tbody class="col-lg-2">
    <tr>
        <th scope="row"><label for="me_name">�޴�</label></th>
        <td><input type="text" name="me_name" id="me_name" required class="form-control"></td>
    </tr>
    <tr>
        <th scope="row"><label for="me_link">��ũ</label></th>
        <td>
            <input type="text" name="me_link" id="me_link" required class="form-control">
          	<?=help("ȸ������ �Ϸ翡 �ѹ��� �ο�")?>
        </td>
    </tr>
    </tbody>
    </table>
</div>

<div class="text-center">
    <button id="add_manual" class="btn btn-success">�߰�</button>
    <button class="btn btn-default" onclick="window.close();">â�ݱ�</button>
</div>
<?php } ?>