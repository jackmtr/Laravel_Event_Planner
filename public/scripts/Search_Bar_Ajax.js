/**
 * Created by devigoberdhan on 2016-04-28.
 */

$(document).ready(function($) {


        $('#search_text').keyup(function(){
            var txt = $(this).val();
            var token = $("input[name='_token']").val();
           // console.log(token);
            if(txt != '')
            {

                //$.ajaxSetup({
                //    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                //});

                $.ajax({
                    url:"/search_post",
                    type:"post",
                    data:{
                        search:txt,
                        _token: token},
                    success:function(data)
                    {
                        //jQuery.each( obj, function( i, val ) {
                        //    $( "#" + i ).append( document.createTextNode( " - " + val ) );
                        //});
                        $('#tbody').html('');

                        $.each(data, function(i, val){
                            console.log(val);
                            tableCreate(val);
                        });
                        //$('#result').html(data);
                    }
                });
            }
            else
            {
                $('#tbody').html('');
            }
        });

    function tableCreate(val) {
        //tbl.style.width = '100%';
        //tbl.setAttribute('border', '1');
        $('#tbody').append(
            "<tr>" +
            "<td class= 'cellcheckbox'><input type='" + "checkbox'" + " name='"  + val.first_name + "'>"
            + "</td>" +
            "<td>" + val.first_name + "</td>" +
            "<td>" + val.last_name + "</td>" +
            "<td>" + val.email + "</td>" +
            "<td>" + val.company + "</td>" +
            "<td>" + val.notes + "</td>" +
            "<td>" + val.added_by + "</td>" +
            "</tr>");


                    //var firstname = document.createElement('td');
                    //firstname.appendChild(document.createTextNode(val.first_name));
                    //firstname.setAttribute('rowSpan', '2');
                    //tr.appendChild(firstname);
        //lastname.appendChild(document.createTextNode(val.last_name));
        //lastname.setAttribute('rowSpan', '2');
        ////tr.appendChild(lastname);
        //    tbdy.appendChild(tr);
        //table.appendChild(tbdy);
    }

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