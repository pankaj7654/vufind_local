// ajax calling for set university name on the top of page using API call
$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: VuFind.path + '/AJAX/JSON',
    dataType: 'json',
    data: {
      method: 'HomeJournalDetailShow',
    },
    success: function(data){
      console.log(data.data);
      if (data && data.data && data.data.data && data.data.data.length > 0) {
        // Define an array of keys to display
        var keysToDisplay = ["memid","memName","subscription_type","subscribedYear", "aishe_code","podate"];
        
        var table = '<div class="container-fluid"><table class="table table-striped table-hover table-sm table-bordered overflow-auto overflow-hidden table-responsive" style="font-size: 14px">';
        
        // Header row
        table += '<thead><tr>';
        for (var key of keysToDisplay) {
          table += '<th>' + key + '</th>';
        }
        table += '</tr></thead>';
        
        // Data rows
        table += '<tbody>';
        data.data.data.forEach(function(row) {
          table += '<tr>';
          for (var key of keysToDisplay) {
            table += '<td>' + row[key] + '</td>';
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




  

