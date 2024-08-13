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