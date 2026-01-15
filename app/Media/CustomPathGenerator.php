<?php

namespace App\Media;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        // Handle ProjectJourney model - store under project's folder
        if ($media->model_type === 'App\Models\ProjectJourney') {
            $projectId = $media->model->project_id ?? 'unknown';

            return 'projects/'.$projectId.'/journey/';
        }

        // Handle Service features_image collection
        if ($media->model_type === 'App\Models\Service' && $media->collection_name === 'features_image') {
            return 'services/'.$media->model_id.'/features/';
        }

        // Generic path generation for any model
        $modelName = $this->getModelName($media->model_type);

        return $modelName.'/'.$media->model_id.'/';
    }

    public function getPathForConversions(Media $media): string
    {
        if ($media->model_type === 'App\Models\ProjectJourney') {
            $projectId = $media->model->project_id ?? 'unknown';

            return 'projects/'.$projectId.'/journey/conversions/';
        }

        // Handle Service features_image collection
        if ($media->model_type === 'App\Models\Service' && $media->collection_name === 'features_image') {
            return 'services/'.$media->model_id.'/features/conversions/';
        }

        // Generic path generation for any model
        $modelName = $this->getModelName($media->model_type);

        return $modelName.'/'.$media->model_id.'/conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        if ($media->model_type === 'App\Models\ProjectJourney') {
            $projectId = $media->model->project_id ?? 'unknown';

            return 'projects/'.$projectId.'/journey/responsive/';
        }

        // Handle Service features_image collection
        if ($media->model_type === 'App\Models\Service' && $media->collection_name === 'features_image') {
            return 'services/'.$media->model_id.'/features/responsive/';
        }

        // Generic path generation for any model
        $modelName = $this->getModelName($media->model_type);

        return $modelName.'/'.$media->model_id.'/responsive/';
    }

    /**
     * Extract model name from full class name and create directory name
     */
    private function getModelName(string $modelType): string
    {
        // Extract class name from full namespace (e.g., 'App\Models\Project' -> 'Project')
        $className = class_basename($modelType);

        // Convert to Title Case (e.g., 'Project' -> 'Projects', 'BlogPost' -> 'BlogPosts')
        return Str::plural(Str::studly($className));
    }
}
