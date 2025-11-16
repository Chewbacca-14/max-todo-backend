# API Endpoints

### Authentication Endpoints

#### Register User

-   **POST** `/api/register`
-   **Description**: Create a new user account
-   **Body**:
    ```json
    {
        "name": "string (required, max:255)",
        "email": "string (required, unique email)",
        "password": "string (required, min:6)"
    }
    ```
-   **Response**: User object with authentication token

#### Login User

-   **POST** `/api/login`
-   **Description**: Login an existing user
-   **Body**:
    ```json
    {
        "email": "string (required, email)",
        "password": "string (required)"
    }
    ```
-   **Response**: User object with authentication token

#### Logout User

-   **POST** `/api/logout`
-   **Description**: Logout the authenticated user
-   **Authentication**: Required (Bearer token)
-   **Response**: Success message

### Notes Endpoints

All note endpoints require authentication (Bearer token in Authorization header).

#### Get All Notes

-   **GET** `/api/notes`
-   **Description**: Get all notes for the authenticated user
-   **Authentication**: Required
-   **Response**: Array of user's notes

#### Create Note

-   **POST** `/api/notes`
-   **Description**: Create a new note
-   **Authentication**: Required
-   **Body**:
    ```json
    {
        "title": "string (required, max:255)",
        "note": "string (required)"
    }
    ```
-   **Response**: Created note object

#### Update Note

-   **PUT** `/api/notes/{id}`
-   **Description**: Update an existing note
-   **Authentication**: Required
-   **Body**:
    ```json
    {
        "title": "string (optional, max:255)",
        "note": "string (optional)"
    }
    ```
-   **Response**: Updated note object

#### Delete Note

-   **DELETE** `/api/notes/{id}`
-   **Description**: Delete a note
-   **Authentication**: Required
-   **Response**: Success message

### Authentication

For protected endpoints, include the Bearer token in the Authorization header:

```
Authorization: Bearer {your-token}
```



