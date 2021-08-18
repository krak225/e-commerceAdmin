<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Géolocalisation des établissements</title>
    
    <style>
      html, body, #map {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery-ui-1.8.12.custom.min.js')); ?>"></script>
    
    <script>
	
		var map;
		var panel;
		var initialize;
		// var calculateItineraire;
		// var direction;
		// var geocoder;
		var marker_origin;
		// var marker_destination;
		// var destination;

		function myMap() {
			
			var default_origin_latLng = new google.maps.LatLng(5.3485044,-4.0763655); // Correspond au coordonnées de Yopougon figayo


			var myOptions = {
				zoom      : 16, // Zoom par défaut
				center    : default_origin_latLng, // Coordonnées de départ de la carte de type latLng 
				mapTypeId : google.maps.MapTypeId.ROADMAP, // Type de carte, différentes valeurs possible HYBRID, ROADMAP, SATELLITE, TERRAIN
				maxZoom   : 200
			};

			map      = new google.maps.Map(document.getElementById('map'), myOptions);
			panel    = document.getElementById('panel');

			//Placer la position de départ par défaut
			// marker_origin = new google.maps.Marker({
				// position : default_origin_latLng,
				// map      : map,
				// title    : "Point de départ: Adjamé Liberté",
				// draggable:true,
				// icon     : "images/moi.png" // Chemin de l'image du marqueur pour surcharger celui par défaut
			// }); 



			var contentMarker = new Array();
			var destination = new Array();
			var marker = new Array();
			var infoWindow = new Array();
			
			<?php $i = 0; ?>
			<?php foreach($etablissements as $etablissement){ ?>

			  //Coordonnées du point de destination
			  destination[<?php print $i;?>] = new google.maps.LatLng(<?php print $etablissement->etablissement_latitude;?>,<?php print $etablissement->etablissement_longitude;?>);
			 
			  //PLACER LE MARQUEUR DE DESTINATION FIXE PAR LES DONNÉES DE LA BDD
			  marker[<?php print $i;?>] = new google.maps.Marker({
				position : destination[<?php print $i;?>],
				map      : map,
				title    : "<?php print addslashes($etablissement->etablissement_nom);?>",
				// icon     : "images/markerMaison.png" // Chemin de l'image du marqueur pour surcharger celui par défaut
			  });
			  
					  
			  //L'infobule sur le marqueur de destination
			  contentMarker[<?php print $i;?>] = [
				  '<div class="containerTabs" style="width:350px;">',
				  '<div class="title" style="border-bottom:1px dotted #ddd;padding:5px 0px;font-weight:bold;color:blue;"><?php print addslashes($etablissement->etablissement_nom);?></div>',
				  '<div>'
						+'<div class="first" style="padding:4px 0px;width:100%;">Représentant <span style="float:right;width:50%;">: <?php print addslashes($etablissement->etablissement_representant);?></span></div>'
						+'<div class="first" style="padding:4px 0px;width:100%">Téléphone <span style="float:right;width:50%;">: <?php print addslashes($etablissement->etablissement_telephone);?></span></div>'
						+'<div class="first" style="padding:4px 0px;width:100%">Type <span style="float:right;width:50%;">: <?php print addslashes($etablissement->nature_affaire_id);?></span></div>'
						+'<div class="first" style="padding:4px 0px;width:100%">Quartier <span style="float:right;width:50%;">: <?php print addslashes($etablissement->etablissement_quartier);?></span></div>'
						+'<div class="first" style="padding:4px 0px;width:100%">Supports utilisés <span style="float:right;width:50%;">: <?php print addslashes($etablissement->etablissement_type_support);?></span></div>'
						+'<div class="first" style="padding:4px 0px;width:100%">Observations <span style="float:right;width:50%;">: <?php print addslashes($etablissement->etablissement_observations);?></span></div>'
					+'</div>'
				 +'</div>'
			  ].join('');

			  infoWindow[<?php print $i;?>] = new google.maps.InfoWindow({
				content  : contentMarker[<?php print $i;?>],
				position : destination[<?php print $i;?>]
			  });
			  
			  google.maps.event.addListener(marker[<?php print $i;?>], 'click', function() {
				infoWindow[<?php print $i;?>].open(map,marker[<?php print $i;?>]);
			  });
			  
			<?php $i ++; ?>
			  
			<?php } ?>


			//
			direction = new google.maps.DirectionsRenderer({
				map   : map,
				panel : panel // Dom element pour afficher les instructions d'itinéraire
			});

			  
		}
		 
    </script>
	</head>
	<body> <link rel="stylesheet" href="jquery-ui-1.8.12.custom.css" type="text/css" /> 

		<!--div style="height:100px;border:1px solid red;">
		
		<div class="step-content clearfix"> 
			<form enctype="multipart/form-data"  method="post" class="form-horizontal" action="<?php echo e(route('maps_etablissements')); ?>">
				
				<?php echo csrf_field(); ?>

				
				<div class="step-pane active" id="step1"> 
						
					<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
						<label for="etablissement_nom" class="col-md-4 control-label">Nom de l'établissement</label>

						<div class="col-md-8">
							<input id="etablissement_nom" type="text" class="form-control" name="etablissement_nom" value="<?php echo e(old('etablissement_nom')); ?>" required autofocus>

							<?php if($errors->has('etablissement_nom')): ?>
								<span class="help-block">
									<strong><?php echo e($errors->first('etablissement_nom')); ?></strong>
								</span>
							<?php endif; ?>
						</div>
					</div>
					

				</div> 
				
				<div class="line line-lg pull-in"></div>
				
				<div class="actions pull-right"> 
					<button type="reset" class="btn btn-danger btn-sm">Annuler</button> 
					<button type="submit" class="btn btn-primary btn-sm">RECHERCHER</button> 
				</div>
				
			</form>
			
		</div>
	
		</div-->
		
		<div id="map" style="min-height:700px;">
			<p>Veuillez patienter pendant le chargement de la carte...</p>
		</div>
		<div id="panel"></div>

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXhYFQBF6kQa_uqbMdGZDiffliQZXqut0&callback=myMap"></script>
	</body>
</html>