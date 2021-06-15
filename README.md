
## Backend API Story
### Fitur
- Login
- Create Category
- Update Category
- Create News
- Update News
- Read News

### Cara Install
```bash
# install dependencies
$ composer install

# setting .env
$ php artisan cp .env.example .env

# generate key
$ php artisan key:generate

# migrate database
$ php artisan migrate --seed

# install passport key
$ php artisan passport:install

# run server
$ php artisan serve
```

## Contoh Request

```bash
# Request Login
http://127.0.0.1:8000/api/login

Parameter : 
- email : 'hai@andridesmana.pw'
- password : 'Bismillah'

Method : 
- POST
```

```bash
# Request Account
http://127.0.0.1:8000/api/profile

Headers :
- Authorzation => Bearer Token

Method
- GET
```

```bash
# Request Category
http://127.0.0.1:8000/api/category

Method :
- GET
```

```bash
# Request Category Store
http://127.0.0.1:8000/api/category

Parameter :
- category
- desc 

Method :
- POST

Headers :
- Authorzation => Bearer Token
```

```bash
# Request Category Update
http://127.0.0.1:8000/api/category/{id}

Parameter :
- category
- desc

Method :
- PUT

Headers :
- Authorzation => Bearer Token
```

```bash
# Request Category Show
http://127.0.0.1:8000/api/category/{id}

Headers :
- Authorzation => Bearer Token

Method :
- GET
```

```bash
# Request Delete Category
http://127.0.0.1:8000/api/category/{id}

Headers :
- Authorzation => Bearer Token

Method :
- DELETE
```

```bash
# Request Article
http://127.0.0.1:8000/api/article/

Headers :
- Authorzation => Bearer Token

Method :
- GET
```

```bash
# Request Store Article
http://127.0.0.1:8000/api/article

Parameter :
- title
- body
- category_id

Method :
- POST

Headers :
- Authorzation => Bearer Token
```

```bash
# Request Update Article
http://127.0.0.1:8000/api/news/{slug}

Parameter :
- title
- body
- category_id

Method :
- PUT

Headers :
- Authorzation => Bearer Token
```

```bash
# Request Show News
http://127.0.0.1:8000/api/news/{slug}

Parameter :
- title
- body
- category_id

Method :
- GET
```
## Code for Frontend

Frontend dibagun dengan Nuxt Js, [clone repo](https://github.com/andes2912/story_frontend).

