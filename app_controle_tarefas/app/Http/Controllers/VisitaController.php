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
        $userType = json_decode(auth()->user()->roles)->type;
        $userSpaces = json_decode(auth()->user()->roles)->spaces;

        if ($userType === "reviewer") {
            $visitas = Visita::where('day', '>=', now()->subDay())->paginate(20);
            return view('visita.index', ['visitas' => $visitas, 'userType' => $userType]);
        }
        if (count($userSpaces) > 0 && $userType === 'admin') {

            $visitas = Visita::whereIn('space_id', $userSpaces)->orWhere('user_id', $user_id)
                ->paginate(10);

            return view('visita.index', ['visitas' => $visitas, 'userType' => $userType]);
        }
        if ($userType === "user") {
            $visitas = Visita::where('user_id', $user_id)->paginate(10);
            return view('visita.index', ['visitas' => $visitas, 'userType' => $userType]);
        }
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
            'pcdType'
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
    public function show($id, Visita $visita)
    {


        $user_id = auth()->user()->id;
        $userType = json_decode(auth()->user()->roles)->type;
        $userSpaces = json_decode(auth()->user()->roles)->spaces;
        $spaces = Space::all();
        $visita = Visita::find($id);

        if ($userType === "reviewer") {
            return view('visita.show', ['visita' => $visita, 'userType' => $userType, 'spaces' => $spaces]);
        }

        if (in_array($visita->space_id, $userSpaces) && $userType === 'admin') {
            return view('visita.show', ['visita' => $visita, 'userType' => $userType, 'spaces' => $spaces]);
        }

        if ($visita->user_id === $user_id) {
            return view('visita.show', ['visita' => $visita, 'userType' => $userType, 'spaces' => $spaces]);
        }
        return redirect()->route('visita.index');

    }

    public function consultById(Request $request)
    {
        $id = $request->id;
        $visita = Visita::find($id);
        // return $visita;
        return view('visita.show', ['visita' => $visita]);
    }

    public function cancelById(Request $request)
    {
        $user_id = auth()->user()->id;
        $id = $request->id;
        $visita = Visita::find($id);
        if ($visita->user_id === $user_id) {
            $visita->status = 'canceled';
            $visita->save();
        }
        return redirect()->route('visita.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Visita $visita)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = $request->all(
            'day',
            'hour',
            'peopleNumber',
            'name',
            'grade',
            'age',
            'pcd',
            'pcdType'
        );
        $dados['pcd'] = isset($dados['pcd']) ? true : false;
        $dados['pcdType'] = isset($dados['pcdType']) ? $dados['pcdType'] : '';
        $dados['space_id'] = $request->space;
        $dados['spaceName'] = Space::find($dados['space_id'])->name;
        $dados['status'] = $request->status;
        $dados['obs'] = $request->obs;


        $user_id = auth()->user()->id;
        $userType = json_decode(auth()->user()->roles)->type;
        $userSpaces = json_decode(auth()->user()->roles)->spaces;

        if ($userType === "reviewer") {
            Visita::where('id', $id)->update($dados);
            return redirect()->route('visita.index');
        }

        if (in_array($request->space_id, $userSpaces) && $userType === 'admin') {
            Visita::where('id', $id)->update($dados);
            return redirect()->route('visita.index');
        }

        if ($request->user_id === $user_id) {
            Visita::where('id', $id)->update($dados);
            return redirect()->route('visita.index');
        }

        return redirect()->route('visita.index');

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