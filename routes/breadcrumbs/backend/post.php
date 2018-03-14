<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 3/13/18
 * Time: 23:15
 */

Breadcrumbs::register('admin.post.index', function ($breadcrumbs) {
    $breadcrumbs->push('Quản lý bài viết', route('admin.post.index'));
});

Breadcrumbs::register('admin.post.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.post.index');
    $breadcrumbs->push('Tạo mới', route('admin.post.create'));
});

Breadcrumbs::register('admin.post.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.post.index');
    $breadcrumbs->push('Chỉnh sửa', route('admin.post.edit', $id));
});