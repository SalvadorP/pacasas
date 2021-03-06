<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Apuestas;
use App\User;
use Input;
use Redirect;
use DB;
use Auth;
use Mail;

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
		return view('apuestas.totales', ['apuestas' => $this->getTotales()]);
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
		$this->sendNotificationMail($apuesta);

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
		$this->sendNotificationMail($apuesta);

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

	public function estadisticas() {
		return view('apuestas.stats', ['apuestas' => $this->getTotales()]);
	}

	protected function getTotales() {
		$query = "SELECT SUM(total) AS total, SUM(redondeo) AS redondeo, u.name
			FROM apuestas a
	        LEFT JOIN users u ON u.id = a.users_id
			GROUP BY a.users_id
			ORDER BY redondeo DESC
		";
		return DB::select($query);
	}
	
	protected function sendNotificationMail($apuesta) {
		$emails = array();
		foreach (User::all() as $u) {
			$emails[] = $u->email;
		}
		$data = ['total' => $apuesta->total, 'redondeo' => $apuesta->redondeo, 
                'creador' => Auth::user()->name , 'nombre' => $apuesta->user->name];
		Mail::send('apuestas.mail', $data, function($message) use ($emails, $apuesta)
		{
			$message->from("info@pacasas.es", $apuesta->user->name);
			$message->to($emails)->subject($apuesta->user->name." SUMA ".$apuesta->total."€ ");
		});
	}

}

