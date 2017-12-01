<?php

namespace App\Modules\AppPurchaseDetail\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\AppPurchaseDetail\Models\AppPurchaseDetail;
use App\Modules\AppPurchase\Models\AppPurchase;
use App\Modules\AppRawMaterial\Models\AppRawMaterial;
use app\Providers\Lookup;
use app\Providers\Common;
use Illuminate\Pagination\Paginator;
Use Redirect;
class AppPurchaseDetailController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
			/**
			$table->increments('app_purchase_detail_id');
			$table->integer('app_purchase_id');
			$table->integer('app_raw_material_id');
			$table->integer('qty');
			$table->integer('sub_total');
			**/
    public function index(Request $request)
    {
				//$data_header=array("purchase_number"=>"","suplier_name"=>"","purchase_date"=>"");
				//$data_detail=array();
				$app_purchase_id=$_GET["purchase_id"];
				$data_header=$data = AppPurchase::select('app_suplier.*','app_purchase.*','app_purchase.description as description','app_suplier.name as suplier_name')
																					->leftJoin('app_suplier', 'app_suplier.app_suplier_id','=', 'app_purchase.app_suplier_id')
																					->where('app_purchase.app_purchase_id', '=',$app_purchase_id)->first();
																					
				$data_detail=AppPurchaseDetail::select('app_purchase_detail.*','app_purchase.*','app_raw_material.*',"app_raw_material.name as raw_material_name")
																					->leftJoin('app_purchase','app_purchase.app_purchase_id','=', 	 'app_purchase_detail.app_purchase_id')
																					->leftJoin('app_raw_material','app_raw_material.app_raw_material_id','=', 	 'app_purchase_detail.app_raw_material_id')
																					->where('app_purchase_detail.app_purchase_id', '=',$app_purchase_id)->paginate(3);
			 $lookup_suplier = Lookup::getLookupSuplier();
			 $lookup_raw_material=Lookup::getLookupRawMaterial();			 
        return view("AppPurchaseDetail::index")
							->with("lookup_suplier",$lookup_suplier)
							->with("lookup_raw_material",$lookup_raw_material)
							->with("data_header",$data_header)
							->with("data_detail",$data_detail);
    }
		
		public function update_header(Request $request)
    {
        //
				//echo 1; die();
				$app_purchase_id = $request->input("app_purchase_id");
				$purchase=array("app_suplier_id" =>$request["app_suplier_id"],
												"purchase_date"  =>date("Y-m-d"),
												"description"    =>$request["description"]);
								
			  $update=AppPurchase::where("app_purchase_id","=",$app_purchase_id)
																		 ->update($purchase);																		
				if($update==1){
					$message="update header successful";
				}else{
					$message="update header failed";
				}
				
				return Redirect::to('purchase_detail?purchase_id='.$app_purchase_id)
												->with("message",$message);
    }
		
		public function renderLookupSuplier(){
			$lookup_suplier = Lookup::getLookupSuplier();
			echo json_encode($lookup_suplier);
		}	
		
		public function renderLookupRawMaterial(){
			$lookup_raw_material = Lookup::getLookupRawMaterial();
			echo json_encode($lookup_raw_material);
		}	
		
		public function save(Request $request)
		{
			$app_purchase_id= $request["app_purchase_id"];
			$purchase_detail=	array("app_purchase_id"		=>$request["app_purchase_id"],
											  "app_raw_material_id"			=>$request["app_raw_material_id"],
												"qty"											=>$request["qty"],
									      "sub_total"								=>$request["sub_total"]);
								
			 $save=AppPurchaseDetail::insert($purchase_detail);				
				if($save==1){
					$message="Save data Purchase Item  successful";
				}else{
					$message="Save data Purchase Itema failed";
				}
				
				return Redirect::to('purchase_detail?purchase_id='.$app_purchase_id)
												->with("message",$message);
		}
		
		public function edit($app_purchase_detail_id)
    {
        //
				$data = AppPurchaseDetail::select('app_purchase_detail.*','app_purchase.*','app_raw_material.*',"app_raw_material.name as raw_material_name")
																	->leftJoin('app_purchase','app_purchase.app_purchase_id','=', 	 'app_purchase_detail.app_purchase_id')
																	->leftJoin('app_raw_material','app_raw_material.app_raw_material_id','=', 	 'app_purchase_detail.app_raw_material_id')
																	->where('app_purchase_detail.app_purchase_detail_id', '=',$app_purchase_detail_id)
																	->first();
				echo json_encode($data);
    }
		
    public function update(Request $request)
    {
       $app_purchase_id				= $request["app_purchase_id"];
			 $app_purchase_detail_id= $request["app_purchase_detail_id"];
			 $purchase_detail=	array("app_purchase_id"		=>$request["app_purchase_id"],
													"app_raw_material_id"			=>$request["app_raw_material_id"],
													"qty"											=>$request["qty"],
													"app_purchase_detail_id"	=>$request["app_purchase_detail_id"],
													"sub_total"								=>$request["sub_total"]);
								
			  $update=AppPurchaseDetail::where("app_purchase_detail_id","=",$app_purchase_detail_id)
																		 ->update($purchase_detail);																		
				if($update==1){
					$message="update data successful";
				}else{
					$message="update data failed";
				}
				
				return Redirect::to('purchase_detail?purchase_id='.$app_purchase_id)
												->with("message",$message);
    }
		
		 public function destroy(Request $request)
    {
			 $app_purchase_id				= $request["app_purchase_id"];
			 $app_purchase_detail_id = $request->input("app_purchase_detail_id");
			 $delete = AppPurchaseDetail::where('app_purchase_detail_id', '=',$app_purchase_detail_id)
																								->delete();
			 if($delete ==true){
				 $message="Delete data successfull";
			 }else{
				 $message="Delete data failed";
			 }
			 	return Redirect::to('purchase_detail?purchase_id='.$app_purchase_id)
												->with("message",$message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
