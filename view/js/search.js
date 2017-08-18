$(document).ready(function(){
    
   $("#searchform").submit(function(e){
           e.preventDefault(); 
       table = $('#example').DataTable( );
       table.destroy();
        //console.log("submit");
    var dataString = $("#searchform").serializeArray();
       //console.log(dataString);
        $.ajax({
                type: "POST",
                url: "../app/api/searchuser_api.php",
                data: dataString,
                success: function(result)
                {
                   //console.log(result);
                    var arr= [];
                    var string = JSON.parse(result);
                    
                    for(i=0; i<string.length; i++ )
                        {
                            var data = [];
                            
                            data.push(string[i].uname);
                            data.push(string[i].email);
                            
                            if (string[i].acc_type == 1)
                            data.push("User");
                            else
                            data.push("Admin");
                            
                        arr.push(data);    
                             
                            
                        }
                    
                        //console.log(arr);
                    	$('#example').DataTable( {
						dom: 'Blfrtip',
						
						data: arr,

						buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],

						"scrollX": true,

						"scrollY": true,

						"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]

					} );
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