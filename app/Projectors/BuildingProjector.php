<?php

namespace App\Projectors;

use App\Events\BuildingCapacityDecreasedEvent;
use App\Events\BuildingCapacityIncreasedEvent;
use App\Events\BuildingCreatedEvent;
use App\Events\BuildingNameChangedEvent;
use App\Models\Building;
use Spatie\EventProjector\Models\StoredEvent;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

final class BuildingProjector implements Projector
{
    use ProjectsEvents;

    public function onBuildingCreated(StoredEvent $storedEvent, BuildingCreatedEvent $event)
    {
        Building::create(array_merge($event->buildingAttributes, ['created_at' => $storedEvent->created_at, 'updated_at' => $storedEvent->created_at]));
    }

    public function onCapacityIncreased(StoredEvent $storedEvent, BuildingCapacityIncreasedEvent $event)
    {
        $building             = Building::getByUuid($event->buildingUuid);
        $building->capacity   += $event->capacityIncrease;
        $building->updated_at = $storedEvent->created_at;
        $building->save();
    }

    public function onCapacityDecreased(StoredEvent $storedEvent, BuildingCapacityDecreasedEvent $event)
    {
        $building             = Building::getByUuid($event->buildingUuid);
        $building->capacity   -= $event->capacityDecrease;
        $building->updated_at = $storedEvent->created_at;
        $building->save();
    }

    public function onNameChanged(StoredEvent $storedEvent, BuildingNameChangedEvent $event)
    {
        $building             = Building::getByUuid($event->buildingUuid);
        $building->name       = $event->newName;
        $building->updated_at = $storedEvent->created_at;
        $building->save();
    }
}
