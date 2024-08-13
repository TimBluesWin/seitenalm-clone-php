<html>
  <head>
    <meta charset="utf-8">
    <title>Seitenalm</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <!-- Using flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://npmcdn.com/flatpickr/dist/l10n/de.js"></script>
    <link rel="stylesheet" href="{{ asset('flatpickr.theme.min.css') }}">
    <script src="{{ asset('app.js') }}"></script>
  </head>
  <body>
    <main>
      <!-- The introduction of the form; I copied it directly from the original form. -->
      <div data-brick="intro" class="ce ce-intro">
        <div class="intro has-body has-no-images  ">
          <div class="intro-body">
            <div class="intro-content">
              <div class="intro-content-body">
                <h1>
                  Ihr Wohlfühl-Urlaub im Almparadies Seitenalm!
                </h1>
                <p>Bitte geben Sie uns Ihre <strong>Urlaubswünsche</strong> bekannt und wir werden uns umgehend um Ihren nächsten Urlaub kümmern.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Beginning of form -->
      <form name="registration-form" id="registration-form"
      method="post" class="form container gutter-x ce">
        @csrf
        <!-- Divide the form into 3 fieldsets -->
        <fieldset>
          <!-- Legend for vacation data -->
          <legend class="form-legend">Ihre Urlaubsdaten</legend>
          <div>
            <div class="w-full">
              <!-- For this I have to use Javascript. If value is filled, then add class "required". If not, remove. -->
              <!-- I might just make this 'required' class only appear after submission, though. -->
              <div class="form-field request" class="required">
                <!-- Label for vacation date -->
                <label for="vacation-date" class="form-label required">Reisezeitraum</label>
                <!-- Input field for vacation date (with HTML validation -->
                <!-- Field becomes red when the input is invalid -->
                <input id="vacation-date" name="vacation-date"
                type="date" class="form-input-date form-input form-control input @error('vacation-date') is-invalid @enderror" 
                required/>
                <!-- Show error, when input is invalid. -->

                @error('vacation-date')
                  <div class="form-tooltip">
                    Geben Sie ein gültiges Datum ein.
                  </div>
                @enderror
              </div>
            </div> 
          
            <div class="w-full">
              <div class="form-field request" class="required">
                <!-- Label for number of adults -->
                <label for="adult" class="form-label required">Anzahl Erwachsene</label>
                <!-- Input field for number of adults (with HTML validation) -->
                <!-- Field becomes red when input is invalid and form has been submitted. -->
                <input id="adult" type="number" name="adult" class="form-input @error('adult') is-invalid @enderror" 
                required min="1" step="1" pattern="[0-9]*"/>
                <!-- Show error message, when number of adults is neither filled in nor positive nor a number. -->
                <!-- The error is shown only when the form is submitted. -->
                @error('adult')
                  <div class="form-tooltip">
                    Geben Sie eine positive Zahl ein.
                  </div>
                @enderror
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <!-- Legend for adding children. -->
          <legend class="form-legend">Kinder</legend>
          <!-- Importance of children in Seitenalm. -->
          <p class="form-info">Als Familienspezialist ist es uns wichtig, Ihnen ein maßgeschneidertes Angebot zu übermitteln. Bitte geben Sie uns daher den Vornamen und das Alter Ihrer Kinder/Ihres Kindes an.</p>
          <!-- To-do: Add and remove children -->
          <div class="text-right request-form-children-control mb-4">
            <a class="button children-add-button">
              Kind hinzufügen
            </a>
            <a class="inline-block text-sm m-1 opacity-75 underline hover:no-underline">
              Kind entfernen
            </a>
          </div>
        </fieldset>
        <fieldset>
          <!-- Legend for contact data -->
          <legend class="form-legend">Ihre Kontaktdaten</legend>
          <div class="contact-wrap">
            <div class="form-field request" class="required">
              <!-- Label for first name -->
              <label for="first-name" class="form-label required">Vorname</label>
              <!-- Input field for last name with HTML validation -->
              <!-- Field becomes red when the value is invalid (and if the form is submitted) -->
              <input id="first-name" type="text" name="first-name"
              required pattern="[a-zA-Z\xC0-\uFFFF]+([ \-']{0,1}[a-zA-Z\xC0-\uFFFF]+){0,2}[.]{0,1}" 
              class="form-input @error('first-name') is-invalid @enderror"/>
    
              <!-- Show error message when first name is not valid. -->
              <!-- The error is only shown when the form is submitted. -->
              @error('first-name')
                <div class="form-tooltip">
                  Geben Sie einen gültigen Namen ein.
                </div>
              @enderror
            </div>
    
            <div class="form-field request">
              <!-- Label for last name -->
              <label for="last-name" class="form-label required">Nachname</label>
              <!-- Input field for last name with HTML validation -->
              <!-- Field becomes red when the value is invalid (and if the form is submitted) -->
              <input id="last-name" type="text" name="last-name"
              required pattern="[a-zA-Z\xC0-\uFFFF]+([ \-']{0,1}[a-zA-Z\xC0-\uFFFF]+){0,2}[.]{0,1}" class="form-input @error('last-name') is-invalid @enderror">
    
              <!-- Show error message when last name is not valid. -->
              <!-- The error is only shown when the form is submitted. -->
              @error('last-name')
                <div class="form-tooltip">
                    Geben Sie einen gültigen Name ein.
                </div>
              @enderror
            </div>
    
            <div class="form-field request required">
              <!-- Label for gender -->
              <label for="gender" class="form-label required">Geschlecht</label>
              <!-- Combo Box for gender -->
              <!-- Field becomes red when the value is invalid (and if the form is submitted) -->
              <select name="gender" class="form-input @error('gender') is-invalid @enderror">
                <!-- I add the "select" command in the combo box (with empty value) -->
                <option value="" selected>Auswählen</option>
                <option value="M" selected>Männlich</option>
                <option value="F" selected>Weiblich</option>
                <!-- Use for-loop to add genders into combo box. -->
                <!-- To-do: add genders into combo box. -->
              </select>
              <!-- Show error message when gender is not filled -->
              <!-- The error is only shown when the form is submitted. -->
              @error('gender')
                <div class="form-tooltip">
                    Bitte wählen sie Ihr Geschlect aus.
                </div>
              @enderror
            </div>
            <div class="form-field request required">
              <!-- Label for Email -->
              <label for="email" class="form-label required">E-Mail</label>
              <!-- Input field for Email with HTML validation -->
              <!-- Field becomes red when the value is invalid (and if the form is submitted) -->
              <input id="email" type="email" name="email"
              required class="form-input @error('email') is-invalid @enderror"/>
    
              <!-- Show error message when email is neither filled nor valid. -->
              <!-- The error is only shown when the form is submitted. -->
              @error('email')
              <div class="form-tooltip">
                  Geben Sie eine gültige E-Mail Adresse ein.
              </div>
              @enderror
            </div>
    
            <div class="form-field request required">
              <!-- Label for country -->
              <label for="country" class="form-label required">Land</label>
              <!-- Combo Box for country -->
              <!-- Field becomes red when the value is invalid (and if the form is submitted) -->
              <select name="country" class="form-input  @error('country') is-invalid @enderror">
                <!-- I add the "select" command in the combo box (with empty value) -->
                <option value="" selected>Auswählen</option>
                <option value="de">Deutschland</option>
                <option value="at">Österreich</option>
                <option value="ch">Schweiz</option>
                <option value="" disabled="true">-------------------</option>
                @foreach($countries as $country)
                  <option value="{{ $country['alpha2'] }}">{{ $country['name'] }}</option>
                @endforeach
              </select>
    
    
              <!-- Show error message when country is not valid. -->
              <!-- The error is only shown when the form is submitted. -->
              @error('country')
                <div class="form-tooltip">
                  Wählen Sie ein Land aus.
                </div>
              @enderror
            </div>
    
            <div class="form-field request required">
              <!-- Label for zipcode -->
              <label for="zip-code" class="form-label required">PLZ</label>
              <!-- Input field for zipcode with HTML validation (allow only 4 digits) -->
              <!-- Field becomes red when the value is invalid (and if the form is submitted) -->
              <input id="zip-code" type="text" name="zip-code" 
              required pattern="[0-9]{4}" class="form-input @error('zip-code') is-invalid @enderror"/>
    
              <!-- Show error message when zip code is not valid. -->
              <!-- The error is only shown when the form is submitted. -->
              @error('zip-code')
                <div
                  *ngIf="anmeldungForm.controls.plz.invalid && abgeschickt" class="form-tooltip"
                >
                  Geben Sie eine gültige ZIP ein.
      
                </div>
              @enderror
            </div>
    
            <div class="form-field request required">
              <!-- Label for city -->
              <label for="city" class="form-label required">Stadt</label>
              <!-- Input field for city -->
              <!-- Field becomes red when the value is invalid (and if the form is submitted) -->
              <input id="city" type="text" pattern='[^!\?\{\(\[\*%&_=:<>]+'
              name="city" required class="form-input @error('city') is-invalid @enderror"/>
              
    
              <!-- Show error message when city is not valid. -->
              <!-- The error is only shown when the form is submitted. -->
              @error('city')
                <div class="form-tooltip">
                  Geben Sie einen Städtenamen ein.
                </div>
              @enderror
            </div>
    
            <!-- Label for street -->
            <div class="form-field request">
              <label for="street" class="form-label required">Straße</label>
              <!-- Input field for street -->
              <!-- Field becomes red when the value is invalid (and if the form is submitted) -->
              <input id="street" type="text" pattern="[^!\?\{\(\[\*%&_=:<>]+"
              name="street" required class="form-input @error('street') is-invalid @enderror" />
              
    
              <!-- Show error message when street is not valid. -->
              <!-- The error is only shown when the form is submitted. -->
              @error('city')
                <div class="form-tooltip">
                  Geben Sie einen Straßennamen ein.
                </div>
              @enderror
            </div>
    
            <div class="form-field request">
              <!-- Label for phone number -->
              <label for="phone-number" class="form-label">Telefon</label>
              <!-- Input field for phone number (not required) -->
              <input id="phone-number" type="text" pattern="[^a-zA-z]+"
              name="phone-number" class="form-input @error('phone-number') is-invalid @enderror"/>
    
              <!-- Show error message when telephone number is not valid. -->
              <!-- The error is only shown when the form is submitted. -->
              @error('phone-number')
                <div class="form-tooltip">
                  Geben Sie eine gültige Telefonnummer ein.
                </div>
              @enderror
              
            </div>
    
            <div class="form-field request">
              <!-- Label for question / wish -->
              <label for="question" class="form-label">Fragen oder Wünsche</label>
              <!-- Show text area -->
              <textarea id="question" name="question" class="h-full form-input"></textarea>
            </div>
          </div>
        </fieldset>
    
        <!-- Container for invalid form. I intentionally make the behaviour -->
        <!-- slightly different than the original form. -->
        <!-- The original shows this container when a field is left empty. -->
        @if ($errors->any())
          <div class="form-invalid-container">
            <div class="font-display text-2xl mb-2">
              Beim Senden des Formulars ist ein Fehler aufgetreten!
            </div>
            Die ungültigen Felder wurden hervorgehoben.
          </div>
        @endif
    
        <div class="text-center">
          <!-- Send the form. After sending the form only does the validation -->
          <!-- as the requirement of this task is to not make the submit button functional -->
          <button type="submit" class="button button-special button-large">Anfragen Absenden</button>
        </div>
      </form>
    <!-- End of form -->
    </main>
  </body>
  <script>
      // I put it in the end of this view file for easy implementation of
      // loading the flatpickr after the page is loaded.
      // Show 2 months if initial width > 640 pixels, otherwise only 1 month.
      let monthsDisplayed = window.innerWidth >= 640 ? 2 : 1;
      flatpickr("#vacation-date", {
        "locale": "de",
        "mode": "range",
        "showMonths": monthsDisplayed,
        "minDate": "today",
        // I got these dates from inspect element
        "disable": [
          {"from":"2024-11-04","to":"2024-12-19"},
          {"from":"2025-03-17","to":"2025-04-10"}
        ],
        "altFormat": "d. M Y",
        "dateFormat": "Y-m-d",
      });
  </script>
</html>