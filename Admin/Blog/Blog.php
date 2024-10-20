<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Blog</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <h2>Add a New Blog</h2>
    <form action="AddBlog.php" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" required></textarea><br>
        Image <input type="file" id="image" name="image" />
<br>        
        <input type="submit" value="Submit">
    </form>
</body>
</html>