$(document).ready(function() {
    $('#import-data').click(function() {
        $.ajax({
            url: "/import",
            type: 'POST',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Handle successful import
                alert('Data imported successfully!');
                location.reload(); // Reload the page to show the updated data
            },
            error: function(error) {
                // Handle errors
                console.error(error);
                alert('Error importing data.');
            }
        });
    });
});