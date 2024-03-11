/**
 * Add an event to an element
 * @param elem The element to add the event to
 * @param event The name of the event to add
 * @param callback The function to call when the event is triggered
 */
export const addEventTo = (elem, event, callback) => elem.addEventListener(event, callback);

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

export function sha256(message) {
	// encode as UTF-8
	const msgBuffer = new TextEncoder().encode(message);

	// hash the message
	return crypto.subtle.digest('SHA-256', msgBuffer).then(buffer => {
		const hashArray = Array.from(new Uint8Array(buffer));
		return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
	});
}

function checkVisible(elm) {
    var rect = elm.getBoundingClientRect();
    var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
    return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
  }

function scroll_up(){
window.scrollTo({top, behavior:"smooth"});
}


var button_back_visible = false;
var IdTimeout;
/*Show the 'Scroll back to Top' button if the top of the page isn't visible*/
window.addEventListener('scroll', function(event) 
{
	let button_back = document.getElementById('button_back');
    if(checkVisible(document.getElementById("premiere_section")) && button_back_visible)
    {
		IdTimeout = window.setTimeout(function(){
			button_back.style.display = 'none';
		  },500);
		button_back.animate(disappear,length_animation)
		button_back_visible = false;
    }
	if (!checkVisible(document.getElementById("premiere_section")) && !button_back_visible ){
		clearTimeout(IdTimeout);
        button_back.style.display = 'flex';
		button_back.animate(appear,length_animation)
		button_back_visible = true;
    }
});
const appear = [
	{ opacity:0,},
	{ opacity:1,},
  ];
  const disappear = [
	{ opacity:1,},
	{ opacity:0,},
  ];
  
  const length_animation = {
	duration: 500,
	iterations: 1,
  };
