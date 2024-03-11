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
        this.seeAll = document.querySelector(".search-container > a");
        this.loadEventListeners();
    }   

    /**
     * Adds event listeners to the name input element and handles loading and clearing of results.
     * - Listens for 'input' event on the name input element to trigger loading.
     * - If the 'seeAll' query parameter is set to 'true', triggers loading.
     * - Listens for 'blur' event on the name input element to clear results and hide the result display.
     * 
     * @returns {void}
     */
    loadEventListeners() {
        this.name.getElement().addEventListener("click", this.load.bind(this));
        this.name.getElement().addEventListener("input", this.load.bind(this));

        if (this.getQueryParam("seeAll") === "true") {
            this.load();
        } else {
            document.addEventListener("click", (event) => {
                if (!this.results.contains(event.target) && !this.name.getElement().contains(event.target)) {
                    this.clear();
                    this.seeAll.style.visibility = "visible";
                    this.results.style.display = "none";
                }
            })
        }
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
            "name": this.name.getElement().value.trim(),
        }

        const [success, result] = await api.get('../api/resources/get.php', formData);

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
        this.seeAll.style.visibility = "hidden";
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
        const keywords = this.name.getElement().value.split(" ");
        this.clear();

        for (let i = 0; i < data.length; i++) {
            let template = document.getElementById("result-template").content.cloneNode(true);
            template.querySelector("a").href = data[i].url;

            if (this.name.getElement().value !== '') {
                for (let j = 0; j < keywords.length; j++) {
                    const regex = new RegExp(`(${keywords[j]})(?![^<>]*>|[^"]*"(?:[^"]*"[^"]*")*[^"]*$)`, 'gi');
                    data[i].name = data[i].name.replace(regex, '<span class="highlight">$1</span>');
                }
            }

            template.querySelector("span").innerHTML = data[i].name;
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

class LinkCreator {
    constructor() {
        this.linkCreator = document.querySelector(".resource-creator");
        this.popup = this.linkCreator.querySelector(".popup");
        this.popupButton = new Button(this.linkCreator.querySelector(".resource-creator-button"));
        this.createContainer = this.linkCreator.querySelector(".create-container");
        this.continueContainer = this.linkCreator.querySelector(".continue-container");
        this.continueText = this.linkCreator.querySelector(".continue-text");
        this.createButton = new Button(this.linkCreator.querySelector(".create-container button"));
        this.continueButton = new Button(this.linkCreator.querySelector(".continue-container button"));
        this.name = new Input(document.querySelector("#name"));
        this.url = new URLInput(document.querySelector("#url"));
        this.loadEventListeners();
        this.checkForm();
    }

    /**
     * Adds event listeners to various elements in the UI:
     * - Listens for click events on the popup button to toggle visibility.
     * - Listens for click events on the create button to trigger resource creation.
     * - Listens for keyup events on the name and URL input fields to check form validity.
     * - Listens for keydown events on the name and URL input fields to trigger resource creation when Enter key is pressed.
     * - Listens for click events on the continue button to switch between container visibility states.
     * 
     * @returns {void}
     */
    loadEventListeners() {
        this.popupButton.getElement().addEventListener("click", this.toggle.bind(this));
        this.createButton.getElement().addEventListener("click", this.triggerResourceCreation.bind(this));

        this.name.getElement().addEventListener("keyup", this.checkForm.bind(this));
        this.url.getElement().addEventListener("keyup", this.checkForm.bind(this));

        this.name.getElement().addEventListener("keydown",() => {
            if ((event.key === 'Enter' || event.keyCode === 13) && !this.createButton.getElement().disabled) {
                this.triggerResourceCreation();
            }
        });

        this.url.getElement().addEventListener("keydown", () => {
            if ((event.key === 'Enter' || event.keyCode === 13) && !this.createButton.getElement().disabled) {
                this.triggerResourceCreation();
            }
        })

        this.continueButton.getElement().addEventListener("click", () => {
            this.continueContainer.classList.remove("active");
            this.createContainer.classList.add("active");
        })
    }

    /**
     * Checks the form validity based on the content of the name input field 
     * and the validity of the URL input field. Disables the create button if 
     * the name input field is empty or the URL input field is invalid; otherwise, 
     * enables the create button.
     * 
     * @returns {void}
     */
    checkForm() {
        if (this.name.getElement().value == "" || !this.url.validate()) {
            this.createButton.disable();
        } else {
            this.createButton.enable();
        }
    }

    /**
     * Toggles the visibility of the popup and associated containers.
     * 
     * If the popup is currently active, removes the "active" class from the popup, createContainer, and continueContainer.
     * If the popup is not active, adds the "active" class to the popup, createContainer, and invokes the checkForm method.
     * 
     * @returns {void}
     */
    toggle() {
        if (this.popup.classList.contains("active")) {
            this.popup.classList.remove("active");
            this.createContainer.classList.remove("active");
            this.continueContainer.classList.remove("active");
        } else {
            this.popup.classList.add("active");
            this.createContainer.classList.add("active");
            this.checkForm();
        }
    }

    /**
     * Asynchronously triggers the creation of a new resource.
     * 
     * Waits for the creation process to complete and updates the UI accordingly.
     * Sets the result message returned by the creation process to the continueText element.
     * Removes the "active" class from the createContainer and adds the "active" class to the continueContainer.
     * 
     * @returns {void}
     */
    async triggerResourceCreation() {
        const result = await this.createResource();
        this.continueText.innerText = result;
        this.createContainer.classList.remove("active");
        this.continueContainer.classList.add("active");
    }

    /**
     * Sends a request to the server to create a resource based on the provided name and URL.
     *
     * @returns {Promise<string>} A promise that resolves with a response from the API.
     */
    async createResource() {
        let url = this.url.getElement().value;

        if (!url.startsWith("http://") && !url.startsWith("https://")) {
            url = "https://" + url;
        }

        const formData = {
            "name": this.name.getElement().value,
            "url": url,
        }

        const [success, result] = await api.post('../api/resources/add.php', formData);

        if (!success) {
            api.logger.log("1AB2", result);
            return "Unknown error occurred.";
        }

        if ("success" in result && "message" in result['success'] && result['success']['message'] == 'RESOURCE_ADDED') {
            return "Resource has been created successfully and is PENDING APPROVAL.";
        }

        if (!("error" in result) || !("message" in result['error'])) {
            api.logger.log("1AB3", JSON.stringify(result));
            return "Unknown error occurred.";
        }

        switch(result['error']['message']) {
            case 'INVALID_URL':
                api.logger.log("1AB3", JSON.stringify(result));
                return "URL is invalid.";
            case 'MISSING_URL':
                api.logger.log("1AB3", JSON.stringify(result));
                return "URL is missing.";
            case 'MISSING_NAME':
                api.logger.log("1AB3", JSON.stringify(result));
                return "Name is missing.";
            case 'RESOURCE_EXISTS':
                api.logger.log("1AB3", JSON.stringify(result));
                return "A resource with the same name already exists.";
            default:
                api.logger.log("1AB3", JSON.stringify(result));
                return "Unknown error occurred.";
        }

        return result;
    }
}

const search = new Search();
const linkCreator = new LinkCreator();

</script>