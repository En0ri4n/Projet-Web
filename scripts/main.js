/**
 * Add an event to an element
 * @param elem The element to add the event to
 * @param event The name of the event to add
 * @param callback The function to call when the event is triggered
 */
const addEventTo = (elem, event, callback) => elem.addEventListener(event, callback);

/**
 * Set the validity of the input field, based on a regular expression.<br>
 * It will check the value of the input field and apply the regular expression to it.<br>
 * If the value is valid, it will display a check tag
 *
 * @param input The input field to check
 * @param regEx The regular expression to apply to the value of the input field
 * @param message The message to display if the value is not valid
 */
const setCustomValidator = (input, regEx, message) =>
{
	addEventTo(input, 'input', (evt) =>
	{
		const value = input.value;
		
		if (value.length === 0)
		{
			evt.target.className = ''
			this.setCustomValidity("")
			return
		}
		
		if (regEx.test(value))
		{
			evt.target.className = 'valid'
			this.setCustomValidity("")
		}
		else
		{
			evt.target.className = 'invalid'
			this.setCustomValidity(message);
		}
		
		evt.target.reportValidity()
	})
}