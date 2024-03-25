# Bug Tracker

Bug Tracker is a web application built with Laravel, Tailwind CSS, and Docker to help developers manage their projects, streamline issue tracking, and enhance collaboration.

https://youtu.be/1EEgPZsKkcc

## Features

- **Authentication:**
  - User registration.
  - User login.
  - Logout functionality.

- **Project Management:**
  - Add, edit, and delete projects.
  - Search for projects efficiently.

- **Ticket Management:**
  - Create, update, and delete tickets.
  - Each ticket has a status (Resolved, New, In Progress), priority (Immediate, High, Low, Medium), and type (Issue, Bug, Feature Request).

- **Comments:**
  - Add comments for tickets.

- **Pagination:**
  - Pagination for projects, tickets & Comments.

- **Dark and Light Mode:**
  - Choose between dark and light mode for personalized user experience.

- **User Tasks:**
  - View tickets assigned to the logged-in user in charts and tables for better organization.

- **Profile Management:**
  - Update profile information.
  - Update password.
  - Delete account.

- **Administration:**
  - Admin section to manage user accounts.
  - Grant admin status to appropriate users.

## Technologies Used

- Laravel
- Laravel Breeze
- Docker
- Tailwind CSS
- Flowbite (Tailwind CSS component library)

## Getting Started

1. Clone the repository:
   ```bash
   git clone https://github.com/Massila2522/bug_tracker.git
2. Install Docker Desktop and enable WSL2.
3. Configure Docker Desktop to use WSL2.
4. Open a terminal in WSL2.
5. Navigate to the application folder.
6. Run Sail to start the Docker containers:
   ```bash
   ./vendor/bin/sail up
7. Run migrations:
   ```bash
   ./vendor/bin/sail artisan migrate
8. Access the application at http://localhost.

## Accessing phpMyAdmin

After running the application, you can access the database using phpMyAdmin at: http://localhost:8001/

**Credentials:**
- **Username:** `sail`
- **Password:** `password`

Please ensure that your Docker environment is running (`./vendor/bin/sail up`) before accessing phpMyAdmin.

## License

This project is open-source and available under the [MIT License](https://opensource.org/licenses/MIT).
