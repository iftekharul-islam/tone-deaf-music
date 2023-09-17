# Tone-deaf-music Laravel Project

**Tone-deaf-music** is a web application built with Laravel for managing music events and venues.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP 8.2
- Composer
- Node.js (latest version)
- npm (Node Package Manager)

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/Tone-deaf-music.git
    cd Tone-deaf-music```

2. Install Composer dependencies:
```composer install```

3. Database Setup and Seeding:

    Create a new database for the project and configure the database connection in the .env file.
    Run the migrations and seed the database:

    ```php artisan migrate --seed```

    This will seed the database with an admin user, manager staff, and venue user for testing purposes. <br>
    Here are the credentials for the admin user:
    ```
    Name: Admin
    Email: admin@example.com
    Password: 12345678```

4. Install Node.js dependencies:
    ```npm install```

5. Compile assets:
    ```npm run dev```

6. Running the Application, Start the Laravel development server:
   ```php artisan serve```

You will see a message indicating that the server is running, along with a URL (e.g., http://localhost:8000). Open this URL in your web browser to access the Tone-deaf-music application.

Contributing
If you would like to contribute to this project, please open an issue or create a pull request on the GitHub repository.

License
This project is open-source and available under the MIT License.
   
