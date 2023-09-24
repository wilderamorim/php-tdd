## Configuring the project

### Initializing the project

```bash
docker-compose up -d
```

### Accessing the container

```bash
docker-compose exec -it app bash
```

### Installing dependencies

```bash
composer install
```

### Running tests

```bash
composer test
```

### Accessing the application

- http://localhost:8888/?phpinfo=1
- http://localhost:8888