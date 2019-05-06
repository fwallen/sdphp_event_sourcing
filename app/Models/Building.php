<?php

namespace App\Models;

use App\Events\BuildingCapacityDecreasedEvent;
use App\Events\BuildingCapacityIncreasedEvent;
use App\Events\BuildingCreatedEvent;
use App\Events\BuildingNameChangedEvent;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Building extends Model
{
    protected $guarded = [];

    public static function createWithAttributes(array $attributes) : Building
    {
        $attributes['uuid'] = (string) Uuid::uuid4();

        event(new BuildingCreatedEvent($attributes));

        return static::getByUuid($attributes['uuid']);

    }

    public function increaseCapacity(int $increase)
    {
        event(new BuildingCapacityIncreasedEvent($this->uuid, $increase));
    }

    public function decreaseCapacity(int $decrease)
    {
        event(new BuildingCapacityDecreasedEvent($this->uuid, $decrease));
    }

    public function changeName(string $newName)
    {
        event(new BuildingNameChangedEvent($this->uuid, $newName));
    }

    public static function getByUuid(string $uuid): Building
    {
        return static::where('uuid',$uuid)->first();
    }
}