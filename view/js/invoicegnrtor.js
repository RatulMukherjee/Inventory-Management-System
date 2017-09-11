$(document).ready(function(){
    
     //$('select').material_select();
     $("#next").click(function(){
         
          $('ul.tabs').tabs('select_tab', 'test2'); 
         
     });   $("#prev").click(function(){
         
          $('ul.tabs').tabs('select_tab', 'test1'); 
         
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
                console.log(result);
                
                // var string = JSON.parse(result);
                // var str='<option value="" disabled selected>Choose your option</option>';
                //  for(i=0 ; i<string[0].length; i++)
                //      {
                //          str+='<option value="'+string[0][i].model+'">'+string[0][i].model+'</option>';
                //      }
                //  $("#model").find('option').remove();
                //  $("#model").append(str);
                //  $('#model').material_select(); 

          
                
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
             
    
  
    
    
});