# Product Feeder System

<br>

To get started, follow these steps:

#### Please open the terminal of the project and run it (Step: 1, 2, 4)

1. Install the required packages using composer by running the following command:

```bash
composer install
```

2. Please start server

```bash
php -S localhost:8080 -t .
```

---

#### System Structure

Feeder system path : `http://localhost:8080/feed/{:feeder}/{:format}/{:type}`

Feeder file path : `http://localhost:8080/public/{:feeder}/.{:type}`