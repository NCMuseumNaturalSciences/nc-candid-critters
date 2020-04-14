<?php

namespace App\Transformers;

use App\MapSite;
use League\Fractal\TransformerAbstract;

class DeploymentSitesTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(MapSite $mapSite)
    {
        return [

        ];
    }

}
