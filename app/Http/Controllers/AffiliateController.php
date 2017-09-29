<?php

namespace App\Http\Controllers;

use App\Affiliate;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Affiliate::paginate();
        return view('affiliate.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('affiliate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $model = new Affiliate();
        $model->name = $request->input('name');
        $model->address = $request->input('address');
        $model->description = $request->input('description');
        $model->latitude = $request->input('latitude');
        $model->longitude = $request->input('longitude');
        $model->save();

        return redirect('/affiliates/' . $model->getKey());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Affiliate::find($id);
        return view('affiliate.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Affiliate::find($id);
        return view('affiliate.update', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $model = Affiliate::find($id);
        $model->name = $request->input('name');
        $model->address = $request->input('address');
        $model->description = $request->input('description');
        $model->latitude = $request->input('latitude');
        $model->longitude = $request->input('longitude');
        $model->save();

        return redirect('/affiliates/' . $model->getKey())->with('status', 'Model updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search()
    {
        return view('affiliate.search');
    }

    public function contains(Request $request)
    {
        return $request->input();
    }
}
