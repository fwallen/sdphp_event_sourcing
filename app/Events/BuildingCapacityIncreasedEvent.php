<?php


namespace App\Events;


use Spatie\EventProjector\ShouldBeStored;

class BuildingCapacityIncreasedEvent implements ShouldBeStored
{
    public $buildingUuid;

    public $capacityIncrease;

    public function __construct(string $buildingUuid, int $capacityIncrease) {
        $this->buildingUuid = $buildingUuid;

        $this->capacityIncrease = $capacityIncrease;
    }
}