<?php

use Core\Page;
use Core\Request;
use Modules\Crud\Libraries\Repositories\CrudRepository;

// init table fields
$tableName  = 'people';
$table      = tableFields($tableName);
$fields     = $table->getFields();
$module     = $table->getModule();
$titlePref  = isset($_GET['role']) ? $_GET['role'] : $tableName;
$title      = _ucwords(__("$module.label.$titlePref"));
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');
$route      = isset($_GET['role']) ? '/'.$_GET['role'].'s' : '';

if(Request::isMethod('POST'))
{

    $crudRepository = new CrudRepository($tableName);
    $crudRepository->setModule($module);
    $crudRepository->create($_POST[$tableName]);

    set_flash_msg(['success'=>"$title berhasil ditambahkan"]);

    header('location:'.routeTo('people'.$route));
    die();
}

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
        'title' => __('crud.label.create')
    ]
]);

return view('crud/views/create', compact('fields', 'tableName', 'error_msg', 'old'));