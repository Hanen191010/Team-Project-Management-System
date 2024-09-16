# Team Project Management System

## Introduction

This project is a Team Project Management System built using the Laravel PHP framework. The project aims to facilitate project and task management among team members, providing a permission system that defines different roles for each member (Manager, Developer, Tester).

*Note:* This project utilizes JWT (JSON Web Token) to secure login and API usage.

## Features

* *Project Management:*
    * *Create Projects:* Users can create new projects, defining their names and brief descriptions.
    * *View Project List:* Displays a list of all projects that the user participates in.
    * *View Project Details:* Users can view detailed information about each project, including its name, description, and creation date.
    * *Edit Projects:* Users can modify the information of existing projects (name, description).
    * *Delete Projects:* Users can delete their projects.
* *Task Management:*
    * *Create Tasks:* Users can create new tasks within projects, defining their titles, detailed descriptions, setting the task status (New, In Progress, Completed), priority (Low, Medium, High), and specifying a due date.
    * *View Task List:* Displays a list of all project tasks, with the ability to filter by status or priority.
    * *View Task Details:* Users can view detailed information about each task, including its title, description, status, priority, and due date.
    * *Edit Tasks:* Users can modify the information of existing tasks (title, description, status, priority, due date).
    * *Delete Tasks:* Users can delete their tasks.
* *Permission System:*
    * *Define Roles:* Users can assign different roles to team members (Manager, Developer, Tester).
    * *Define Role Permissions:*
        * *Manager:* Can add, edit, and delete tasks, as well as manage members (add, edit, delete).
        * *Developer:* Can only edit the status of tasks.
        * *Tester:* Can add comments on tasks.
* *User Authentication:*
    * *Secure Login:* Utilizes JWT for secure user authentication.
* User Management:
    * Create new users
    * View list of users
    * Update user information 
    * Delete a user 

## Getting Started

1. *Clone the repository:*
    
bash
    git clone https://github.com/Hanen191010/Team-Project-Management-System.git
    cd team-project-manager
    
2. *Install dependencies:*
    
bash
    composer install
    
3. *Generate database:*
    
bash
    php artisan migrate
    php artisan db:seed
4. *Generate JWT secret:*
    
bash
    php artisan jwt:secret
    
5. *Start server:*
    
bash
    php artisan serve
    
6. *Access Application:*
    * Open your web browser and navigate to `http://localhost:8000`.


## Postman Collection

* A Postman collection for API testing is included in the folder of the project.
* You can import it into Postman to effectively test all API functions.

## Contributing

Contributions are welcome! Please feel free to open an issue or submit a pull request.


## Acknowledgements

This project was built using the Laravel PHP framework and utilizes the JWT Authentication package. 

*Thank you!*