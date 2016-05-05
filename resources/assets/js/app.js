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

$(function(){
    alert('HERE');

});

function add_fields() {
     $('#wrapper').innerHTML += '<span>Label: <input type="text"><small>(ft)</small></span>\r\n';
 }
