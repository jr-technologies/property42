/**
 * Created by jrpro_000 on 8/1/2016.
 */

$(document).on('click','.add-to-favorite',function(){
    var addedClass = $( ".add-to-favorite" ).hasClass( "added" )
    if(addedClass == 'added')
    {
        var property_id = $(this).attr('property_id');
        var user_id = $(this).attr('user_id');
        var key = $(this).attr('key');
        $.ajax({
            type: "POST",
            url: apiPath.concat("favourite/property/delete"),
            data:{
                propertyId:property_id,userId:user_id
            },
            headers: {
                Authorization: key
            },
            success: function(response) {
                $('.add-to-favs').closest('a').removeClass('added-to-favs');
            },
            error: function () {
                $('.popup-opener').closest('li').removeClass('popup-holder');
            }
        })
    }
    else {
        var property_id = $(this).attr('property_id');
        var key = $(this).attr('key');
        $.ajax({
            type: "POST",
            url: apiPath.concat("favourite/property"),
            data: {
                propertyId: property_id
            },
            headers: {
                Authorization: key
            },
            success: function (response) {
                $('.add-to-favs').closest('a').addClass('added-to-favs');
            },
            error: function () {
                $('.popup-opener').closest('li').addClass('popup-holder');
            }
        })
    }
});

$(document).on('click','.remove-to-favs',function(){
    var property_id = $(this).attr('property_id');
    var user_id = $(this).attr('user_id');
    var key = $(this).attr('key');
    $.ajax({
        type: "POST",
        url: apiPath.concat("favourite/property/delete"),
        data:{
            propertyId:property_id,userId:user_id
        },
        headers: {
            Authorization: key
        },
        success: function(response) {
            $('.add-to-favs').closest('a').removeClass('added-to-favs');
        },
        error: function () {
            $('.popup-opener').closest('li').removeClass('popup-holder');
        }
    })
});
