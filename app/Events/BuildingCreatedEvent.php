<?php


namespace App\Events;


use Spatie\EventProjector\ShouldBeStored;

class BuildingCreatedEvent implements ShouldBeStored
{
    public $buildingAttributes;

    public function __construct(array $buildingAttributes)
    {
        $this->buildingAttributes = $buildingAttributes;
    }
}