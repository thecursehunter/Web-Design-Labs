<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .search-results {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Search</h2>
        
        <!-- Search form -->
        <div class="row">
            <div class="col-md-8">
                <input type="text" id="searchInput" class="form-control" placeholder="Search for users...">
            </div>
            <div class="col-md-4">
                <button id="searchBtn" class="btn btn-primary">Search</button>
            </div>
        </div>
        
        <!-- Results will be displayed here -->
        <div class="search-results" id="searchResults">
            <!-- AJAX will populate this area -->
        </div>
    </div>

    <!-- Include jQuery for AJAX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Include our custom script for AJAX functionality -->
    <script src="script.js"></script>
</body>
</html>