// ajax calling for set university name on the top of page using API call
$(document).ready(function(){
  //  debugger;
	//  console.log(VuFind.path);

    $.ajax({
      type: 'GET', //Method type
      url: VuFind.path + '/AJAX/JSON', //Your form processing file url
      dataType: 'json',
      data: {
        method: 'FetchINFMemberNameByIP',    //it is AjaxHandler class name
      },
      success: function(data){
        $('#memName').empty();
        if(typeof(data.data) == 'object'){
          $('#memName').append(data.data[1]);
        }
        else{
          $('#memName').append(data.data);
        }
      },
      error:function(xhr, status, error){
        console.log('fail');
      }
    });
  });




// $("#myElement").ready(function() {
//     $.ajax({
//       type: 'GET', //Method type
//       url: VuFind.path + '/AJAX/JSON', //Your form processing file url
//       dataType: 'json',
//       data: {
//         method: 'FetchINFMemberNameByIP',    //it is AjaxHandler class name
//       },
//       success: function(data){
//         $('#memName').empty();
//         $('.DDRavailableBtn').append('<span class="label label-warning">DDR available</span>')
//       },
//       error:function(xhr, status, error){
//         console.log('fail');
//       }
//     });
//   });

    // $('.DDRavailableBtn').append('<span class="label label-warning">DDR available</span>')

