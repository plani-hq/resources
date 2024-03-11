<?php

include_once '../../utils/database.php';

class Redirect extends Database {
    private $userID;

    public function __construct() {
        parent::__construct();
        $this->userID = $this->getUserID();
        $this->execute();
    }

    /**
     * Handles the execution of the API endpoint for loading to the admin page.
     *
     * Validates the incoming GET request, ensuring it is of type GET.
     * Retrieves the email from the request, validates its format, and checks user permissions.
     * Loads the admin page if the user is allowed to modify resources.
     *
     * @throws mysqli_sql_exception If a MySQL-specific error occurs during database operations.
     * @throws Exception For invalid requests.
     * 
     * @return void
     */
    private function execute() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Check if the request method is GET

            $email = $this->getEmail();
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->goToResourcesPage();
            }

            if (!$this->isAllowed($email)) {
                $this->goToResourcesPage();
            } else {
                include("page.php");
            }
        } else {
            // Handle non-GET requests with a 405 status code
            $this->returnError(405, "Method Not Allowed: This endpoint only accepts GET requests.");
        }
    }

    private function goToResourcesPage() {
        header("Location: ../");
    }

    /**
     * Fetches the user ID associated with the authenticated token from cookies.
     *
     * This method checks for the presence of a specific cookie ('flashi-authToken').
     * If the token exists and is valid (not expired), it fetches the corresponding user ID
     * from the database using a prepared SQL statement.
     *
     * @return string Returns the user ID if the token is valid and associated with a user.
     *                Otherwise, it redirects the user to the resources page.
     */
    public function getUserID() {
        $token = $this->getToken();

        if ($token) {
            $sql = "SELECT user_id FROM tokens WHERE token = ? AND expiration >= NOW()";
            $statement = $this->query($sql, 's', $token);
            $result = $statement->get_result();
            $row_count = $result->num_rows;

            if ($row_count > 0) {
                return $result->fetch_assoc()['user_id'];
            } else {
                // User is not authenticated
                $this->goToResourcesPage();
            }
        } else {
            // Token is not valid
            $this->goToResourcesPage();
        }
    }

    /**
     * Retrieve the authentication token based on the current request method.
     *
     * This method checks the current HTTP request method (GET, POST, or other) and retrieves
     * the authentication token from the corresponding superglobal array ($_GET, $_POST, or $_COOKIE).
     * If a token is found, it is sanitized using htmlspecialchars() before being returned.
     * If no token is found, a 401 error is thrown using the returnError() method.
     *
     * @return string|null The sanitized authentication token if found; otherwise, null.
     * @throws Exception If no authentication token is found, the user is redirected to the resources page.
     */
    public function getToken() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (isset($_GET['authToken'])) {
                    return htmlspecialchars($_GET['authToken']);
                }
        
            case 'POST':
                if (isset($_POST['authToken'])) {
                    return htmlspecialchars($_POST['authToken']);
                }
        
            default:
                if (isset($_COOKIE['flashi-authToken'])) {
                    return htmlspecialchars($_COOKIE['flashi-authToken']);
                }
        }
        
        // Handle the case where no token is found
        $this->goToResourcesPage();
    }

    /**
     * Check if the provided email address is allowed to modify resources.
     *
     * @param string $email The email address to check.
     *
     * @return bool Returns true if the email address is allowed, false otherwise.
     */
    private function isAllowed($email) {
        return in_array($email, 
            array(
                "lostorto.business@gmail.com",
                "support@flashi.uk",
                "admin@flashi.uk",
                "demo@flashi.uk",
                "demo1@flashi.uk",
                "demo2@flashi.uk",
                "demo3@flashi.uk"
            ));
    }

    /**
     * Retrieve the email address associated with the current user ID from the database.
     *
     * @throws Exception If an unexpected error occurs during the database query or result retrieval.
     *   - If the user is not found, it returns an error with a 400 Bad Request status code.
     *   - If there is a database execution error, it returns an error with a 500 Internal Server Error status code.
     *
     * @return string|null Returns the email address if found, or null in case of errors.
     */
    private function getEmail() {
        // SQL query to get email field in users table
        $sql = "SELECT email 
                FROM users 
                WHERE user_id = ?";

        $statement = $this->query($sql, "s", $this->userID);
        $result = $statement->get_result();
        $row_count = $result->num_rows;
        $statement->close();

        if ($row_count > 0) {
            return $result->fetch_assoc()['email'];
        } else {
            // User is not found
            $this->goToResourcesPage();
        }
    }
}

$redirect = new Redirect();

?>