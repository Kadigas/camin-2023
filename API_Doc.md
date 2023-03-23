# API Documentation

## ping (GET)

Endpoint:

```txt
/api/ping
```

### Request

Standard header, no body.

### Response

#### 200 OK

Indicator that API endpoint created successfully.

```json
"Pong"
```

## camin (GET)

Endpoint:

```txt
/api/camin
```

### Request

Standard header, no body.

### Response

#### 200 OK

Successfully get all camin data, stored in JSON Array `camins`.

```json
{
    "status": true,
    "camins": [
        {
            "nama": string,
            "angkatan_id": int,
            "nrp": string,
            "jurusan": string
        }
    ]
}
```

## camin/{camins_id} (GET)

Endpoint:

```txt
/api/camin/{camins_id}
```

### Request

Standard header, no body.

### Response

#### 200 OK

Successfully get camin data with inserted id.

```json
{
    "status": true,
    "camin": {
        "nama": string,
        "angkatan_id": int,
        "nrp": string,
        "jurusan": string
    }
}
```

#### 404 Not Found

Camin data with inserted id doesn't exist.

```json
{
    "status": "error",
    "error": "Data camin not found"
}
```

## camin (POST)

Endpoint:

```txt
/api/camin
```

### Request

Standard header with body.

```json
{
    "nama": string,
    "angkatan_id": int,
    "nrp": string,
    "jurusan": string
}
```

### Response

#### 201 Created

Successfully created camin with given data.

```json
{
    "status": true,
    "message": "Camin created"
}
```

#### 400 Bad request

Failed validation in at least one of following fields mentioned below.

```json
{
    "status": "error",
    "error": {
        "nama": [
            "Name can't be empty!"
        ],
        "nrp": [
            "NRP can't be empty!"
        ],
        "jurusan": [
            "Jurusan can't be empty!"
        ],
        "angkatan_id": [
            "Please choose your angkatan"
        ]
    }
}
```

#### 409 Conflict

Conflict in NRP (the NRP inserted already exist).

```json
{
    "status": "error",
    "error": "Conflicting NRP"
}
```

## camins (POST)

Endpoint:

```txt
/api/camins
```

### Request

Standard header with body, able to receive multiple data.

```json
[
    {
        "nama": string,
        "angkatan_id": int,
        "nrp": string,
        "jurusan": string
    },
    {
        "nama": string,
        "angkatan_id": int,
        "nrp": string,
        "jurusan": string
    }
]
```

### Response

#### 200 OK

The API will always respond with `200 OK` with response body contains array of responses respective to the requests:

- 201, Successfully created camin with given data.
- 400, Failed validation in all mentioned error(s) in the respective request.
- 409, Conflict in NRP (the NRP inserted already exist).

example below is a response to a request with 4 data (1 sucessfull, 2 failed validation (with several variations), and 1 conflicting NRP).

```json
[
    [
        201,
        "Camin created"
    ],
    [
        400,
        "Validation failed with error(s): Name can't be empty, NRP can't be empty, Jurusan can't be empty, Please choose your angkatan."
    ],
    [
        400,
        "Validation failed with error(s): NRP can't be empty, Jurusan can't be empty, Please choose your angkatan."
    ],
    [
        409,
        "Camin not created (Conflicting NRP)"
    ]
]
```

## camin/{camins_id} (PUT)

Endpoint:

```txt
/api/camin/{camins_id}
```

### Request

Standard header with body.

```json
{
    "nama": string,
    "angkatan_id": int,
    "nrp": string,
    "jurusan": string
}
```

### Response

#### 201 Created

Successfully update camin data with inserted id.

```json
{
    "status": true,
    "message": "Updated"
}
```

#### 400 Bad Request

Failed validation in at least one of following fields mentioned below.

```json
{
    "status": "error",
    "error": {
        "nama": [
            "Name can't be empty!"
        ],
        "nrp": [
            "NRP can't be empty!"
        ],
        "jurusan": [
            "Jurusan can't be empty!"
        ],
        "angkatan_id": [
            "Please choose your angkatan"
        ]
    }
}
```

#### 404 Not Found

Camin data with inserted id doesn't exist.

```json
{
    "status": "error",
    "error": "Data camin not found"
}
```

#### 409 Conflict

Conflict in NRP (the NRP inserted already exist).

```json
{
    "status": "error",
    "error": "Conflicting NRP"
}
```

## camin/{camins_id} (DELETE)

Endpoint:

```txt
/api/camin/{camins_id}
```

### Request

Standard header, no body.

### Response

#### 200 OK

Successfully deleted camin data with inserted id.

```json
{
    "status": true,
    "message": "deleted"
}
```

#### 404 Not Found

Camin data with inserted id doesn't exist.

```json
{
    "status": "error",
    "error": "Data camin not found"
}
```

## General Error

### 404 Not Found

The API route doesn't exist.

```json
{
    "status": "error",
    "error": "route not found"
}
```

### 405 Method Not Allowed

The method used for a certain API route is not supported.
