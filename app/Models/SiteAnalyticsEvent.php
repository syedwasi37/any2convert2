<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteAnalyticsEvent extends Model
{
    public $timestamps = false;

    protected $fillable = ['event_type', 'event_value', 'created_at'];
}
