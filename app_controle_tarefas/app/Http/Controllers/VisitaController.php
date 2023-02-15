<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $user_id = auth()->user()->id;
        $visitas = Visita::where('user_id', $user_id)->paginate(10);
        return view('visita.index', ['visitas' => $visitas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spaces = Space::where('available', 1)->get();
        return view('visita.create', ['spaces' => $spaces]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dados = $request->all(
            'day',
            'hour',
            'peopleNumber',
            'name',
            'grade',
            'age',
            'pcd',
            'pcdType',
        );
        $fileName = Str::uuid() . '.pdf';
        $dados['fileName'] = $fileName;
        $dados['pcd'] = isset($dados['pcd']) ? true : false;
        $dados['pcdType'] = isset($dados['pcdType']) ? $dados['pcdType'] : '';
        $dados['space_id'] = $request->space;
        $dados['spaceName'] = Space::find($dados['space_id'])->name;
        $dados['user_id'] = auth()->user()->id;

        $request->file->storeAs('documents', $fileName);

        $visita = Visita::create($dados);
        
        return view('visita.show', ['visita' => $visita]);

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

    public function consultById(Request $request)
    {
        $id = $request->id;
        $visita = Visita::find($id);
        // return $visita;
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