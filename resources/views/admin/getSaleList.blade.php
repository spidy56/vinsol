@extends('layouts.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            <div class="header_wrap">
              <div class="num_rows">
                @if(Session::has('message'))
                <div class="error" style="text-align:center;">
                    <h4 class="error">{{ Session::get('message') }}</h4>
                </div>

                @endif
                <div class="card-header">Sale List
                    <div style="float: right;">
                        <a href="{{route('home')}}" class="d">>> Make Sale</a>
                    </div>
                </div>
<br>
                {{-- {{ $saleList->links()}} --}}
                      {{-- <div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
                           <select class  ="form-control" name="state" id="maxRows">
                               
                               
                               <option value="10">10</option>
                               <option value="15">15</option>
                               <option value="20">20</option>
                               <option value="50">50</option>
                               <option value="70">70</option>
                               <option value="100">100</option>
                  <option value="5000">Show ALL Rows</option>
                              </select>
                           
                        </div> --}}
              </div>
              <div class="tb_search">
      <input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
              </div>
            </div>
      <table class="table table-striped table-class" id= "table-id">
        
          
      <thead>
      <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Price</th>
              <th>Discounted Price</th>
              <th>Quantity</th>
              <th>Publish Date</th>
              <th>Created At</th>
          </tr>
        </thead>
      <tbody>
          @foreach ($saleList as $s_list)
              
          <tr>
              <td>{{$s_list->title ?? ''}}</td>
              <td>{{$s_list->description ?? ''}}</td>
              <td>{{$s_list->price ?? ''}}</td>
              <td>{{$s_list->discounted_price ?? ''}}</td>
              <td>{{$s_list->quantity ?? ''}}</td>
              <td>{{$s_list->publish_date ?? ''}}</td>
              <td>{{$s_list->created_at ?? ''}}</td>
              
          </tr>
          @endforeach
          
          
        
          <tbody>
      </table>
      
      <!--		Start Pagination -->
      {{ $saleList->links()}}
                  {{-- <div class='pagination-container'>
                      <nav>
                        <ul class="pagination">
                         <!--	Here the JS Function Will Add the Rows -->
                        </ul>
                      </nav>
                  </div> --}}
            {{-- <div class="rows_count">Showing 11 to 20 of 91 entries</div> --}}
      
      </div> <!-- 		End of Container -->
      
      
      <!--  Developed By Yasser Mas -->
    </div>
</div>
<script>
     getPagination('#table-id');
	$('#maxRows').trigger('change');
	function getPagination (table){

		  $('#maxRows').on('change',function(){
		  	$('.pagination').html('');						// reset pagination div
		  	var trnum = 0 ;									// reset tr counter 
		  	var maxRows = parseInt($(this).val());			// get Max Rows from select option
        
		  	var totalRows = $(table+' tbody tr').length;		// numbers of rows 
			 $(table+' tr:gt(0)').each(function(){			// each TR in  table and not the header
			 	trnum++;									// Start Counter 
			 	if (trnum > maxRows ){						// if tr number gt maxRows
			 		
			 		$(this).hide();							// fade it out 
			 	}if (trnum <= maxRows ){$(this).show();}// else fade in Important in case if it ..
			 });											//  was fade out to fade it in 
			 if (totalRows > maxRows){						// if tr total rows gt max rows option
			 	var pagenum = Math.ceil(totalRows/maxRows);	// ceil total(rows/maxrows) to get ..  
			 												//	numbers of pages 
			 	for (var i = 1; i <= pagenum ;){			// for each page append pagination li 
			 	$('.pagination').append('<li data-page="'+i+'">\
								      <span>'+ i++ +'<span class="sr-only">(current)</span></span>\
								    </li>').show();
			 	}											// end for i 
     
         
			} 												// end if row count > max rows
			$('.pagination li:first-child').addClass('active'); // add active class to the first li 
        
        
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
       showig_rows_count(maxRows, 1, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

        $('.pagination li').on('click',function(e){		// on click each page
        e.preventDefault();
				var pageNum = $(this).attr('data-page');	// get it's number
				var trIndex = 0 ;							// reset tr counter
				$('.pagination li').removeClass('active');	// remove active class from all li 
				$(this).addClass('active');					// add active class to the clicked 
        
        
        //SHOWING ROWS NUMBER OUT OF TOTAL
       showig_rows_count(maxRows, pageNum, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL
        
        
        
				 $(table+' tr:gt(0)').each(function(){		// each tr in table not the header
				 	trIndex++;								// tr index counter 
				 	// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
				 	if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
				 		$(this).hide();		
				 	}else {$(this).show();} 				//else fade in 
				 }); 										// end of for each tr in table
					});										// end of on click pagination list
		});
											// end of on select change 
		 
								// END OF PAGINATION 
    
	}	


			

// SI SETTING
$(function(){
	// Just to append id number for each row  
default_index();
					
});

//ROWS SHOWING FUNCTION
function showig_rows_count(maxRows, pageNum, totalRows) {
   //Default rows showing
        var end_index = maxRows*pageNum;
        var start_index = ((maxRows*pageNum)- maxRows) + parseFloat(1);
        var string = 'Showing '+ start_index + ' to ' + end_index +' of ' + totalRows + ' entries';               
        $('.rows_count').html(string);
}

// CREATING INDEX
function default_index() {
  $('table tr:eq(0)').prepend('<th> ID </th>')

					var id = 0;

					$('table tr:gt(0)').each(function(){	
						id++
						$(this).prepend('<td>'+id+'</td>');
					});
}

// All Table search script
function FilterkeyWord_all_table() {
  
// Count td if you want to search on all table instead of specific column

  var count = $('.table').children('tbody').children('tr:first-child').children('td').length; 

        // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("search_input_all");
  var input_value =     document.getElementById("search_input_all").value;
        filter = input.value.toLowerCase();
  if(input_value !=''){
        table = document.getElementById("table-id");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {
          
          var flag = 0;
           
          for(j = 0; j < count; j++){
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
             
                var td_text = td.innerHTML;  
                if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                //var td_text = td.innerHTML;  
                //td.innerHTML = 'shaban';
                  flag = 1;
                } else {
                  //DO NOTHING
                }
              }
            }
          if(flag==1){
                     tr[i].style.display = "";
          }else {
             tr[i].style.display = "none";
          }
        }
    }else {
      //RESET TABLE
      $('#maxRows').trigger('change');
    }
}
</script>
@endsection
