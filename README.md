
# Docker Application for Brackets Project

An application for checking the correct positioning of brackets


## Installing Docker

Before running the application, make sure you have Docker installed on your computer. You can download and install Docker from the [official Docker website](https://www.docker.com/get-started).

### Building Docker Image

```bash
docker-compose build
```

### Running the Container

```bash
docker-compose up -d
```

After running the container, the Brackets Project application will be available at http://localhost.

### Stopping the Container

```bash
docker-compose stop
```

## Additional Information

- For configuration of the application, see Dockerfile and docker-compose.yml files.
