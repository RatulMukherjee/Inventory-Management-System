$(document).ready(function(){
   
    if (localStorage.getItem("email") != null && localStorage.getItem("pass") != null )
		{
		 	$("#email").val(localStorage.getItem("email"));
		 	$("#password").val(localStorage.getItem("pass"));
		}
    
    //console.log("hello");
    $("#loginform").submit(function(e){
           e.preventDefault(); 
        
        //console.log("submit");
    var dataString = $("#loginform").serializeArray();
        $.ajax({
                type: "POST",
                url: "../app/api/login_api.php",
                data: dataString,
                success: function(result)
                {
                     var string= JSON.parse(result);
                    //console.log(string.message);
                    
                    
                    if (string.error == "False" && string.message == "Success" )
                      {
                        if ($("#check").is(":checked")) 
     				  	{	
     				  		localStorage.setItem("pass",$("#password").val());
     				  	}
                       
                          localStorage.setItem("email",$("#email").val());
                          window.location="dashboard.html";
                          //console.log("logged in");
                         
                          
                      }
                    else if (string.error == "True")
                        {
                            
                            $("#errmsg").html(string.message);
                            $("#loginform").trigger('reset');   
                            
                        }
                    else{
                         $("#errmsg").html(string.message);
                         $("#loginform").trigger('reset'); 
                        
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