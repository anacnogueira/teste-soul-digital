<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Type;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    private $type;

    /**
     * Class Constructor
     * @param    $type   
     */
    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = $this->type->all();

        return view('types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validates($request->all());

        if ($validator->fails()){
            return redirect()->route('tipos.create')
            ->withErrors($validator)
            ->withInput();           
        }

        $this->type->create($request->all());
 
        return redirect()->route('tipos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = $this->type->find($id);

        return view('types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = $this->type->find($id);

        return view('types.edit', compact('type'));
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
        $type = $this->type->find($id);

        $validator = $this->validates($request->all());

        if ($validator->fails()){
            return redirect()->route('tipos.edit',['id' => $id])
            ->withErrors($validator)
            ->withInput();           
        }

        $type->update($request->all());
              
        return redirect()->route('tipos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->type->destroy($id);

        return redirect()->route("tipos.index");
    }

    private function validates($request)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        $messages = [
            'required' => 'O campo é obrigatório.',
            'max' => 'Tamanho máximo de 255 caracteres excedido',
        ];

        return Validator::make($request, $rules, $messages);       
    }
}
