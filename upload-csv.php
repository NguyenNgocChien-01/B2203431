<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CSV</title>
</head>
<body>
    <h2>Tải lên file CSV</h2>
    <form action="upload-csv-process.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Chọn file CSV để tải lên</label><br>
        <input type="file" name="fileToUpload" id="fileToUpload" accept=".csv"><br><br>
        <input type="submit" value="Upload CSV" name="submit">
    </form>
</body>
</html>
