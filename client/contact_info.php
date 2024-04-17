<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Information Form</title>
</head>
<body>
    <h2>Contact Information Form</h2>
    <form action="process_contact.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="phone">Phone:</label><br>
        <input type="tel" id="phone" name="phone"><br><br>
        
        <label for="additional_info">Additional Information:</label><br>
        <textarea id="additional_info" name="additional_info"></textarea><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
