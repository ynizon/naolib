<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Input;
use App\Delegue;
use App\Demande;
use Exception;
use Mail;
use Session;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Formulaire;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Events\BreadDataAdded;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/* Recupere les donnees envoyees par un formulaire , les stocke et envoie un email */
	public function postform(Request $request, $id){
		try{
			$form = Formulaire::where("id","=",$id)->firstOrFail();

			if ($request->input("dataType") != ""){
				$slug = $request->input("dataType");
			}

			$dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

			if ($form->name == "Demande de rendez-vous"){
				//Il faut lui affecter un utilisateur par defaut
				$request['user_id'] = Auth::user()->id;
			}

			// Validate fields with ajax
			$oVoyagerBaseController = new VoyagerBaseController();
			// Validate fields with ajax
			$val = $oVoyagerBaseController->validateBread($request->all(), $dataType->addRows)->validate();
			$data = $oVoyagerBaseController->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

			event(new BreadDataAdded($dataType, $data));

			$tabMsgTmp = array();

			//On supprime qq champs
			foreach ($data->getAttributes() as $attribute=>$value){
				if (strpos($attribute,"_id") === false and !in_array($attribute, array("id","updated_at","created_at"))){
					$tabMsgTmp[$attribute] = $value;
				}
			}

			$tabMsg = array();

			//Pour les demandes de rdv, on ajoute des infos
			if ($form->name == "Demande de rendez-vous"){
				if (isset($tabMsgTmp["name"])){
					$id_user = Auth::user()->id;
					$demandeur = User::find($id_user);

					if ($demandeur){
						$tabMsg["Nom"] = $demandeur->name;
						$tabMsg["Téléphone"] = $demandeur->telephone;
						$tabMsg["Num adhérent"] = $demandeur->num_adherent;
						$tabMsg["Email"] = $demandeur->email;
					}
				}
			}

			//On remap les champs avec les bons libellés et dans le bon ordre
			$rows = $dataType->addRows;
			foreach ($rows as $row){
				if (isset($tabMsgTmp[$row->getAttribute("field")])){
					$tabMsg[$row->getAttribute("display_name")] = $tabMsgTmp[$row->getAttribute("field")];
				}
			}

			//Envoie a la personne destinataire du formulaire

			if ($form->to != ""){
				Mail::send('emails.message', ['tabMsg' => $tabMsg], function ($m) use ($form){
					$m->from($form->from, $form->from);
					$m->to($form->to, $form->to)->subject(config("app.name")." > ".$form->name);
				});
			}

			//Envoie d'un message aux référents pour les demandes de rendez vous
			if ($form->name == "Demande de rendez-vous"){
				$users = Delegue::referent($tabMsg["Branche"]);
				foreach ($users as $user){
					$form->to = $user->email;
					Mail::send('emails.message', ['tabMsg' => $tabMsg], function ($m) use ($form){
						$m->from($form->from, $form->from);
						$m->to($form->to, $form->to)->subject(config("app.name")." > ".$form->name);
					});
				}
			}

			return redirect('/validation')->withOk($form->message_success);
		}catch (\Exception $e){
			return redirect('/validation')->withError($form->message_error);
		}
	}

	public function planning(Request $request){
		$oDemande = new Demande();
		$demandes = array();
		$date_base = $request->input("date");
		$delegue_id = (int) $request->input("delegue_id");
		$nb_jours = (int) $request->input("nb_jours");
		for ($iJour = 0; $iJour<$nb_jours; $iJour++){
			$date_time = strtotime($date_base . ' +'.$iJour.' day');
			$date = date('Y-m-d', $date_time);
			if (date("w",$date_time) >0 and  date("w",$date_time) <6){
				$demandes[$date] = $oDemande->getForDay($date, $delegue_id);
			}
		}

		return view('planning', compact("demandes"));
	}

	public function adminplanning(Request $request){
		$delegues = Delegue::get();

		return view('admin/planning', compact("delegues"));
	}

    public function profile(Request $request)
	{
			$user = Auth::user();

			return view('users/profile',  compact('user'));
	}

    public function profilupdate(Request $request)
	{
		$user = Auth::user();
		$id = $user->id;

		if ($request->input("name") != ""){
			$user->name = $request->input("name");
		}
		if ($request->input("email") != ""){
			$user->email = $request->input("email");
		}
		if ($request->input("num_adherent") != ""){
			$user->num_adherent = $request->input("num_adherent");
		}
		if ($request->input("telephone") != ""){
			$user->telephone = $request->input("telephone");
		}
		if ($request->input("password") != ""){
			$user->password = bcrypt($request->input("password"));
		}

		$user->save();

		return redirect('/home')->withOk("L'utilisateur " . $request->input('name') . " a été modifié." );
	}


	public function reponsedemandeur(Request $request){

		try{
			$sMessage = $request->input("message");
			$from = $request->input("from_email");
			$to = $request->input("to_email");
			;
			Mail::send('emails.email', ["lemessage"=>$sMessage], function ($m)  use ($from,$to) {
				$m->from($from, $from);
				$m->to($to, $to)->subject(config("app.name").' > Réponse à votre demande');
			});
			echo ("Votre message a bien été envoyé." );

		}catch(\Exception $e){
			//echo $e->getMessage();
			echo ("Erreur: Votre message n'a pas été envoyé." );
		}
		exit();
	}
}
