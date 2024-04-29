<?php

class Log {
    private $errorCode;
    private $errorMessage;
    private $ipAddress;
    private $userAgent;

    public function __construct() {
        $this->ipAddress = file_get_contents('https://ipinfo.io/ip');
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->errorCode = $this->getErrorCode();
        $this->errorMessage = $this->getErrorMessage();
        $this->log();
    }

    /**
     * Retrieves and validates the error code from the POST request.
     *
     * This private method checks if the request method is POST and if the 'errorCode' parameter
     * is set and not empty in the POST request. If the conditions are met, it returns the error
     * code; otherwise, it sends an error response with the appropriate status code and message.
     *
     * @return string|null The error code if available and valid, or null if not available or invalid.
     */
    private function getErrorCode() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['errorCode']) && !empty($_POST['errorCode'])) {
                return $_POST['errorCode'];
            } else {
                $this->returnError(400, "Missing error code.");
            }
        } else {
            $this->returnError(405, "Method Not Allowed: This endpoint only accepts POST requests.");
        }
    }

    /**
     * Retrieves and returns the error message from the POST request.
     *
     * This private method checks if the request method is POST and if the 'errorMessage' parameter
     * is set and not empty in the POST request. If the error message is available and valid, it returns
     * the error message; otherwise, it returns a default "N/a" value. If the request method is not POST,
     * the method sends an error response with with the appropriate status code and message.
     *
     * @return string The retrieved error message or a default "N/a" value.
     */
    private function getErrorMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['errorMessage']) && !empty($_POST['errorMessage'])) {
                return $_POST['errorMessage'];
            } else {
                return "N/a";
            }
        } else {
            $this->returnError(405, "Method Not Allowed: This endpoint only accepts POST requests.");
        }
    }

    /**
     * Sends an error response with the specified status code and error message.
     *
     * This function sets the HTTP response status code, constructs a JSON-encoded
     * error response message, and outputs the response. It then terminates the script
     * execution using the exit() function to prevent further processing.
     *
     * @param int    $statusCode   The HTTP status code to be set in the response.
     * @param string $errorMessage The error message to be included in the response.
     *
     * @return void This function does not return a value.
     */
    private function returnError($statusCode, $errorMessage) {
        http_response_code($statusCode); // Set status code
        $response = array(
            'error' => array(
                'message' => $errorMessage
            )
        );
        echo json_encode($response);
        exit();
    }

    /**
     * Logs the IP address, user agent, error code, and timestamp to a CSV file.
     *
     * This private method prepares the log data as an array containing the IP address,
     * user agent, error code, and the current date and time. It then checks if the
     * specified CSV file exists; if the file does not exist, it creates a new file
     * with headers and writes the log data to the file in CSV format. If the file
     * already exists, the method appends the log data to the existing file.
     *
     * @return void This function does not return a value.
     */
    private function log() {
        // Define the CSV file path
        $csvFile = "../../logs.csv";
        $logData = array(
            $this->ipAddress,
            $this->userAgent,
            $this->errorCode,
            $this->errorMessage,
            date("Y-m-d H:i:s") // Add the current date and time
        );
    
        if (!file_exists($csvFile)) {
            // If the file does not exist, create a new file with headers
            $headers = array("IP Address", "User Agent", "Error Code", "Error Message" ,"Timestamp");
            $file = fopen($csvFile, "a"); // Open the file in append mode
            fputcsv($file, $headers); // Write the headers to the file
        } else {
            $file = fopen($csvFile, "a"); // Open the file in append mode
        }
    
        // Write the log data to the CSV file
        fputcsv($file, $logData);
    
        // Close the file
        fclose($file);
    }
}

$log = new Log();

?>