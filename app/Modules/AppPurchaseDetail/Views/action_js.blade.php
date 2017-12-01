<script>
	function doSave(){
		$("#modal-add").modal("hide");
		$("#frm-create").submit();
	}
	
	function doDelete(){
		$("#modal-delete").modal("hide");
		$("#frm-delete").submit();
	}
	
	function doUpdate(){
		$("#modal-edit").modal("hide");
		$("#frm-edit").submit();
	}
	
	function doUpdateHeader(){
		$("#modal-edit-header").modal("hide");
		$("#frm-edit-header").submit();
	}
	
	/*
	function getRawMaterialById(select_object){
		alert(select_object.value);
	}
	*/
	
	function getRawMaterialById(select_object){
		var app_raw_material_id=select_object.value;
		$.ajax({ 
    type: 'GET', 
    url: '{{url("raw_material/edit")}}'+'/'+app_raw_material_id, 
    dataType: 'json',
    success: function (response){ 
				$("#frm-create #unit_price").val(response["unit_price"]);
				$("#frm-create #description").val(response["description"]);
    }
		});	
	}
	
	//get sub total when create
	function getSubTotal(){
		var unit_price= $("#frm-create #unit_price").val();
		var qty 			= $("#frm-create #qty").val();
		var sub_total = unit_price * qty;
		$("#frm-create #sub_total").val(sub_total);
	}
	
	//get sub total when edit
	function getSubTotalEdit(){
		var unit_price= $("#frm-edit #unit_price").val();
		var qty 			= $("#frm-edit #qty").val();
		var sub_total = unit_price * qty;
		$("#frm-edit #sub_total").val(sub_total);
	}
	
	
	function renderLookupSuplier(){
		$.ajax({ 
    type: 'GET', 
    url: '{{url("purchase/render_lookup_suplier")}}', 
    dataType:'json',
    success: function (response){
				//alert(response);
				for(var i=0; i< response.length -1; i++ ){
					var suplier_name=response[i]["name"];
					var app_suplier_id=response[i]["app_suplier_id"];
					$("#frm-edit-header #app_suplier_id").append("<option value="+app_suplier_id+">"+suplier_name+"</option>");
				}
			}
		});
	}
	
	function renderLookupRawMaterial(){
		$.ajax({ 
    type: 'GET', 
    url: '{{url("purchase_detail/render_lookup_raw_material")}}', 
    dataType:'json',
    success: function (response){
				//alert(response);
				for(var i=0; i< response.length -1; i++ ){
					var raw_material_name=response[i]["name"];
					var app_raw_material_id=response[i]["app_raw_material_id"];
					$("#frm-edit #app_raw_material_id").append("<option value="+app_raw_material_id+">"+raw_material_name+"</option>");
				}
			}
		});
	}
	
	function closePopOverPurchaseDate(){
			$("#frm-edit-header #purchase_date").popover("hide");			
	}
	
	function editHeader(id){
		//alert(id);
		var app_purchase_id=id;
		$.ajax({ 
    type: 'GET', 
		url: '{{url("purchase/edit")}}'+'/'+app_purchase_id, 
    dataType: 'json',
			success: function (response){ 
				 //setup popover system
				 $("#frm-edit-header #purchase_date").popover({
						  trigger: 'manual',
							placement: 'auto bottom',
							html: 'true',
							title :'<span class="text-info"><strong>Info</strong></span>'+
                '<button type="button" id="close" class="close" onclick="closePopOverPurchaseDate()">&times;</button>',
							content: function() {
								 var message = "Purchase Date will automaticly updated by system";
								 return message;
							}
					});
					$("#frm-edit-header #purchase_date").popover("show");				
					//$("#frm-edit-header #purchase_date").popover('toggle');
					
					$("#frm-edit-header #app_purchase_id").val(response["app_purchase_id"]);
					$("#frm-edit-header #purchase_number").val(response["purchase_number"]);
					$("#frm-edit-header #purchase_date").val(response["purchase_date"]);
					$("#frm-edit-header #description").val(response["description"]);						
					var app_suplier_id=response["app_suplier_id"];
					var suplier_name=response["suplier_name"];
					$("#frm-edit-header #app_suplier_id").empty();
					$("#frm-edit-header #app_suplier_id").prepend("<option value="+app_suplier_id+">"+suplier_name+"</option>");
					renderLookupSuplier();				
					$("#modal-edit-header").modal("toggle");
			}
		});		
	}
	
	
	function edit(id){
		var app_purchase_detail_id=id;
		$.ajax({ 
    type: 'GET', 
		url: '{{url("purchase_detail/edit")}}'+'/'+app_purchase_detail_id, 
    dataType: 'json',
    success: function (response){ 
				$("#frm-edit #app_purchase_detail_id").val(response["app_purchase_detail_id"]);
				$("#frm-edit #app_raw_material_id").val(response["app_raw_material_id"]);
				$("#frm-edit #qty").val(response["qty"]);	
				$("#frm-edit #sub_total").val(response["sub_total"]);	
				$("#frm-edit #unit_price").val(response["unit_price"]);
				$("#frm-edit #description").val(response["description"]);						
				var app_raw_material_id=response["app_raw_material_id"];
				var raw_material_name=response["raw_material_name"];
				$("#frm-edit #app_raw_material_id").empty();
				$("#frm-edit #app_raw_material_id").prepend("<option value="+app_raw_material_id+">"+raw_material_name+"</option>");
				renderLookupRawMaterial();				
				$("#modal-edit").modal("toggle");
    }
		});		
	}
	
	function detail(id){
		var app_purchase_id=id;
		var url='{{url("purchase_detail")}}?'+'purchase_id='+app_purchase_id;
		location.href = url;
	}
	
	function deleteData(id){
			var app_purchase_detail_id=id;
		$.ajax({ 
    type: 'GET', 
		url: '{{url("purchase_detail/edit")}}'+'/'+app_purchase_detail_id, 
    dataType: 'json',
    success: function (response){ 
				$("#frm-delete #app_purchase_detail_id").val(response["app_purchase_detail_id"]);
				$("#frm-delete #app_raw_material_id").val(response["app_raw_material_id"]);
				$("#frm-delete #qty").val(response["qty"]);	
				$("#frm-delete #sub_total").val(response["sub_total"]);	
				$("#frm-delete #unit_price").val(response["unit_price"]);
				$("#frm-delete #description").val(response["description"]);						
				var app_raw_material_id=response["app_raw_material_id"];
				var raw_material_name=response["raw_material_name"];
				$("#frm-delete #app_raw_material_id").empty();
				$("#frm-delete #app_raw_material_id").prepend("<option value="+app_raw_material_id+">"+raw_material_name+"</option>");
				renderLookupRawMaterial();				
				$("#modal-delete").modal("toggle");
    }
		});		
	}
</script>