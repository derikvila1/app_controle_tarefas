<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;

class VisitaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('visita.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('visita.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $spaces = array(
            0 => "Centro Cultural dos Povos da Amazônia",
            1 => "Palacete Provincial",
            2 => "Centro Cultural Palácio Rio Negro",
            3 => "Galeria do Largo",
            4 => "Casa das Artes",
            5 => "Centro Cultural Palácio da Justiça",
            6 => "Teatro Amazonas",
            7 => "Museu Seringal Vila Paraiso",
            8 => "Parques Culturais - Rio Negro ou Jefferson Peres"
        );

        $dados = $request->all('address', 'day', 'participantes', 'name', 'série', 'idade', 'confirmed', );
        $dados['requesterId'] = auth()->user()->id;
        $dados['confirmed'] = 0;
        $dados['spaceCode'] = 0;

        $visita = Visita::create($dados);

        return redirect()->route('visita.show', $visita->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function show(Visita $visita)
    {
        return view('visita.show', ['visita' => $visita]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function edit(Visita $visita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visita $visita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visita $visita)
    {
        //
    }
}