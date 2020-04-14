<?php

namespace App;

trait FullTextSearch
{
    // https://arianacosta.com/php/laravel/tutorial-full-text-search-laravel-5/
    /**
     * Replaces spaces with full text search wildcards
     *
     * @param string $term
     * @return string
     */
    protected function fullTextWildcards($term)
    {
        return str_replace(' ', '*', $term) . '*';
    }

    /**
     * Scope a query that matches a full text search of a term.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        $columns = implode(',',$this->searchable);
        $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)" , $this->fullTextWildcards($term));
        return $query;
    }
}
