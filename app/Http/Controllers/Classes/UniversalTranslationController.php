<?php

namespace app\Http\Controllers\Classes;

use App\Classes\ProtectedRequest;
use App\Models\Interfaces\ITranslatable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

abstract  class UniversalTranslationController extends UniversalController
{
    protected function available(ITranslatable $model,string $language_code):void
    {
        if(!$model->translations
        ->pluck('language_code')
        ->contains($language_code)){
            abort(404, 'Translation not found');
        }
    }

    public function indexTranslations(ITranslatable $model, 
                                    string $resource = NULL, 
                                    bool $paginate = TRUE, 
                                    callable  $callback = NULL):Response|JsonResponse
    {
        $result = $model->translations();
        
        return parent::legacyIndex($result,$resource,$paginate,$callback);
    }

    public function storeTranslation(FormRequest $request,
                                    ITranslatable $model,
                                    string $resource = NULL,
                                    string $connection_name = NULL,
                                    callable $callback = NULL):Response|JsonResponse
    {
        return parent::legacyStore(ProtectedRequest::make($request, ['language_code', 'name']),
            $model ->translations(),
            $resource,
            $connection_name,
            $callback);
    }

    protected function showTranslation(ITranslatable $model,
                                    string $language_code,
                                    string  $resource=NULL) : Response|JsonResponse
    {
        $this->available($model, $language_code);

        return parent::legacyShow($model ->translations()
        ->where('language_code',$language_code)->first(),
        $resource);
    }

    protected function updateTranslation(FormRequest $request,
                                        ITranslatable $model,
                                        string $language_code,
                                        string $resource = NULL,
                                        string $connection_name = NULL,
                                        callable $callback = NULL): Response|JsonResponse
    {
        $this ->available($model,$language_code);

        return parent::legacyUpdate(ProtectedRequest::make($request, 'name'),
            $model ->translations()
            ->where('language_code',$language_code)
            ->first(),
            $resource,
            $connection_name,
            $callback);
    }

    protected function deleteTransalation(ITranslatable $model,
                                        string $language_code):Response|JsonResponse
    {
        $this ->available($model, $language_code);

        return parent::legacyDelete($model ->translations()
        ->where('language_code', $language_code)
        ->first());
    }

    protected function destroyTransalation(ITranslatable $model,
                                        string $language_code):Response|JsonResponse
    {
        $this ->available($model, $language_code);

        return parent::legacyDestroy($model ->translations()
        ->where('language_code', $language_code)
        ->first());
    }

}