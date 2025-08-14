
# Campus Lost & Found (PHP + MySQL for XAMPP)

## Quick Setup
1. Copy the `lostfound-xampp` folder into your XAMPP `htdocs` directory.
2. Start **Apache** and **MySQL** in XAMPP Control Panel.
3. Open **phpMyAdmin** and run the SQL in `db.sql` (or import it) to create the database & tables. This also creates a demo admin user:
   - **Username:** admin
   - **Password:** admin123
4. Visit the app in your browser: `http://localhost/lostfound-xampp/`
5. (Optional) Admin area at `http://localhost/lostfound-xampp/admin/login.php`

## Notes
- File uploads go to `uploads/` (JPG/PNG up to 3MB). Execution of PHP in uploads is blocked with an `.htaccess` file.
- This is a demo-quality project. For production, change admin auth to use `password_hash()` + `password_verify()` and enable CSRF tokens.
- Default categories are defined in `config.php` (function `categories()`). Adjust as needed.
