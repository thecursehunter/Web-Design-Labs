// script.js - Contains JavaScript for AJAX functionality

$(document).ready(function() {
    // Function to perform search and update results
    function performSearch() {
        // Get search keyword
        var keyword = $('#searchInput').val();
        
        // Make AJAX request to search.php
        $.ajax({
            url: 'search.php',  // URL to handle the request
            type: 'GET',        // HTTP method
            data: {
                keyword: keyword // Data to send
            },
            dataType: 'json',   // Expected data type
            
            // What to do when request succeeds
            success: function(data) {
                // Clear previous results
                $('#searchResults').empty();
                
                // If no results found
                if (data.length === 0) {
                    $('#searchResults').html('<p>No users found.</p>');
                    return;
                }
                
                // Create HTML table for results
                var html = '<table class="table table-striped">';
                html += '<thead><tr><th>ID</th><th>Name</th><th>Password</th><th>URL</th></tr></thead>';
                html += '<tbody>';
                
                // Loop through results
                $.each(data, function(index, user) {
                    html += '<tr>';
                    html += '<td>ID: ' + user.id + '</td>';
                    html += '<td>Name:' + user.username + '</td>';
                    html += '<td>Password: ' + user.password + '</td>';
                    html += '<td>URL:' + user.url + '</td>';
                    html += '</tr>';
                });
                
                html += '</tbody></table>';
                
                // Update results container
                $('#searchResults').html(html);
            },
            
            // What to do when request fails
            error: function(xhr, status, error) {
                $('#searchResults').html('<p>Error: ' + error + '</p>');
                console.error('AJAX Error: ' + status + ' - ' + error);
            }
        });
    }
    
    // Trigger search when button is clicked
    $('#searchBtn').click(function() {
        performSearch();
    });
    
    // Also trigger search when Enter key is pressed in search input
    $('#searchInput').keypress(function(e) {
        if (e.which === 13) { // Enter key
            performSearch();
        }
    });
});