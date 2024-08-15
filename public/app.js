let daysBirth = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
let monthsBirth = ['Jan.', 'Feb.', 'März', 'Apr.', 'Mai', 'Jun.', 'Jul.', 'Aug.', 'Sep.', 'Okt.', 'Nov.', 'Dez.'];
let yearsBirth = ['2024', '2023', '2022', '2021', '2020', '2019', '2018', '2017', '2016', '2015', 
  '2014', '2013', '2012', '2011', '2010', '2009', '2008', '2007', '2006'];

// This array stores which inputs are invalid (based on Ids).
// The plan is to make a function that checks the whole form for validation.
// Each ID of invalid field will be stored in this array.
// If size of this array > 0, show the error container.
// Later, while the user edits the form, each time the field loses focus, it will validate that particular field.
// This change will add / remove classes from the label and inputs, as well as adding / remove the tooltip.
// If it becomes valid, remove the id from the list. Otherwise, re-add the id to the list.
// Then the container can be make hidden once this array becomes empty again.

// Another thing is since the validations are not that complex (only required and patterns in most cases)
// as well as number of adults at least one, I think we can simply loop the inputs and select fields,
// and see the pattern, required, and min attribute.
let invalidInputIds = [];

// Highlight / unhighlight field should only occur after the form is submitted.
let submitted = false;

window.addEventListener('resize', function(event) {
    // Because we are reinitializing the flatpickr, we have to first get the value of the travel date
    // which will then be inserted in the reinitialized flatpickr.
    let travelDate = document.getElementById("vacation-date").value;
    // Redefine the number of months
    let monthCount = window.innerWidth >= 640 ? 2 : 1;
    console.log(monthCount);
    // Redefine flatpickr
    flatpickr("#vacation-date", {
      "locale": "de",
      "mode": "range",
      "showMonths": monthCount,
      "minDate": "today",
      "disable": [
        {"from":"2024-11-04","to":"2024-12-19"},
        {"from":"2025-03-17","to":"2025-04-10"}
      ],
      "altFormat": "d. M Y",
      "dateFormat": "Y-m-d",
    });
    // Input element for travel date
    let travelDateInput = document.getElementById("vacation-date");
    // Here we set the value of the travel date.
    travelDateInput.value = travelDate;
}, true);

function addChildren()
{
  numberOfChildren = numberOfChildren + 1;
  let childrenHTML = "<div class='flex flex-wrap w-full' id='children-div-" + numberOfChildren + "'>";
  childrenHTML = childrenHTML + "<div class='form-field request required'>";
  childrenHTML = childrenHTML + '<label for="children-name-' + numberOfChildren +  '" class="form-label required">Name des Kindes</label>';
  childrenHTML = childrenHTML + '<input type="text" id="children-name-' + numberOfChildren + '" required ' + 
  'onfocusout="validateSingleField(this)"  name="children[' + numberOfChildren + '][name]" class="form-input">';
  // Closing div for the name of child
  childrenHTML = childrenHTML + '</div>';
  childrenHTML = childrenHTML + '<div class="w-full">';
  childrenHTML = childrenHTML + '<div class="form-field required children-container">';
  childrenHTML = childrenHTML + '<div class="children-label">';
  childrenHTML = childrenHTML + '<label class="form-label required" for="children-birthday-' + numberOfChildren + '">Geburtstag</label>';
  // closing div for the children birthday label.
  childrenHTML = childrenHTML + '</div>';
  childrenHTML = childrenHTML + '<div class="children_wrap form-field">';
  childrenHTML = childrenHTML + '<select id="children-birthdate-' + numberOfChildren + '" required class="form-input"'
  childrenHTML = childrenHTML + ' onfocusout="validateSingleField(this)" name="children[' + numberOfChildren + '][birthdate]">';
  childrenHTML = childrenHTML + '<option value="" selected>Tag</option>';
  for(let i = 0; i < daysBirth.length; i++)
  {
    childrenHTML = childrenHTML + '<option value="' + daysBirth[i] + '">' + daysBirth[i] + '</option>'
  }
  // closing select for birth date.
  childrenHTML = childrenHTML + '</select>';
  childrenHTML = childrenHTML + '<select id="children-birthmonth-' + numberOfChildren + '" required class="form-input"'
  childrenHTML = childrenHTML + ' onfocusout="validateSingleField(this)" name="children[' + numberOfChildren + '][birthmonth]">';
  childrenHTML = childrenHTML + '<option value="" selected>Monat</option>';
  for(let i = 0; i < monthsBirth.length; i++)
  {
    childrenHTML = childrenHTML + '<option value="' + monthsBirth[i] + '">' + monthsBirth[i] + '</option>'
  }
  // closing select for birth month.
  childrenHTML = childrenHTML + '</select>';
  childrenHTML = childrenHTML + '<select id="children-birthyear-' + numberOfChildren + '" required class="form-input"'
  childrenHTML = childrenHTML + ' onfocusout="validateSingleField(this)" name="children[' + numberOfChildren + '][birthyear]">';
  childrenHTML = childrenHTML + '<option value="" selected>Jahr</option>';
  for(let i = 0; i < yearsBirth.length; i++)
  {
    childrenHTML = childrenHTML + '<option value="' + yearsBirth[i] + '">' + yearsBirth[i] + '</option>'
  }
  // closing select for birth year.
  childrenHTML = childrenHTML + '</select>';
  // closing div for the children birthday input.
  childrenHTML = childrenHTML + '</div>';
  // closing div for the whole birthday of child (part 2)
  childrenHTML = childrenHTML + '</div>';
  // Closing div for the whole birthday of child (part 1)
  childrenHTML = childrenHTML + '</div>';
  // Closing div for whole child.
  childrenHTML = childrenHTML + '</div>';
  console.log(childrenHTML);
  childrenDiv = document.getElementById("children-container");
  childrenDiv.insertAdjacentHTML('beforeend', childrenHTML );
  // Show button to remove child if more than 1 child.
  if(numberOfChildren > 1)
  {
    // This "inline-block" ensures that the remove child button is displayed inline with the add child button.
    document.getElementById("remove-child").style.display = "inline-block";
  }

  // Side note: I actually saw another implementation of dynamic form input,
  // where the user put the HTML template inside a hidden div, and that would lead to a cleaner code.
  // However, this disallows us to make unique ids (and unique name) for each input.
}

