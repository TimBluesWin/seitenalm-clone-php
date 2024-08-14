let daysBirth = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
let monthsBirth = ['Jan.', 'Feb.', 'März', 'Apr.', 'Mai', 'Jun.', 'Jul.', 'Aug.', 'Sep.', 'Okt.', 'Nov.', 'Dez.'];
let yearsBirth = ['2024', '2023', '2022', '2021', '2020', '2019', '2018', '2017', '2016', '2015', 
  '2014', '2013', '2012', '2011', '2010', '2009', '2008', '2007', '2006'];

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
  let childrenHTML = "<div class='flex flex-wrap w-full'>";
  childrenHTML = childrenHTML + "<div class='form-field request required'>";
  childrenHTML = childrenHTML + '<label for="children-name-' + numberOfChildren +  '" class="form-label required">Name des Kindes</label>';
  childrenHTML = childrenHTML + '<input type="text" id="children-name-' + numberOfChildren + '" required ' + 
  'name="children[' + numberOfChildren + '][name]" class="form-input">';
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
  childrenHTML = childrenHTML + ' name="children[' + numberOfChildren + '][birthdate]">';
  childrenHTML = childrenHTML + '<option value="" selected>Tag</option>';
  for(let i = 0; i < daysBirth.length; i++)
  {
    childrenHTML = childrenHTML + '<option value="' + daysBirth[i] + '">' + daysBirth[i] + '</option>'
  }
  // closing select for birth date.
  childrenHTML = childrenHTML + '</select>';
  childrenHTML = childrenHTML + '<select id="children-birthmonth-' + numberOfChildren + '" required class="form-input"'
  childrenHTML = childrenHTML + ' name="children[' + numberOfChildren + '][birthmonth]">';
  childrenHTML = childrenHTML + '<option value="" selected>Monat</option>';
  for(let i = 0; i < monthsBirth.length; i++)
  {
    childrenHTML = childrenHTML + '<option value="' + monthsBirth[i] + '">' + monthsBirth[i] + '</option>'
  }
  // closing select for birth month.
  childrenHTML = childrenHTML + '</select>';
  childrenHTML = childrenHTML + '<select id="children-birthyear-' + numberOfChildren + '" required class="form-input"'
  childrenHTML = childrenHTML + ' name="children[' + numberOfChildren + '][birthyear]">';
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
}

function removeChildren()
{
  let children = document.getElementById("children-container");
  children.removeChild(children.lastChild);
  numberOfChildren = numberOfChildren - 1;
  // If there are only 1 child left, make the "remove child" button invisible.
  if(numberOfChildren == 1)
    {
      document.getElementById("remove-child").style.display = "none";
    }
}