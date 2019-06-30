<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class Parts extends Controller
{
    public function index(){
    	$query = \App\DBParts::all();
    	if(count($query) == 0){
		return response()->json($query)->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
    	} else {
    		return response()->json(array("error" => "No parts found with SAP Code: " . $sap))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
    	}
	}
    public function get($sap){
    	$query = \App\DBParts::where('SAP', $sap)->get();
    	if(count($query) > 0){
			return response()->json(array(["data" =>$query], array(["status" => "accepted"])))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
		} elseif(count($query) == 0) {
    		return response()->json(array("error" => "No part found with SAP Code: " . $sap . " has been found."))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
		}
	}

	public function getSAP($sap){
    	$query = \App\DBParts::where('SAP', $sap)->get();
    	if(count($query) > 0){
    		if($query->sap != null){
				return response()->json(array(["data" => $query], array(["status" => "accepted"])))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
			} elseif ($query->sap == null){
    		return response()->json(array("error" => "No " . $sap . " code defined."))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
			}
		} elseif(count($query) == 0) {
    		return response()->json(array("error" => "No part found with SAP Code: " . $sap . " has been found."))->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
		}
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

	public function setMatQuantity($sap, $quantity){
		$updateQuantity = \App\DBParts::where('SAP', $sap)->update(["QuantityInUse" => $quantity]);
	}

	public function getMFBFInfo($sap){
		$output = array();
		$query = \App\DBParts::where('SAP', $sap)->first();
		$query->makeHidden(["id", "boxQuantity", "palletQuantity", "backupQuantity"]);
		if($query->QuantityInUse == "box"){
			$quantity = $query->boxQuantity;
		} elseif($query->QuantityInUse == "pallet"){
			$quantity = $query->palletQuantity;
		} elseif($query->QuantityInUse == "backup"){
			$quantity = $query->backupQuantity;
		}

		$output = array(
			"SAP" => $sap,
			"Quantity" => $quantity,
			"Material" => $query->Material . " " . $query->Veneer . " " . $query->carline,
			"StorageLocation" => $query->prodStorageLoc,
			"Plant" => $query->prodPlant
		);
		
		return response()->json($output)->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
	}

	public function getMB1AInfo($sap){
		$output = array();
		$query = \App\DBParts::where('SAP', $sap)->first();
		//$query->makeHidden(["id", "boxQuantity", "palletQuantity", "backupQuantity"]);

		$output = array(
			"SAP" => $sap,
			"Quantity" => 1,
			"Material" => $query->Material . " " . $query->Veneer . " " . $query->carline,
			"StorageLocation" => $query->prodStorageLoc,
			"Plant" => $query->prodPlant,
			"CostCenter" => $query->costCenter,
			"Reason" => 6,
			"HeaderText" => "Production SCRAP"
		);
		
		return response()->json($output)->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK])->header('Content-Type', 'application/json');
	}
}
