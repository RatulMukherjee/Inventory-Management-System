$(document).ready(function(){

    
     $('select').material_select();
     $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true // Close upon selecting a date,
      });
     $("#next").click(function(){
         
          $('ul.tabs').tabs('select_tab', 'test2'); 
         
     });   
     $("#prev").click(function(){
         
          $('ul.tabs').tabs('select_tab', 'test1'); 
         
     });
   

        $("#same_as").click(function () { 

            if($(this).is(':checked'))
                {
                    $("#shipping_addr").val($("#billing_addr").val());
                    $("#shipped_to").val($("#billed_to").val());
                }
                
            else
                {
                    $("#shipping_addr").val('');
                    $("#shipped_to").val('');
                    
                }    
           
            
        });

     
      var price=100000000000000000;

     $.ajax({
            type: "POST",
            url: "../app/api/showbrands_api.php",
            success: function(result)
            {
              //console.log(result);
                var string=JSON.parse(result);
                //console.log(string[0].brand);
                var str='<option value="" disabled selected>Choose your option</option>';
                for(i=0 ; i<string.length; i++)
                    {
                        str+='<option value="'+string[i].brand+'">'+string[i].brand+'</option>';
                    }
                $("#brand").append(str);
                $("#part_number").find('option').remove();
                $('#brand').material_select(); 
            },
            error: function(XMLHttpRequest,textStatus,errorThrown)
            {
                if (XMLHttpRequest.readyState == 4)
                {
                    alert(XMLHttpRequest.statusText);
                }
                else  if (XMLHttpRequest.readyState == 0)
                {
                    ("Internal Server Error");
                }
                else
                {
                    alert("Sorry for the inconvience.Please try again after some time.")
                }
            }     
            });


            $('#brand').change(function(){
                var brand=$(this).find("option:selected").attr('value');
                   $.ajax({
                    type: "POST",
                    data: {
                        brand: brand
                        
                    },   
                    url: "../app/api/showproducts_api.php",
                    success: function(result)
                    {
                        //console.log(result);
                        var string = JSON.parse(result);
                       var str='<option value="" disabled selected>Choose your option</option>';
                        for(i=0 ; i<string.length; i++)
                            {
                                str+='<option value="'+string[i].name+'">'+string[i].name+'</option>';
                            }
                        $("#product").find('option').remove();
                        $("#part_number").find('option').remove();
                        $("#product").append(str);
                        $('#product').material_select(); 
                        
                    },
                    error: function(XMLHttpRequest,textStatus,errorThrown)
                    {
                        if (XMLHttpRequest.readyState == 4)
                        {
                            alert(XMLHttpRequest.statusText);
                        }
                        else  if (XMLHttpRequest.readyState == 0)
                        {
                            ("Internal Server Error");
                        }
                        else
                        {
                            alert("Sorry for the inconvience.Please try again after some time.")
                        }
                    }     
                    });
        });
        $('#product').change(function(){
            var product=$(this).find("option:selected").attr('value');
             //console.log($("#brand").find("option:selected").attr('value'));

              var brandarray=[$("#brand").find("option:selected").attr('value')];
               $.ajax({
                type: "POST",
                data: {
                    products: product,
                    brands:brandarray,
                    price: price
                    
                },   
                url: "../app/api/searchproducts_api.php",
                success: function(result)
                {
                    //console.log(result);
                    var string = JSON.parse(result);
                    var str='<option value="" disabled selected>Choose your option</option>';
                     for(i=0 ; i<string[0].length; i++)
                         {
                             str+='<option value="'+string[0][i].model+'">'+string[0][i].model+'</option>';
                         }
                     $("#model").find('option').remove();
                     $("#part_number").find('option').remove();
                     $("#model").append(str);
                     $('#model').material_select(); 

              
                    
                },
                error: function(XMLHttpRequest,textStatus,errorThrown)
                {
                    if (XMLHttpRequest.readyState == 4)
                    {
                        alert(XMLHttpRequest.statusText);
                    }
                    else  if (XMLHttpRequest.readyState == 0)
                    {
                        ("Internal Server Error");
                    }
                    else
                    {
                        alert("Sorry for the inconvience.Please try again after some time.")
                    }
                }     
                });
    });
    $('#model').change(function(){
        var model=$(this).find("option:selected").attr('value');
           $.ajax({
            type: "POST",
            data: {
                model: model,

                
                
            },   
            url: "../app/api/searchPartNumber_api.php",
            success: function(result)
            {
                //console.log(result);
                
                 var string = JSON.parse(result);
                 var str='<option value="" disabled selected>Choose your option</option>';
                  for(i=0 ; i<string.length; i++)
                      {
                          str+='<option value="'+string[i].part_number+'">'+string[i].part_number+'</option>';
                      }
                  $("#part_number").find('option').remove();
                  $("#part_number").append(str);
                  $('#part_number').material_select(); 

          
                
            },
            error: function(XMLHttpRequest,textStatus,errorThrown)
            {
                if (XMLHttpRequest.readyState == 4)
                {
                    alert(XMLHttpRequest.statusText);
                }
                else  if (XMLHttpRequest.readyState == 0)
                {
                    ("Internal Server Error");
                }
                else
                {
                    alert("Sorry for the inconvience.Please try again after some time.")
                }
            }     
            });
})

var invoicearray=[];
$("#addinvoiceitem").click(function () {
    var c_product=$("#invoice_description").serializeArray(); 
    //console.log(c_product);
    var tx_value=parseInt(c_product[4].value)*parseInt(c_product[6].value);
    //console.log(tx_value);
    var cgst_val=tx_value*(parseInt(c_product[7].value)/100);
    var igst_val=tx_value*(parseInt(c_product[9].value)/100);
    var sgst_val=tx_value*(parseInt(c_product[8].value)/100);
    var total=tx_value+igst_val+cgst_val+sgst_val;
   
    var str="<tr><td>"+(invoicearray.length+1)+"</td><td>"+c_product[0].value+"  "+c_product[2].value+" ("+c_product[3].value+")</td><td>"+c_product[5].value+"</td><td>"+c_product[4].value+"</td><td>"+c_product[6].value+"</td><td>"+tx_value+"</td><td>"+cgst_val+"</td><td>"+sgst_val+"</td><td>"+igst_val+"</td><td>"+total+"</td></tr>";
    $("#invoicetable").find('tbody').append(str);

    invoicearray.push(c_product);

    $("#invoice_description").trigger('reset');

   
});

$("#submit").click(function () { 
    var dataString=$("#invoice_details").serializeArray();
    $.ajax({
        type: "POST",
        url: "../app/api/invoiceDetails_api.php",
        data: {
           items: invoicearray,
           details:dataString
        },  
        success: function (result) {
            console.log(result);
            
        }
    });

});

// $("#invoice_details").submit(function (e) { 
//     e.preventDefault();

//      var dataString=$("#invoice_details").serialize();

//      $.ajax({
//          type: "POST",
//          url: "../app/api/invoicegnrtor_api.php",
//          data: dataString,
//          success: function (result) 
//          {
//              console.log(result);
             
//          }
//      });
// });

             
    
  
    
    
});