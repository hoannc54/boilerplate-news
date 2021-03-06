<?php

return [

    /*
     * Application captcha specific settings
     */
    'captcha'                => [
        /*
         * Whether the registration captcha is on or off
         */
        'registration' => env('REGISTRATION_CAPTCHA_STATUS', false),
    ],

    /*
     * Whether or not registration is enabled
     */
    'registration'           => env('ENABLE_REGISTRATION', true),

    /*
     * Table names for access tables
     */
    'table_names'            => [
        'users' => 'users',
    ],

    /*
     * Configurations for the user
     */
    'users'                  => [
        /*
         * Whether or not the user has to confirm their email when signing up
         */
        'confirm_email'         => env('CONFIRM_EMAIL', false),

        /*
         * Whether or not the users email can be changed on the edit profile screen
         */
        'change_email'          => env('CHANGE_EMAIL', false),

        /*
         * The name of the super administrator role
         */
        'admin_role'            => 'administrator',

        /*
         * The default role all new registered users get added to
         */
        'default_role'          => 'user',

        /*
         * Whether or not new users need to be approved by an administrator before logging in
         * If this is set to true, then confirm_email is not in effect
         */
        'requires_approval'     => env('REQUIRES_APPROVAL', false),

        /*
         * Login username to be used by the controller.
         */
        'username'              => 'email',

        /*
         * Session Database Driver Only
         * When active, a user can only have one session active at a time
         * That is all other sessions for that user will be deleted when they log in
         * (They can only be logged into one place at a time, all others will be logged out)
         */
        'single_login'          => true,

        /*
         * How many days before users have to change their passwords
         * false is off
         */
        'password_expires_days' => env('PASSWORD_EXPIRES_DAYS', 30),
    ],

    /*
    * Configuration for roles
    */
    'roles'                  => [
        /*
         * Whether a role must contain a permission or can be used standalone as a label
         */
        'role_must_contain_permission' => true,
    ],

    /*
     * Socialite session variable name
     * Contains the name of the currently logged in provider in the users session
     * Makes it so social logins can not change passwords, etc.
     */
    'socialite_session_name' => 'socialite_provider',

    'role_list'              => [
        'administrator' => 'Administrator',
        'admod'         => 'Admod',
        'author'        => 'Author'
    ],
    'perm_list'              => [
        //Backend
        'view_backend'        => 'Xem admin',
        'view_log'            => 'Xem log hệ thống',
        //Categories
        'view_categories'     => 'Xem danh mục',
        'create_categories'   => 'Tạo danh mục',
        'edit_categories'     => 'Sửa danh mục',
        'delete_categories'   => 'Xoá danh mục',
        // Posts
        'view_other_posts'    => 'Xem các bài viết của người khác',
        'create_posts'        => 'Tạo bài viết',
        'edit_other_posts'    => 'Sửa bài viết của người khác',
        'delete_posts'        => 'Xoá bài viết',
        'delete_other_posts'  => 'Xoá bài viết của người khác',
        'publish_posts'       => 'Công khai bài viết',
        'publish_other_posts' => 'Công khai bài viết của người khác',
        // Users
        'view_users'          => 'Xem danh sách người dùng',
        'create_users'        => 'Tạo người dùng',
        'edit_users'          => 'Chỉnh sửa người dùng',
        'delete_users'        => 'Xoá người dùng',
        //Roles
        'view_roles'          => 'Xem danh sách role',
        'create_roles'        => 'Tạo role mới',
        'edit_roles'          => 'Chỉnh sửa role',
        'delete_roles'        => 'Xoá role'
    ],
    'admod_perms' => [],
    'author_perms' => []
];
