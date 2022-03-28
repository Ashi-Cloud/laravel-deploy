<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deployment extends Model
{
    use HasFactory;

    const STATUS_RUNNING = 'runnning';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    protected $guarded = [];

    public function scopeActive(Builder $builder)
    {
        return $builder->where('is_active', true);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getFormattedLog()
    {
        return str_replace("\t","    ", nl2br($this->logs));
    }

    public function getShortLog()
    {
        return Str::of(strip_tags($this->getFormattedLog()))->limit(200);
    }
}
