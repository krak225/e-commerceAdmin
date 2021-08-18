/*function ($) { "use strict";

  $(function(){

		var csrf_token = $('meta[name="csrf-token"]').attr('content');
	alert('');
		
var csrf_token = document.querySelector('meta[name="csrf-token"]')['content'];
var base_url = 'http://perception.com/todo/';
var btn = document.querySelector('.add');
var remove = document.querySelector('.draggable');

function dragStart(e) {
  this.style.opacity = '0.4';
  dragSrcEl = this;
  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.innerHTML);
};

function dragEnter(e) {
  this.classList.add('over');
  
}

function dragLeave(e) {
  e.stopPropagation();
  this.classList.remove('over');
}

function dragOver(e) {
  e.preventDefault();
  e.dataTransfer.dropEffect = 'move';
  return false;
}

function dragDrop(e) {
  if (dragSrcEl != this) {
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData('text/html');
	
	var tache_id 			= dragSrcEl.getAttribute('data-tache_id');
	var tache_new_statut 	= this.getAttribute('data-statut');
	
	
	$.ajax({
		headers:{'X-CSRF-TOKEN': csrf_token},
		type:'post',
		data:{id:tache_id,statut:tache_new_statut}
		url: base_url + 'toto/changestatut',
		success: function(e){
			alert('ok');
		},
		error: function(){
			alert("Erreur lors de du chargement");
		}
	});
	
	
	
	var data = new FormData();
	data.append('id', tache_id);
	data.append('statut', tache_new_statut);
	
	var xhr;

	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xhr=new XMLHttpRequest();
	}

	else{ // code for IE6, IE5
	  xhr=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xhr.setRequestHeader('X-CSRF-TOKEN', csrf_token);
	xhr.open("POST", base_url + 'changestatut',true);
	xhr.send(data);
	// xhr.setRequestHeader("Content-type", "application/json; charset=utf-8");
	// xhr.setRequestHeader("Content-length", params.length);
	// xhr.setRequestHeader("Connection", "close");

	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			alert(xhr.responseText);
		}
	}
	// xmlDoc=xhr.responseXML;
	
	// alert(xmlDoc);
	
  }
  return false;
}

function dragEnd(e) {
  var listItens = document.querySelectorAll('.draggable');
  [].forEach.call(listItens, function(item) {
    item.classList.remove('over');
  });
  this.style.opacity = '1';
}

function addEventsDragAndDrop(el) {
  el.addEventListener('dragstart', dragStart, false);
  el.addEventListener('dragenter', dragEnter, false);
  el.addEventListener('dragover', dragOver, false);
  el.addEventListener('dragleave', dragLeave, false);
  el.addEventListener('drop', dragDrop, false);
  el.addEventListener('dragend', dragEnd, false);
}

var listItens = document.querySelectorAll('.draggable');
[].forEach.call(listItens, function(item) {
  addEventsDragAndDrop(item);
});


	});
}(window.jQuery);
*/