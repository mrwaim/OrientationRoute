<?php
$videoSubmenu = [];
foreach ($videos as $video) {
    $videoSubmenu[] = [
            'videoFilter' => $video->id,
            'url' => $video->order_number . '-' . $video->slug . '/view',
            'menu' => ($video->watchedByUser($auth->user) ? '✔' : '') . ' ' . $video->title,
    ];
}
?>
@include('elements.side-menu-parent-item', [
'folder' => 'videos',
'menu' => 'Orientation Video',
'menuIcon' => 'fa-graduation-cap',
'children' => array_merge($videoSubmenu,
 [ [
        'page' => 'all',
        'url' => 'all',
        'menu' => 'View All Videos',
    ]
])])
