/**
 * Created by devigoberdhan on 2016-04-28.
 */

jQuery(document).ready(function($) {


        $('.search_btn').click(function(){

            $.ajax({
                url : 'contacts/search',
                dataType: "json",
                type: "GET",
                data: {
                    name_startsWith: request.term,
                    type: 'country'
                },
                success: function( data ) {
                    response( $.map( data, function( item ) {
                        return {
                            label: item,
                            value: item
                        }
                    }));
                }
            });
        });

});