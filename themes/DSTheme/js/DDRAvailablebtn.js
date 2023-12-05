$("#ajaxcallDDRbtn").ready(function() {
  // var data = new getDataFromFrontend();  
  //   console.log(data);
    $.ajax({
      type: 'GET', //Method type
      url: VuFind.path + '/AJAX/JSON', //Your form processing file url
      dataType: 'json',
      data: {
        method: 'SetDDRAvailableBtnByJquery',    //it is AjaxHandler class name
        // jid:journalID,                        //it is AjaxHandler class name
        // memid:userMemId
      },
      success: function(data){
        // $('#ajaxcallDDRbtn').empty();
        alert("Ajax is calling");
        console.log(data);
        $('.DDRavailableBtn').append('<span class="label label-warning" role="button" onClick="loadAccessMem(this)" id="accessmemname">DDR available</span>');
      },
      error:function(xhr, status, error){
        console.log('fail');
      }
    });
  });


  
// function isPhtmlLoaded() {
//   return document.cookie.indexOf('phtmlLoaded=true') >= 0;
// }

// // Function to load the phtml page and set the cookie when it's loaded
// function loadPhtmlOnce() {
//   if (!isPhtmlLoaded()) {
//       $.ajax({
//           url: 'your_page.phtml', // Replace 'your_page.phtml' with your actual phtml file path
//           type: 'GET',
//           success: function(response) {
//               $('#phtmlContent').html(response);
//               $('#phtmlContent').show();
//               document.cookie = 'phtmlLoaded=true; expires=Fri, 31 Dec 9999 23:59:59 GMT'; // Set the cookie to expire in the far future
//           },
//           error: function() {
//               console.log('Failed to load phtml content.');
//           }
//       });
//   }
// }

// // Call the loadPhtmlOnce function when the page is ready
// $(document).ready(function() {
//   loadPhtmlOnce();
// });


// $(document).ready(function(){
//   // $('#ajaxcallDDRbtn').load(result-list.phtml);
//   alert("calling");
// });