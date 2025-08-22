# ISP Backend API - CodeIgniter 4
A RESTful API backend for Internet Service Provider management system built with CodeIgniter 4.

> [!NOTE]
> Note: This API is designed to work with the Flutter-based ISP application. Ensure both frontend and backend are using compatible versions.

## Features
- User authentication (login/logout)
- User data management
- Data usage tracking
- Plan management
- RESTful API endpoints
- MySQL database integration
- Secure password hashing

## Requirements
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer
- CodeIgniter 4.4+

## Installation
1. Clone the repository:
```bash
git clone https://github.com/vjm-dev/isp_backend_codeigniter.git
cd isp_backend_codeigniter
```
2. Install dependencies:
```bash
composer install
```
3. Configure environment:
```bash
cp env .env
```
Edit .env file with your database credentials:
```
database.default.hostname = localhost
database.default.database = isp_app
database.default.username = your_username
database.default.password = your_password
database.default.DBDriver = MySQLi
CI_ENVIRONMENT = development
```
4. Database setup

Run the SQL script from `isp_app.sql`

Run the development server:
```bash
php spark serve
```
Server will start at http://localhost:8080

## Database Schema
### Tables
- users - User accounts and information
- plans - Internet service plans
- data_usages - Monthly data usage records
- daily_usages - Daily data consumption details

### Sample Data
Default users:

- Guest User: guest@isp.com / password: `1234`

- Premium User: premium@isp.com / password: `1234`

## API Endpoints
Base URL:
```
http://localhost:8080/v1
```

### Authentication
#### Login
```http
POST /auth/login
Content-Type: application/json
{
    "email": "guest@isp.com"
    "password": "1234"
}
```
Login response: 
```json
{
    "id": "user_guest",
    "name": "Guest User",
    "email": "guest@isp.com",
    "phone": "+1234567890",
    "planName": "Internet 100 Mbps",
    "monthlyPayment": 29.99,
    "lastUpdated": "2024-01-15 10:30:00",
    "data_usage": {
        "start_date": "2024-01-01",
        "end_date": "2024-02-05",
        "used": 150.0,
        "limit": 500.0,
        "daily_usage": [
            {
                "date": "2024-01-15",
                "download": 5.2,
                "upload": 1.1
            }
        ]
    }
}
```
### User data
#### Get User data
```http
GET /users/{user_id}/data
```
Response: Same structure as login response

### Data usage
#### Update Data usage
```http
POST /users/{user_id}/usage
Content-Type: application/json
{
    "amount": 5.5
}
```
Response:
```json
{
    "status": "success"
}
```
### Plans
#### Get all plans
```http
GET /plans
```
Response:
```json
[
    {
        "id": "1",
        "name": "Internet 100 Mbps",
        "speed": "100 Mbps",
        "data_limit": 500,
        "monthly_payment": 29.99,
        "created_at": "2025-08-21 16:12:28",
        "updated_at": "2025-08-21 16:12:28"
    },
    {
        "id": "2",
        "name": "Internet 300 Mbps",
        "speed": "300 Mbps",
        "data_limit": 1000,
        "monthly_payment": 49.99,
        "created_at": "2025-08-21 16:12:28",
        "updated_at": "2025-08-21 16:12:28"
    },
    {
        "id": "3",
        "name": "Internet 1 Gbps",
        "speed": "1 Gbps",
        "data_limit": 2000,
        "monthly_payment": 79.99,
        "created_at": "2025-08-21 16:12:28",
        "updated_at": "2025-08-21 16:12:28"
    }
]
```
#### API Calls

- Login: POST to http://localhost:8080/v1/auth/login

- User data: GET to http://localhost:8080/v1/users/user_guest/data

- Plans: GET to http://localhost:8080/v1/plans

- Update usage: POST to http://localhost:8080/v1/users/user_guest/usage