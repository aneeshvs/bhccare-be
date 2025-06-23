<?php

namespace App\Http\Controllers\Classes;

use App\Classes\ProtectedRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\IGetModelEx;
use App\Http\Controllers\Traits\TResponseAndError;
use App\Models\Classes\DefaultDBModel;
use App\Models\Classes\SiteDBModel;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;
use Throwable;

abstract class UniversalController extends Controller implements IGetModelEx
{

    use TResponseAndError;

    protected function transformColumn(string $name, mixed $data): string|bool|array|null
    {
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @param array|Model|HasOne|BelongsToRelationship|BelongsToMany|HasMany|MorphMany|Builder|Collection|SupportCollection|null $model
     * @param string|null $resource
     * @param bool $paginate
     * @param callable|null $callback
     * @return Response|JsonResponse
     */
    protected function legacyIndex(array|Model|HasOne|BelongsToRelationship|BelongsToMany|HasMany|MorphMany|Builder|Collection|SupportCollection|null $model,
                                   string                                                                                                             $resource = NULL,
                                   bool|int                                                                                                           $paginate = TRUE,
                                   callable                                                                                                           $callback = NULL): Response|JsonResponse
    {
        try {

            //if (get_class($model) === Collection::class) {
            //    $result = $model;
            //} else {
            //    $result = $paginate ? $model->paginate() : (get_class($model) === Builder::class ? $model->get() : $model->all());
            //}

            //dd([
            //    'model_class'    => Model::class,
            //    'model'          => get_class($model),
            //    'is_subclass_of' => is_subclass_of(get_class($model), Model::class),
            //    'type'           => gettype($model),
            //]);

            //$model = ContactMethodsTranslation::model()->all();

            //HasOne
            //$model    = CountryTranslation::model()->first()->country();
            //$resource = NULL;

            //HasMany
            //$model    = ContactMethod::find(1)->translations();
            //$resource = NULL;
            //$paginate = 1;

            // Support/Collection
            //$model = Country::all();
            //$model = collect($model);

            // Builder
            //$model    = Music::where('state_id', 1);
            //$resource = MusicResource::class;
            //$paginate = 1;

            // Model::class
            //$model    = ContactMethodsTranslation::model();
            //$resource = ContactMethodTranslationShortResource::class;
            //$paginate = 1;

            //dd(get_class($model));
            // ToDo: Clean up commented lines and duplicate codes

            if (is_array($model)) {
                $model = collect($model);
            }

            if (!$model) {
                $result = $model;
            } elseif (get_class($model) === BelongsToMany::class) {
                if ($paginate) {
                    $result = $model->paginate(is_bool($paginate) ? 15 : $paginate);
                    if ($resource) {
                        $resource::collection($result);
                    }
                } else {
                    $result = $model->get();
                    if ($resource) {
                        $result = $resource::collection($result);
                    }
                }
            } elseif (get_class($model) === HasMany::class ||
                get_class($model) === MorphMany::class) {

                if ($paginate) {
                    $result = $model->paginate(is_bool($paginate) ? 15 : $paginate);
                    if ($resource) {
                        $resource::collection($result);
                    }
                } else {
                    $result = $model->get();
                    if ($resource) {
                        $result = $resource::collection($result);
                    }
                }
            } elseif (get_class($model) === HasOne::class) { // ToDo: Not needed for index method
                $result = $model->get();
                if ($resource) {
                    $result = new $resource($result);
                }
            } elseif (is_subclass_of(get_class($model), Model::class)) {
                if ($paginate) {
                    $result = $model->paginate(is_bool($paginate) ? 15 : $paginate);
                    if ($resource) {
                        $resource::collection($result);
                    }
                } else {
                    $result = $model->all();
                    if ($resource) {
                        $result = $resource::collection($result);
                    }
                }
            } elseif (get_class($model) === Collection::class) {
                $result = $model;
                if ($paginate) {
                    $result = $model->paginate(is_bool($paginate) ? 15 : $paginate);
                }
                if ($resource) {
                    $resource::collection($result);
                }
            } elseif (get_class($model) === SupportCollection::class) {
                $result = $model;
                if ($paginate) {
                    $result = $model->paginate(is_bool($paginate) ? 15 : $paginate);
                }
                if ($resource) {
                    $resource::collection($result);
                }
                //if ($resource) {
                //    $result = $resource::collection($model);
                //}
            } elseif (get_class($model) === Builder::class) {
                if ($paginate) {
                    $result = $model->paginate(is_bool($paginate) ? 15 : $paginate);
                    if ($resource) {
                        $resource::collection($result);
                    }
                } else {
                    $result = $model->get();
                    if ($resource) {
                        $result = $resource::collection($result);
                    }
                }
            } else {
                return $this->sendNotImplementedYet('Unhandled model type', [
                    'type'  => gettype($model),
                    'class' => get_class($model),
                    'model' => $model,
                ]);
            }

            if ($callback) {
                $result = $callback($result);
            }

            return $this->sendResponse($result ?: [], NULL, 200);
        } catch (Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FormRequest|ProtectedRequest $request
     * @param Model|HasOne|BelongsToRelationship|BelongsToMany|HasMany|MorphMany $model
     * @param string|null $resource
     * @param string|null $connection_name
     * @param callable|null $callback
     * @return Response|JsonResponse
     */
    protected function legacyStore(FormRequest|ProtectedRequest                                       $request,
                                   Model|HasOne|BelongsToRelationship|BelongsToMany|HasMany|MorphMany $model,
                                   string                                                             $resource = NULL,
                                   string                                                             $connection_name = NULL,
                                   callable                                                           $callback = NULL): Response|JsonResponse
    {
        try {
            if (get_class($request) !== ProtectedRequest::class) {
                $request = ProtectedRequest::make($request);
            }

            $authUser = auth()->user();
            $request->merge([
                'owner_id'   => $authUser->id,
                'owner_type' => get_class($authUser),
            ]);

            $result = DB::connection($connection_name)
                ->transaction(function () use ($callback, $model, $request) {
                    $result = $model->create($request->protected()->all());

                    if ($callback && !empty($result2 = $callback($result, $request->original()))) {
                        $result = $result2;
                    }

                    return $result;
                });

            return $this->sendResponse($resource === NULL ? $result : new $resource($result), static::MSG_CREATE_OKAY, 200);
        } catch (Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        } catch (Throwable $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param array|Model|null $model
     * @param string|null $resource
     * @return Response|JsonResponse
     */
    protected function legacyShow(array|Model|null $model, string $resource = NULL): Response|JsonResponse
    {
        return $this->sendResponse($resource === NULL || is_array($model) ? $model : new $resource($model));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param FormRequest|ProtectedRequest $request
     * @param Model $model
     * @param string|null $resource
     * @param string|null $connection_name
     * @param callable|null $callback
     * @return Response|JsonResponse
     */
    protected function legacyUpdate(FormRequest|ProtectedRequest $request,
                                    Model                        $model,
                                    string                       $resource = NULL,
                                    string                       $connection_name = NULL,
                                    callable                     $callback = NULL): Response|JsonResponse
    {
        try {
            if (get_class($request) !== ProtectedRequest::class) {
                $request = ProtectedRequest::make($request);
            }

            $result = DB::connection($connection_name)
                ->transaction(function () use ($callback, $model, $request) {
                    $result = tap($model)
                        ->update($request->protected()->all());

                    if ($callback && !empty($result2 = $callback($result, $request->original()))) {
                        $result = $result2;
                    }

                    return $result;
                });

            return $this->sendResponse($resource === NULL ? $result : new $resource($result), static::MSG_UPDATE_OKAY, 200);
        } catch (Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        } catch (Throwable $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }

    /**
     * Delete/SoftDelete the specified resource from storage.
     *
     * @param Model $model
     * @return Response|JsonResponse
     */
    protected function legacyDelete(Model $model): Response|JsonResponse
    {
        try {
            $model->delete();

            return $this->sendResponse(NULL, static::MSG_DELETE_OKAY, 204);
        } catch (Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 404);
        }
    }

    /**
     * Destroy the specified resource from storage.
     *
     * @param Model $model
     * @return Response|JsonResponse
     */
    protected function legacyDestroy(Model $model): Response|JsonResponse
    {
        try {
            $model->forceDelete();

            return $this->sendResponse(NULL, static::MSG_DESTROY_OKAY, 204);
        } catch (Exception $ex) {
            if ((int)$ex->getCode() === 23000) { // Integrity Constraint
                return $this->sendError(static::MSG_DESTROY_FAILED, [], 412);
            }

            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }

    protected function legacySync(BelongsToMany $relationship,
                                  array         $data,
                                  string        $resource = NULL,
                                  string        $connection_name = NULL,
                                  callable      $callback = NULL): Response|JsonResponse
    {
        try {

            $result = DB::connection($connection_name)
                ->transaction(function () use ($callback, $data, $relationship) {
                    $result = $relationship->sync($data);
                    if ($callback) {
                        $result = $callback($relationship, $data);
                    }

                    return $result;
                });

            return $this->sendResponse($resource === NULL ? $result : new $resource($result), static::MSG_SYNC_OKAY, 200);
        } catch (Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        } catch (Throwable $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }

    public function transaction(DefaultDBModel|SiteDBModel $model, ?string $resource, callable $callback, string $message): Response|JsonResponse
    {
        try {
            $result = DB::connection($model::connectionName())
                ->transaction(function () use ($callback, $model) {
                    return $callback($model);
                });

            return $this->sendResponse($resource === NULL ? $result : new $resource($result), $message, 200);
        } catch (Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        } catch (Throwable $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }

}
