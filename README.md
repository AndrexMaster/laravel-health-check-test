API Usage

    Method: GET

    Endpoint: /api/v1/health-check

    Required Header: X-Owner: {uuid}

    Rate Limit: 60 requests per minute.

Response Example (200 OK):
JSON

{
"db": true,
"cache": true
}
