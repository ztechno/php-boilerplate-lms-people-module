<?php
$roleClause = '';
if($filter)
{
    $filter_query = [];
    foreach($filter as $f_key => $f_value)
    {
        if($f_key == 'role')
        {
            // $f_value = ucwords($f_value);
            // $filter_query[] = "roles.name = '$f_value'";
        }
        else
        {
            $filter_query[] = "$f_key = '$f_value'";
        }
    }

    $filter_query = implode(' AND ', $filter_query);

    if(empty($where) && empty($filter_query))
    {
    }
    else
    {
        $where = (empty($where) && $filter_query ? 'WHERE ' : ' AND ') . $filter_query;
    }
    $roleClause = isset($_GET['filter']['role']) ? "AND roles.name='".ucwords($_GET['filter']['role'])."'" : '';
}


$db->query = "SELECT 
                $table.*, 
                roles.name as role
              FROM 
                $table 
              JOIN user_roles ON user_roles.user_id = $table.user_id
              JOIN roles ON roles.id = user_roles.role_id $roleClause
              $where ORDER BY ".$col_order." ".$order[0]['dir']." LIMIT $start,$length";

$data  = $db->exec('all');

$total = $db->exists($table,$where,[
    $col_order => $order[0]['dir']
]);

return compact('data','total');