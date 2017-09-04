$(document).ready(function(){
    
         $.ajax({
                type: "POST",
                url: "../app/api/getuname_api.php",
                data: {
                    email:  localStorage.getItem("email")
                    
                    
                },
                success: function(result)
                {
                    //console.log(result);
                    var string= JSON.parse(result);
                    
                    localStorage.setItem("name",string[0].uname);
                    $("#accname").html(string[0].uname);
             
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

