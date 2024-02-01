# Task Management Application

This Laravel project provides a simple Task Management API with user authentication and a simple frontend.

## Getting Started

### Prerequisites

- PHP >= 7.4
- Composer
- XAMPP

### Installation

1) Clone the repository:

   ```bash
   git clone https://github.com/RifatArefin32/Task-Manager-BS23.git
   cd Task-Manager-BS23
   ```
2) Install dependencies:
    ```
    composer install
    npm install
    ```
3)  Configure your environment:
    - Copy the .env.example file to .env:
            ```
            cp .env.example .env
            ```
    - Update the .env file
            ```
                DB_CONNECTION=mysql
                DB_HOST=127.0.0.1
                DB_PORT=3307
                DB_DATABASE=laravel
                DB_USERNAME=root
                DB_PASSWORD=
            ```
4) Run migrations
    ```
    php artisan migrate
    ```
5) Serve the application:
   ```
        php artisan serve
   ```

***Access the application at http://127.0.0.1:8000.***


# API Endpoints
## Authentication
### Register
1) Endpoint: POST /api/register

2) Request Body:
```
{
  "username": "your_username",
  "email": "your_email@example.com",
  "password": "your_password",
  "password_confirmation": "your_password"
}
```
1) Response:
```
{
  "message": "Registration successful"
}
```
### Login
1) Endpoint: POST /api/login

2) Request Body:
```
{
  "email": "your_email@example.com",
  "password": "your_password"
}
```
1) Response:
```
{
  "token": "your_access_token"
}
```
## Tasks
### Get All Tasks
1) Endpoint: GET /api/tasks

2) Authentication: Bearer Token

3) Response:
```
[
  {
    "id": 1,
    "title": "Learn Laravel",
    "description": "From YouTube",
    "status": "unfinished",
    "user_id": 1,
    "created_at": "2024-01-31T07:45:26.000000Z",
    "updated_at": "2024-01-31T07:45:26.000000Z"
  },
  // ... other tasks
]
```
### Get Task by ID
1) Endpoint: GET /api/tasks/{id}

2) Authentication: Bearer Token

3) Response:
```
{
  "id": 1,
  "title": "Learn Laravel",
  "description": "From YouTube",
  "status": "unfinished",
  "user_id": 1,
  "created_at": "2024-01-31T07:45:26.000000Z",
  "updated_at": "2024-01-31T07:45:26.000000Z"
}
```
### Create Task
1) Endpoint: POST /api/tasks/create

2) Authentication: Bearer Token

3) Request Body:
```
{
  "title": "Learn Vue.js",
  "description": "Build a project",
  "status": "unfinished"
}
```
1) Response:
```
{
  "message": "Task created successfully"
}
```
### Update Task
1) Endpoint: PUT /api/tasks/{id}

2) Authentication: Bearer Token

3) Request Body:
```
{
  "title": "Learn Vue.js",
  "description": "Build a project",
  "status": "finished"
}
```
1) Response:
```
{
  "message": "Task updated successfully"
}
```
### Delete Task
1) Endpoint: DELETE /api/tasks/{id}

2) Authentication: Bearer Token

3) Response:
```
{
  "message": "Task deleted successfully"
}
```