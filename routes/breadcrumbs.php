<?php
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Главная', route('dashboard.index'));
});

Breadcrumbs::for('admins', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Администраторы', route('admin.index'));
});

Breadcrumbs::for('admin-show', function ($trail, $name) {
    $trail->parent('admins');
    $trail->push('Администратор '. $name, route('admin.show', $name));
});
