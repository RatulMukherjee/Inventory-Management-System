$(document).ready(function() {
    
    $("#accname").html(localStorage.getItem('name'));

               $.ajax({
                type: "POST",
                url: "../app/api/showlist_api.php",
                success: function(result)
                {
                  
                 
                   var string=JSON.parse(result);
                    //console.log(string);
                  var str='<option value="" disabled selected>Choose your option</option>';
                    $("#products").append(str);
                     for(i=0 ; i<string.length; i++)
                        {
                            if (string[i].brand != null)
                            str+='<option value="'+string[i].brand+'">'+string[i].brand+'</option>';
                        }
                    $("#brands").append(str);
                    var str='';
                     for(i=0 ; i<string.length; i++)
                        {
                            if (string[i].name != null)
                                str+='<option value="'+string[i].name+'">'+string[i].name+'</option>';
                        }
                    
                   $("#products").append(str)
                    $('#brands').material_select();
                    $('#products').material_select();
                    
                    
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
var rangeSlider = document.getElementById('slider-range');

noUiSlider.create(rangeSlider, {
	start: [ 500000 ],
	range: {
		'min': [  2000 ],
		'max': [ 500000 ]
	}
});
    var rangeSliderValueElement = document.getElementById('slider-range-value');

rangeSlider.noUiSlider.on('update', function( values, handle ) {
	rangeSliderValueElement.innerHTML = "Less than "+values[handle];
}); 
           $("#searchform").submit(function(e){
           e.preventDefault();
              
               var dataString={price: rangeSlider.noUiSlider.get()};
               if ($("#products").val() == null)
                   {
                      dataString.products="none";
                   }
               else
               {
                  dataString.products=$("#products").val();  
                   
               }
               if ($("#brands").val().length == 0 )
                   {
                       dataString.brands="none";
                   }
               else
               {    
                   dataString.brands=$("#brands").val();
                   
               }
               
            
                   
            //var dataString = {products: $("#products").val(), brands:$("#brands").val(),price: rangeSlider.noUiSlider.get()};
                console.log(dataString);
                         $.ajax({
                type: "POST",
                url: "../app/api/searchproducts_api.php",
                data: dataString,
                success: function(result)
                {
                    var string= JSON.parse(result);
                    
                    console.log(string);
                    
               if (string.error == "False")
                    {
                        var  table = $('#example').DataTable( );
                         table.destroy();
                  
                        var arr= [];
                        for(i=0; i<string[0].length; i++ )
                                {
                                    var data = [];

                                    data.push(string[0][i].model);
                                    data.push(string[0][i].quantity);
                                    data.push(string[0][i].part_number)
                                    data.push(string[0][i].price);
                                    data.push(string[0][i].gst);
                                    data.push(string[0][i].product_dscp);
                                    data.push("<button class=\"btn\">History</button>");

                                    arr.push(data); 
                                }
                       
                    	$('#example').DataTable( {
						dom: 'Blfrtip',
						
						data: arr,

						buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],

						"scrollX": true,

						"scrollY": true,

						"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]

                    } );
                    

                    $('#example tbody').on( 'click', 'button', function () {
                        var index = $(this).closest('tr').index();
                        var table=$('#example').DataTable();
                        var data = table.row( $(this).parents('tr') ).data();
                        console.log(data[0]); 
                            });
                    }
                    else if (string.error == "True")
                        {
                            Materialize.toast("No stock", 5000, 'rounded') 
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
						alert("Sorry for the inconvience.Please try again after some time.");
					}
				}     
                });
  });
         });
