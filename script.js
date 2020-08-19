//Getting value from "ajax.php".
function fillName(Value) {
   //Assigning value to "search" div in "search.php" file.
   $('#searchName').val(Value);
   //Hiding "display" div in "search.php" file.
   $('#display').hide();
}
function fillPublisher(Value) {
   $('#searchPublisher').val(Value);
   $('#display').hide();
}
function fillISBN(Value) {
   $('#searchISBN').val(Value);
   $('#display').hide();
}
$(document).ready(function() {
   //On pressing a key on "Search box" in "book.php" file. This function will be called.
   $("#searchName").keyup(function() {
       //Assigning search box value to javascript variable named as "name".
       var name = $('#searchName').val();
       //Validating, if "name" is empty.
       if (name == "") {
           //Assigning empty value to "display" div in "book.php" file.
           $("#display").html("");
       }
       //If name is not empty.
       else {
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "Ajax.php".
               url: "Ajax.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "searchName" variable.
                   searchName: name
               },
               //If result found, this funtion will be called.
               success: function(html) {
                   //Assigning result to "display" div in "book.php" file.
                   $("#display").html(html).show();
               }
           });
       }
   });


   $("#searchPublisher").keyup(function() {
       var name = $('#searchPublisher').val();
       if (name == "") {
           $("#display").html("");
       }
       else {
           $.ajax({
               type: "POST",
               url: "Ajax.php",
               data: {  searchPublisher: name   },
               success: function(html) {
                   $("#display").html(html).show();
               }
           });
       }
   });


   $("#searchISBN").keyup(function() {
       var name = $('#searchISBN').val();
       if (name == "") {
           $("#display").html("");
       }
       else {
           $.ajax({
               type: "POST",
               url: "Ajax.php",
               data: { searchISBN: name   },
               success: function(html) {
                   $("#display").html(html).show();
               }
           });
       }
   });
   
    $("#searchNamebtn").click(function(){
        var name = $("#searchName").val();
      if(name)
      {
          $.ajax(
          {
              type:'POST',
              url:'Ajax.php',
              data:'name='+name,
              success:function(html)
              {
                  $('#display').html("");
                  $('#display').html(html).show();
              }
          }); 
      }
      else
      {
        $('#display').html('<label>Error</label>'); 
      }
    });
    
    $("#searchPublisherbtn").click(function(){
        var publisher = $("#searchPublisher").val();
      if(publisher)
      {
          $.ajax(
          {
              type:'POST',
              url:'Ajax.php',
              data:'publisher='+publisher,
              success:function(html)
              {
                  $('#display').html("");
                  $('#display').html(html).show();
              }
          }); 
      }
      else
      {
        $('#display').html('<label>Error</label>'); 
      }
    });


    $("#searchISBNbtn").click(function(){
      var ISBN = $("#searchISBN").val();
    
      if(ISBN)
      {
          $.ajax(
          {
              type:'POST',
              url:'Ajax.php',
              data:'ISBN='+ISBN,
              success:function(html)
              {
                  $('#display').html("");
                  $('#display').html(html).show();
              }
          }); 
      }
      else
      {
        $('#display').html('<label>Error</label>'); 
      }
    });
   
});
