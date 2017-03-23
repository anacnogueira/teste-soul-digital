<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\User;
use App\Entities\Type;

use redeJacarei\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use App\Contracts\ManageFile as ManageFileInterface;

class UserController extends Controller
{
    private $manageFile;
    private $user;
    private $type;


    /**
     * Class Constructor
     * @param    $manageFile   
     * @param    $user   
     * @param    $type   
     */
    public function __construct(ManageFileInterface $manageFile, User $user, Type $type)
    {
        $this->manageFile = $manageFile;
        $this->user = $user;
        $this->type = $type;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $types = [];
        $data = $this->type->orderBy('name', 'asc')->get();
        foreach ($data as $item) {
            $types[$item->id] = $item->name;   
        }


        return view('users.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validatesStore($request->all());

        if ($validator->fails()){
            return redirect()->route('usuarios.create')
            ->withErrors($validator)
            ->withInput();           
        }

        $data = $request->toArray();
        $data['password'] = bcrypt($data['password']); 

        //Upload Photo
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $data['image'] = $this->manageFile->store($request, $request->input('name').' '.date('dmyHis'),"storage/users", '');
        }
        
        $this->user->create($data);        
        
        return redirect()->route('usuarios.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = [];
        $data = $this->type->orderBy('name', 'asc')->get();
        foreach ($data as $item) {
            $types[$item->id] = $item->name;   
        }  
        

        $user = $this->user->find($id);

        return view('users.edit', compact('user', 'types'));
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
        //
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

    public function settings()
    {


    }


   private function validatesStore($request)
   {    

        $rules = [
            'name' => 'required',  
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*[a-zA-Z])(?=.*\d).+$/',
            'type_id' => 'required',

        ];


        $messages = [
            'required' => 'O campo é obrigatório.',
            'email.unique' => 'E-mail já cadastrado',
            'email.email' => 'Forneça um formato de e-mail válido',
            'password.min' => 'A senha deve conter no minino 6 caracteres',
            'password.regex' => 'A senha deve conter ao menos uma letra e um número'
        ];

        return Validator::make($request, $rules, $messages);
   }
}