function removeChildren()
{
  let removedChild = document.getElementById("children-div-" + numberOfChildren.toString());
  removedChild.remove();
  numberOfChildren = numberOfChildren - 1;
  // If there are only 1 child left, make the "remove child" button invisible.
  if(numberOfChildren == 1)
    {
      document.getElementById("remove-child").style.display = "none";
    }
}

// This does the following thing:
// - Add tooltip (unfortunately I cannot really make it as simple as "display:block", as there
//   hovering-only part of the style, so I have to add it programmatically)
// - Make the label bold (I can use if element is required and value is empty)
// - Make border of the input field red (accomplished by class "is-invalid")
// It should be noted that in the original form, the children's birthday has no tooltip.
// and neither do its label change (for the latter I think it would be impossible anyway, as its ID would be different.)
function highlightInvalidField(elementId)
{

}

// Remove tooltip, make the label not bold (if required and value not empty)
function unhighlightValidField(elementId)
{

}

function validateSingleField(element)
{
  // Basically the only major validations are required, pattern.
  // That means that I can simply run the checks for required,
  // pattern (these should be similar with what we implemented in the backend), and
  // perhaps min (for number of adults)

  // This can then be retrieved at the end of validation to add / not add to the invalid element id array.
  let inputIsValid = true;

  console.log("testing: " + element.id);

  if(element.hasAttribute('required') && element.value === '')
  {
    console.log(element.id + " fails required test; it's empty.");
    inputIsValid = false;
  }
  // Does regex checking. It shouldn't check if element is empty.
  if((element.hasAttribute('pattern') || element.hasAttribute('data-pattern')) && element.value !== '')
  {
    let pattern = "";
    if(element.hasAttribute("pattern"))
    {
      pattern = element.getAttribute("pattern");
    }
    else
    {
      pattern = element.getAttribute("data-pattern")
    }
    // This RegExp class allows us to construct regex from the given pattern attribute.
    let regex = new RegExp("^" + pattern + "$");
    console.log(regex);
    if(!regex.test(element.value))
    {
      console.log(element.id + " fails pattern test.");
      inputIsValid = false;
    }
  }
  // minimum value for number of adults
  if(element.hasAttribute('min'))
  {
    let minimumValue = parseInt(element.getAttribute("min"));
    
    if(parseInt(element.value) < minimumValue)
    {
      console.log(element.id + " fails min test. Expected minimum: " + minimumValue + ", actual value: " + element.value);
      inputIsValid = false;
    }
  }
  if(inputIsValid)
  {
    console.log(element.id + " is valid!");
  }
  if(!inputIsValid && submitted)
  {
    highlightInvalidField(element.id);
    // Add to the invalid field list
    addIntoInvalidArray(element.id);

  }
  // This one is needed for onlostfocus on individual field.
  else if(inputIsValid && submitted)
  {
    unhighlightValidField(element.id);
    // remove from invalid field list
    removeFromInvalidArray(element.id)
  }
  if(invalidInputIds.length > 0)
  {
    document.getElementById("form-invalid-container").style.display = "block";
  }
  else
  {
    document.getElementById("form-invalid-container").style.display = "none";
  }
}

// I think storing element is also possible. However, that would involve
// having to use document.getElementById each time I want to mess with the tooltip,
// or adding / removing class for labels.
// I can simply say '{{elementID}}-tooltip' or '{{elementID}}-label' (I will edit the blade file later.)  
function addIntoInvalidArray(elementId)
{
  if(!invalidInputIds.includes(elementId))
  {
    invalidInputIds.push(elementId);
  }
}

function removeFromInvalidArray(elementId)
{
  if(invalidInputIds.includes(elementId))
  {
    console.log("There is still " + elementId + "in the array!");
    const newArray = invalidInputIds
    .filter(item => item !== elementId);
    invalidInputIds = newArray;
  }
}

function validateAllFields()
{
  submitted = true;
  let inputs = document.forms["registration-form"].getElementsByTagName("input");
  // Then we can for-loop, run "validateSingleField"
  for(let i = 0; i < inputs.length; i++)
  {
    let currentField = inputs[i];
    validateSingleField(currentField);
  }
  // Now validating select
  let comboBoxes = document.forms["registration-form"].getElementsByTagName("select");
  for(let i = 0; i < comboBoxes.length; i++)
    {
      let currentField = comboBoxes[i];
      validateSingleField(currentField);
    }
  // Deny submit if any input is invalid by returning false.
  if(invalidInputIds.length == 0)
  {
    document.forms["registration-form"].submit();
  }
}