<?php

return [
    [
        'label' => 'people.menu.people',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-users',
        'activeState' => ['people.people','people.instructors','people.participants'],
        'route' => '',
        'items' => [
            [
                'label' => 'people.menu.instructors',
                'route' => routeTo('people/instructors'),
                'activeState' => 'people.instructors'
            ],
            [
                'label' => 'people.menu.participants',
                'route' => routeTo('people/participants'),
                'activeState' => 'people.participants'
            ],
        ]
    ],
    
];