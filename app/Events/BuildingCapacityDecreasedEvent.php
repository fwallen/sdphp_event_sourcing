<?php


namespace App\Events;


use Spatie\EventProjector\ShouldBeStored;

class BuildingCapacityDecreasedEvent implements ShouldBeStored
{
    public $buildingUuid;

    public $capacityDecrease;

    public function __construct(string $buildingUuid, int $capacityDecrease)
    {
        $this->buildingUuid = $buildingUuid;

        $this->capacityDecrease = $capacityDecrease;
    }
}