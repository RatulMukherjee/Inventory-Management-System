$(document).ready(function(){
         
/*AJAX TO RETRIEVE AVAILABLE BRANDS IN THE DATABASE*/    
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
                    $("#brands").append(str);
                    $('#brands').material_select(); 
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
    
   /* END OF AJAX*/
           
    
    /*AJAX TO SHOW PRODUCTS AVAILABLE UNDER THAT BRAND*/
    
            $('#brands').change(function(){
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
                    $("#products").find('option').remove();
                    $("#products").append(str);
                    $('#products').material_select(); 
                    $("#productsdiv").removeClass('hide');
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
         
    /*END OF AJAX*/
    
    
    /*UNHIDE THE FORM TO WRITE PRODUCT DETAILS*/
    $('#products').change(function(){
            var product=$(this).find("option:selected").attr('value');
             $("#productinfo").removeClass('hide');
             $('#gst').material_select();     
    });
    
    
    
   /* FINAL SUBMIT*/
    
           $("#addform").submit(function(e){
           e.preventDefault();
        
    var dataString = $("#addform").serialize();
        $.ajax({
                type: "POST",
                url: "../app/api/addproducts_api.php",
				beforeSend: function(){
					 $('#add').attr('disabled', true);
					
				},
                data: dataString,
                success: function(result)
                {
                    //console.log(result);
                    var string= JSON.parse(result);
                    //console.log(string.message);
                    
                    
                    if (string.error =="False" && string.message =="Success" )
                      {
                                Materialize.toast(string.message, 3000, 'rounded')
                                
                         
                          
                      }
                    else if (string.error == "True")
                        {
                              Materialize.toast(string.message, 3000, 'rounded')
                               
                            
                        }
                    else{
                            Materialize.toast(string.message, 3000, 'rounded')
                        
                    }
                    
                    //$("#adddiv").removeClass('center');
                    $("#adddiv").find('#reset').remove();
                    var str= '<input class="btn"  type="button" name="reset" value="Reset" id="reset">';     
                    $("#adddiv").append(str);
                    
                  
                    
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
    
    /*END OF AJAX*/
    
    /*RESET BUTTON*/
    
        $("#adddiv").on('click','#reset',function(){
           
            $("#productinfo").find('input').val('');
            $("#add").val("Add");
            $("#reset").val("Reset");
            $('#add').attr('disabled', false);
            
            
              
            
            
        });
        
        
        
   
    
    
           
           
       });
    
    
    