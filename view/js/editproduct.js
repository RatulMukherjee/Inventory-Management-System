$(document).ready(function() {
    
    $("#accname").html(localStorage.getItem('name'));
    
     $("#editbrand :input").change(function() {
    $("#editbrand").data("changed",true);
         
         console.log("change");
    });

               $.ajax({
                type: "POST",
                url: "../app/api/showlist_api.php",
                success: function(result)
                {
                  
                    //console.log(result);
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
		'min': [  100 ],
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
                //console.log(dataString);
                          $.ajax({
                type: "POST",
                url: "../app/api/searchproducts_api.php",
                data: dataString,
                success: function(result)
                {
                    var string= JSON.parse(result);
                   
                    console.log(result);
                    
                  if (string.error == "False")
                    { 
                        
                         $('#example').DataTable().destroy();
                        var arr= [];
                        for(i=0; i<string[0].length; i++)
                                {
                                    var data = [];

                                    data.push(string[0][i].model);
                                    data.push(string[0][i].part_number);
                                    data.push(string[0][i].price);
                                    data.push(string[0][i].product_dscp);

                                    data.push(" <button data-target=\"modal1\" quantity=\""+string[0][i].quantity+"\" pid=\""+string[0][i].pid+"\" class=\"btn modal-trigger\">Edit</button>"); 
                                    arr.push(data); 
                                }
                        
                     	$('#example').DataTable( {
						dom: 'Blfrtip',
						
						data: arr,

                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                        

						"scrollX": true,

						"scrollY": true,
                            
                        "ordering": false,
                            
						"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]

					} );
                        
                           $('#example tbody').on( 'click', 'button', function () {
                            var index = $(this).closest('tr').index();
                            var pid=$(this).attr('pid');
                            var quantity=$(this).attr('quantity');
                            var table=$('#example').DataTable();
                            var data = table.row( $(this).parents('tr') ).data();
                            //console.log(pid); 
                                $('.modal').modal({
                                      dismissible: true, // Modal can be dismissed by clicking outside of the modal
                                      opacity: .5, // Opacity of modal background
                                      inDuration: 300, // Transition in duration
                                      outDuration: 200, // Transition out duration
                                      startingTop: '4%', // Starting top style attribute
                                      endingTop: '10%', // Ending top style attribute
                                      ready: function(modal, trigger){

                                           $("#pidmod").val(pid); 

                                          $("#modelmod").val(data[0]);
                                          $("#modelmod").focus();

                                          $("#part_numbermod").focus();
                                          $("#part_numbermod").val(data[1]);

                                          $("#pricemod").val(data[2]);
                                          $("#pricemod").focus();

                                          $("#quantitymod").val(quantity);
                                          $("#quantitymod").focus();

                                          $("#product_dscpmod").val(data[3]);
                                          $("#product_dscpmod").focus();

                                          $("#gstmod").material_select(); 
                                        
                                      
                                      }
                                    
                                    
                                    });      
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
    
    
                $("#editbrand").click(function(){
                    
                    
                    var dataString=$("#editform").serializeArray();
                    
                    console.log(dataString);
                        

                     $.ajax({
                        type: "POST",
                        url: "../app/api/editproduct_api.php",
                    /*    beforeSend: function(){
                             $('#add').attr('disabled', true);

                        },*/
                        data: dataString,
                        success: function(result)
                        {
                          
                            var string= JSON.parse(result);
                            
                            if (string.error== "False")
                                {
                                    
                                     Materialize.toast(string.message, 3000, 'rounded')
                                    
                                }
                            else if (string.error =="True")
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
                                alert("Sorry for the inconvience.Please try again after some time.");
                            }
                        }     
                        });        
                });
         });
        
         
     
         