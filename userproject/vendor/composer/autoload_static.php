<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit777d1eedcaa4aed57d0780684f6cea7d
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Akash\\UserProject\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Akash\\UserProject\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit777d1eedcaa4aed57d0780684f6cea7d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit777d1eedcaa4aed57d0780684f6cea7d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit777d1eedcaa4aed57d0780684f6cea7d::$classMap;

        }, null, ClassLoader::class);
    }
}
