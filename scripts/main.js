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
addEventTo(document, 'DOMContentLoaded', () =>
{
    const searchBar = document.getElementById('search-input');

    if(searchBar == null)
        return;

    addEventTo(searchBar, 'keyup', (evt) =>
    {
        if(evt.keyCode === 13)
        {
            console.log('Enter pressed');
            window.location.href = `/search/${searchBar.value}`;
        }
    });
})

/* TODO: Faire en sorte que le bouton s'affiche de nouveau */
function checkVisible(elm)
{
    var rect = elm.getBoundingClientRect();
    var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
    return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
}

var button_back_visible = false;
var IdTimeout;
/*Show the 'Scroll back to Top' button if the top of the page isn't visible*/
window.addEventListener('scroll', function(event)
{
    if(document.getElementById("premiere_section") == null)
    {
        return;
    }    

    let button_back = document.getElementById('button_back');
    if(checkVisible(document.getElementById("premiere_section")) && button_back_visible)
    {
        IdTimeout = window.setTimeout(function()
            {
                button_back.style.display = 'none';
            }, 500);
        button_back.animate(disappear, length_animation)
        button_back_visible = false;
    }
    if(!checkVisible(document.getElementById("premiere_section")) && !button_back_visible)
    {
        clearTimeout(IdTimeout);
        button_back.style.display = 'flex';
        button_back.animate(appear, length_animation)
        button_back_visible = true;
    }
});

function scrollToTop()
{
    window.scroll({top: 0, behavior: 'smooth'});
}

const appear = [
    {opacity: 0,},
    {opacity: 1,},
];
const disappear = [
    {opacity: 1,},
    {opacity: 0,},
];
const length_animation = {
    duration: 500,
    iterations: 1,
};