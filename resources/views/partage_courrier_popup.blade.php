
	<div class="col-sm-12" style="padding:0px;margin:-16px 0px -10px 0px;">
		
		<!--section class="panel panel-default"> 
			<header class="panel-heading">Informations</header> 
			<div class="step-content clearfix" style="padding-bottom:0px;padding-left:0px;"> 
				
				<div class="step-pane active" id="step1"> 
						
					<div class="col-md-12 form-group">
						<div class="table-responsived"> 
							<table class="table_infos" style="width:100%;">
								<tr>
									<th style="width:150px;padding:5px 0px;">Libellé</th>
									<td style="padding:5px;">: {{ $courrier->courrier_objet }}</td>
								</tr>
								<tr>
									<th style="width:150px;padding:5px 0px;">Date début prévu</th>
									<td style="padding:5px;">: <span id="date_debut_preview">{{ Stdfn::dateFromDB($courrier->courrier_date_arrivee) }} </span></td>
								</tr>
							</table>
						</div>
					</div>
					
				</div> 

			</div> 
			
		</section-->
		
		
		<section class="panel panel-default"> 
			<header class="panel-heading lt border">Vos collaborateurs</header>
			<div class="step-content clearfix" style="padding-bottom:0px;padding-left:0px;"> 
				
				<div class="table-responsive" style="margin-top:-30px;"> 
					<table class="table table-striped m-b-none datatable"> 
						<thead> 
							<tr> 
								<th width="70%">Nom & Prénoms</th> 
								<th width="30%">Autoriser</th> 
								<th width="" style="display:none;">N°</th> 
							</tr> 
						</thead> 
						<tbody id="liste_utilisateurs_affectes">
						@foreach($autres_users as $user)
							<tr>
								<td>{{ $user->nom . ' ' . $user->prenoms }}</td>
								<td><input type="checkbox" data-user_id="{{$user->id}}" name="partage_with_user_id" title="Cochez pour partager le courrier avec lui"></td>
								<td style="display:none;"></td>
							</tr>	
						@endforeach
						</tbody> 
					</table> 
				</div> 
			</div> 
			
			
		</section>
		
	</div>
	<br style="clear:both;"/>
	