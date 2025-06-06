<?php

class BusyBeeDomesticOrderCalculator extends AbstractBusyBeeOrderCalculator
{
    protected string $often;

    protected function setOften(string $often): self
    {
        $this->often = $often;
        return $this;
    }

    protected function getReservedPrice(): float
    {
        return (float) match ($this->often) {
            'One off',
            'Weekly' => get_option('domestic_cleaning_once_reserved_price'),
            'Monthly',
            'Fortnightly' => get_option('domestic_cleaning_every_reserved_price'),
        };
    }

    public function calculate(
        int $bedrooms,
        int $bathrooms,
        array $additionalServices,
    ): float {
        $price = $this->getReservedPrice();
        $price = $this->addPrice($price, max($bathrooms, 0) * $this->getBathroomPrice());
        $price = $this->addPrice($price, max($bedrooms, 0) * $this->getBedroomPrice());

        if ($this->isSpaceFurnished()) {
            $price = $this->addPrice($price, $this->getFurnishedExtraPrice());
        }
        if ($this->isOurCleaningProducts()) {
            $price = $this->addPrice($price, $this->getOurCleaningProductsPrice());
        }
        foreach ($additionalServices as $service => $quantity) {
            $price = $this->addPrice($price, $this->getExtraOptionsPrice($service) * max($quantity, 0));
        }

        return $price;
    }

    protected function getBedroomPrice(): float
    {
        return (float) match ($this->often) {
            'One off',
            'Weekly' => get_option('domestic_cleaning_once_price_per_bedroom'),
            'Monthly',
            'Fortnightly' => get_option('domestic_cleaning_every_price_per_bedroom'),
        };
    }

    protected function getBathroomPrice(): float
    {
        return (float) match ($this->often) {
            'One off',
            'Weekly' => get_option('domestic_cleaning_once_price_per_bathroom'),
            'Monthly',
            'Fortnightly' => get_option('domestic_cleaning_every_price_per_bathroom'),
        };
    }

    public function load(BusyBeeDynamicModel $model): self
    {
        return $this->setOurCleaningProducts($model->getAttribute('cleaning_products'))
            ->setOften($model->getAttribute('often_work'));
    }
}
