<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit37a5f35fc27ed9593f620cb133bba7a5
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'primakurzy\\Shortcode\\' => 21,
        ),
        'T' => 
        array (
            'Thunder\\Shortcode\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'primakurzy\\Shortcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/primakurzy/shortcode/src',
        ),
        'Thunder\\Shortcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/thunderer/shortcode/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit37a5f35fc27ed9593f620cb133bba7a5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit37a5f35fc27ed9593f620cb133bba7a5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit37a5f35fc27ed9593f620cb133bba7a5::$classMap;

        }, null, ClassLoader::class);
    }
}
