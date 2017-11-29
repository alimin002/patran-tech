@extends('main')
@section('title', 'Raw Material')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Raw Material</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('')}}">Home</a>
                        </li>
                        <li class="active">
                            <strong>Raw Material</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
						
						<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">									
                  <div class="ibox-content">
									@if(session()->has('message'))							
										<div class="alert alert-info">
											{{session()->get('message')}}
										</div>
									@endif
                   <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
										<div class="html5buttons">
										<div class="dt-buttons btn-group">
											<a class="btn btn-default buttons-html5" data-toggle="modal" data-target="#modal-add">
												<i class="fa fa-plus"></i>&nbsp;<span>Add Data</span>
											</a>
										</div>
										</div>
										<div id="DataTables_Table_0_filter" class="dataTables_filter">
											<label>
												
												<form action="{{url('raw_material')}}" method="post">
												 {{ csrf_field() }}
													Search: <input style="width:300px;" name="keyword" type="search" class="form-control input-sm" placeholder="type keyword and press enter" aria-controls="DataTables_Table_0">
												</form>
											</label>
										</div>
										<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
											<span class="pull-left">Total Data {{$data->total()}}</span>
											<span class="pull-right">Page {{$data->currentPage()}} Of {{$data->lastPage()}}</span>
										</div>
										<table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
											<thead>
												<tr role="row">
													<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 206.566px;">
														Raw Material Name
													</th>
													<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 256.566px;">
														Suplier Name
													</th>
													<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 229.899px;">
														Unit
													</th>
													<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 176.566px;">
														Unit Price
													</th>
													<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 176.566px;">
														Stock
													</th>
													<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 125.333px;">
														Category
													</th>
													<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 125.333px;">
														Description
													</th>
													<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 125.333px;">
														Action
													</th>
												</tr>
											</thead>
                    <tbody>
										@foreach($data as $key => $values)
                    <tr class="gradeA odd" role="row">
                        <td>{{$values["raw_name"]}}</td>
                        <td>{{$values["suplier_name"]}}</td>
                        <td>{{$values["unit"]}}</td>
                        <td>{{$values["unit_price"]}}</</td>
												<td>
													@if ($values["stock"] == "")
														<p>
															Please go to <a href="{{url('stock_raw_material')}}"><b>menu stock</b></a>&nbsp;to assign number of stock for this raw material! 
														</p>
													@elseif ($values["stock"] == 0)
														<p style="color:red">
															{{$values["stock"]}}&nbsp;{{$values["unit"]}}
														</p>
													@else
														{{$values["stock"]}}&nbsp;{{$values["unit"]}}
													@endif
												</td>
                        <td>{{$values["category_name"]}}</td>
												<td>{{$values["description"]}}</td>
												<?php
													$app_raw_material_id=$values['app_raw_material_id'];
												?>
												<td>
													<button class="btn btn-primary" onclick="deleteData('{{$values['app_raw_material_id']}}')">
														<i class="fa fa-trash"></i>
													</button>
													<button class="btn btn-primary" onclick="edit('{{$values['app_raw_material_id']}}')">
														<i class="fa fa-edit"></i>
													</button>
												</td>
                    </tr>
										@endforeach
										</tbody>              
                   </table>
										<div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
											`{{$data->links()}}
										</div>
									</div>
                </div>
              </div>
            </div>
          </div>
        </div>
				@include('AppRawMaterial::create')
				@include('AppRawMaterial::edit')
				@include('AppRawMaterial::delete')
				@include('AppRawMaterial::action_js')
@endsection