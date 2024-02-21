<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    const FILE_ARRETS = '244400404_tan-arrets.json';//2024-01-27
    const FILE_ARRETS_CODE = 'tan-arrets_code.json';//2024-01-27

    public function infos() {
        return view("infos");
    }

    public function listArrets(Request $request) {
        $contents = json_decode(file_get_contents(storage_path("app/json/".self::FILE_ARRETS)), true);
        $allArrets = [];
        $arrets = [];
        $search = $request->input("search");
        foreach ($contents as $content) {
            $allArrets[$content['stop_id']] = $content['stop_name'];
            $nomArret = $content["stop_name"];
            $codeArretAvecChiffre = substr($content['stop_id'],-1);
            if (stripos($nomArret, $search) !== false && in_array($codeArretAvecChiffre, [0,1,2,3,4,5,6,7,8,9])) {
                if (!in_array($nomArret, $arrets)) {
                    $arrets[] = $nomArret;
                }
            }
        }
        $file = storage_path("app/json/".self::FILE_ARRETS_CODE);
        if (!file_exists($file)) {
            file_put_contents($file, json_encode($allArrets));
        }
        return response()->json($arrets);
    }

    public function goto(Request $request) {
        $lat= '';
        $lng= '';
        $contents = json_decode(file_get_contents(storage_path("app/json/".self::FILE_ARRETS)), true);
        $search = $request->input("q");
        foreach ($contents as $content) {
            if ($content["stop_name"] == $search) {
                $lat = $content['stop_coordinates']['lat'];
                $lng = $content['stop_coordinates']['lon'];
            }
        }

        return redirect("/dashboard/".$lat."/".$lng."?ou=".$search);
    }

    public function dashboard($lat = '', $lng = '') {
        $arretsCodes = json_decode(file_get_contents(storage_path("app/json/".self::FILE_ARRETS_CODE)), true);
        $favorites = $this->getFavorites();
        if ($lat == '' && $lng == '') {
            $content = [];
        } else {
            $url = "https://open.tan.fr/ewp/arrets.json/$lat/$lng";
            $contentOrigins = json_decode(file_get_contents($url),true);
            $content = [];

            foreach ($contentOrigins as $contentOrigin) {
                if (isset($favorites[$contentOrigin['codeLieu']]) && count($favorites[$contentOrigin['codeLieu']])>0) {
                    $content[] = $contentOrigin;
                }
            }

            foreach ($contentOrigins as $contentOrigin) {
                if (!isset($favorites[$contentOrigin['codeLieu']]) || count($favorites[$contentOrigin['codeLieu']])==0) {
                    $content[] = $contentOrigin;
                }
            }
        }

        $prefAlarm = $this->getUserAlarmPref();

        return view("/dashboard", compact("lng","lat", "content", "prefAlarm", "favorites", "arretsCodes"));
    }

    public function detailArret($ligneBus = '', $codeLieu = '', $sens = '', $date = '') {
        $arretsCodes = json_decode(file_get_contents(storage_path("app/json/".self::FILE_ARRETS_CODE)), true);
        if ($date == '' or $date == '-') {
            $date = date("Y-m-d");
        }
        $url = "https://open.tan.fr/ewp/horairesarret.json/".$codeLieu.$sens."/".$ligneBus."/".$sens."/".$date;
        //$url = "https://open.tan.fr/ewp/horairesarret.json/APRE2/C6/2";
        $horaires = [];
        $infos = json_decode(file_get_contents($url), true);;
        $terminus = $arretsCodes[$codeLieu];

        $direction = $infos["arret"]["libelle"]." -> ".$infos["ligne"]["directionSens".$sens];
        $maxCols = 0;
        foreach ($infos["horaires"] as $info) {
            if (count($info["passages"]) > $maxCols) {
                $maxCols = count($info["passages"]);
            }
        }

        foreach ($infos["horaires"] as $info) {
            $newTab = [];
            $k = count($info["passages"]);
            while ($k < $maxCols) {
                $newTab[] = "";
                $k++;
            }
            $heure = $info["heure"];
            if ((int) $heure > 23) {
                $heure = ((int) $heure -24)."h";
            }
            $horaires[$heure] = array_merge($info["passages"], $newTab);
        }
        return view("detail", compact("horaires", "ligneBus", "direction","sens", "codeLieu","terminus","date"));
    }

    public function refreshArret($codeLieu = '') {
        $favorites = $this->getFavorites();

        $url = "https://open.tan.fr/ewp/tempsattente.json/".$codeLieu;
        $url = "https://open.tan.fr/ewp/tempsattentelieu.json/$codeLieu/2";
        $horaires = [];
        $infos = json_decode(file_get_contents($url), true);;
        foreach ($infos as $infox) {
            if ($infox['temps'] != '') {
                if (!isset($horaires[$infox["ligne"]["numLigne"]])) {
                    $horaires[$infox["ligne"]["numLigne"]] = [];
                }
                $terminusSens = $infox["terminus"]."@".$infox["sens"];
                if (!isset($horaires[$infox["ligne"]["numLigne"]][$terminusSens])) {
                    $horaires[$infox["ligne"]["numLigne"]][$terminusSens] = [];
                }
                if (!isset($horaires[$infox["ligne"]["numLigne"]][$terminusSens])) {
                    $horaires[$infox["ligne"]["numLigne"]][$terminusSens] = [];
                }

                $horaires[$infox["ligne"]["numLigne"]][$terminusSens][] = $infox;
            }
        }

        $prefAlarm = $this->getUserAlarmPref();

        return view("arret", compact("horaires","prefAlarm", "codeLieu", "favorites"));
    }

    public function refreshFavorisArret($codeLieu = '', $ligneBus = '') {
        $arretsCodes = json_decode(file_get_contents(storage_path("app/json/".self::FILE_ARRETS_CODE)), true);
        $url = "https://open.tan.fr/ewp/tempsattente.json/".$codeLieu;
        $url = "https://open.tan.fr/ewp/tempsattentelieu.json/$codeLieu/3";
        $horaires = [];
        $infos = json_decode(file_get_contents($url), true);;
        foreach ($infos as $infox) {
            if ($infox['ligne']['numLigne'] == $ligneBus && $infox['temps'] != '') {
                $terminusSens = $infox["terminus"]."@".$infox["sens"];
                if (!isset($horaires[$terminusSens])) {
                    $horaires[$terminusSens] = [];
                }
                $horaires[$terminusSens][] = $infox;
            }
        }

        $prefAlarm = $this->getUserAlarmPref();

        return view("favorisarret", compact("horaires", "codeLieu", "arretsCodes","ligneBus", "prefAlarm"));
    }

    public function perturbations() {
        $urls = [];
        $urls[] = "https://data.nantesmetropole.fr/api/explore/v2.1/catalog/datasets/244400404_info-trafic-tan-previsionnel/records?limit=50";
        //$urls[] = "https://data.nantesmetropole.fr/api/explore/v2.1/catalog/datasets/244400404_info-trafic-tan-temps-reel/records?limit=50";

        $infos = [];
        foreach ($urls as $url) {
            $content = json_decode(file_get_contents($url), true);

            foreach ($content['results'] as $result) {
                $arrets = json_decode($result["listes_arrets"], true);

                if (!isset($arrets['LISTE_ARRETS']['LIGNE'])) {
                    if (is_array($arrets['LISTE_ARRETS'])){
                        foreach ($arrets['LISTE_ARRETS'] as $arretLigne) {
                            $arret = $arretLigne['LIGNE'];
                            if (!isset($infos[$arret])) {
                                $infos[$arret] = [];
                            }
                            $infos[$arret][] = str_replace("\n", "<br/>", str_replace("\r\n\r\n", "\n", $result['resume']));
                        }
                    }
                } else {
                    $arret = $arrets['LISTE_ARRETS']['LIGNE'];
                    if (!isset($infos[$arret])) {
                        $infos[$arret] = [];
                    }
                    $infos[$arret][] = str_replace("\n", "<br/>", str_replace("\r\n\r\n", "\n", $result['resume']));
                }
            }
        }
        return response()->json($infos);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if (null != $request->input("ligne_bus")){
             $user->prefs = json_encode($request->input("ligne_bus"));
             $user->save();
        }
        if (null != $request->input("jours")){
             $user->weekdays = json_encode($request->input("jours"));
             $user->save();
        }

        $tabJours = array(1,2,3,4,5,6,0);
        if ($user->weekdays != ""){
           $tabJours = json_decode($user->weekdays);
        }

        $tabLignes = [];
        if ($user->prefs != ""){
           $tabLignes = json_decode($user->prefs);
        }

        return view("home",compact("tabLignes","tabJours"));
    }

    public function remove(Request $request)
    {
        $user = Auth::user();
        $user->delete();
        Auth::logout();
        return redirect("/");
    }

    private function getUserAlarmPref() {
        if (Auth::user()) {
            $minutes = Auth::user()->pref_alarm;
        } else {
            $minutes = 5;
        }

        return $minutes;
    }

    public function addFavorite($codeLieu, $bus) {
        if (Auth::user()){
            $prefs = [];
            if (!is_null(Auth::user()->prefs_arrets)){
                $prefs = json_decode(Auth::user()->prefs_arrets, true);
            }

            if (isset($prefs[$codeLieu])) {
                if (isset($prefs[$codeLieu][$bus])) {
                    unset($prefs[$codeLieu][$bus]);
                } else {
                    $prefs[$codeLieu][$bus] = $bus;
                }
            } else{
                if (!isset($prefs[$codeLieu])) {
                    $prefs[$codeLieu] = [];
                }
                $prefs[$codeLieu][$bus] = $bus;
            }
            Auth::user()->prefs_arrets = json_encode($prefs);
            Auth::user()->save();
        }
    }

    private function getFavorites() {
        $favorites = [];
        if (Auth::user() && !is_null(Auth::user()->prefs_arrets)) {
            $favorites = json_decode(Auth::user()->prefs_arrets, true);
        }

        return $favorites;
    }
}
