<?php

include_once '../../utils/database.php';

class HideResource extends Database {
    private $userID;
    private $resourceID;

    public function __construct() {
        parent::__construct();
        $this->userID = $this->getUserID();
        $this->execute();
    }

    /**
     * Handles the execution of the API endpoint for hiding resources.
     *
     * Validates the incoming POST request, ensuring it is of type POST.
     * Retrieves the email from the request, validates its format, and checks user permissions.
     * Retrieves the resource ID from the request and hides the resource using the hideResource() method.
     * Returns success message if the operation is successful.
     *
     * @throws mysqli_sql_exception If a MySQL-specific error occurs during database operations.
     * @throws Exception For invalid requests.
     * 
     * @return void
     */
    private function execute() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the request method is POST

            $email = $this->getEmail();
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->returnError(400, "INVALID_EMAIL");
            }

            if (!$this->isAllowed($email)) {
                $this->returnError(400, "USER_NOT_ALLOWED");
            }
            
            $this->resourceID = $this->getResourceID();
            $this->checkResourceExists();
            $this->hideResource();
            $this->returnSuccess("RESOURCE_APPROVED");
        } else {
            // Handle non-POST requests with a 405 status code
            $this->returnError(405, "Method Not Allowed: This endpoint only accepts POST requests.");
        }
    }

    /**
     * This method retrieves the resource ID from the 'resource_id' parameter in the POST request.
     *
     * @return int An integer containing the resource ID obtained from the POST request.
     *
     * @throws Exception If the 'resource_id' parameter is not provided in the POST request.
     */
    private function getResourceID() {
        if (isset($_POST['resource_id'])) {
            return $_POST['resource_id'];
        } else {
            $this->returnError(400, "MISSING_RESOURCE_ID");
        }
    }

    /**
     * Check if a resource with the given resource ID exists in the database.
     *
     * Executes a SQL query to select resources with the provided resource ID. If a resource is found,
     * the method returns; otherwise, it returns a 400 Bad Request error indicating that
     * the resource was not found.
     *
     * @throws Exception If an unexpected error occurs during execution.
     * @throws mysqli_sql_exception If a MySQL-specific error occurs.
     *
     * @return void
     */
    private function checkResourceExists() {
        // SQL query to select resources with the given resource ID
        $sql = "SELECT * FROM resources WHERE id = ?";

        $statement = $this->query($sql, "i", $this->resourceID);
        $result = $statement->get_result();
        $row_count = $result->num_rows;
        $statement->close();

        if ($row_count <= 0) {
            // Resource does not exist
            $this->returnError(400, "RESOURCE_NOT_FOUND");
        }
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
            $this->returnError(400, "USER_NOT_FOUND");
        }
    }

    /**
     * Hides a resource in the database by updating its status to 'hidden'.
     * 
     * This method executes an SQL query to update the status of a resource with 
     * the specified ID to 'hidden' in the database. It takes no parameters directly 
     * but relies on the value of the property $this->resourceID to identify the resource 
     * to be hidden.
     *
     * @throws Exception If a general exception occurs during the process.
     * @throws mysqli_sql_exception If a MySQLi-specific SQL exception occurs.
     *
     * @return void
     */
    private function hideResource() {
        // SQL query to hide a resource in the database
        $sql = "UPDATE resources
                SET status = 'hidden'
                WHERE id = ?;";

        $statement = $this->query($sql, "s", $this->resourceID);
        $statement->close();
        $this->getConn()->close();
    }
}

$hideResource = new HideResource();

?>