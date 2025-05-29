# Laravel Post Scheduler API

A multi-platform post scheduling system built using Laravel 12.

This API-based application allows users to create, schedule, and manage posts across multiple platforms with media upload, user authentication, and queue-based job processing. The system enforces a daily limit of scheduled posts per user.

GitHub Repository:  
https://github.com/Eng-yasmine/post-schedual

---

## Features

- User authentication using Laravel Sanctum  
- Full CRUD operations for posts  
- Many-to-many relationship between posts and platforms  
- Schedule posts with specific date and time  
- Limit of 10 scheduled posts per user per day  
- Image upload using Spatie Media Library  
- Background job handling via Laravel Queue  
- Performance monitoring with Laravel Telescope  
- Validation using Form Request classes  
- Unified API responses using traits  

---

## Technologies Used

- Laravel 12  
- Sanctum (Authentication)  
- Spatie Media Library (Image handling)  
- Laravel Queue (Job handling)  
- Laravel Telescope (Debugging and monitoring)  
- Carbon (Date handling)  
- MySQL  

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/Eng-yasmine/post-schedual.git
cd post-schedual
