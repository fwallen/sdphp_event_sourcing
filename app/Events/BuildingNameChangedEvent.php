<?php

namespace App\Events;

use Spatie\EventProjector\ShouldBeStored;

class BuildingNameChangedEvent implements ShouldBeStored
{
    public $buildingUuid;

    public $newName;

    public function __construct(string $buildingUuid, string $newName)
    {
        $this->buildingUuid = $buildingUuid;
        $this->newName      = $newName;
    }
}