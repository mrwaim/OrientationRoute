@include('elements.side-menu-parent-item', [
'folder' => 'videos',
'menu' => 'Orientation Video',
'menuIcon' => 'fa-graduation-cap',
'children' =>
 [ [
        'page' => 'all',
        'url' => 'all',
        'menu' => 'View All Videos',
    ]
]])
