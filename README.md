# Search page
<img width="1470" alt="image" src="https://github.com/user-attachments/assets/929123ef-57d7-4a09-88bb-f675e015bdcd" />

# results page
<img width="1470" alt="image" src="https://github.com/user-attachments/assets/a9c735a5-9af3-4364-a436-5969efaf7004" />


# Project Setup and Installation Guide

This guide will walk you through how to set up and run the project locally using MAMP, and how to import the SQL file into phpMyAdmin5.

### Requirements

Before you start, ensure you have the following installed on your local machine:

- [MAMP](https://www.mamp.info/en/) (macOS or Windows version)
- A web browser (Chrome, Firefox, etc.)

### Step 1: Install MAMP

1. Download and install MAMP from [here](https://www.mamp.info/en/).
2. Follow the installation instructions specific to your operating system.

### Step 2: Move the Project to `htdocs`

1. After installing MAMP, navigate to your MAMP installation directory.
   - On macOS, the default location is `/Applications/MAMP/htdocs/`.
   - On Windows, it is typically `C:\MAMP\htdocs\`.
2. Copy your project folder (the folder containing all your project files) into the `htdocs` directory.

### Step 3: Configure MAMP to Start the Server

1. Open the MAMP application.
2. Launch MAMP, and it will open the MAMP control panel.
3. In the control panel, click the **Start Servers** button. This will start the Apache and MySQL servers.
4. Once the servers are running, you should see a green light next to Apache and MySQL.

### Step 4: Access the Project in Your Browser

1. Open your web browser and go to `http://localhost:8888/`.
2. You should now see a MAMP welcome page.
3. To access your project, type the project folder name in the URL. For example, if your project folder is named `my_project`, you would go to: `http://localhost:8888/my_project/`


### Step 5: Import the SQL File into phpMyAdmin5

1. Open the MAMP control panel and click the **Open WebStart page** button. This will open the MAMP homepage in your browser.
2. From the MAMP homepage, click the **phpMyAdmin** link (usually located in the top navigation bar).
3. In phpMyAdmin, click the **Databases** tab to create a new database.
4. Name your database (for example, `my_database`) and click **Create**.
5. After the database is created, click the **Import** tab.
6. In the **File to Import** section, click the **Choose File** button and select your `.sql` file.
7. Click **Go** to begin the import. phpMyAdmin will execute the SQL queries and create the tables in your newly created database.
8. Once the import is complete, you will see a success message.

### Step 6: Connect Your Project to the Database

Ensure that your project’s configuration file (e.g., `config.php`, `db.php`, etc.) has the correct database connection details. Here’s a sample configuration for connecting to the database using MySQL:

```php
<?php
$servername = "localhost";
$username = "root"; // Default MAMP MySQL username
$password = "root"; // Default MAMP MySQL password
$dbname = "my_database"; // The name of the database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}
?>
