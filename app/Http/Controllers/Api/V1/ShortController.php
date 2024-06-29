<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\ShortsFilter;
use App\Models\Short;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UpdateShortRequest;
use App\Http\Resources\V1\ShortCollection;
use App\Http\Resources\V1\ShortResource;

use Illuminate\Database\QueryException;


class ShortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ShortsFilter();
        $filterItems = $filter->transform($request); //[['column', 'operator', 'value']]
        
        $query = Short::query()->where($filterItems)->orderBy('created_at', 'desc');
        // $query->select('id', 'title', 'category_id', 'description', 'thumbnail', 'created_at', 'updated_at');

        return new ShortCollection($query->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedShort = Short::create($request->all());

        return new ShortResource($validatedShort);
    }

    /**
     * Display the specified resource.
     */
    public function show(Short $short)
    {
        return new ShortResource($short);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShortRequest $request, Short $short)
    {
        $short->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $short = Short::findOrFail($id);
        $short->delete();
        return response()->json(['message' => 'Short link deleted successfully'], 200);
    }
}
