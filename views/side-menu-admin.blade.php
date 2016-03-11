@include('elements.side-menu-parent-item', [
'folder' => 'videos',
'menu' => 'Orientation Video',
'menuIcon' => 'fa-graduation-cap',
'children' => [ [
        'page' => 'all',
        'url' => 'all',
        'menu' => 'View All Videos',
    ], [
        'page' => 'all-videos',
        'url' => 'all-videos',
        'menu' => 'All Videos',
    ], [
        'page' => 'create-video',
        'url' => 'create-video',
        'menu' => 'Create Video',
    ], [
        'page' => 'users',
        'url' => 'users',
        'menu' => 'View Users',
    ]
]])