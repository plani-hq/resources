class Input {
    /**
     * Creates an Input object with the specified element.
     *
     * @param {HTMLElement} element - The HTML element to be associated with the Input object.
     */
    constructor(element) {
        this.element = element;
    }

    /**
     * Get the element associated with the current instance.
     *
     * @returns {HTMLElement} The HTML element associated with the instance.
     */
    getElement() {
        return this.element;
    }

    disable() {
        this.getElement().disabled = true;
        this.getElement().classList.add("disabled");
    }

    enable() {
        this.getElement().disabled = false;
        this.getElement().classList.remove("disabled");
    }
}

/**
 * Represents an EmailInput class that extends the Input class.
 * Provides a method to validate the email input value against a regular expression pattern.
 *
 * @extends Input
 */
class EmailInput extends Input {
    validate() {
        const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        if (this.getElement().value.match(validRegex)) {
            return true;
        } else {
            this.getElement().focus();
            return false;
        }
    }
}

/**
 * Represents a URLInput class that extends the Input class.
 * Provides a method to validate the URL input value against a regular expression pattern.
 *
 * @extends Input
 */
class URLInput extends Input {
    validate() {
        const validRegex = /^(https?:\/\/)?([\w.-]+)\.([a-z]{2,})(\/\S*)?$/i;

        if (this.getElement().value.match(validRegex)) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Represents an PasswordInput class that extends the Input class.
 * Provides a method to toggle the input type between 'password' and 'text'.
 *
 * @extends Input
 */
class PasswordInput extends Input {
    toggle() {
        this.getElement().type = (this.getElement().type === "text") ? "password" : "text";
    }
}

/**
 * Represents a Button class that extends the Input class.
 * Provides methods to set the button state to down (disabled) or up (enabled).
 *
 * @extends Input
 */
class Button extends Input {
    down(text) {
        this.getElement().classList.add("disabled");
        this.getElement().disabled = true;
        this.getElement().innerHTML = text;
    }
    
    up(text) {
        this.getElement().classList.remove("disabled");
        this.getElement().disabled = false;
        this.getElement().innerHTML = text;
    }
}