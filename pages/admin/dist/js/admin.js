// pop up terms and conditions
$(document).ready(function(){
    $('#terms-and-conditions').on('click', function(){
        if ($(".inscription-select").val() == "League of legends"){
          $(".modal-incription .lol").addClass("show");
          $(".modal-incription .smash").removeClass("show");
          $(".modal-incription .valorant").removeClass("show")
          $(".modal-incription .default").removeClass("show");
          $(".options-popup").removeClass("hide");
        }
        else if ($(".inscription-select").val() == "Super Smash Bros. Ultimate") {
          $(".modal-incription .smash").addClass("show");
          $(".modal-incription .valorant").removeClass("show")
          $(".modal-incription .default").removeClass("show");
          $(".modal-incription .lol").removeClass("show");
          $(".options-popup").removeClass("hide");
        }
        else if ($(".inscription-select").val() == "Valorant") {
          $(".modal-incription .valorant").addClass("show");
          $(".modal-incription .default").removeClass("show");
          $(".modal-incription .lol").removeClass("show");
          $(".modal-incription .smash").removeClass("show");
          $(".options-popup").removeClass("hide");
        }else {
          $(".modal-incription .default").addClass("show");
          $(".options-popup").addClass("hide");

        }
        return false;
    });
    $('.btn-accept').on('click', function(){
        if (!$('#terms-and-conditions').prop("checked")) {
          $('#terms-and-conditions').prop('checked',true);
        }
    });
    $('.inscription-select').on('click', function() {
        $('#terms-and-conditions').prop('checked',false);
    });
    $('#terms-and-conditions').on('click',function(){
      $('.container-terms-and-conditions').click();
    });

    if($('.current-league').text() == "League of legends"){
      $('.img-current-ligue').addClass('img-lol');
    }else if ($('.current-league').text() == "Super Smash Bros. Ultimate") {
      $('.img-current-ligue').addClass('img-smash');
    }else if ($('.current-league').text() == "Valorant") {
      $('.img-current-ligue').addClass('img-valorant');
    }else{
      console.log("d");
    }
});
'use strict';

;( function ( document, window, index )
{
  var inputs = document.querySelectorAll( '.inputfile' );
  Array.prototype.forEach.call( inputs, function( input )
  {
    var label	 = input.nextElementSibling,
      labelVal = label.innerHTML;

    input.addEventListener( 'change', function( e )
    {
      var fileName = '';
      if( this.files && this.files.length > 1 ){
        fileName =  this.files.length + " archivos subidos";
        }
      else{
        fileName = e.target.value.split( '\\' ).pop();
        console.log("entr");
        }
      if( fileName ){
        label.querySelector( 'span' ).innerHTML = fileName;
        }
      else{
        label.innerHTML = labelVal;
        }
    });
  });
}( document, window, 0 ));
