<?php

class BusyBeeDefaultOrderCalculator extends AbstractBusyBeeOrderCalculator
{
    protected function getReservedPrice(): float
    {
        return (float) match ($this->typeCleaning) {
            BusyBeeOrderCalculatingContext::END_OF_TENANCY_CLEANING => get_option(
                'end_of_tenancy_reserved_price'
            ),
            BusyBeeOrderCalculatingContext::DEEP_CLEANING => get_option(
                'deep_cleaning_reserved_price'
            ),
            BusyBeeOrderCalculatingContext::AFTER_CONSTRUCTION_CLEANING => get_option(
                'after_construction_reserved_price'
            ),
            BusyBeeOrderCalculatingContext::CARPET_CLEANING => get_option(
                'carpet_cleaning_reserved_price'
            ),
        };
    }

    protected function getBedroomPrice(): float
    {
       return (float) match ($this->typeCleaning) {
            BusyBeeOrderCalculatingContext::END_OF_TENANCY_CLEANING => get_option(
                'end_of_tenancy_price_per_bedroom'
            ),
            BusyBeeOrderCalculatingContext::DEEP_CLEANING => get_option(
                'deep_cleaning_price_per_bedroom'
            ),
            BusyBeeOrderCalculatingContext::AFTER_CONSTRUCTION_CLEANING => get_option(
                'after_construction_price_per_bedroom'
            ),
            BusyBeeOrderCalculatingContext::CARPET_CLEANING => get_option(
                'carpet_cleaning_price_per_bedroom'
            ),
        };
    }
    protected function getBathroomPrice(): float
    {
        return (float) match ($this->typeCleaning) {
            BusyBeeOrderCalculatingContext::END_OF_TENANCY_CLEANING => get_option(
                'end_of_tenancy_price_per_bathroom'
            ),
            BusyBeeOrderCalculatingContext::DEEP_CLEANING => get_option(
                'deep_cleaning_price_per_bathroom'
            ),
            BusyBeeOrderCalculatingContext::AFTER_CONSTRUCTION_CLEANING => get_option(
                'after_construction_price_per_bathroom'
            ),
            BusyBeeOrderCalculatingContext::CARPET_CLEANING => get_option(
                'carpet_cleaning_price_per_bathroom'
            ),
        };
    }
    protected function getExtraFrom(): int
    {
        return (int) match ($this->typeCleaning) {
            BusyBeeOrderCalculatingContext::END_OF_TENANCY_CLEANING => get_option(
                'end_of_tenancy_extra_from'
            ),
            BusyBeeOrderCalculatingContext::DEEP_CLEANING => get_option(
                'deep_cleaning_extra_from'
            ),
            BusyBeeOrderCalculatingContext::AFTER_CONSTRUCTION_CLEANING => get_option(
                'after_construction_extra_from'
            ),
            BusyBeeOrderCalculatingContext::CARPET_CLEANING => get_option(
                'carpet_cleaning_extra_from'
            ),
        };
    }
    protected function getExtraSum(): float
    {
        return (float) match ($this->typeCleaning) {
            BusyBeeOrderCalculatingContext::END_OF_TENANCY_CLEANING => get_option(
                'end_of_tenancy_extra_price'
            ),
            BusyBeeOrderCalculatingContext::DEEP_CLEANING => get_option(
                'deep_cleaning_extra_price'
            ),
            BusyBeeOrderCalculatingContext::AFTER_CONSTRUCTION_CLEANING => get_option(
                'after_construction_extra_price'
            ),
            BusyBeeOrderCalculatingContext::CARPET_CLEANING => get_option(
                'carpet_cleaning_extra_price'
            ),
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
        $price = $this->addPrice(
            $price,
            $bedrooms >= $this->getExtraFrom()
                ? $this->getExtraSum()
                : 0
        );

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

    public function load(BusyBeeDynamicModel $model): self
    {
        return $this->setSpaceFurnished($model->getAttribute('space_furnished'));
    }
}
