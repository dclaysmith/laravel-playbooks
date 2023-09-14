<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Dclaysmith\LaravelPlaybooks\Models\PlaybookAudience;

use Dclaysmith\LaravelPlaybooks\Http\Requests\Api\PlaybookAudience\StoreRequest;

use Dclaysmith\LaravelPlaybooks\Http\Resources\PlaybookAudienceResource;

use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesDefaults;
use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesFilters;
use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesIncludes;
use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesPagination;
use Dclaysmith\LaravelPlaybooks\Http\Traits\AppliesSorts;

use Dclaysmith\LaravelPlaybooks\Http\Filters\Base as Filter;

class PlaybookAudienceController extends Controller
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
        $builder = PlaybookAudience::query();

        $this->applyIncludes($builder, $request, ["playbook"]);

        $this->applyFilters($builder, $request, []);

        $this->applySorts($builder, $request, [], [], []);

        return PlaybookAudienceResource::collection(
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
        ]);

        $playbookAudience = PlaybookAudience::firstOrCreate($data);

        $playbookAudience->load(["playbook"]);

        return new PlaybookAudienceResource($playbookAudience, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $playbookAudience = PlaybookAudience::with(["playbook"])->findOrFail($id);

        return new PlaybookAudienceResource($playbookAudience, 200);
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
        $playbookAudience = PlaybookAudience::findOrFail($id);

        $playbookAudience->delete();

        return response(200);
    }
}
