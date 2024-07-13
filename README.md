My (Mostly Complete) Applicant Viewer

This is done in Laravel 10 and React with Axios for handling the requests easier. I got far enough I think it'll work if you set up the Users and Auth Tokens, but it was already getting late. I think it should be enough for you to get an idea of what I'm doing. 

The project was fairly basic, with migrations for a table to store the data in the sheet and an ImportApplicants.php script to pull it in from the CSV.

php artisan import:applicants storage/app/public/list.csv

Sanctum will be used to issue API access tokens to companies to authenticate the API requests to the application. The Controller will also only return records for Applicants that match the users company.  

I also added a very basic rate limit to stop the server getting Ddos'd, though external solutions like Cloudflare would help with this too.


Some future improvements would be the ability to upload new CSVs. Dropdowns instead of text entry for the search fields, not having the search for DBS checks be 1's and 0's and a user interface that isn't ugly as sin and more Validation (Not that you ever really ever have too much validation)


As a quick run-through of my process,

Backend:
Spec out requirements (You'd already provided all I needed!)
Setup Laravel Project
Create the Migrations (One Table to store the CSV)
Create Models and Controllers for the Applicants.
Define our routes. With one page this was mainly the CRUD and a way to download the RTF CSV
Apply Sanctum for security
Import our data using a script from the CSV file


Frontend:
Setup React with Axios
Create Basic components for display and searching applicants
Setup Axios to handle CSRF tokens. 



This all should provide a very basic system that shows Applicants limited to the company viewing and with Sanctum for security.  

If you've any questions, want me to elaborate more or anything, or want something in "Naked" PHP instead to test my skills there, let me know. 
