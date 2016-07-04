/**
 * Created by WAQAS on 6/14/2016.
 */
//var apiPath ="http://"+window.location.hostname+"/p42/public/api/v1/";
//var apiPath ="http://"+window.location.hostname+"/jr/property42/backend/property42/public/api/v1/";
var apiPath ="http://"+window.location.hostname+"/42/public/api/v1/";

$(document).on('change', '#society', function(){
   var society_id = $(this).val();
   if(society_id !="") {
      $('#blocks').closest('.fake-select').addClass('loading');
      $.ajax({
         url: apiPath.concat("society/blocks"),
         data: {
            society_id: society_id
         },
         success: function (response) {
            $('#blocks').empty();
            $('#blocks').append($('<option>').text('select a block').attr('value', ''));
            $.each(response.data.blocks, function (i, block) {
               $('#blocks').append($('<option>').text(block.name).attr('value', block.id));
            });
            $('#blocks').closest('.fake-select').removeClass('loading');
            $('#blocks').trigger('loaded');
         }
      })
   }
   else
   {
      $('#blocks').empty();
      $('#blocks').append($('<option>').text('All block').attr('value',''));
      $('#blocks').closest('.fake-select').removeClass('loading');
   }
});

$(document).on('change', '.property_type', function(event){
   if($(this).prop('checked') == true){
      var property_type_id = $(this).val();
      if(property_type_id !="") {
         $('#property_sub_types').closest('.fake-select').addClass('loading');
         $.ajax({
            url: apiPath.concat("types/subtypes"),
            data: {
               type_id: property_type_id
            },
            success: function (response) {
               $('#property_sub_types').empty();
               $('#property_sub_types').append($('<option>').text('All Sub Types').attr('value', '').attr('selected','selected'));
               $.each(response.data.propertySubType, function (i, propertySubType) {
                  $('#property_sub_types').append($('<option>').text(propertySubType.sub_type).attr('value', propertySubType.id));
               });
               $('#property_sub_types').closest('.fake-select').removeClass('loading');
               $('#property_sub_types').trigger('loaded');
            }
         })
      }
      else
      {
         $('#property_sub_types').empty();
         $('#property_sub_types').append($('<option>').text('All SubTypes').attr('value',''));
         $('#property_sub_types').closest('.fake-select').removeClass('loading');
      }
   }
});


$(document).on('change','.property_type',function(){
   if($(this).prop('checked') == true){
      var property_type = $(this).val();
      if(property_type !=1 && property_type != ''){
         $('.bedrooms').addClass('hide-bedrooms');
         $('#bedrooms-select').prop('disabled', true);
      }else{
         $('.bedrooms').removeClass('hide-bedrooms');
         $('#bedrooms-select').prop('disabled', false);
      }
   }
});

$(document).on('click','.add-to-favs',function(){
   var property_id = $(this).attr('property_id');
   var key = $(this).attr('key');
   $.ajax({
      type: "POST",
      url: apiPath.concat("favourite/property"),
      data:{
         property_id:property_id
      },
      headers: {
         Authorization: key
      },
      success: function(response) {
         $('.add-to-favs').closest('a').addClass('added-to-favs');
      },
      error: function () {
         alert('please login to add this property to your favourites.')
      }
   })
});

$(document).on('click','.remove-to-favs',function(){
   var property_id = $(this).attr('property_id');
   var user_id = $(this).attr('user_id');
   var key = $(this).attr('key');
   $.ajax({
      type: "POST",
      url: apiPath.concat("favourite/property/delete"),
      data:{
         property_id:property_id,user_id:user_id
      },
      headers: {
         Authorization: key
      },
      success: function(response) {
         $('.add-to-favs').closest('a').removeClass('added-to-favs');
      },
      error: function () {
         alert('please login to add this property to your favourites.')
      }
   })
});