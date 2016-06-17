/**
 * Created by WAQAS on 6/14/2016.
 */
var apiPath ="http://localhost/property42/public/api/v1/";
$(document).on('change', '#society', function(){
   $('#blocks').addClass('loading');
   var society_id = $(this).val();

   $.ajax({
      url: apiPath.concat("society/blocks"),
      data:{
         society_id:society_id
      },
      success: function(response) {
         console.log(response);
         $('#blocks').empty();
         $.each(response.data.blocks, function(i, block) {
            $('#blocks').append($('<option>').text(block.name).attr('value', block.id));
         });
         $('#blocks').removeClass('loading');
      }
   })
});
$(document).on('change','.property_type',function(){
   var property_type = $(this).val();
   if(property_type !=1 && property_type != 0){
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