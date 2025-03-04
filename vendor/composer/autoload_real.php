<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit454c6c26b888612756b61d0ea07a6145
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit454c6c26b888612756b61d0ea07a6145', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit454c6c26b888612756b61d0ea07a6145', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit454c6c26b888612756b61d0ea07a6145::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
