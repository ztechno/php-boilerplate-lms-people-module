<?php

use Modules\Crud\Libraries\Repositories\CrudRepository;

// init table fields
$tableName  = 'people';
$id         = $_GET['id'];
$table      = tableFields($tableName);
$fields     = $table->getFields();
$module     = $table->getModule();

$crudRepository = new CrudRepository($tableName);
$crudRepository->setModule($module);
$crudRepository->delete([
    'id' => $id
]);

$titlePref  = isset($_GET['role']) ? $_GET['role'] : $tableName;
$title      = _ucwords(__("$module.label.$titlePref"));
$route      = isset($_GET['role']) ? '/'.$_GET['role'].'s' : '';

set_flash_msg(['success'=>"$title berhasil dihapus"]);

header('location:'.routeTo('people'.$route));
die();
