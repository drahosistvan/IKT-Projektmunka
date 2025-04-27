# IKT Webshop

## Getting Started

This guide will help you set up the project quickly, whether you prefer an automated installation or a manual step-by-step process.

---

### Prerequisites

Make sure you have the following installed:

- **Docker** (for Laravel Sail)
- **Make** (for using the provided `Makefile` commands)

---

## Easy Installation

The easiest way to get started is by using the `Makefile`. This will automate the setup process, including dependency installation, starting the Docker environment, and setting up the database.

### Steps:

1. Clone the repository:
    ```bash
    git clone <repository-url>
    cd <project-directory>
    ```

2. Run the following command:
    ```bash
    make install
    ```

This will:
- Copy `.env.example` to `.env`
- Install PHP dependencies using Docker-based Composer
- Start the Docker containers
- Generate the application key
- Run database migrations and seed the database

Once the setup is complete, the application will be accessible at [http://localhost](http://localhost).

---

## Development Workflows

### Start the Development Server
To bring up the environment and start developing:
```bash
make up
```
This will start all necessary Docker containers (PHP, MySQL, Redis, etc.).

Stop the Development Server

When you are done, you can stop the environment with:
```bash
make down
```

### Manual Installation (Step-by-Step Guide)
If you prefer to set up the project manually without using the Makefile, follow these steps:

Step 1: Clone the Repository
```bash
git clone git@github.com:drahosistvan/IKT-Projektmunka.git
cd IKT-Projektmunka
```

Step 2: Copy the Environment File
```bash
cp .env.example .env
```
Step 3: Install Dependencies

If you don’t have Composer installed locally, use Docker to run Composer inside a container:
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-req=ext-intl
```
Step 4: Start Laravel Sail

Start the Docker containers:
```bash
./vendor/bin/sail up
```
Step 5: Generate the Application Key
```bash
./vendor/bin/sail artisan key:generate
```
Step 6: Run Migrations and Seed the Database
```bash
./vendor/bin/sail artisan migrate --seed
```
Step 7: Access the Application

Open http://localhost in your browser to see the app running.

## Troubleshooting

### Common Issues
1.	Missing intl Extension
      If you encounter errors related to ext-intl missing, ensure that Laravel Sail is configured correctly. This is already
      handled by running Composer with `--ignore-platform-req=ext-intl.`

2. Docker Container Won’t Start
   Ensure Docker is running on your machine. You can restart it and then try:
```bash
./vendor/bin/sail up -d
```

3. Database Connection Error
   If you encounter database connection errors, ensure that the database credentials in your `.env` file are correct.
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```
