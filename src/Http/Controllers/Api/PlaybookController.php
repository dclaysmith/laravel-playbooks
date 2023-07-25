<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Dclaysmith\LaravelPlaybooks\Models\Playbook;

use Dclaysmith\LaravelPlaybooks\Http\Requests\Api\Playbook\IndexRequest;
use Dclaysmith\LaravelPlaybooks\Http\Requests\Api\Playbook\StoreRequest;

use Dclaysmith\LaravelPlaybooks\Http\Resources\PlaybookResource;

use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesDefaults;
use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesFilters;
use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesIncludes;
use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesPagination;
use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesSorts;

use Dclaysmith\LaravelPlaybooks\Http\Filters\Base as Filter;

class PlaybookController extends Controller
{
    use AppliesDefaults,
        AppliesFilters,
        AppliesIncludes,
        AppliesPagination,
        AppliesSorts;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $builder = Playbook::query();

        $this->applyIncludes($builder, $request, []);

        $this->applyFilters($builder, $request, []);

        $this->applySorts($builder, $request, ["name"], [], ["name"]);

        return $this->applyPagination($builder, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $page = Playbook::firstOrCreate($data);

        $page->load([]);

        return new PlaybookResource($page, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Playbook::with([
        ])->findOrFail($id);

        return new PlaybookResource($page, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();

        $page = Playbook::findOrFail($id);

        $page->fill($data);

        $page->save();

        $page->load([]);

        return new PlaybookResource($page, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Playbook::findOrFail($id);

        $page->delete();

        return response(200);
    }
}
