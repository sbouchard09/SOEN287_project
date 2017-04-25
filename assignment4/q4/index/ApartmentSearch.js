//----------------------------------------------------
// Assignment 3
// Written by: Scott Bouchard - 26251625
// For SOEN 287 Section W - Winter 2017
//----------------------------------------------------
// This program checks if some conditions are met; 
// if the user is searching for an apartment that is
// greater than a 5 1/2 downtown, it will display a 
// message. If the user is searching for a 4 1/2 or 
// larger, downtown, with a price < $1000 / month, it
// will display another message.
// The message will be displayed in an "Expert
// Suggestions" section of the form which is, by 
// default, set to hidden/
//----------------------------------------------------

var dom;

// resets all the fields in the form when the user selects the 'Start Over' button
function reset() {
    var selected = [],
        inputFields = dom.getElementsByTagName('input'),
        i;
    
    for (i = 0; i < inputFields.length; i++) {
        if (inputFields[i].type === 'checkbox' && inputFields[i].checked) {
            inputFields[i].checked = false;
        }
    }
    
    dom.getElementById('f_expert').style.visibility = 'hidden';
    dom.getElementById('suggestion').innerHTML = "";
}

// isLocationDowntown checks the location selected by the user and returns true if the location is set to downtown
function isLocationDowntown() {
    var downtown = false,
        selected = [],
        inputFields = dom.getElementsByTagName('input'),
        i;
    
    for (i = 0; i < inputFields.length; i++) {
        if (inputFields[i].type === 'checkbox' && inputFields[i].checked && inputFields[i].value === 'downtown') {
            downtown = true;
            break;
        }
    }
    
    return downtown;
}

// function getSize returns the size of the apartment that's selected by the user
function getSize() {
    var selected = [],
        inputFields = dom.getElementsByTagName('input'),
        i,
        str = "";
    
    for (i = 0; i < inputFields.length; i++) {
        if (inputFields[i].type === 'checkbox' && inputFields[i].checked && inputFields[i].id === 'size') {
            str = str + inputFields[i].value + ",";
        }
    }
    return str;
}

// expertSuggestions displays an appropriate message when certain conditions are met
function expertSuggestions() {
    var downtownBigger = "It is very difficult to find an apartment larger than 5 1/2 downtown.",
        downtownLess1000 = "Normally, an apartment of 4 1/2 and above costs more than $1000 in the downtown area.",
        suggestion = "",    // stores the message to be displayed in the Expert Suggestions section
        i,
        j,
        price = dom.getElementById('price').value,  // to store the price range selected
        str = [];                                   // to store the size of apartments selected
    
    // sets the expert suggestion using the conditions
    if (isLocationDowntown) {
        str = getSize().split(','); // each size selected will be stored in an array
        // looks for if the size selected is 'Bigger than 5 1/2
        for (i = 0; i < str.length; i++) {
            if (str[i] === 'bigger') {
                dom.getElementById('f_expert').style.visibility = 'visible';
                suggestion = suggestion + downtownBigger + "<br>";
                break;
            }
        }
        // checks that the price is set to <1000
        if (price === 'less1000') {
            for (i = 0; i < str.length; i++) {
                if (str[i] === '4half' || str[i] === '5half' || str[i] === 'bigger') {
                    dom.getElementById('f_expert').style.visibility = 'visible';
                    suggestion = suggestion + downtownLess1000;
                    break;
                }
            } 
        }
    }
    
    dom.getElementById('suggestion').innerHTML = suggestion;
}

// sets the dom equal to the current document
// sets the Event listener for the buttons on the form
function loadElements() {
    dom = document;
    dom.getElementById('search').addEventListener('click', expertSuggestions, false);
    dom.getElementById('reset').addEventListener('click', reset, false);
}

window.addEventListener("load", loadElements, false);