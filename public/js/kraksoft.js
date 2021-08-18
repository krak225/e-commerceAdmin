+function ($) { "use strict";

  $(function(){

		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		
	    
		var base_url = $("#eco_base_url").val();
		
		
		$('.datatable:not(".someClass")').each(function() {
			
			var oTable = $(this).dataTable({
			"bProcessing": false,
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"sPaginationType": "full_numbers",
			"language": {
				"url": base_url + "js/datatables/lang/French.json"
			},
			"lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]],
			"bFilter" : true,   
			"bLengthChange": true,
			"order": [[ 1, "desc" ]],
			});
			
		});
		
		
		$('#crtlBoxRecherche').click(function(){
			$('#boxRecherche').toggle();
		});
		
		
		//
		$('.btnModifierProduit').click(function(){
			
			var produit_id  = $(this).attr('data-produit_id');
			
			$('#dialogKrakPopup').krakPopup({
				title:"Modification d'un produit",
				url:base_url+'modifier_produit/'+produit_id,
				width:800,
				contentMinHeight:200,
				draggable:true,
				closeButton:false,
				submitButton:false,
				customButton:{
					show:false,
					text:'Modifier',
					clickFn:function(){
						
					}
				},
				onFinish:function(){
					
					//validation du formulaire
					$('#btnSaveModifierProduit').click(function(){
						
						var produit_nom  = $('#produit_nom').val();
						var produit_prix = $('#produit_prix').val();
						var categorie_id = $('#categorie_id').val();
						
						if(produit_nom != "" && produit_prix != "0" && categorie_id != ""){
							
							$.ajax({
								headers:{'X-CSRF-TOKEN': csrf_token},
								type:'post',
								url: base_url + 'modifier_produit',
								data: $('#formModifierProduit').serialize(),
								success: function(e){
									
									noty({
										dismissQueue: false,
										force: true,
										layout:'center',
										modal: true,
										theme: 'defaultTheme',
										text:"Modification effectuée avec succès !",
										type: 'success',
										buttons: [
											{addClass: 'btn btn-info ', text: 'OK', onClick: function($noty) {
												$noty.close();

												location.href = '';

											}}]
									});
									
									
								},
								error: function(){
									notification("Erreur lors du traitement","error");
								}
							});
							
						}else{
							notification("Veuillez renserigner tous les champs","warning");
						}
						
					});
					
				},
			});
			
			
		});
		
		

		//Added on 11052021
		$('.btnSupprimerProduit').click(function(){
			
			var produit_id = $(this).attr('data-produit_id');
			
			noty({
				dismissQueue: false,
				force: true,
				layout:'center',
				modal: true,
				theme: 'defaultTheme',
				text:"Voulez-vous vraiment supprimer ce produit ?",
				type: 'warning',
				buttons: [
					{addClass: 'btn btn-danger ', text: 'Supprimer', onClick: function($noty) {
				   		$noty.close();

						$.ajax({
							headers:{'X-CSRF-TOKEN': csrf_token},
							type:'post',
							url: base_url + 'supprimer_produit',
							data: {produit_id:produit_id},
							success: function(data){
								
								if(data == 1){
									location.href = "";
								}else{
									notification('Erreur lors de la suppression',"warning");
								}
								
							},
							error: function(){
								notification("Erreur lors du traitement","error");
							}
						});

				   	}},
				   	{addClass: 'btn btn-info ', text: 'Non', onClick: function($noty) {
				   		$noty.close();
				   	}}]
			});

			
		});
		
		
		//Added on 11052021
		$('.btnSupprimerCategorie').click(function(){
			
			var categorie_id = $(this).attr('data-categorie_id');
			
			noty({
				dismissQueue: false,
				force: true,
				layout:'center',
				modal: true,
				theme: 'defaultTheme',
				text:"Voulez-vous vraiment supprimer cette catégorie ?",
				type: 'warning',
				buttons: [
					{addClass: 'btn btn-danger ', text: 'Supprimer', onClick: function($noty) {
				   		$noty.close();

						$.ajax({
							headers:{'X-CSRF-TOKEN': csrf_token},
							type:'post',
							url: base_url + 'supprimer_categorie',
							data: {categorie_id:categorie_id},
							success: function(data){
								
								if(data == 1){
									location.href = "";
								}else{
									notification('Erreur lors de la suppression',"warning");
								}
								
							},
							error: function(){
								notification("Erreur lors du traitement","error");
							}
						});

				   	}},
				   	{addClass: 'btn btn-info ', text: 'Non', onClick: function($noty) {
				   		$noty.close();
				   	}}]
			});

			
		});
		
		
		//Added on 11052021
		$('.btnSupprimerFraisLivraison').click(function(){
			
			var frais_livraison_id = $(this).attr('data-frais_livraison_id');
			
			noty({
				dismissQueue: false,
				force: true,
				layout:'center',
				modal: true,
				theme: 'defaultTheme',
				text:"Voulez-vous vraiment supprimer ce frais de livraison ?",
				type: 'warning',
				buttons: [
					{addClass: 'btn btn-danger ', text: 'Supprimer', onClick: function($noty) {
				   		$noty.close();

						$.ajax({
							headers:{'X-CSRF-TOKEN': csrf_token},
							type:'post',
							url: base_url + 'supprimer_frais_livraison',
							data: {frais_livraison_id:frais_livraison_id},
							success: function(data){
								
								if(data == 1){
									location.href = "";
								}else{
									notification('Erreur lors de la suppression',"warning");
								}
								
							},
							error: function(){
								notification("Erreur lors du traitement","error");
							}
						});

				   	}},
				   	{addClass: 'btn btn-info ', text: 'Non', onClick: function($noty) {
				   		$noty.close();
				   	}}]
			});

			
		});
		
		
		//Added on 12052021
		$('#btnChangerStatutLivraisonCommande').click(function(){
			
			var commande_id	= $(this).attr('data-commande_id');
			
			new Contextual({
				isSticky: false,
				items: [
					{
						label: 'COMMANDE LIVREE', 
						onClick: () => {
							
							$.ajax({
								headers:{'X-CSRF-TOKEN': csrf_token},
								type:'post',
								url: base_url + 'setcommandelivree',
								data:{commande_id:commande_id},
								success: function(data){
									//alert(data);
									location.href="";
									
								},
								error: function(){
									// alert("Erreur lors de du chargement");
								}
							});
							
						}, 
						icon: "fa-info", 
						shortcut: ''
					},
					{type: 'seperator'},
				]
			});
			
		});
		
		
		//Added on 12052021
		$('#btnChangerStatutLivraisonCourse').click(function(){
			
			var course_id	= $(this).attr('data-course_id');
			
			new Contextual({
				isSticky: false,
				items: [
					{
						label: 'COURSE LIVREE', 
						onClick: () => {
							
							$.ajax({
								headers:{'X-CSRF-TOKEN': csrf_token},
								type:'post',
								url: base_url + 'setcourselivree',
								data:{course_id:course_id},
								success: function(data){
									//alert(data);
									location.href="";
									
								},
								error: function(){
									// alert("Erreur lors de du chargement");
								}
							});
							
						}, 
						icon: "fa-info", 
						shortcut: ''
					},
					{type: 'seperator'},
				]
			});
			
		});
		
		
	  
		//NOTY
		function notification(text,type,callback){
			
			noty({
				dismissQueue: false,
				force: true,
				layout:'center',
				modal: true,
				theme: 'defaultTheme',
				text:text,
				type: type,
				buttons: [{addClass: 'btn btn-information ', text: 'OK', onClick: function($noty) {
				   $noty.close();
				  
				   }}]
			});
		}

	
		//Appliquer les masques de saisie
		$('select').select2({
			placeholder: "Choisir",
			allowClear: true
		}); 
		
		$('.telephone').mask('date');

	
	});
}(window.jQuery);