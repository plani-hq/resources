<?php

include_once '../../utils/database.php';

class AddResource extends Database {
    private $name;
    private $url;

    public function __construct() {
        parent::__construct();
        $this->execute();
    }

    /**
     * Handles the execution of the API endpoint for adding a resource.
     *
     * Validates the incoming POST request, ensuring it is of type POST.
     * Retrieves the name and URL for the resource from the request and 
     * adds them to the database using the addResource() method.
     * Returns a success message if the operation is successful.
     *
     * @throws mysqli_sql_exception If a MySQL-specific error occurs during database operations.
     * @throws Exception For invalid requests.
     * 
     * @return void
     */
    private function execute() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the request method is POST

            $this->name = $this->getName();
            $this->url = $this->getUrl();
            $this->checkResourceExists();
            $this->addResource();
            $this->returnSuccess("RESOURCE_ADDED");
        } else {
            // Handle non-POST requests with a 405 status code
            $this->returnError(405, "Method Not Allowed: This endpoint only accepts POST requests.");
        }
    }

    /**
     * Retrieves the name specified in the GET parameters.
     *
     * This method checks if the 'name' parameter is set in the GET request. 
     * If the name is set, it returns the name.
     * If not, it returns an error response with HTTP status code 400 (Bad Request) and a custom 
     * error message indicating that the 'name' parameter is missing.
     *
     * @return string The name if set; otherwise, returns an empty string.
     */
    private function getName() {
        if (isset($_POST['name'])) {
            return $_POST['name'];
        } else {
            $this->returnError(400, "MISSING_NAME");
        }
    }

    /**
     * Retrieves the URL specified in the GET parameters.
     *
     * This method checks if the 'url' parameter is set in the GET request. 
     * If the URL is set and valid, it returns the URL.
     * If not, it returns an error response with HTTP status code 400 (Bad Request) and a custom 
     * error message indicating that the 'url' parameter is missing.
     *
     * @return string The url if set; otherwise, returns an empty string.
     */
    private function getURL() {
        if (isset($_POST['url'])) {
            if (!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
                $this->returnError(400, "INVALID_URL");
            }
            return $_POST['url'];
        } else {
            $this->returnError(400, "MISSING_URL");
        }
    }

    /**
     * Check if a resource with the given name exists in the database.
     *
     * Executes a SQL query to select resources with the provided name. If a resource is found,
     * the method returns a 400 Bad Request error indicating that a resource already exists
     * with the same name. Otherwise, the method returns void.
     *
     * @throws Exception If an unexpected error occurs during execution.
     * @throws mysqli_sql_exception If a MySQL-specific error occurs.
     *
     * @return void
     */
    private function checkResourceExists() {
        // SQL query to select resources with the given name
        $sql = "SELECT * FROM resources WHERE name = ?";

        $statement = $this->query($sql, "s", $this->name);
        $result = $statement->get_result();
        $row_count = $result->num_rows;
        $statement->close();

        if ($row_count > 0) {
            // Resource found
            $this->returnError(400, "RESOURCE_EXISTS");
        }
    }

    /**
     * Add a resource to the database, ignoring duplicates.
     *
     * Attempt to insert a new row into the 'resources' table.
     * If a resource with the same name already exists, it ignores the duplicate entry without raising an error.
     * Handles exceptions and returns appropriate error responses if encountered during execution.
     *
     * @throws Exception If a general exception occurs during the process.
     * @throws mysqli_sql_exception If a MySQLi-specific SQL exception occurs.
     *
     * @return void
     */
    private function addResource() {
        // SQL query to add a resource to the database
        $sql = "INSERT IGNORE INTO resources (name, url, status)
                VALUES (?, ?, 'pending')";

        $statement = $this->query($sql, "ss", $this->name, $this->url);
        $statement->close();
        $this->getConn()->close();
    }
}

$addResource = new AddResource();

?>