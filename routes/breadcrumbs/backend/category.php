<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 3/13/18
 * Time: 23:15
 */

Breadcrumbs::register('admin.category.index', function ($breadcrumbs) {
    $breadcrumbs->push('Danh mục', route('admin.category.index'));
});

Breadcrumbs::register('admin.category.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.category.index');
    $breadcrumbs->push('Tạo mới', route('admin.category.create'));
});

Breadcrumbs::register('admin.category.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.category.index');
    $breadcrumbs->push('Chỉnh sửa', route('admin.category.edit', $id));
});