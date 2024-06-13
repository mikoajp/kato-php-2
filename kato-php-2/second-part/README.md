PHP App
========

You need to have PHP-cli installed on your computer with composer.

1. Create a Symfony 6 project inside `new-symfony-app` folder

2. Create a single `ApiController` with one method that:

    1. will accept a JSON body request.
    2. create a dedicated dto to show the BODY request structure.
    3. will return `message` parameter from JSON request with cut string to only `hello` and `text`.
    4. count how many times above words matched the pattern.
    5. please add e2e tests as well as unit tests to cover behaviour.

Below request and response that should be used:

JSON request

```json
{
  "message": "hello very long text hello"
}
```

JSON response

```json
{
  "message": "hello text",
  "count": {
    "hello": 2,
    "text": 1
  }
}
```