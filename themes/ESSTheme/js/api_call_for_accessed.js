// create datatable which is accessed current journal
function loadAccessMem(e) {
  // console. log(jQuery(). jquery);
  // var version = ($().modal||$().tab).Constructor.VERSION.split('.');
  // console.log(version);
  var journalID = e.dataset.jid;
  var count = e.dataset.count;
  var jname = e.dataset.jname;
  var userMemId = e.dataset.memid;
  var doi = e.dataset.doi;
  var title = e.dataset.title;
  var containerTitle = e.dataset.containertitle;
  var format = e.dataset.format;
  var issn = e.dataset.issn;
  var publisher = e.dataset.publisher;
  var url = e.dataset.url;
  var docId = e.dataset.docid;
  var volume = e.dataset.volume;
  var issue = e.dataset.issue;
  var year = e.dataset.year;
  const author = e.dataset.author;
  const pages = e.dataset.pages;

    // Check if the 'firstname' cookie is set
    let firstname = getCookie('firstname');
    if (firstname === null) {
        // If not set, set it with an empty value
        firstname = '';
        setCookie('firstname', firstname, 30); // Set the cookie
    }
  
    // Check if the 'lastname' cookie is set
    let lastname = getCookie('lastname');
    if (lastname === null) {
        // If not set, set it with an empty value
        lastname = '';
        setCookie('lastname', lastname, 30); // Set the cookie
    }
  
    // Check if the 'email2' cookie is set
    let email2 = getCookie('email2');
    if (email2 === null) {
        // If not set, set it with an empty value
        email2 = '';
        setCookie('email2', email2, 30); // Set the cookie
    }
  
    // Check if the 'name' cookie is set
    let name = firstname + ' ' + lastname;

    $('#showOrgenization').modal('show');

    if (count !== '0') {
      $(".preload").fadeIn();
      $.ajax({
        type: 'GET',
        url: VuFind.path + '/AJAX/JSON',
        dataType: 'json',
        async: false,
        data: {
          method: 'FetchINFMemberCountByJournalID',
          jid: journalID,
          memid: userMemId
        },
        success: function (data) {
          $(".preload").fadeOut();
          memberDetails = data['data'];
    
          // Clear the previous table data and destroy the DataTable
          $('#memberDataTable').DataTable().clear().destroy();
    
          // Append the new table element to the container
          $('.subscribingInstituteNameList').empty().append('<table id="memberDataTable" class="table table-striped table-bordered table-hover" width="100%"><thead><tr><th style="width: 80%;">Member Name</th><th style="width: 20%;">Action</th></tr></thead></table>');
    
          // Initialize the DataTable with your data
          $('#memberDataTable').DataTable({
            data: memberDetails['data'],
            columns: [
              { data: "memName" },
              {
                data: "memid",
                render: function (data, type, row) {
                  return '<button type="button" class="btn btn-primary" id="makerequesttoorg" ' +
                    'data-toggle="modal" data-dismiss="modal" ' +
                    'value="' + row['memid'] + '" ' +
                    'value2="' + journalID + '" ' +
                    'value3="' + jname + '" ' +
                    'value4="' + row['memName'] + '" ' +
                    'value5="' + userMemId + '" ' +
                    'value6="' + doi + '" ' +
                    'value7="' + title + '" ' +
                    'value8="' + containerTitle + '" ' +
                    'value9="' + issn + '" ' +
                    'value10="' + publisher + '" ' +
                    'value11="' + url + '" ' +
                    'value12="' + format + '" ' +
                    'value13="' + docId + '" ' +
                    'value14="' + volume + '" ' +
                    'value15="' + issue + '" ' +
                    'value16="' + year + '" ' +
                    'value17="' + author + '" ' +
                    'value18="' + pages + '" ' +
                    'value19="' + name + '" ' +
                    'value20="' + email2 + '">Make request</button>';
                },
              },
            ],
          });
    
          // Handle the click event for the "Make request" button
          $('#memberDataTable').on('click', '#makerequesttoorg', function () {
            $('#showOrgenization').modal('hide');
            $('#requestModal').modal('show');
            makeRequestOrgenization(
              $(this).val(),
              $(this).attr('value2'),
              $(this).attr('value3'),
              $(this).attr('value4'),
              $(this).attr('value5'),
              $(this).attr('value6'),
              $(this).attr('value7'),
              $(this).attr('value8'),
              $(this).attr('value9'),
              $(this).attr('value10'),
              $(this).attr('value11'),
              $(this).attr('value12'),
              $(this).attr('value13'),
              $(this).attr('value14'),
              $(this).attr('value15'),
              $(this).attr('value16'),
              $(this).attr('value17'),
              $(this).attr('value18'),
              $(this).attr('value19'),
              $(this).attr('value20')
            );
          });
        },
      });
    } else {
      $('.subscribingInstituteNameList').empty().append('No data available');
    }    
};






