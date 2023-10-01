<?php

use Core\Database;

if(isset($_GET['role']))
{
    $db = new Database();
    $role = $db->single('roles',[
        'name' => ucwords($_GET['role'])
    ]);

    if($role)
    {
        $db->insert('user_roles', [
            'user_id' => $data->user_id,
            'role_id' => $role->id
        ]);
    }
    
}