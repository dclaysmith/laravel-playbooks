<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Dclaysmith\LaravelPlaybooks\Http\Resources\ConditionResource;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Dclaysmith\LaravelPlaybooks\Http\Filters\Base as Filter;

class ConditionController extends Controller
{
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
            "laravel-playbooks.conditions_directory"
        );

        $views = [];
        foreach (new \DirectoryIterator($viewDirectory) as $file) {
            if ($file->isFile()) {
                $views[] = str_replace(".php", "", $file->getFilename());
            }
        }

        $page = (int) $request->get("page", $default = 1);
        $perPage = (int) $request->get("per_page", $default = 25);
        $offset = $page * $perPage - $perPage;

        return new LengthAwarePaginator(
            array_slice($views, $offset, $perPage),
            count($views),
            $perPage,
            $page
        );
    }
}
