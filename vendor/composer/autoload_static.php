<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit45558008e71a25162fe27953274c0fc2
{
    public static $files = array (
        '1db9a602f20508d50525f9dad168786f' => __DIR__ . '/..' . '/htmlburger/carbon-field-icon/core/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Carbon_Fields\\' => 14,
            'Carbon_Field_Icon\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Carbon_Fields\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/carbon-fields/core',
        ),
        'Carbon_Field_Icon\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/carbon-field-icon/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit45558008e71a25162fe27953274c0fc2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit45558008e71a25162fe27953274c0fc2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit45558008e71a25162fe27953274c0fc2::$classMap;

        }, null, ClassLoader::class);
    }
}
