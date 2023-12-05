  $(document).ready(function() {
    // Make an AJAX call to fetch the university name by IP
    $.ajax({
        type: 'GET',
        url: VuFind.path + '/AJAX/JSON',
        dataType: 'json',
        data: {
            method: 'FetchINFMemberNameByIP'
        },
        success: function(data) {
            // Check if data.data is an array or a string
            if (Array.isArray(data.data)) {
                // Assuming data.data[1] contains the university name
                var universityName = data.data[1];
                setUniversityName(universityName);
            } else if (typeof data.data === 'string') {
                setUniversityName(data.data);
            } else {
                handleAjaxError('Invalid data format received.');
            }
        },
        error: function(xhr, status, error) {
            handleAjaxError('Failed to fetch university name: ' + error);
        }
    });

    // Function to display the university name
    function setUniversityName(name) {
        $('#memName').empty().append(name);
        // You can add additional logic or styling as needed.
    }

    // Function to handle AJAX errors
    function handleAjaxError(errorMessage) {
        console.error(errorMessage);
        // You can display an error message to the user or take other actions.
    }
});





  