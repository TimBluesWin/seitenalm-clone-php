<h1>What is this?</h1>

A clone of Seitenalm request form, built using Laravel, HTML, CSS, and Javascript.

<h1>Development Environment</h1>
<ul>
    <li>Operating System: Windows 11 Home 23H2</li>
    <li>Code Editor: Visual Studio Code</li>
    <li>Browser: Microsoft Edge and Google Chrome</li>
    <li>Laravel 11.20</li>
</ul>

<h1>How to run this application?</h1>
<ol>
    <li>Clone this application using git clone.</li>
    <li>Run "composer install" (without quotes).</li>
    <li>Copy and paste the provided ".env.example" file, and rename the copied file into ".env"
    (without quotes)</li>
    <li>Run "php artisan key:generate" (without quotes)</li>
    <li>Run "php artisan migrate" (without quotes; when asked if you want to create the SQLite DB, type "yes".)</li>
    <li>Afterwards, run "php artisan serve" (without quotes). You should be able to run the app by typing "localhost:8000" (without quotes) into the address bar.</li>
    <li>Note: If you still experience errors, execute "php artisan config:cache" (without quotes)</li>
</ol>