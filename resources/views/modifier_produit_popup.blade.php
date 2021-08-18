<div class="panel panel-default"> 

	<div class="step-content clearfix"> 
	
		<form id="formModifierProduit" method="post" action="{{route('SaveModifierProduit')}}" enctype="multipart/form-data" class="form-horizontal">
		
			<input type="hidden" name="produit_id" value="{{$produit->produit_id}}"/>
			
			{!! csrf_field() !!}
			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group">
					
					<div class="col-md-12 row">
						
						<div class="col-md-5">
							<span> Nom du produit <span class="text text-danger">*</span></span>
							<input placeholder="" type="text" class="form-control" name="produit_nom" id="produit_nom" value="{{ $produit->produit_nom }}" required>
						</div>
						
						<div class="col-md-5">
							<span> Description<span class="text text-danger"></span></span>
							<input style="padding-top:0px;" placeholder="" type="text" class="form-control" name="produit_description" id="produit_description" value="{{ $produit->produit_description }}">
						</div>
						
						<div class="col-md-2">
							<span> Prix<span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="number" class="form-control" name="produit_prix" id="produit_prix" value="{{ $produit->produit_prix }}" required> 
						</div>

					</div>
					
					<div class="col-md-12 row" style="margin-top:10px;">	
						
						
						<div class="col-md-4">
							<span> Catégorie <span class="text text-danger">*</span></span>
							<select class="form-control" name="categorie_id" id="categorie_id" required>
								<option value="">Choisir</option>
								@foreach($categories as $categorie)
								<option value="{{ $categorie->categorie_id }}">{{ $categorie->categorie_nom }}</option>
								@endforeach
							</select>
						</div>
						
						<div class="col-md-5">
							<!--span> Photo<span class="text text-danger"></span></span>
							<input style="padding-top:0px;" type="file" class="form-control" name="produit_photo" -->
							
						</div>
						<div class="col-md-2 pull-right">
							<span>&nbsp; <span class="text text-danger"></span></span>
							<button type="button" id="btnSaveModifierProduit" class="btn btn-success btn-sm rounded">ENREGISTRER</button> 
						</div>
						
					</div>
					
				</div>

				
			</div> 
			
		</form>
		
		 
	
	</div>
	
	
</div>
