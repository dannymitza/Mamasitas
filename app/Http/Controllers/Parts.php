<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\DatabaseManager as DB;


class Parts extends Controller
{
    public function index(){
    	$query = \App\DBParts::all();
    	if(count($query) == 0){
		return response()->json($query)->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
    	} else {
    		abort(404);
    	}
	}
    public function get($sap){
    	$query = \App\DBParts::where('SAP', $sap)->get();
    	if(count($query) > 0){
			return response()->json(\App\DBParts::where('SAP', $sap)->get())->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
		} else {
			abort(404);
		}
	}

	public function getSAP($sap){
		return response()->json(\App\DBParts::where('SAP', $sap)->get("SAP"))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
	}

	public function getBoxQty($sap){
		return response()->json(\App\DBParts::where('SAP', $sap)->get("boxQuantity"))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
	}

	public function getPalletQty($sap){
		return response()->json(\App\DBParts::where('SAP', $sap)->get("palletQuantity"))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
	}

	public function getBackupQty($sap){
		return response()->json(\App\DBParts::where('SAP', $sap)->get("backupQuantity"))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
	}

	public function getProductStorageLoc($sap){
		return response()->json(\App\DBParts::where('SAP', $sap)->get("prodStorageLoc"))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
	}

	public function getProductPlant($sap){
		return response()->json(\App\DBParts::where('SAP', $sap)->get("prodPlant"))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
	}

	public function getCostCenter($sap){
		return response()->json(\App\DBParts::where('SAP', $sap)->get("costCenter"))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
	}

	public function getMatInfo($sap){
		return response()->json(\App\DBParts::where('SAP', $sap)->get(["Material", "Veneer"]))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
	}
}
