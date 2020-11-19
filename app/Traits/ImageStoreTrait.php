<?php


namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\OptimizerChainFactory;

trait ImageStoreTrait
{
    /**
     * @param String $path
     * @param $image
     * @return mixed
     */
    public function storeImage(string $path, $image): string
    {
        $image_path = $image->store($path, 'public');
        $optimizerChain = OptimizerChainFactory::create();
        $pathFile = Storage::disk('public')->path($image_path);
        $optimizerChain->optimize($pathFile);
        return $image_path;
    }
}
