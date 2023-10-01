<?php

use Core\Page;
use Modules\Crud\Libraries\Repositories\CrudRepository;

// init table fields
$tableName  = 'people';
$table      = tableFields($tableName);
$role       = [
    'role' => 'instructor'
];

$_GET['filter'] = $role;
$fields     = $table->getFields();
$module     = $table->getModule();
$success_msg = get_flash_msg('success');

// get data
$crudRepository = new CrudRepository($tableName);
$crudRepository->setModule($module);
$data           = $crudRepository->get();

if(isset($_GET['draw']))
{
    return $crudRepository->dataTable($fields, function($d){
        $action = '<a href="'.routeTo('people/edit',['id'=>$d->id,'role'=>'instructor']).'" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i> '.__('crud.label.edit').'</a> ';
        $action .= '<a href="'.routeTo('people/delete',['id'=>$d->id,'role'=>'instructor']).'" onclick="if(confirm(\''.__('crud.label.confirm_msg').'\')){return true}else{return false}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> '.__('crud.label.delete').'</a>';

        return $action;
    });
}

// page section
$title = _ucwords(__("$module.label.instructors"));
Page::setActive("$module.instructors");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('people/instructors'),
        'title' => $title
    ],
    [
        'title' => 'Index'
    ]
]);

Page::pushFoot("<script src='".asset('assets/crud/js/crud.js')."'></script>");

return view('people/views/people/index', compact('data', 'fields', 'tableName', 'success_msg', 'role'));