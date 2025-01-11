<?php

declare(strict_types=1);

namespace Boatrace\Venture\Project;

use DI\Container;
use DI\ContainerBuilder;

/**
 * @author shimomo
 */
class Converter
{
    /**
     * @var \Boatrace\Venture\Project\Converter
     */
    protected static Converter $instance;

    /**
     * @var \DI\Container
     */
    protected static Container $container;

    /**
     * @param  \Boatrace\Venture\Project\MainConverter  $converter
     * @return void
     */
    public function __construct(protected MainConverter $converter){}

    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return string|float|int|null
     */
    public function __call(string $name, array $arguments): string|float|int|null
    {
        return $this->converter->$name(...$arguments);
    }

    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return string|float|int|null
     */
    public static function __callStatic(string $name, array $arguments): string|float|int|null
    {
        return self::getInstance()->$name(...$arguments);
    }

    /**
     * @return \Boatrace\Venture\Project\Converter
     */
    public static function getInstance(): Converter
    {
        return self::$instance ?? self::$instance = (
            self::$container ?? self::$container = self::getContainer()
        )->get('Converter');
    }

    /**
     * @return \DI\Container
     */
    public static function getContainer(): Container
    {
        $builder = new ContainerBuilder;
        $builder->addDefinitions(__DIR__ . '/../config/definitions.php');
        return $builder->build();
    }
}
