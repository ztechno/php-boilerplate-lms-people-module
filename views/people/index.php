<?php get_header() ?>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
        <div class="right-button ms-auto">
            <a href="<?= routeTo('people/create', $role) ?>" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> <?= __('crud.label.create') ?>
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if ($success_msg) : ?>
            <div class="alert alert-success"><?= $success_msg ?></div>
        <?php endif ?>
        <div class="table-responsive table-hover table-sales">
            <table class="table table-bordered datatable-crud" style="width:100%">
                <thead>
                    <tr>
                        <th width="20px">#</th>
                        <?php 
                        foreach($fields as $field): 
                            $label = $field;
                            if(is_array($field))
                            {
                                $label = $field['label'];
                            }
                            $label = _ucwords($label);
                        ?>
                        <th><?=$label?></th>
                        <?php endforeach ?>
                        <th class="text-right">
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<?php get_footer() ?>
