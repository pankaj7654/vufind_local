$(window).on('load', function() {
    $('#myModal').modal('show');
});

//onsubmit="return validateForm()"

// function validateForm() {
//     var firstname = document.getElementById("firstname").value;
//     var lastname = document.getElementById("lastname").value;
//     var email = document.getElementById("email").value;
//     var nameErr = emailErr = messageErr = true;

//     // Validate firstname
//     if (firstname === "") {
//         document.getElementById("nameErr").innerHTML = "First name is required";
//     } else {
//         document.getElementById("nameErr").innerHTML = "";
//         nameErr = false;
//     }

//     // Validate Email
//     if (email === "") {
//         document.getElementById("emailErr").innerHTML = "Email is required";
//     } else {
//         var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//         if (!email.match(emailPattern)) {
//             document.getElementById("emailErr").innerHTML = "Invalid email format";
//         } else {
//             document.getElementById("emailErr").innerHTML = "";
//             emailErr = false;
//         }
//     }

//     // Validate lastname
//     if (lastname === "") {
//         document.getElementById("nameErr").innerHTML = "Last name is required";
//     } else {
//         document.getElementById("nameErr").innerHTML = "";
//         nameErr = false;
//     }

//     return !(nameErr || emailErr || messageErr);
// }


// $(document).unbind().on("click", "#saveUserDetails", function(event) {
//     reqName = $('#fname').val();
//     reqLname = $('#lname').val();
//     reqEmail = $('#userEmail').val();

//     function IsFName(requestorName) {
//         var regex = /^[a-zA-Z]/;
//         if(!regex.test( reqName ) || reqName == '') {
//           return false;
//         }else{
//           return true;
//         }
//       }

//       function IsLName(requestorName) {
//         var regex = /^[a-zA-Z]/;
//         if(!regex.test( reqLname ) || reqLname == '') {
//           return false;
//         }else{
//           return true;
//         }
//       }
    
//       function IsEmail(requestorEmail) {
//         var regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
//         if(!regex.test( reqEmail ) || reqEmail == '') {
//           return false;
//         }else{
//           return true;
//         }
//       } 
    

//     if(IsFName(reqName)==false){
//       $('#invalid_fname').show();
//     }else {
//       $('#invalid_fname').hide();
//     }

//     if(IsLName(reqName)==false){
//         $('#invalid_lname').show();
//       }else {
//         $('#invalid_lname').hide();
//       }

//     if(IsEmail(reqEmail)==false){
//         $('#invalid_email').show();
//       }else {
//         $('#invalid_email').hide();
//       }

// });


// function PopUp(hideOrshow) {
//     if (hideOrshow == 'hide') document.getElementById('ac-wrapper').style.display = "none";
//     else document.getElementById('ac-wrapper').removeAttribute('style');
// }
// window.onload = function () {
//     setTimeout(function () {
//         PopUp('show');
//     }, 1000);
// }