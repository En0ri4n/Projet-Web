/**
 * Add an event to an element
 * @param elem The element to add the event to
 * @param event The name of the event to add
 * @param callback The function to call when the event is triggered
 */
export const addEventTo = (elem, event, callback) => elem.addEventListener(event, callback);

/**
 * Add multiple events to an element
 * @param elem The element to add the event to
 * @param events The name of the event to add and the function to call when the event is triggered (as a Map)
 */
export const addEventsTo = (elem, events) => events.forEach((event, callback) => elem.addEventListener(event, callback));

/**
 * Set the validity of the input field, based on a regular expression.<br>
 * It will check the value of the input field and apply the regular expression to it.<br>
 * If the value is valid, it will display a check tag
 *
 * @param input The input field to check
 * @param regEx The regular expression to apply to the value of the input field
 * @param message The message to display if the value is not valid
 */
export const setCustomValidator = (input, regEx, message) =>
{
    addEventTo(input, 'input', (evt) =>
    {
        const value = input.value;

        if(value.length === 0)
        {
            evt.target.className = ''
            evt.target.setCustomValidity("")
            return
        }

        if(regEx.test(value))
        {
            evt.target.className = 'valid'
            evt.target.setCustomValidity("")
        }
        else
        {
            evt.target.className = 'invalid'
            evt.target.setCustomValidity(message);
        }

        evt.target.reportValidity()
    })
}

/**
 * Set the validity of the input field, based on a regular expression.<br>
 * It will check the value of the input field and apply the regular expression to it.<br>
 * If the value is valid, it will display a check tag
 *
 * @param input The input field to check
 * @param condition The condition to apply to the value of the input field
 * @param message The message to display if the value is not valid
 */
export const setCustomConditionValidator = (input, condition, message) =>
{
    addEventTo(input, 'input', (evt) =>
    {
        const value = input.value;

        if(value.length === 0)
        {
            evt.target.className = ''
            evt.target.setCustomValidity("")
            return
        }

        if(condition(value))
        {
            evt.target.className = 'valid'
            evt.target.setCustomValidity("")
        }
        else
        {
            evt.target.className = 'invalid'
            evt.target.setCustomValidity(message);
        }

        evt.target.reportValidity()
    })
}

export const sha256 = async message =>
{
    const msgBuffer = new TextEncoder().encode(message);
    const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
};

export const scrollToTop = () => window.scroll({ top: 0, left: 0, behavior: 'smooth' });