### First run on macOS
1. mkdir ~/test-project
2. cd ~/test-project
3. wget https://github.com/StaffNowa/docker-symfony/releases/download/v2.0.25/d4d_darwin_all.tar.gz
4. tar xzfv d4d_darwin_all.tar.gz && rm d4d_darwin_all.tar.gz
5. ./d4d start

### Login
```
curl -X POST http://symfony.local/api/login \
    -H "Accept: application/json" \
    -H "Content-Type: application/json" \
    -d '{
        "email": "john@example.com",
        "password": "password123"
    }'
```

### Register
```
curl -X POST http://symfony.local/api/register \
    -H "Accept: application/json" \
    -H "Content-Type: application/json" \
    -d '{
        "name": "John Doe",
        "email": "john@example.com",
        "password": "password123",
        "password_confirmation": "password123"
    }'
```

### Logout
```
curl -X POST http://symfony.local/api/logout \
  -H "Accept: application/json" \
  -H "Authorization: Bearer <TOKEN>"
```

### Access protected route (authenticated)
## Retrieve profiling questions
```
curl -X GET http://symfony.local/api/profiling-questions \
    -H "Accept: application/json" \
    -H "Authorization: Bearer <TOKEN>"
```

## Retrieve user wallet
```
curl -X GET http://symfony.local/api/wallet \
    -H "Accept: application/json" \
    -H "Authorization: Bearer <TOKEN>"
```

## Update user's profile
```
curl -X POST http://symfony.local/api/profile \
  -H "Accept: application/json" \
  -H "Authorization: Bearer <TOKEN>" \
  -H "Content-Type: application/json" \
  -d '{"answers": [{"Gender": "Male"}]}'    
```

### How to seed database
1. go to docker container `./d4d exec php`
2. run command `php artisan db:seed`
