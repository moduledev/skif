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

Breadcrumbs::for('role-show', function ($trail, $name) {
    $trail->parent('roles');
    $trail->push('Данные роли '. $name, route('role.show', $name));
});

Breadcrumbs::for('role-edit', function ($trail, $name) {
    $trail->parent('roles');
    $trail->push('Изменить роль '. $name, route('role.show', $name));
});

Breadcrumbs::for('role-create', function ($trail) {
    $trail->parent('roles');
    $trail->push('Создать роль ', route('role.create'));
});

Breadcrumbs::for('info', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Контакные данные', route('info.index'));
});

Breadcrumbs::for('tasks', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Задачи', route('task.index'));
});

Breadcrumbs::for('task-create', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Создать задачу', route('task.create'));
});
