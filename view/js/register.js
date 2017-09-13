$(document).ready(function(){

       $("#registerform").submit(function(e){
           e.preventDefault();
        //console.log("submit");
    var dataString = $("#registerform").serializeArray();
        $.ajax({
                type: "POST",
                url: "../app/api/register_api.php",
                data: dataString,
                success: function(result)
                {
                     var string= JSON.parse(result);
                    console.log(string.message);
                    
                    
                    if (string.error =="False" && string.message =="Success" )
                      {
                        $("#registerform").trigger('reset');   
                        window.location="login.html";
                         
                          
                      }
                    else if (string.error == "True")
                        {
                            $("#errmsg").append(string.message);
                            $("#registerform").trigger('reset');   
                            
                        }
                    else{
                         $("#errmsg").append(string.message);
                         $("#registerform").trigger('reset'); 
                        
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