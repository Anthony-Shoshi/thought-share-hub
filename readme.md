# Blogging Platform

This is a simple blogging platform with both backend and frontend components. Users can log in as an admin to manage categories and posts from the backend, while regular users can search, read, like, comment and share blog posts from the frontend.

![image](https://github.com/user-attachments/assets/1ea45a65-b3a1-4406-a035-1de69b0d92c1)

![image](https://github.com/user-attachments/assets/896907c0-f1d6-4897-a67b-27b756ab1f0c)

## Admin Login

To log in as an admin and access the backend, use the following credentials:

- **URL:** http://localhost/user/login
- **Username:** admin
- **Password:** 123456

## Backend Features

### Manage Categories

- Add, edit, and delete categories.

### Manage Posts

- Add, edit, and delete blog posts.

## Frontend Features

- View blog posts created by the admin.

## Installation

1. Install Docker Desktop on Windows or Mac, or Docker Engine on Linux.
2. Clone/Download the project
3. Open Terminal
4. CD YOUR_PROJECT_DIRECTORY
5. RUN below commands

```bash
docker compose build --no-cache
```

```bash
docker-compose up
```

**By default, Docker will set up the database tables. However, if you encounter any issues with the database, you can manually import the SQL file located in the project root directory.**

## Usage

1. Log in as an admin using the provided credentials.
2. Navigate to the backend to manage categories and posts.
3. Regular users can access the frontend to search, read, like, comment and share blog posts.

## Technologies Used

- PHP
- MySQL
- Bootstrap

Feel free to explore and contribute to the project!

