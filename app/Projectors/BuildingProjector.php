<?php

namespace App\Projectors;

use App\Events\BuildingCreatedEvent;
use App\Models\Building;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

final class BuildingProjector implements Projector
{
    use ProjectsEvents;

    public function onBuildingCraeted(BuildingCreatedEvent $event)
    {
        Building::create($event->buildingAttributes);
    }
}
