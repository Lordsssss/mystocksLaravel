# MyStocks Project

## Table of Contents

-   [Overview](#overview)
-   [Features](#features)
-   [Technologies Used](#technologies-used)
-   [Setup Instructions](#setup-instructions)
-   [Database Structure](#database-structure)
-   [API Endpoints](#api-endpoints)
-   [React Component](#react-component)
-   [Usage](#usage)
-   [Customization](#customization)
-   [Troubleshooting](#troubleshooting)
-   [License](#license)

---

## Overview

MyStocks is a stock management web application built with Laravel (backend and frontend) and a single React component for enhanced user interaction. It allows users to search for stocks, add them to their portfolio, view current stock holdings, and update quantities. The app is designed with an admin dashboard for managing users, built-in language localization, and real-time data fetching.

## Features

-   **User Authentication**: Login and registration using Laravel.
-   **Admin Dashboard**: Includes options for viewing users and upgrading their roles to moderator.
-   **Stock Management**: Allows users to search for stocks, add them to their portfolio, and update quantities.
-   **Multilingual Support**: Localized in English, French, and Spanish with language selection in the user profile.
-   **Responsive UI**: Built with Bootstrap for a mobile-friendly and visually appealing interface.
-   **React Component**: A React component to handle stock purchases with a real-time update feature.

## Technologies Used

-   **Backend**: Laravel, PHP
-   **Frontend**: Laravel Blade Templates, Bootstrap, React (for one component)
-   **Database**: MySQL
-   **Auth**: Laravel Authentication
-   **Environment**: Ampps (Local Development)

## Setup Instructions

1. **Clone the Repository**:

    ```bash
    git clone https://github.com/your-username/mystocks.git
    cd mystocks
    ```

2. **Install Backend Dependencies**:

    ```bash
    composer install
    ```

3. **Install Frontend Dependencies**:

    ```bash
    npm install
    ```

4. **Environment Setup**:

    - Copy `.env.example` to `.env`:
        ```bash
        cp .env.example .env
        ```
    - Set database credentials and other configurations in `.env`.

5. **Generate Application Key**:

    ```bash
    php artisan key:generate
    ```

6. **Database Migration**:

    ```bash
    php artisan migrate
    ```

7. **Run the Application**:

    ```bash
    php artisan serve
    npm run dev
    ```

8. **Set Up Ampps**:
    - Configure Ampps to serve the Laravel app if needed.

## Database Structure

-   **users**: Stores user information with fields like `user_id`, `name`, `email`, `password`, `account_number`, `language`, `profile_image`, `role`.
-   **stocks**: Stores stock details, including `stock_id`, `stock_symbol`, `stock_name`, and `current_price`.
-   **portfolios**: Links users and stocks with fields `account_number`, `stock_id`, and `quantity`.

## API Endpoints

-   **Authentication**:

    -   `POST /login`: User login.
    -   `POST /register`: User registration.

-   **Stock Management**:
    -   `GET /api/search-stocks`: Search for stocks (with auto-complete).
    -   `POST /api/buy-stock`: Buy a stock and add it to the user’s portfolio.
    -   `GET /api/owned-stocks`: Get all stocks owned by the user.

## React Component

-   **BuyStock Component**: The React component is used for purchasing stocks. It includes:
    -   **Search Bar**: Allows users to search for stocks using an auto-complete feature similar to Livewire.
    -   **Form Modal**: A form to enter the quantity and confirm the purchase.
    -   **Real-Time Updates**: Displays the list of currently owned stocks.

## Usage

-   **Admin Dashboard**: Admin users can view all users, upgrade them to moderator, and manage stock records.
-   **User Portfolio**: Users can search for stocks, add them to their portfolio, and view existing stocks.
-   **Language Selection**: Users can switch between English, French, and Spanish from the profile page.

## Customization

-   **Translation**: Update the translations in `resources/lang/` for adding or modifying supported languages.
-   **React Component**: Modify the `resources/js/components/BuyStock.js` file for changing stock purchasing behavior.
-   **Frontend Templates**: Modify the Blade templates in `resources/views` to customize the UI.

## Troubleshooting

-   **Authentication Issues**: If getting `401 Unauthorized` errors, ensure the authentication token is correctly stored and sent with API requests.
-   **Database Errors**: Errors like `Unknown column 'id'` are due to incorrect primary key references. Update models to use custom primary keys (`stock_id` or `account_number`).
-   **React Component Rendering**: Ensure you're using `createRoot` for React 18. Update `resources/js/app.js` as needed.

## License

This project is open-source and available under the [MIT License](LICENSE).

```

---

Let me know if there’s anything you’d like to add or modify in the README!

```
