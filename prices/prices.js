
        function update(val,event){
            var productID = val;
            
            var data = $("#edit-product"+val).serializeArray();
            
           event.preventDefault();
             var flag=0;
            var errorarr = new Array();
            var ptitle = data[1].value;
          
            var pdescription = data[2].value;
            var pprice = data[3].value;
            
             $('.error-info-update'+productID).empty();
            if (ptitle.trim() == "" || ptitle.length > 150)  {
                errorarr.push("The field title cannot be empty or exceed 150 characters");
                flag=1;
            }
           
            if (pdescription.trim() == "" || pdescription.length > 150)  {
                errorarr.push("The field description cannot be empty or exceed 150 characters");
                flag=1;
            }
            
            if (pprice.trim() == "" || pprice.length>6 || !$.isNumeric(pprice))  {
                 errorarr.push("The field price cannot be empty, exceed 6 numbers or have characters");
                flag=1;
            } 
            
            var text="";
              if (errorarr.length !=0 ) {
                   
                  var error_danger = document.createElement('div');
                  error_danger.setAttribute("class", "alert alert-danger");
                  for (i in errorarr) {
                      text+= "<p>" + errorarr[i] + "</p>";
                  }
                  error_danger.innerHTML = text;
                   $('.error-info-update'+productID).append(error_danger);
              }
            if (flag==0) {
           $.ajax({
			   		url: 'editPrice.php',
			    	type: 'POST',
			       	data: data,
                    success: function(data) {
                        
                      $('#modal'+productID).modal('hide');
                      $('body').removeClass('modal-open');
                      $('.modal-backdrop').remove();
                       readPrices();
                        
                    }
			       
			     });
            }
       }
       
        $('.add-btn-color').on('click', function(event){
      event.preventDefault();
      $('#modalAddProduct').modal('show').find('.modal-content').load($(this).attr('href'));
    });
	$(document).ready(function(){
		
		readPrices(); 
		
   
		$(document).on('click', '#delete-product', function(event){
			
			var productId = $(this).data('id');
			SwalDelete(productId);
			event.preventDefault();
		});
        
      
       
        
	});
        
		$(document).on('click','#save',function(event) {
         var data = $("#insert-product").serializeArray();
         
           event.preventDefault();
            $('.error-info').empty();
            var flag=0;
      var errorarr = new Array();
            var ptitle = data[0].value;
  
            var pdescription = data[1].value;
            var pprice = data[2].value;
           
            if (ptitle.trim() == "" || ptitle.length > 150)  {
                errorarr.push("The field title cannot be empty or exceed 150 characters");
                flag=1;
            }
           
            if (pdescription.trim() == "" || pdescription.length > 150)  {
                errorarr.push("The field description cannot be empty or exceed 150 characters");
                flag=1;
            }
            
            if (pprice.trim() == "" || pprice.length>6 || !$.isNumeric(pprice))  {
                 errorarr.push("The field price cannot be empty, exceed 6 numbers or have characters");
                flag=1;
            } 
            
            var text="";
              if (errorarr.length !=0 ) {
                   
                  var error_danger = document.createElement('div');
                  error_danger.setAttribute("class", "alert alert-danger");
                  for (i in errorarr) {
                      text+= "<p>" + errorarr[i] + "</p>";
                  }
                  error_danger.innerHTML = text;
                   $('.error-info').append(error_danger);
              }
            if (flag==0) {
           $.ajax({
			   		url: 'insertPrice.php',
			    	type: 'POST',
			       	data: data,
                    success: function(data) {
                      $('#modalAddProduct').modal('hide');
                       readPrices();
                        
                      
                    }
			       
			     });
            }
        });
    
        
	
	
	function SwalDelete(productId){
		
		swal({
			title: 'Are you sure?',
			text: "It will be deleted permanently!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			       
			     $.ajax({
			   		url: 'delete.php',
			    	type: 'POST',
			       	data: 'delete='+productId,
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal('Deleted!', response.message, response.status);
					readPrices();
			     })
			     .fail(function(){
			     	swal('Oops...', 'Something went wrong with ajax !', 'error');
			     });
			  });
		    },
			allowOutsideClick: false			  
		});	
		
	}
	
	function readPrices(){
		$('#load-products').load('read-prices.php');	
	}