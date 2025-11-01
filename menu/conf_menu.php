<?php

// Убираем верхний уровень 'menu'
return [
    'default' => [
        'items' => [
            'dashboard' => [
                'label' => 'Dashboard',
                'url' => '/lexiroru/',
                'page' => 'dashboard'
            ],
            'word_manager' => [
                'label' => 'Менеджер слов', 
                'url' => '?page=wm',
                'page' => 'wm'
            ],
            'settings' => [
                'label' => 'Настройки',
                'url' => '?page=settings',
                'page' => 'settings'
            ]
        ],
        'classes' => [
            'list' => 'menu-list',
            'item' => 'menu-item',
            'link' => 'menu-link',
            'active' => 'active'
        ]
    ],
'user' => [
    'items' => [
        'profile' => [
            'label' => 'Мой профиль',
            'url' => '?page=profile',
            'page' => 'profile'
        ],
        'messages' => [
            'label' => 'Сообщения', 
            'url' => '?page=messages',
            'page' => 'messages'
        ]
    ]
],
    'admin' => [
        'items' => [
            'admin_dashboard' => [
                'label' => 'Панель управления',
                'url' => '/admin',
                'page' => 'admin'
            ],
            'user_management' => [
                'label' => 'Управление пользователями',
                'url' => '?page=users', 
                'page' => 'users'
            ],
            'system_reports' => [
                'label' => 'Системные отчеты',
                'url' => '?page=reports',
                'page' => 'reports'
            ]
        ],
        'classes' => [
            'list' => 'admin-menu',
            'item' => 'admin-menu-item',
            'link' => 'admin-menu-link',
            'active' => 'admin-active'
        ]
    ]
];