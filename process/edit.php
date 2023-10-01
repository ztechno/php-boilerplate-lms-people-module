<?php

use Core\Page;
use Core\Request;
use Modules\Crud\Libraries\Repositories\CrudRepository;

// init table fields
$tableName  = 'people';
$id         = $_GET['id'];
$table      = tableFields($tableName);
$fields     = $table->getFields();
$module     = $table->getModule();
$titlePref  = isset($_GET['role']) ? $_GET['role'] : $tableName;
$title      = _ucwords(__("$module.label.$titlePref"));
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');

unset($fields['email']);

$crudRepository = new CrudRepository($tableName);
$crudRepository->setModule($module);

$route      = isset($_GET['role']) ? '/'.$_GET['role'].'s' : '';

if(Request::isMethod('POST'))
{

    $crudRepository->update($_POST[$tableName], [
        'id' => $id
    ]);

    set_flash_msg(['success'=>"$title berhasil diupdate"]);

    header('location:'.routeTo('people'.$route,$params));
    die();
}

$data = $crudRepository->find([
    'id' => $id
]);

// page section
Page::setActive("$module.$tableName");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('people'.$route),
        'title' => $title
    ],
    [
        'title' => __('crud.label.edit')
    ]
]);

return view('crud/views/edit', compact('fields', 'tableName', 'data', 'error_msg', 'old'));