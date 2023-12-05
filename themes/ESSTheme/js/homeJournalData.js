// ajax calling for set university name on the top of page using API call
$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: VuFind.path + '/AJAX/JSON',
    dataType: 'json',
    data: {
      method: 'HomeJournalDetailShow',
    },
    success: function (data) {
      console.log(data.data.data[0].resources);
      if (data.data.data[0].resources.length > 0) {
        // Define an array of keys to display
        var keysToDisplay = ["resId", "resName", "subscribedYear", "URL", "category", "moreInfo"];
    
        var table = '<div class="container-fluid"><table class="table table-striped table-hover table-sm overflow-auto overflow-hidden table-responsive" style="font-size: 14px;">';
    
        // Header row
        table += '<thead><tr>';
        for (var key of keysToDisplay) {
          table += '<th class="">' + key + '</th>';
        }
        table += '</tr></thead>';
    
        // Data rows
        table += '<tbody>';
        data.data.data[0].resources.forEach(function (row, index) {
          // Generate unique IDs for each modal and button
          var modalId = 'InstituteSubscribedResources' + index;
          var buttonId = 'moreBtn' + index;
    
          table += '<tr>';
          for (var key of keysToDisplay) {
            if (key != "moreInfo") {
              if(key === "URL"){
                table += '<td><a href="' + row['URL'] + '" target="_blank">' + row['URL'] + '</a></td>';
              }else{
                table += '<td>' + row[key] + '</td>';
              }
            } else {
              table += '<td><button type="button" data-toggle="modal" data-target="#' + modalId + '" id="' + buttonId + '" class="btn more-btn facet">more &nbsp;<span class="icon icon--font fa fa-arrow-right" role="img" aria-hidden="true"></span></button></td>' +
                '<div class="modal fade" id="' + modalId + '" tabindex="-1" role="dialog" aria-labelledby="' + modalId + '" aria-hidden="true">' +
                '<div class="modal-dialog modal-dialog-centered" role="document">' +
                '<div class="modal-content">' +
                '<div class="modal-header">' +
                '<button type="button" class="btn-close closebtn" style="float: right;" data-lightbox data-dismiss="modal" aria-label="Close">X</button>' +
                '<h4 class="modal-title" id="journalName">' + row['resName'] + ' Description</h4>' +
                '</div>' +
                '<div class="modal-body">' +
                '<small>' + row['moreInfo'] + '</small>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
            }
          }
          table += '</tr>';
        });
        table += '</tbody>';
    
        table += '</table></div>';
    
        $('#homeJournalData').append(table);
      } else {
        $('#homeJournalData').append("No data available");
      }
    },
    
    error: function(xhr, status, error){
      console.log('Failed to fetch data');
    }
  });
});




  

