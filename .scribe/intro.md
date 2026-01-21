# Introduction

E-commerce API for managing products, categories, cart, orders, and more.

<aside>
    <strong>Base URL</strong>: <code>http://127.0.0.1:8000</code>
</aside>

    This documentation aims to provide all the information you need to work with our API.

    <aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
    You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>

    ## Authentication

    This API uses **Laravel Sanctum** for authentication. To authenticate, you need to:

    1. Register or login to get an API token
    2. Include the token in subsequent requests using the `Authorization` header:
       ```
       Authorization: Bearer {YOUR_API_TOKEN}
       ```

    Endpoints marked with a 🔒 require authentication.

