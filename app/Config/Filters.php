<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\Filter_auth;
use App\Filters\No_auth;
use App\Filters\Filter_Admin;
use App\Filters\Filter_viewer;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'             => CSRF::class,
        'toolbar'          => DebugToolbar::class,
        'honeypot'         => Honeypot::class,
        'Filter_auth'      => Filter_auth::class,
        'invalidchars'     => InvalidChars::class,
        'secureheaders'    => SecureHeaders::class,
        'No_auth'          => No_auth::class,
        'Filter_admin'     => Filter_admin::class,
        'Filter_viewer'    => Filter_viewer::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'Filter_admin' => ['except' => [
                'auth', 'auth/*',
                '/'
            ]],
            'Filter_viewer' => ['except' => [
                'auth', 'auth/*',
                '/'
            ]],
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'Filter_admin' => ['except' => [
                'home', 'home/*',
                'kategori', 'kategori/*',
                'dep', 'dep/*',
                'arsip', 'arsip/*',
                'user', 'user/*'
            ]],
            'Filter_viewer' => ['except' => [
                'viewer', 'viewer/*',
                'kategoriviewer', 'kategoriviewer/*',
                'depviewer', 'depviewer/*',
                'arsipviewer', 'arsipviewer/*',
                'profile', 'profile/*'
            ]],
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
