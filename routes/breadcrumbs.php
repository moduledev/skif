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

Breadcrumbs::for('admin-edit', function ($trail, $name) {
    $trail->parent('admins');
    $trail->push('Редактирование данных '. $name, route('admin.edit', $name));
});

Breadcrumbs::for('admin-create', function ($trail) {
    $trail->parent('admins');
    $trail->push('Добавить нового администратора', route('admin.create'));
});

Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Доступные роли', route('role.index'));
});
