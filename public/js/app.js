// $("#addCategory").click(function () {
//         $(".newCategory").show();
//     });
//     var categoryCount = @Model.Categories.Count;
//     $('#btnCategory').click(function (e) {
//         e.preventDefault();
//         var action = 'AddCategory';
//         var data = $('#newCategory');
//         var list = $('#categoryList');
//         var newCategory = data.val();
//         $.post(action, { addCategory: newCategory }, function (response) {
//             if (response) {
// ​
//                 var label = $("<label>").text(newCategory);
//                 $("<input data-val='true' data-val-required='The IsSelected field is required.' id='Categories_" + categoryCount + "__IsSelected' name='Categories[" + categoryCount + "].IsSelected' type='checkbox' value='true'>").appendTo(list);
//                 $("<input name='Categories[" + categoryCount + "].IsSelected' type='hidden' value='false'>").appendTo(list);
//                 $("<input id='Categories_" + categoryCount + "__Name' name='Categories[" + categoryCount + "].Name' type='hidden' value='" + newCategory + "'>").appendTo(list);
//                 $("<label for='Categories_" + categoryCount + "__IsSelected'>" + newCategory + "</label>").appendTo(list);
//                 categoryCount++;
//                 $(data).val('');
//                 $(".newCategory").hide();
//             } else {
//                 // something went wrong
//             }
//         });
//     });



<script type="text/javascript">
   $(document).ready(function() {

    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var data            = $("#newPhone");         //new phone input id
    var newPhone        = data.val();

    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();

         $.post(action, { add_button: newPhone }, function (response) {
            if (response) {

                if(x < max_fields){ //max input box allowed
                         x++; //text box increment
                    $(wrapper).append('<div><input  id="newPhone" type="text" name="mytext[]"/><a href="#" class="remove_field"> <i class="fa fa-minus-circle" aria-hidden="true"></i></a></div>'); //add input box
                }
// ​
//                 var label = $("<label>").text(newCategory);
//                 $("<input data-val='true' data-val-required='The IsSelected field is required.' id='Categories_" + categoryCount + "__IsSelected' name='Categories[" + categoryCount + "].IsSelected' type='checkbox' value='true'>").appendTo(list);
//                 $("<input name='Categories[" + categoryCount + "].IsSelected' type='hidden' value='false'>").appendTo(list);
//                 $("<input id='Categories_" + categoryCount + "__Name' name='Categories[" + categoryCount + "].Name' type='hidden' value='" + newCategory + "'>").appendTo(list);
//                 $("<label for='Categories_" + categoryCount + "__IsSelected'>" + newCategory + "</label>").appendTo(list);
//                 categoryCount++;
//                 $(data).val('');
//                 $(".newCategory").hide();
            } else {
                alert('error');
            }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

</script>




=======================
WORKING ADD INPUT FIELD
========================

// <script type="text/javascript">
//    $(document).ready(function() {

//     var max_fields      = 10; //maximum input boxes allowed
//     var wrapper         = $(".input_fields_wrap"); //Fields wrapper
//     var add_button      = $(".add_field_button"); //Add button ID
    
//     var x = 1; //initlal text box count
//     $(add_button).click(function(e){ //on add input button click
//         e.preventDefault();
//         if(x < max_fields){ //max input box allowed
//             x++; //text box increment
//             $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field"> <i class="fa fa-minus-circle" aria-hidden="true"></i></a></div>'); //add input box
//         }
//     });//end of on click
    
//     $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
//         e.preventDefault(); $(this).parent('div').remove(); x--;
//     }) //end of remove field
// }); //end of document ready function



// </script>