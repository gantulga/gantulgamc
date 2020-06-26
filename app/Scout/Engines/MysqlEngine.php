<?php

namespace App\Scout\Engines;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;
use Laravel\Scout\Builder;
use Laravel\Scout\Engines\Engine;

class MysqlEngine extends Engine
{
    protected static $indexTable = 'search_index';

    /**
     * Update the given model in the index.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $models
     * @return void
     */
    public function update($models)
    {
        if ($models->isEmpty()) {
            return;
        }

        //if ($this->usesSoftDelete($models->first()) && $this->softDelete) {
        //$models->each->pushSoftDeleteMetadata();
        //}

        $objects = $models->map(function ($model) {
            if (empty($searchableData = $model->toSearchableArray())) {
                return;
            }
            $index = $model->searchableAs();
            $id = $model->getScoutKey();
            $title = $searchableData['title'] ?? $model->title;
            unset($searchableData['title']);
            //if(is_array($searchableData['props']))

            $content = implode(" \n", array_values($searchableData));
            $link = $model->getLink(false);

            return [
                'index' => $index,
                'id' => $id,
                'title' => $title,
                'content' => $content,
                'link' => $link,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->filter()->values()->all();

        if (!empty($objects)) {
            \DB::table(self::$indexTable)->upsert(
                $objects,
                ['index', 'id'],
                ['title', 'content', 'updated_at', 'link']
            );
        }
    }

    /**
     * Remove the given model from the index.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $models
     * @return void
     */
    public function delete($models)
    {
        $keys = $models->map(function ($model) {
            return "('" . $model->searchableAs() . "'," . $model->getScoutKey() . ")";
        })->values()->all();

        $keys = implode(', ', $keys);

        \DB::table(self::$indexTable)->whereRaw('(`index`, id) IN (' . $keys . ')')->delete();
    }

    /**
     * Perform the given search on the engine.
     *
     * @param  \Laravel\Scout\Builder  $builder
     * @return mixed
     */
    public function search(Builder $builder)
    {
        $result = [];

        $query = self::searchQuery($builder->query, $builder->model->searchableAs());

        if($builder->callback){
            $query = call_user_func($builder->callback, $query, $this);
        }

        $result['count'] = $query->count();

        if ($builder->limit) {
            $query = $query->take($builder->limit);
        }

        if (property_exists($builder, 'offset') && $builder->offset) {
            $query = $query->skip($builder->offset);
        }

        $result['results'] = $query->get();

        return $result;
    }

    /**
     * Perform the given search on the engine.
     *
     * @param  \Laravel\Scout\Builder  $builder
     * @param  int  $perPage
     * @param  int  $page
     * @return mixed
     */
    public function paginate(Builder $builder, $perPage, $page)
    {
        $builder->limit = $perPage;
        $builder->offset = ($perPage * $page) - $perPage;

        return $this->search($builder);
    }

    /**
     * Perform the given search on the engine.
     *
     * @param  string  $search
     * @param  string  $index
     * @return mixed
     */
    public static function searchQuery(string $search, string $index = null)
    {
        $query = \DB::table(self::$indexTable)
            ->selectRaw("*, MATCH (title,content) AGAINST (? IN NATURAL LANGUAGE MODE) AS relevance_score", [$search])
            ->whereRaw("MATCH (title,content) AGAINST (? IN NATURAL LANGUAGE MODE)", $search)
            ->orderByDesc('relevance_score');

        if ($index) {
            $query->where('index', $index);
        }

        return $query;
    }

    /**
     * Pluck and return the primary keys of the given results.
     *
     * @param  mixed  $results
     * @return \Illuminate\Support\Collection
     */
    public function mapIds($results)
    {
        return collect($results['results'])->pluck('id')->values();
    }

    /**
     * Map the given results to instances of the given model.
     *
     * @param  \Laravel\Scout\Builder  $builder
     * @param  mixed  $results
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function map(Builder $builder, $results, $model)
    {
        //return Collection::make();
        if (count($results['results']) === 0) {
            return $model->newCollection();
        }

        $ids = collect($results['results'])->pluck('id')->values()->all();
        $objectIdPositions = array_flip($ids);

        return $model->getScoutModelsByIds(
                $builder, $ids
            )->filter(function ($model) use ($ids) {
                return in_array($model->getScoutKey(), $ids);
            })->sortBy(function ($model) use ($objectIdPositions) {
                return $objectIdPositions[$model->getScoutKey()];
            })->values();
    }

    /**
     * Get the total count from a raw result returned by the engine.
     *
     * @param  mixed  $results
     * @return int
     */
    public function getTotalCount($results)
    {
        return count($results);
    }

    /**
     * Flush all of the model's records from the engine.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function flush($model)
    {
        $index = $model->searchableAs();

        \DB::table(self::$indexTable)->where('index', $index)->delete();
    }
}
