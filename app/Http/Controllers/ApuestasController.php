<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Apuestas;
use Input;
use Redirect;

use Illuminate\Http\Request;

class ApuestasController extends Controller {

	protected $rules = [
		'users_id' => ['required'],
		'total' => ['required', 'numeric'],
		'redondeo' => ['required', 'numeric'],
	];

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()
	{
		$apuestas = Apuestas::all();
		return view('apuestas.index', compact('apuestas'));
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function create()
	{
		return view('apuestas.create');
	}

	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function store(Request $request)
	{
		$this->validate($request, $this->rules);

		$input = Input::all();
		$apuesta = Apuestas::create( $input );
		$apuesta->slug = $apuesta->id;
		$apuesta->save();		

		return Redirect::route('apuestas.index')->with('message', 'Apuesta Creada');
	}

	/**
	* Display the specified resource.
	*
	* @param  \App\Models\Apuestas $apuesta
	* @return Response
	*/
	public function show(Apuestas $apuesta)
	{
		return view('apuestas.show', compact('apuesta'));
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Models\Apuestas $apuesta
	* @return Response
	*/
	public function edit(Apuestas $apuesta)
	{
		return view('apuestas.edit', compact('apuesta'));
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \App\Models\Apuestas $apuesta
	* @return Response
	*/
	public function update(Apuestas $apuesta, Request $request)
	{
		$this->validate($request, $this->rules);

		$input = array_except(Input::all(), '_method');
		$apuesta->update($input);

		return Redirect::route('apuestas.index', $apuesta->slug)->with('message', 'Apuesta actualizada.');
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Models\Apuestas $apuesta
	* @return Response
	*/
	public function destroy(Apuestas $apuesta)
	{
		$apuesta->delete();
		return Redirect::route('apuestas.index')->with('message', 'Apuesta Borrada.');
	}

}
