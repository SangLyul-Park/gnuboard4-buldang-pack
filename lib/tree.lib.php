<?
// ���α׷� : Ʈ���޴� ���̺귯�� 
// �� �� �� : GPL2

// tree item���� ���� �ɴϴ�
function get_tree_items($tree_table) {
    $sql = "select * from $tree_table where 1 ORDER BY tree_parent_id, tree_order";
    $result = sql_query($sql);
    
    $tree = array();
    while ($row = sql_fetch_array($result)) {
        $tree[] = $row;
    }

    return $tree;
}


function expand_Tree($node) {
  $result = array('text' => $node['title'], 'children' => array());
  $nodes = getChildren($node);  // query all nodes whose parent_id = $node['id']
  foreach ($nodes as $node) {
    $result['children'][] = expand_Tree($node);
  }
  return $result;
}

function getChildren($node) {
    $sql = " select * from g4_menu where tree_parent_id = '$node' where 1 ORDER BY tree_order";
    $result = sql_query($sql);

    $tree = array();
    while ($row = sql_fetch_array($result)) {
        $tree[] = $row;
    }
}
?>