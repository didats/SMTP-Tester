<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf7ce2f7ce5dac4a500bd66c0c047f8c4
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf7ce2f7ce5dac4a500bd66c0c047f8c4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf7ce2f7ce5dac4a500bd66c0c047f8c4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf7ce2f7ce5dac4a500bd66c0c047f8c4::$classMap;

        }, null, ClassLoader::class);
    }
}
