$(document).ready(function() {
    $('select').material_select();

             
var rangeSlider = document.getElementById('slider-range');

noUiSlider.create(rangeSlider, {
	start: [ 4000 ],
	range: {
		'min': [  2000 ],
		'max': [ 50000 ]
	}
});
    var rangeSliderValueElement = document.getElementById('slider-range-value');

rangeSlider.noUiSlider.on('update', function( values, handle ) {
	rangeSliderValueElement.innerHTML = "Less than "+values[handle];
}); 
           $("#searchform").submit(function(e){
           e.preventDefault();
               table = $('#example').DataTable( );
       table.destroy();
            var dataString = {products: $("#products").val(), brands:$("#brands").val(),price: rangeSlider.noUiSlider.get()};
                     $.ajax({
                type: "POST",
                url: "../app/api/searchproducts_api.php",
                data: dataString,
                success: function(result)
                {
                    //console.log(result);
                    
                    var arr= [];
                    var string = JSON.parse(result);
                    
                    for(i=0; i<string.length; i++ )
                        {
                            var data = [];
                            
                            data.push(string[i].model);
                            data.push(string[i].quantity);
                            data.push(string[i].price);
                            data.push(string[i].gst );
                            
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