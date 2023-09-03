<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Pagination\LengthAwarePaginator;

use Dclaysmith\LaravelPlaybooks\Http\Filters\Base as Filter;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $views = [];

        $viewDirectory = dirname(__FILE__) . "/../../../Actions";

        foreach (new \DirectoryIterator($viewDirectory) as $file) {
            if ($file->isFile()) {
                if (!in_array($file->getFilename(), ["CustomAction.php", "Action.php",])) {
                    $className = str_replace(".php", "", $file->getFilename());
                    $namespaced = "Dclaysmith\\LaravelPlaybooks\\Actions\\" . $className;
                    $views[] = (object) [
                        "className" => $className,
                        "namespace" => $namespaced,
                        "configuration" => $namespaced::definition()
                    ];
                }
            }
        }

        /**
         * Retrieve all of the views in the designated folder
         */
        $viewDirectory = config(
            "laravel-playbooks.actions_directory"
        );

        foreach (new \DirectoryIterator($viewDirectory) as $file) {
            if ($file->isFile()) {
                $className = str_replace(".php", "", $file->getFilename());
                $namespaced = config(
                    "laravel-playbooks.actions_namespace"
                ) . "\\" . $className;
                $views[] = (object) [
                    "className" => $className,
                    "namespace" => $namespaced,
                    "configuration" => $namespaced::definition()
                ];
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
