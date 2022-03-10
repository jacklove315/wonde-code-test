# wonde-code-test
Setting the system up locally

Prior Requirements on your machine 

`PHP ^8.0`
`Composer ^2.0` 
`NodeJS ^14.0`

## Step 1 - Pulling the repository down

On your local machine, open a terminal in the location of choice

Then run:

`git clone https://github.com/jacklove315/wonde-code-test.git`

## Step 2 - Setting the project up

After pulling the repo, in your terminal 

`cd wonde-code-test`

We now need to install the system dependencies:

For PHP dependencies run:

`composer install`

For JavaScript dependencies run:

`npm install`
   
## Step 2.1 - Setting .env file 

We need to create an `.env` file before we can the application

Open the project in a code editor of choice and copy `.env.example` to new `.env` file to the root directory (wonde-code-test)

You can do that by running this command in the terminal:

`cp .env.example .env`

## Step 2.2 - Generating Laravel Application key and Wonde API Authorization Key

The Wonde Test API key for this project is already set and is stored in the `.env.example` file under `WONDE_API_KEY`. 
You can change it any time to test different keys.

To generate a Laravel Application key run:

`php artisan key:generate`

## Step 3 - Running the Laravel Project

To run the project run the following commands in your terminal

First compile JavaScript files by running:

`npx mix`

And lastly run this command to create a local server:

`php artisan serve`

## Step 4 - Viewing the project

To view the project in your browser, follow the link given in the terminal after running `php artisan serve`
