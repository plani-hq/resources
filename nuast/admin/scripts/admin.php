<?php

// PREVENT DIRECT ACCESS
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    // The file is being accessed directly
    http_response_code(403);
    header("Location: /403/");
    exit;
}
// PREVENT DIRECT ACCESS

?>

<script>

class Search {
    constructor() {
        this.name = new Input(document.querySelector("#search"));
        this.results = document.querySelector(".results");
        this.loadEventListeners();
        this.load();
    }   

    /**
     * Registers event listeners for the search input element to trigger the loading of search results.
     * When the search input field is changed, the load method is invoked.
     * 
     * @returns {void}
     */
    loadEventListeners() {
        this.name.getElement().addEventListener("input", () => {
            this.load();
        })
    }

    /**
     * Retrieves the value of the specified query parameter from the current URL.
     * 
     * @param {string} param - The name of the query parameter to retrieve.
     * 
     * @returns {string|null} - The value of the query parameter if found, or null if the parameter does not exist.
     * 
     * @example
     * // If the URL is https://example.com/page?param1=value1&param2=value2
     * const value1 = getQueryParam('param1'); // Returns 'value1'
     * const value2 = getQueryParam('param2'); // Returns 'value2'
     * const nonExistent = getQueryParam('param3'); // Returns null
     */
    getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    /**
     * Sends a request to the server to retrieve search results based on the provided name.
     *
     * @returns {Promise<Array<Object>>} A promise that resolves with an array of search results.
     */
    async getSearchResults() {
        const formData = {
            "name": this.name.getElement().value,
            "admin": true
        }

        const [success, result] = await api.get('../../api/resources/get.php', formData);

        if (!success) {
            api.logger.log("1AB2", result);
            return;
        }

        return result;
    }

    /**
     * Sends a request to the server to hide the resource based on the provided ID.
     * 
     * @param {string} resourceID - The ID of the resource to hide.
     *
     * @returns {Promise<Array<Object>>} A promise that resolves with a success result.
     */
    async hideResource(resourceID) {
        const formData = {
            "resource_id": resourceID
        }

        const [success, result] = await api.post('../../api/resources/hide.php', formData);

        if (!success) {
            api.logger.log("1AB2", result);
            return;
        }

        return result;
    }

    /**
     * Sends a request to the server to approve the resource based on the provided ID.
     * 
     * @param {string} resourceID - The ID of the resource to approve.
     *
     * @returns {Promise<Array<Object>>} A promise that resolves with a success message.
     */
    async approveResource(resourceID) {
        const formData = {
            "resource_id": resourceID
        }

        const [success, result] = await api.post('../../api/resources/approve.php', formData);

        if (!success) {
            api.logger.log("1AB2", result);
            return;
        }

        return result;
    }

    /**
     * Clears all the results displayed in the UI.
     * This method removes all child elements within the results container.
     *
     * @returns {void}
     */
    clear() {
        this.results.innerHTML = "";
        this.results.style.display = "flex";
    }

    /**
     * Loads search results asynchronously and updates the UI accordingly.
     * Clears the existing content and populates the UI with the fetched data.
     *
     * @returns {void}
     */
    async load() {
        const data = await this.getSearchResults();
        this.clear();

        for (let i = 0; i < data.length; i++) {
            let template = document.getElementById("result-template").content.cloneNode(true);
            template.querySelector("#name").innerText = data[i].name;
            template.querySelector("#url").href = data[i].url;
            template.querySelector("#url").innerText = data[i].url;

            template.querySelector("#hide").addEventListener("click", async () => {
                await this.hideResource(data[i].id);
                this.load();
            })

            template.querySelector("#approve").addEventListener("click", async () => {
                await this.approveResource(data[i].id);
                this.load();
            })

            this.results.appendChild(template);
        }

        if (data.length == 0) {
            let div = document.createElement("div");
            let span = document.createElement("span");
            span.textContent = "No resources found";
            div.appendChild(span);
            this.results.appendChild(div);
        }
    }
}

const search = new Search();

</script>