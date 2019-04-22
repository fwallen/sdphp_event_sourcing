<?php


namespace App\Models;


use App\Events\BuildingCreatedEvent;
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

    public static function getByUuid(string $uuid): Building
    {
        return static::where('uuid',$uuid)->first();
    }
}