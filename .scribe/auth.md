# Authenticating requests

To authenticate requests, include an **`Authorization`** header with the value **`"Bearer {YOUR_API_TOKEN}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

You can retrieve your token by logging in via the <code>/api/login</code> endpoint. The token should be passed in the <code>Authorization</code> header as a Bearer token.
