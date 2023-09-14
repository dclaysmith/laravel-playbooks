<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Dclaysmith\LaravelPlaybooks\Models\PlaybookStep;

use Dclaysmith\LaravelPlaybooks\Http\Requests\Api\PlaybookStep\StoreRequest;
use Dclaysmith\LaravelPlaybooks\Http\Requests\Api\PlaybookStep\UpdateRequest;

use Dclaysmith\LaravelPlaybooks\Http\Resources\PlaybookStepResource;

use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesDefaults;
use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesFilters;
use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesIncludes;
use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesPagination;
use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesSorts;

use Dclaysmith\LaravelPlaybooks\Http\Filters\Base as Filter;

class PlaybookStepController extends Controller
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
        $builder = PlaybookStep::query();

        $this->applyIncludes($builder, $request, ["playbook"]);

        $this->applyFilters($builder, $request, []);

        $this->applySorts($builder, $request, [], [], []);

        return $this->applyPagination($builder, $request);

        return PlaybookStepResource::collection(
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
            "sort_order" => PlaybookStep::where("lp_playbook_id", $request->input('lp_playbook_id'))->count()
        ]);

        $playbookStep = PlaybookStep::firstOrCreate($data);

        $playbookStep->load(["playbook"]);

        return new PlaybookStepResource($playbookStep, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $playbookStep = PlaybookStep::with(["playbook"])->findOrFail($id);

        return new PlaybookStepResource($playbookStep, 200);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $playbookStep = PlaybookStep::findOrFail($id);

        $playbookStep->delete();

        return response(200);
    }
}
