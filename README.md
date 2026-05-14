# SLIME ERP - Student Lifecycle Management and Information System

## Description
SLIME ERP is a comprehensive web-based Enterprise Resource Planning (ERP) system designed specifically for educational institutions to manage student-related operations efficiently. It provides functionalities for user authentication, student information management, grade tracking, and integrated payment processing.

## Installation
Follow these steps to set up the SLIME ERP project locally.

### Prerequisites
*   **PHP**: Version 7.4 or higher (PHP 8.x recommended).
*   **MySQL**: Version 5.7 or higher.
*   **Composer**: For PHP dependency management.
*   **Web Server**: Apache or Nginx.

### Database Setup
1.  Create a new MySQL database (e.g., `slime_db`).
2.  Import the provided SQL dump file located at `database/slime_erp.sql` into your newly created database.
3.  Configure your database connection by editing `database/database.php`:
    ```php
    <?php
    define('DB_HOST', 'localhost'); // Your database host
    define('DB_USER', 'your_db_username'); // Your database username
    define('DB_PASS', 'your_db_password'); // Your database password
    define('DB_NAME', 'slime_db'); // Your database name
    // ... rest of the file
    ?>
    ```

### Dependency Installation
1.  Navigate to the project's root directory in your terminal.
2.  Run Composer to install the required PHP dependencies:
    ```bash
    composer install
    ```

### Web Server Configuration (Example for Apache)
1.  Create a virtual host configuration for your project. Replace `/path/to/your/slime-erp-project` with the actual path to your project directory and `slime-erp.local` with your desired domain.
    ```apache
    <VirtualHost *:80>
        ServerAdmin webmaster@localhost
        DocumentRoot /path/to/your/slime-erp-project
        ServerName slime-erp.local

        <Directory /path/to/your/slime-erp-project>
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>
    ```
2.  Enable the virtual host and restart your Apache web server.

## Usage

### User Authentication
1.  Access the application through your web server (e.g., `http://slime-erp.local/login.php`).
2.  **Admin Login:**
    *   **Default Roll Number:** `admin`
    *   **Default Password:** `password`
    *(It is highly recommended to change the default admin password immediately after the first login.)*
3.  **Student Login:**
    *   Students can log in using their assigned roll number and password.

### Student Management (Admin)
*   **Register New Students**: Navigate to `addstd.php` to add new student profiles.
*   **View Students**: Access `view_students.php` to view and manage existing student information.

### Grade Management (Admin)
*   Admins can update and manage student grades and academic records through the relevant sections of the admin panel.

### Payment Processing (Student)
*   Students can view their outstanding fees on the `payments.php` page.
*   To make a payment, enter the exact due amount for confirmation and proceed with the Razorpay integration.

## Configuration

### Database Credentials
*   Update `database/database.php` with your specific MySQL server details (host, username, password, database name).

### Razorpay API Keys
*   Edit `config.php` and replace the placeholder values with your actual Razorpay Key ID and Key Secret:
    ```php
    <?php
    $keyId = 'rzp_test_YOUR_KEY_ID'; // Your Razorpay Key ID
    $keySecret = 'YOUR_KEY_SECRET'; // Your Razorpay Key Secret
    // ... rest of the file
    ?>
    ```
    *Ensure these keys are kept confidential and are not exposed in public repositories.*

## Contributing
Contributions are welcome! If you'd like to contribute, please fork the repository, create a new branch for your features or bug fixes, and submit a pull request.

## License
This project is licensed under the MIT License.