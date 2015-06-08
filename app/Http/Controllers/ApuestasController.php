<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Apuestas;
use App\User;
use Input;
use Redirect;
use DB;

use Illuminate\Http\Request;

class ApuestasController extends Controller {

	protected $rules = [
		'users_id' => ['required'],
		'total' => ['required', 'numeric'],
		'redondeo' => ['required', 'numeric'],
	];

	/**
   * Instantiate a new UserController instance.
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()
	{
		$query = "SELECT SUM(total) AS total, SUM(redondeo) AS redondeo, u.name
			FROM apuestas a
	        LEFT JOIN users u ON u.id = a.users_id
			GROUP BY a.users_id
			ORDER BY redondeo DESC
		";
		$apuestas = DB::select($query);
		/*$apuestasSQL = Apuestas::all();
		$apuestas = array();
		foreach ($apuestasSQL as $apuesta) {
			if (empty($apuestas[$apuesta->user->name])) {
				$apuestas[$apuesta->user->name]['total'] = 0;
				$apuestas[$apuesta->user->name]['redondeo'] = 0;
			}
			$apuestas[$apuesta->user->name]['total'] += $apuesta->total; 
			$apuestas[$apuesta->user->name]['redondeo'] += $apuesta->redondeo;
			ksort($apuestas);
		}*/
		return view('apuestas.totales', ['apuestas' => $apuestas]);
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function create()
	{
		$users = array('' => '');
		foreach (User::all() as $u) {
			$users[$u->id] = $u->name;
		}
		asort($users);
		return view('apuestas.create', compact('users'));
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
		$users = array('' => '');
		foreach (User::all() as $u) {
			$users[$u->id] = $u->name;
		}
		asort($users);
		return view('apuestas.edit', compact('apuesta', 'users'));
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

	public function totales() 
	{
		$apuestas = Apuestas::all();
		if (empty($apuestas)) {
			$apuestas = array();
		}
		return view('apuestas.index', compact('apuestas'));
	}

}

