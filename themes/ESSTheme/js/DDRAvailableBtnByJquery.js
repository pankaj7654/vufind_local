// $("#ajaxcallDDRbtn").ready(function() {
//   // debugger;
//   $.ajax({
//     type: 'GET', //Method type
//     url: VuFind.path + '/AJAX/JSON', //Your form processing file url
//     dataType: 'json',
//     data: {
//       method:'SetDDRAvailableBtnByJquery',
//     },
//     success: function(data){
//       alert("Ajax is calling");
//       console.log(data);
//       $('.DDRavailableBtn').append('<span class="label label-warning" role="button" onClick="loadAccessMem(this)" id="accessmemname">DDR available</span>');
//     },
//     error:function(xhr, status, error){
//       console.log('fail');
//     }
//   });
// });

// var hasRefreshed = localStorage.getItem("hasRefreshed");
// if (!hasRefreshed) {
//     // If it's the first time, set the flag in localStorage and refresh the page
//     localStorage.setItem("hasRefreshed", true);
//     location.reload(1);
// } else {
//     // If the flag exists, remove it from localStorage to avoid future refreshes
//     localStorage.removeItem("hasRefreshed");
// }

// // Function to load the phtml page and set the cookie when it's loaded
// function loadPhtmlOnce() {
//   if (!isPhtmlLoaded()) {
//       $.ajax({
//           url: 'result-list.phtml', // Replace 'your_page.phtml' with your actual phtml file path
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


    //     // Function to check if the div has been loaded before
    //     function isDivLoaded() {
    //       return localStorage.getItem('divLoaded') === 'true';
    //   }

    //   // Function to show the div and set the localStorage variable when it's loaded
    //   function showDivOnce() {
    //       if (!isDivLoaded()) {
    //           document.getElementById('loadOnceDiv').style.display = 'block';
    //           localStorage.setItem('divLoaded', 'true');
    //       }
    //   }

    //   // Call the showDivOnce function when the page is ready
    //   document.addEventListener('DOMContentLoaded', showDivOnce);