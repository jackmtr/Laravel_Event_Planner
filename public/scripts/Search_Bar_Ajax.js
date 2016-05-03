/**
 * Created by devigoberdhan on 2016-04-28.
 */

$(document).ready(function($) {


        $('#search_text').keyup(function(){
            var txt = $(this).val();
            if(txt != '')
            {

                //$.ajaxSetup({
                //    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                //});

                $.ajax({
                    url:"http://localhost:8000/search",
                    method:"post",
                    data:{search:txt},
                    dataType:"text",
                    success:function(data)
                    {
                        $('#result').html(data);
                    }
                });
            }
            else
            {
                $('#result').html('');
            }
        });

    //
    //$('#text_search').autocomplete({
    //    source: function( request, response ) {
    //        $.ajax({
    //            url : 'ajax',
    //            dataType: "json",
    //            data: {
    //                name_startsWith: request.term,
    //                type: 'search'
    //            },
    //            success: function( data ) {
    //                response( $.map( data, function( item ) {
    //                    return {
    //                        label: item,
    //                        value: item
    //                    }
    //                }));
    //            }
    //        });
    //    },
    //    autoFocus: true,
    //    minLength: 0
    //});


    //$(function()
    //{
    //    $( "#q" ).autocomplete({
    //        source: "/autocomplete",
    //        minLength: 3,
    //        select: function(event, ui) {
    //            $('#q').val(ui.item.value);
    //        }
    //    });
    //});



        //$('.search_btn').click(function(){
        //
        //    $.ajax({
        //        url : 'contacts/search',
        //        dataType: "json",
        //        type: "GET",
        //        data: {
        //            name_startsWith: request.term,
        //            type: 'country'
        //        },
        //        success: function( data ) {
        //            response( $.map( data, function( item ) {
        //                return {
        //                    label: item,
        //                    value: item
        //                }
        //            }));
        //        }
        //    });
        //});



});