// make Request to the orgenization
function makeRequestOrgenization(tomemid, jid, jname,memname,userMemId,doi,title,containerTitle,issn,publisher,url,format,docId,volume, issue,year, author,pages,name, email2){
  $(".preload").fadeIn();
  $.ajax({                                  //Process the form using $.ajax()
    type: 'GET',                            //Method type
    url: VuFind.path + '/AJAX/JSON',        //Your form processing file url
    dataType: 'json',
    data: {
        method: 'FetchINFMemberDetailsByJournalID',
        jid:jid,                        //it is AjaxHandler class name
        tomemid:tomemid,
        frommemid:userMemId
        // replyTo:replyToeid
    },
	async: false,
  success: function(data){
    $(".preload").fadeOut();
    // $(".content").fadeIn(1000);
    console.log(data);
    toEmail = data.data.toEmailId;
    replyTo = data.data.fromEmailId;
    console.log(toEmail);
    // var pages = "15-20";
    var body = '<p><b>Dear ' + memname + ',</b></p>' +
    '<p>We have received your article request with below details as part of Document Delivery service of e-Shodh Sindhu.</p>' +
    '<ul>' +
    '<li>Article Title: ' + title + '</li>' +
    '<li>DOI: ' + doi + '</li>' +
    '<li>Article URL: ' + url + '</li>' +
    '<li>Journal: ' + jname + '</li>' +
    '<li>Publisher: ' + publisher + '</li>' +
    '<li>ISSN: ' + issn + '</li>' +
    '<li>Author(s): ' + author + '</li>' +
    '<li>Volume: ' + volume + '</li>' +
    '<li>Issue: ' + issue + '</li>' +
    '<li>Year: ' + year + '</li>' +
    '<li>Page(s): ' + pages + '</li>' +
    '</ul>' +
    '<p>Availability of the article will be checked by the requested institute and will be communicated to you by the institute.</p>' +
    '<p>Please contact your library (' + replyTo + ') for any queries or feedback regarding the Document Delivery services.</p>' +
    '<p>This is a system generated mail and sent for information purposes only. Please mail to ill@inflibnet.ac.in if you find any discrepancies or the mail is not intended for you.</p>' +
    '<p>With regards,</p>' +
    '<p>e-Shodh Sindhu Team<br>' +
    'INFLIBNET Centre<br>' +
    '(An IUC of UGC)<br>' +
    'Infocity, Opp. DA-IICT<br>' +
    'Gandhinagar - 382007, Gujarat<br>' +
    'Phone: 079-23268245/42<br>' +
    'Email: eshodhsindhu@inflibnet.ac.in</p>';
      
    const subject = `Article request for: ${jname}`;

    $('.memberDetailsForILLRequest').empty();
    $('.memberDetailsForILLRequest').append(`
    <div class="modal-header">
      <h4 class="modal-title">Request to ${memname}</h4>
    </div>
    <form id="userRequestFormDetails">
      <div class="modal-body overflow-auto" style="height: 560px; width: 100%;overflow:scroll;">
        <h5>Article Details</h5>
        <input hidden style="box-shadow: none" id="description" value="${body}">
        <table class="vertical-table table table-hover">
          <tbody>
            <tr>
              <th>Article Title</th>
              <td>${jname}</td>
            </tr>
            <th>Author</th>
            <td>${author}</td>
            </tr>
            <tr>
              <th>DOI</th>
              <td>${doi}</td>
            </tr>
            <tr>
              <th>Article URL</th>
              <td>${url}</td>
            </tr>
            <tr>
              <th>Journal</th>
              <td>${jname}</td>
            </tr>
            <tr>
              <th>ISSN</th>
              <td>${issn}</td>
            </tr>
            <tr>
              <th>Publisher(s)</th>
              <td>${publisher}</td>
            </tr>
            <tr>
              <th>Volume</th>
              <td>${volume}</td>
            </tr>
            <tr>
              <th>Issue</th>
              <td>${issue}</td>
            </tr>
            <tr>
              <th>Year</th>
              <td>${year}</td>
            </tr>
            <tr>
              <th>Page(s)</th>
              <td>${pages}</td>
            </tr>
          </tbody>
        </table><hr>

        <div class="form-group hidden">
          <label class="control-label" for="requesterName">To:</label>
          <input id="toEmail" name="" type="text" value="${toEmail}" class="form-control" autocomplete="given-name">
        </div>
        
        <div class="form-group hidden">
          <label class="control-label" for="requesterName">From:</label>
          <input id="fromEmail" name="" type="text" value="${replyTo}" class="form-control" autocomplete="given-name">
        </div>
        
        <div class="form-group hidden">
          <label class="control-label" for="requesterName">Subject:</label>
          <input id="jname" name="" type="text" value="${subject}" class="form-control" autocomplete="given-name readonly">
        </div>
  
        <div class="form-group">
          <label class="control-label" for="requesterName">Name*:</label>
          <input id="requesterName" name="name" type="text" value="${name}" class="form-control" autocomplete="given-name">
          <span class="error-message text-danger" id="nameError"></span>
        </div>
  
        <div class="form-group">
          <label class="control-label" for="requesterEmail">Email*:</label>
          <input id="requesterEmail" name="email" type="email" value="${email2}" class="form-control" autocomplete="email">
          <span class="error-message text-danger" id="emailError"></span>
        </div>
  
        <div class="form-group">
          <label class="control-label" for="requesterContact">Mobile*:</label>
          <input id="requesterContact" name="mobile" type="text" value="" class="form-control" autocomplete="family-name">
          <span class="error-message text-danger" id="mobileError"></span>
        </div>
  
        <div class="form-group">
          <label class="control-label" for="requesterIdentity">Student ID*:</label>
          <input id="requesterIdentity" name="studentId" type="text" value="" class="form-control" autocomplete="given-name">
          <span class="error-message text-danger" id="studentIdError"></span>
        </div>
  
        <!-- Modal Footer with Submit Button -->
        <div class="form-group">
          <button type="button" class="btn btn-default mx-5" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary mx-5" id="makeRequestBtn">Make request</button>
        </div>
      </div>
    </form>
  `);
  
  // Attach a click event listener to the "Make request" button
  $('#makeRequestBtn').click(function () {
    // Remove any previous validation highlighting
    $('.form-group input').removeClass('input-error');

    // Validation logic
    const name = $('#requesterName').val().trim();
    const email = $('#requesterEmail').val().trim();
    const mobile = $('#requesterContact').val().trim();
    const studentId = $('#requesterIdentity').val().trim();

    // Check if name is empty
    if (name === "") {
      $('#nameError').text('Name is required'); // Set the error message
      $('#nameError').show(); // Show the error message
      $('#requesterName').addClass('input-error'); // Highlight the input field
      return;
    } else {
      $('#nameError').text(''); // Clear the error message
      $('#nameError').hide(); // Hide the error message
      $('#requesterName').removeClass('input-error'); // Remove the 'input-error' class
    }

    // Check if email is empty and a valid email format
    if (email === "") {
      $('#emailError').text('Email is required'); // Set the error message
      $('#emailError').show(); // Show the error message
      $('#requesterEmail').addClass('input-error'); // Highlight the input field
      return;
    } else if (!validateEmail(email)) {
      $('#emailError').text('Invalid email format'); // Set the error message
      $('#emailError').show(); // Show the error message
      $('#requesterEmail').addClass('input-error'); // Highlight the input field
      return;
    } else {
      $('#emailError').text(''); // Clear the error message
      $('#emailError').hide(); // Hide the error message
      $('#requesterEmail').removeClass('input-error'); // Remove the 'input-error' class
    }

    // Check if mobile is empty and a valid mobile format
    if (mobile === "") {
      $('#mobileError').text('Mobile is required'); // Set the error message
      $('#mobileError').show(); // Show the error message
      $('#requesterContact').addClass('input-error'); // Highlight the input field
      return;
    } else if (!validateMobile(mobile)) {
      $('#mobileError').text('Invalid mobile format'); // Set the error message
      $('#mobileError').show(); // Show the error message
      $('#requesterContact').addClass('input-error'); // Highlight the input field
      return;
    } else {
      $('#mobileError').text(''); // Clear the error message
      $('#mobileError').hide(); // Hide the error message
      $('#requesterContact').removeClass('input-error'); // Remove the 'input-error' class
    }

    // Check if student ID is empty
    if (studentId === "") {
      $('#studentIdError').text('Student ID is required'); // Set the error message
      $('#studentIdError').show(); // Show the error message
      $('#requesterIdentity').addClass('input-error'); // Highlight the input field
      return;
    } else {
      $('#studentIdError').text(''); // Clear the error message
      $('#studentIdError').hide(); // Hide the error message
      $('#requesterIdentity').removeClass('input-error'); // Remove the 'input-error' class
    }

    // If all validations pass, you can call the sendEmail function
    sendEmail($('#toEmail').val(), $('#fromEmail').val(), $('#jname').val(), $('#description').val(), doi, title, containerTitle, issn, publisher, format, jid, docId, name, email, mobile, studentId, tomemid, userMemId, volume, issue, year, author,url);
  });
  
      // Email validation function
      function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
      }

      // Mobile validation function (assuming a 10-digit format)
      function validateMobile(mobile) {
        const regex = /^\d{10}$/;
        return regex.test(mobile);
      }

    },
    
  });

}



  
// make Request to the orgenization
function sendEmail(toEmail, replyToeid, subject, body, doi, title, containerTitle, issn, publisher, format, jid, docId, reqName, reqEmail, reqContact, reqId, tomemid, userMemId, volume, issue, year, author,url) {
  $(".preload").fadeIn();
  $.ajax({
    type: 'GET',
    url: VuFind.path + '/AJAX/JSON',
    dataType: 'json',
    data: {
      method: 'INFMailerByAPI',
      to: toEmail,
      from: replyToeid,
      subject: subject,
      body: body,
      doi: doi,
      title: title,
      containerTitle: containerTitle,
      issn: issn,
      publisher: publisher,
      format: format,
      jid: jid,
      docId: docId,
      reqName: reqName,
      reqEmail: reqEmail,
      reqContact: reqContact,
      reqId: reqId,
      tomemid: tomemid,
      userMemId: userMemId,
      volume: volume,
      issue: issue,
      year: year,
      author: author,
      url:url,
    },
    success: function(data) {
      $(".preload").fadeOut();
      if (data.data.success == true) {
        showAlert('Success', 'ILL request was successful', 'success');
      } else {
        showAlert('Error', 'ILL request failed', 'error');
      }
    },
    error: function() {
      showAlert('Error', 'An error occurred while making the API request', 'error');
    
    },
  });
}

