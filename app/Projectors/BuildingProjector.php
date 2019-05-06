<?php

namespace App\Projectors;

use App\Events\BuildingCapacityDecreasedEvent;
use App\Events\BuildingCapacityIncreasedEvent;
use App\Events\BuildingCreatedEvent;
use App\Events\BuildingNameChangedEvent;
use App\Models\Building;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

final class BuildingProjector implements Projector
{
    use ProjectsEvents;

    public function onBuildingCreated(BuildingCreatedEvent $event)
    {
        Building::create($event->buildingAttributes);
    }

    public function onCapacityIncreased(BuildingCapacityIncreasedEvent $event)
    {
        $building = Building::getByUuid($event->buildingUuid);
        $building->capacity += $event->capacityIncrease;
        $building->save();
    }

    public function onCapacityDecreased(BuildingCapacityDecreasedEvent $event)
    {
        $building = Building::getByUuid($event->buildingUuid);
        $building->capacity -= $event->capacityDecrease;
        $building->save();
    }

    public function onNameChanged(BuildingNameChangedEvent $event)
    {
        $building = Building::getByUuid($event->buildingUuid);
        $building->name = $event->newName;
        $building->save();
    }
}
