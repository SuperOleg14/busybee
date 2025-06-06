<?php

abstract class AbstractBusyBeeOrderCalculator
{
    protected const EXTRA_PRICES_POSTFIX = '_price';

    protected bool $spaceFurnished;
    protected bool $isOurCleaningProducts;
    protected int $typeCleaning;

    abstract protected function getReservedPrice(): float;

    abstract public function calculate(
        int $bedrooms,
        int $bathrooms,
        array $additionalServices,
    ): float;

    abstract protected function getBedroomPrice(): float;

    abstract protected function getBathroomPrice(): float;

    abstract public function load(BusyBeeDynamicModel $model): self;

    /**
     * Provides extra options values.
     * If "get_option" function will return "false", (float) will transform this value to zero.
     *
     * @param string $serviceName
     *
     * @return float
     */
    protected function getExtraOptionsPrice(string $serviceName): float
    {
        return (float) get_option($serviceName . self::EXTRA_PRICES_POSTFIX);
    }

    protected function getFurnishedExtraPrice(): float
    {
        return (float) get_option('is_furnished_extra_price');
    }

    protected function getOurCleaningProductsPrice(): float
    {
        return (float) get_option('include_our_cleaning_products');
    }

    protected function addPrice(float $original, float $add): float
    {
        return max($original + $add, $this->getReservedPrice());
    }

    protected function isSpaceFurnished(): bool
    {
        return isset($this->spaceFurnished) && $this->spaceFurnished === true;
    }

    protected function isOurCleaningProducts(): bool
    {
        return isset($this->isOurCleaningProducts) && $this->isOurCleaningProducts === true;
    }

    public function setTypeCleaning(int $type): self
    {
        $this->typeCleaning = $type;

        return $this;
    }

    public function setSpaceFurnished(bool $furnished): self
    {
        $this->spaceFurnished = $furnished;

        return $this;
    }

    public function setOurCleaningProducts(bool $isOur): self
    {
        $this->isOurCleaningProducts = $isOur;

        return $this;
    }
}
