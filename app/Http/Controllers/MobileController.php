<?php

namespace App\Http\Controllers;

use App\Models\Mobile;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMobileRequest;
use App\Http\Requests\UpdateMobileRequest;

class MobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobiles = Mobile::all();
        return view('mobiles.index', compact('mobiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mobiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMobileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMobileRequest $request)
    {
        $mobile = new Mobile();
        $mobile->nombre = $request->input('nombre');
        $mobile->save();
        return redirect()->route('mobiles.index')->with('success', 'Móvil creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mobile  $mobile
     * @return \Illuminate\Http\Response
     */
    public function show(Mobile $mobile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mobile  $mobile
     * @return \Illuminate\Http\Response
     */
    public function edit(Mobile $mobile)
    {
        $mobile = Mobile::findOrFail($mobile->id);
        return view('mobiles.edit', compact('mobile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMobileRequest  $request
     * @param  \App\Models\Mobile  $mobile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMobileRequest $request, Mobile $mobile)
    {
        $mobile->nombre = $request->input('nombre');
        $mobile->save();
        return redirect()->route('mobiles.index')->with('success', 'Móvil actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mobile  $mobile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mobile $mobile)
    {
        $mobile->delete();
        return redirect()->route('mobiles.index')->with('success', 'Móvil eliminado exitosamente.');
    }
}
