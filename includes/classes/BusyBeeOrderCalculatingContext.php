<?php

class BusyBeeOrderCalculatingContext
{
    public const END_OF_TENANCY_CLEANING = 1;
    public const DEEP_CLEANING = 2;
    public const AFTER_CONSTRUCTION_CLEANING = 3;
    public const CARPET_CLEANING = 4;
    public const DOMESTIC_CLEANING = 5;
    public const COMMERCIAL_CLEANING = 6;
    public const CLEANING_MAPPER = [
        self::END_OF_TENANCY_CLEANING => 'End of tenancy cleaning',
        self::DEEP_CLEANING => 'Deep cleaning',
        self::AFTER_CONSTRUCTION_CLEANING => 'After construction cleaning',
        self::CARPET_CLEANING => 'Carpet cleaning',
        self::DOMESTIC_CLEANING => 'Domestic cleaning',
        self::COMMERCIAL_CLEANING => 'Commercial cleaning',
    ];

    public array $strategyMapper = [];

    public function __construct()
    {
        $this->strategyMapper = array_fill_keys(
            [
                self::END_OF_TENANCY_CLEANING,
                self::DEEP_CLEANING,
                self::AFTER_CONSTRUCTION_CLEANING,
                self::CARPET_CLEANING,
                self::COMMERCIAL_CLEANING,
            ],
            new BusyBeeDefaultOrderCalculator()
        );
        $this->strategyMapper[self::DOMESTIC_CLEANING] = new BusyBeeDomesticOrderCalculator();
    }

    public function getStrategy(int $identifier): AbstractBusyBeeOrderCalculator
    {
        if (
            isset($this->strategyMapper[$identifier])
            && $this->strategyMapper[$identifier] instanceof AbstractBusyBeeOrderCalculator
        ) {
            return $this->strategyMapper[$identifier]->setTypeCleaning($identifier);
        }
        throw new RuntimeException('Unknown strategy.');
    }

    public static function getTypeCleaning(int $type): string
    {
        if (isset(self::CLEANING_MAPPER[$type])) {
            return self::CLEANING_MAPPER[$type];
        }
        throw new RuntimeException('Unknown strategy.');
    }
}