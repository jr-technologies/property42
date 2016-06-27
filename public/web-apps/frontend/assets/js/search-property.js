/**
 * Created by WAQAS on 6/14/2016.
 */
var apiPath ="http://localhost/property42/public/api/v1/";
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

$(document).on('change', '.property_type', function(){
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
            $('#property_sub_types').append($('<option>').text('select a SubType').attr('value', ''));
            $.each(response.data.propertySubType, function (i, propertySubType) {
               $('#property_sub_types').append($('<option>').text(propertySubType.sub_type).attr('value', propertySubType.id));
            });
            $('#property_sub_types').closest('.fake-select').removeClass('loading');
         }
      })
   }
   else
   {
      $('#property_sub_types').empty();
      $('#property_sub_types').append($('<option>').text('All SubTypes').attr('value',''));
      $('#property_sub_types').closest('.fake-select').removeClass('loading');
   }
});


$(document).on('change','.property_type',function(){
   var property_type = $(this).val();
   if(property_type !=1 && property_type != ''){
      $('.bedrooms').addClass('hide-bedrooms');
   }else{
      $('.bedrooms').removeClass('hide-bedrooms');
   }
});

$(document).on('click','.add-to-favs',function(){
   var property_id = $(this).attr('property_id');
   $.ajax({
      type: "POST",
      url: apiPath.concat("favourite/property"),
      data:{
         property_id:property_id
      },
      success: function(response) {
      }
   })
});