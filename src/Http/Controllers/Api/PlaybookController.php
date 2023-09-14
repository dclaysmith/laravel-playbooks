<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Dclaysmith\LaravelPlaybooks\Models\Playbook;

use Dclaysmith\LaravelPlaybooks\Http\Requests\Api\Playbook\StoreRequest;
use Dclaysmith\LaravelPlaybooks\Http\Requests\Api\Playbook\UpdateRequest;

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

        return PlaybookResource::collection(
            $this->applyPagination($builder, $request, 25, 100)
        );
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

        $this->applyDefaults($data, [
            "target_class" => 
                config("laravel-playbooks.target"),
            "allow_multiple" => false,
            "allow_concurrent" => false,
            "multiple_buffer_days" => 0
        ]);

        $playbook = Playbook::firstOrCreate($data);

        $playbook->load([]);

        return new PlaybookResource($playbook, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $playbook = Playbook::with([
        ])->findOrFail($id);

        return new PlaybookResource($playbook, 200);
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

        $playbook = Playbook::findOrFail($id);

        $playbook->fill($data);

        $playbook->save();

        $playbook->load([]);

        return new PlaybookResource($playbook, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $playbook = Playbook::findOrFail($id);

        $playbook->delete();

        return response(200);
    }
}
