<?php

include_once '../../utils/database.php';

class GetResources extends Database {
    private $adminRequest;
    private $userID;
    private $name;
    private $limit;
    private $results;

    public function __construct() {
        parent::__construct();
        $this->execute();
    }

    /**
     * Executes the API request for GET method to retrieve resources.
     *
     * Validates the request method to ensure it's a GET request.
     * Retrieves the name of the resource using the `getName` method.
     * Fetches resources based on the resource name.
     * Outputs the resources in JSON format if the request is valid; otherwise, returns a 405 status code error.
     *
     * @return void
     */
    private function execute() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Check if the request method is GET

            $this->adminRequest = $this->isAdminRequest();

            if ($this->adminRequest) {
                $this->userID = $this->getUserID();
                $email = $this->getEmail();

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->returnError(400, "INVALID_EMAIL");
                }
    
                if (!$this->isAllowed($email)) {
                    $this->returnError(400, "USER_NOT_ALLOWED");
                }
            }
            $this->name = $this->getName();
            $this->limit = $this->getLimit();
            $this->results = $this->getResources();
            http_response_code(200);
            echo json_encode($this->results);
        } else {
            // Handle non-GET requests with a 405 status code
            $this->returnError(405, "Method Not Allowed: This endpoint only accepts GET requests.");
        }
    }

    /**
     * Retrieves the name specified in the GET parameters.
     *
     * This method checks if the 'name' parameter is set in the GET request. 
     * If the name is set, it returns the name.
     * If the name is not set, it returns an empty string.
     *
     * @return array The list of keywords if set; otherwise, returns an array with an empty string.
     */
    private function getName() {
        if (isset($_GET['name'])) {
            return explode(' ', $_GET['name']);
        } else {
            return array('');
        }
    }

    /**
     * Retrieves whether the request is an admin request.
     *
     * @return bool True if the 'admin' parameter is set to 'true' in the GET request, false otherwise.
     */
    private function isAdminRequest() {
        if (isset($_GET['admin']) && $_GET['admin'] === 'true') {
            return true;
        } else {
            return false;
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
     * Retrieves the number of resources to return specified in the GET parameters.
     *
     * This method checks if the 'limit' parameter is set in the GET request. 
     * If set, it verifies if the provided number is above 0 and less than or equal to 100.
     * If the filter type is valid, it returns the filter type.
     * If the filter type is not valid, it returns an error response with appropriate status codes and error messages.
     *
     * @return int|null The filter type if valid; otherwise, returns null or outputs an error response.
     */
    private function getLimit() {
        if (isset($_GET['limit'])) {
            if ($_GET['limit'] > 0 && $_GET['limit'] <= 100) {
                return $_GET['limit'];
            } else {
                $this->returnError(400, "INVALID_LIMIT");
            }
        } else {
            return 50;
        }
    }

    private function constructSQL() {
        $sql = "SELECT *
                FROM resources
                WHERE";
        
        if ($this->adminRequest) {
            $sql .= "(status = 'pending')";
        } else {
            $sql .= "(status = 'approved')";
        }

        if (count($this->name) > 0) {
            $sql .= " AND (";
            foreach ($this->name as $name) {
                $sql .= "(name LIKE CONCAT('%', ?, '%')) AND ";
            }
            $sql = rtrim($sql, " AND ");
            $sql .= ")";
        }

        if (!$this->adminRequest) {
            $sql .= " ORDER BY name ASC";
        }

        $sql .= " LIMIT ?";
        return $sql;
    }

    private function getResources() {
        // SQL query to get resources
        $sql = $this->constructSQL();
        $typeString = str_repeat('s', count($this->name)) . 'i';
        $parameters = array_merge([$typeString], $this->name, [$this->limit]);
        $statement = $this->query($sql, ...$parameters);
        $result = $statement->get_result();
        $statement->close();
        $this->getConn()->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

$getResources = new GetResources();

?>