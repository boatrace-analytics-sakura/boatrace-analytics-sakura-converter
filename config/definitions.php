<?php

declare(strict_types=1);

return [
    'Converter' => \DI\create('\Boatrace\Venture\Project\Converter')->constructor(
        \DI\get('MainConverter')
    ),
    'MainConverter' => function ($container) {
        return $container->get('\Boatrace\Venture\Project\MainConverter');
    },
];