function showAlert(title, message, icon) {
  Swal.fire({
    title: title,
    text: message,
    icon: icon,
    confirmButtonText: 'OK',
  }).then(function () {
    // Close your modal here
    $('#requestModal').modal('hide');
  });
}

// Now you have the values of 'firstname', 'lastname', and 'email2', which are either retrieved from cookies or set with empty values
// console.log('First Name:', firstname);
// console.log('Last Name:', lastname);
// console.log('Email:', email2);

// Function to get a cookie value by name
function getCookie(cookieName) {
    const name = cookieName + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieArray = decodedCookie.split(';');
    for (let i = 0; i < cookieArray.length; i++) {
        let cookie = cookieArray[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }
        if (cookie.indexOf(name) === 0) {
            return cookie.substring(name.length, cookie.length);
        }
    }
    return null; // Return null if the cookie is not set
}

// Function to set a cookie
function setCookie(cookieName, cookieValue, expirationDays) {
    const date = new Date();
    date.setTime(date.getTime() + (expirationDays * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = cookieName + "=" + cookieValue + "; " + expires + "; path=/";
}


// $("#ajaxcallDDRbtn").ready(function() {
//   // debugger;
//   $.ajax({
//     type: 'GET', //Method type
//     url: VuFind.path + '/AJAX/JSON', //Your form processing file url
//     dataType: 'json',
//     data: {
//       method: 'SetDDRAvailableBtn',    //it is AjaxHandler class name
//     },
//     success: function(data){
//       alert("Ajax is calling");
//       console.log(data);
//       $('.DDRavailableBtn').append('<span class="label label-warning">DDR available</span>');
//     },
//     error:function(xhr, status, error){
//       console.log('fail');
//     }
//   });
// });