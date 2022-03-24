<?php

return [
    'title' => config('app.name').' | Compra gratis - Vende fácil',
    'menu' => [
        'profile' => [
            'configuration' => 'Configuración',
            'change-password' => 'Cambiar contraseña',
            'alerts' => 'Alertas',
            'logout' => 'Cerrar sesión'
        ],
        'processes' => 'Procesos',
        'publications' => 'Publicaciones',
        'my-purchases' => 'Mis compras',
        'my-offers' => 'Mis ofertas',
        'bookmarks' => 'Favoritos',
        'administration' => 'Administración',
        'resume' => 'Resumen',
        'notifications' => 'Notificaciones',
        'help' => 'Ayuda',
        'faq' => 'Preguntas frecuentes',
    ],
    'footer' => [
        'all-right-reserved' => 'Todos los derechos reservados por ' . config('app.name', 'Laravel')
    ]
]


?>
