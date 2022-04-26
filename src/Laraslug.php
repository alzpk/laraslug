<?php

namespace Alzpk\Laraslug;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use RuntimeException;

trait Laraslug
{
    protected static function bootLaraslug()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getSlugColumn()})) {
                $model->{$model->getSlugColumn()} = Str::slug(
                    $model->getSlugPrefix() . ' ' . $model->{$model->getSlugValueColumn()}
                );
            }
        });
    }

    private function getSlugPrefix(): string
    {
        if (isset($this->slugPrefix)) {
            return trim($this->slugPrefix, ' ');
        }

        return '';
    }

    private function getSlugColumn(): string
    {
        if (isset($this->slugColumn)) {
            return $this->slugColumn;
        }

        if ($this->hasColumn('slug')) {
            return 'slug';
        }

        throw new RuntimeException('No valid slug column found.');
    }

    private function getSlugValueColumn(): string
    {
        if (isset($this->slugValueColumn)) {
            return $this->slugValueColumn;
        }

        if ($this->hasColumn('title')) {
            return 'title';
        }

        if ($this->hasColumn('name') ) {
            return 'name';
        }

        throw new RuntimeException('No valid slug value column found.');
    }

    private function hasColumn(string $column): bool
    {
        return in_array($column, Schema::getColumnListing($this->getTable()));
    }
}
