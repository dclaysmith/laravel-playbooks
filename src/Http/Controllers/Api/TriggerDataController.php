<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Http\Resources\Json\JsonResource;

use Dclaysmith\LaravelPlaybooks\Http\Filters\Base as Filter;

use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesPagination;

class TriggerDataController extends Controller
{
    use AppliesPagination;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * Retrieve all of the views in the designated folder
         */
        $viewDirectory = config(
            "laravel-playbooks.triggers_directory"
        );

        $classes = scandir($viewDirectory);

        if (!in_array($request->input("class_name") . ".php", $classes)) {
            return response()->json([
                'message' => 'Trigger does not exist.',
            ], 404);
        }

        $className = "\\App\\Packages\\LaravelPlaybooks\\Triggers\\" . $request->input("class_name");
       
        $builder = $className::builder();

        return $this->applyPagination($builder, $request);
    }
}
