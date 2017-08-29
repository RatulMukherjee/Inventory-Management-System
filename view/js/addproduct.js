  

$(document).ready(function(){
  
    $("#accname").html(localStorage.getItem('name'));
    
$("#addbrand").click(function(){
    if ($("#brandmod").val() != '' &&  $("#productmod").val() != '' && $("input[name='group1']").is(':checked'))
        {
                $.ajax({
                type: "POST",
                url: "../app/api/addnewbrand_api.php",
                data: {
                    brand:  $("#brandmod").val(),
                    product:$("#productmod").val(),
                    type: $("input[name='group1']:checked").val()
                },    
                success: function(result)
                {
                    //console.log(result);
                    
                    var string = JSON.parse(result);
                    
                    if (string.error=="False")
                      {
                        window.location = "addproducts.html";
                      }
                    else if (string.error == "True")
                        {
                            Materialize.toast(string.message, 3000, 'rounded')
                        }
                    else
                        {
                                Materialize.toast(string.message, 3000, 'rounded')
                        }
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
        }
    else{
            Materialize.toast("Field/s are Empty", 3000, 'rounded')
        }
});
/*    MODAL TO FILL UP NEW BRANDS/PRODUCTS*/
     $('.modal').modal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      inDuration: 300, // Transition in duration
      outDuration: 200, // Transition out duration
      startingTop: '4%', // Starting top style attribute
      endingTop: '10%', // Ending top style attribute
      ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
       
        var brand=$("#brands").find("option:selected").attr('value')
          
          if (brand != '')
            {
                $("#brandmod").val(brand);
                $("#brandmod").prop("readonly",true);
                $("#modbrandlabel").addClass('hide');
            }
      } 
    }
  );
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
                    $("#productsdiv").removeClass('hide')
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
            //var product=$(this).find("option:selected").attr('value');
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
                    console.log(result);
                    var string= JSON.parse(result);
                    
                    //console.log(string.error);
                    
                    
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
    
    /*UPLOAD XLSX FILE AJAX*/
    
    $("#addxls").submit(function(e){
           e.preventDefault();
        
            var file_data = $('#fileToUpload').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);              
             $.ajax({
                        url: '../app/api/uploadxls_api.php', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (result) {
                           var string = JSON.parse(result);
                            
                          
                            
                            
                            
                                 var string=JSON.parse(result);
                            if (string.error == "True")
                                {
                                    Materialize.toast(string.message, 3000, 'rounded')
                                }
                           else
                                { 
                                    /*   var string1=JSON.parse(string[0]);
                                        console.log(string1.error);*/  
                                        //console.log(string.length);
                                    var count = 0;
                                    for(i=0;i<string.length;i++)
                                        {
                                            var string1=JSON.parse(string[i]);
                                            
                                            //console.log(string[i]);
                                            if (string1.error == "False")
                                                {
                                                    
                                                    count++;
                                                    
                                                }
                                        }
                                    
                                     Materialize.toast(""+count+" items updated/registered", 3000, 'rounded')
                                    
                                }
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