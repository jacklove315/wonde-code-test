# wonde-code-test
Setting the system up locally

Prior Requirements on your machine 
(PHP 8^ | Composer 2^ | NPM 7^)

## Step 1 - Pulling the repository down

At the top of this repo, go to 'Code/https' and copy the URL of this repo

On your local machine, open a terminal and CD to your location of choice

Then type 'git clone https://github.com/jacklove315/wonde-code-test.git'

## Step 2 - Setting the project up

After pulling doen the repo, in your terminal CD into ***wonde-code-test***

We now need to install the system dependecies:

  run ***'composer install'*** in your terminal - for our PHP dependencies
  
  run ***'npm install'*** in your terminal - for our JS dependencies
  
## Step 2.1 - Setting .env file 

We need to create an Env file before we run the application

Open the project in a code editor of choice and add a .env file to the root directory (wonde-code-test)

Copy the contents of the .env.exmaple file into the .env file (this can also be found in the root directory (wonde-code-test)

## Step 2.2 - Generating Laravel Application key and Wonde API Authorization Key

The Wonde test API key for this project is already set and is stored in the .env.example file under (WONDE_API_KEY)

To generate a Laravel Application key, open a terminal and CD to the wonde-code-test directory (your code editor terminal will already be positioned here)

Then run ***php artisan key:generate***

## Step 3 - Running the Laravel Project

To run the project run the following commands in your terminal (two separate terminal windows)

***npx mix*** - This compiles all the Vue/js files *RUN THIS FIRST

***php artisan serve*** - this runs the local server


## Step 4 - Viewing the project

To view the project in your browser, follow the link given in the terminal after running php artisan serve
