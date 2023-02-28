
# LARAVEL ASSESSMENT FRAUD DETECTOR

![alt text](https://github.com/amjad-alarori/fraud-scan-app/blob/main/assets/intro.png)
![alt text](https://github.com/amjad-alarori/fraud-scan-app/blob/main/assets/scans.png)
![alt text](https://github.com/amjad-alarori/fraud-scan-app/blob/main/assets/after_scan.png)

A brief description of what this project does and who it's for


## Authors

- [@amjadalarori](https://www.github.com/amjad-alarori)


## API Reference

#### Get all Segmented After Scan

```http
  GET /api/scans
```

#### Get all Customers

```http
  GET http://YOUR_DOCKER_HOST_IP_ADDRESS/api/v1/customers
```




## Appendix

If You running the API of customers and this project on Docker you need to make sure to use your docker host ip address instead of 'localhost' as this call is firing out from the Docker container to another container.
to get your own Docker Host IP Address you can use this command for mac Users:

```bash
ipconfig getifaddr en0
```




## Demo

https://github.com/amjad-alarori/fraud-scan-app


## Installation

1. Clone this repository on your local machine using git clone https://github.com/amjad-alarori/fraud-scan-app.git
2. Install Docker on your machine if it's not already installed.
3. Run this command to start the Docker container.
```bash
./vendor/bin/sail up
```
4. Run this command to Pull the API Docker image.
```bash
docker pull vzdeveloper/customers-api
```
5. Install npm dependencies by running:
```bash
npm install
```

6. Start the server

```bash
npm run watch
```

7. Don't forget to migrate

```bash
php artisan migrate
```


## Requirments

What is fraudulent activity?

- Two customers with the same IP-address or same IBAN are both fraudulent.
- A customer with a phone number from outside the Netherlands is fraudulent.
- A customer that is younger than 18 years old is fraudulent.




## Features

- The application retrieves all customers from the customer API and checks them for fraudulent activity
- The application displays all customers and highlights the fraudulent ones.
- Every time a scan is completed, scan will be inserted as a new “Scan” with the following data:
    + Scan date/time.
    + Create and attach all customer models (relationship).
    + Per customer, tracking of whether they were marked as fraudulent or not.
- Displays all scans that have been executed, including all recorded data for that scan.



## Extra Tasks (Bonus)

- Created API endpoints to serve the data.
- Used Tailwind CSS to style the application.
- Display the reason why a customer was reported after scanning, for example: “Customer has non-NL phone nr.”
- Cached the last scan results and restore them when the page is refreshed.
- Tested application using Pest.


## Running Tests

To run tests, run the following command.

```bash
  ./vendor/bin/pest  
```


## Tech Stack

**Client:** Laravel, TailwindCSS

**Server:** Docker


## 🚀 About Me
I'm a full stack developer...


## 🔗 Links
[![portfolio](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://amjadalarori.nl/)
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/amjad-alarori/)



## Feedback

If you have any feedback, please reach out to us at amjad.alarori@outlook.com

