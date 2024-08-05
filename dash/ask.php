<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASK</title>
    <link rel="stylesheet" href="./ask.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        .container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .container input,
        .container textarea,
        .container select,
        .container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .container textarea {
            resize: vertical;
            min-height: 100px;
            max-height: 300px;
        }
        .container button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    
  <!-- Navbar -->
  <?php include "./nav.php" ?>

<div class="container">
        <h1>Ask a Question</h1>
        <form id="askQuestionForm" method="post" action="submit_question.php">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="details">Details:</label>
            <textarea id="details" name="details" required></textarea>

            <label for="category">Category:</label>
            <select id="category" name="category" required></select>

            <label for="tags">Tags:</label>
            <input type="text" id="tags" name="tags" placeholder="Comma-separated tags">

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetchCategories();
        });

        async function fetchCategories() {
            const response = await fetch('fetch_categories.php');
            const categories = await response.json();
            const categorySelect = document.getElementById('category');
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                categorySelect.appendChild(option);
            });
        }
    </script>


<!-- footer  -->
<?php include "./footer.php" ?>


</body>
</html>