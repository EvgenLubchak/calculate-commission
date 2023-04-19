# Calculate commission 1.0-beta

Features:
<br>
refactored code using services
```
app/public/index.php
```

## local project setup
### Using docker

Run in your work dir to build containers
```
docker compose up --build -d
```

Run to find app service container NAME 
```
docker compose ps
```

Run to connect app container via sh
```
docker exec -it YOUR-APP-NAME sh
```

Run to start test
```
./vendor/bin/phpunit
```
