<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
                    body .content .php-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://127.0.0.1:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.6.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.6.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                            <button type="button" class="lang-button" data-language-name="php">php</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-GETapi-user">
                                <a href="#authentication-GETapi-user">Get authenticated user

Retrieve the currently authenticated user's information.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-register">
                                <a href="#authentication-POSTapi-register">Register a new user

Create a new user account and receive an API token.
If the user has items in their guest cart, they will be migrated to the new account.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-login">
                                <a href="#authentication-POSTapi-login">Login

Authenticate a user and receive an API token.
If the user has items in their guest cart, they will be migrated to their account.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-logout">
                                <a href="#authentication-POSTapi-logout">Logout

Invalidate the current API token and log out the user.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-products" class="tocify-header">
                <li class="tocify-item level-1" data-unique="products">
                    <a href="#products">Products</a>
                </li>
                                    <ul id="tocify-subheader-products" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="products-GETapi-products">
                                <a href="#products-GETapi-products">List all products</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="products-GETapi-products--product_id-">
                                <a href="#products-GETapi-products--product_id-">Get product details</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-categories" class="tocify-header">
                <li class="tocify-item level-1" data-unique="categories">
                    <a href="#categories">Categories</a>
                </li>
                                    <ul id="tocify-subheader-categories" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="categories-GETapi-categories">
                                <a href="#categories-GETapi-categories">List all categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-GETapi-categories--category_id-">
                                <a href="#categories-GETapi-categories--category_id-">Get category details</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-cart" class="tocify-header">
                <li class="tocify-item level-1" data-unique="cart">
                    <a href="#cart">Cart</a>
                </li>
                                    <ul id="tocify-subheader-cart" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="cart-GETapi-cart">
                                <a href="#cart-GETapi-cart">Get cart items</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cart-POSTapi-cart-add">
                                <a href="#cart-POSTapi-cart-add">Add item to cart</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cart-PUTapi-cart--productId-">
                                <a href="#cart-PUTapi-cart--productId-">Update cart item quantity</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cart-DELETEapi-cart--productId-">
                                <a href="#cart-DELETEapi-cart--productId-">Remove item from cart</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cart-DELETEapi-cart">
                                <a href="#cart-DELETEapi-cart">Clear cart</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cart-GETapi-cart-summary">
                                <a href="#cart-GETapi-cart-summary">Get cart summary</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cart-GETapi-cart-count">
                                <a href="#cart-GETapi-cart-count">Get cart item count</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-checkout" class="tocify-header">
                <li class="tocify-item level-1" data-unique="checkout">
                    <a href="#checkout">Checkout</a>
                </li>
                                    <ul id="tocify-subheader-checkout" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="checkout-POSTapi-checkout-initiate">
                                <a href="#checkout-POSTapi-checkout-initiate">Initiate checkout</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="checkout-GETapi-checkout-complete">
                                <a href="#checkout-GETapi-checkout-complete">Complete checkout</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="checkout-GETapi-checkout-fail">
                                <a href="#checkout-GETapi-checkout-fail">Handle checkout failure</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="checkout-GETapi-checkout-status">
                                <a href="#checkout-GETapi-checkout-status">Get checkout status</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="checkout-POSTapi-checkout-test-complete">
                                <a href="#checkout-POSTapi-checkout-test-complete">Test checkout completion</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-orders" class="tocify-header">
                <li class="tocify-item level-1" data-unique="orders">
                    <a href="#orders">Orders</a>
                </li>
                                    <ul id="tocify-subheader-orders" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="orders-GETapi-orders">
                                <a href="#orders-GETapi-orders">List all orders</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="orders-POSTapi-orders">
                                <a href="#orders-POSTapi-orders">Create order (Deprecated)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="orders-GETapi-orders--order_id-">
                                <a href="#orders-GETapi-orders--order_id-">Get order details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="orders-PATCHapi-orders--order_id--status">
                                <a href="#orders-PATCHapi-orders--order_id--status">Update order status</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="orders-POSTapi-orders--order_id--cancel">
                                <a href="#orders-POSTapi-orders--order_id--cancel">Cancel order</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-wishlist" class="tocify-header">
                <li class="tocify-item level-1" data-unique="wishlist">
                    <a href="#wishlist">Wishlist</a>
                </li>
                                    <ul id="tocify-subheader-wishlist" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="wishlist-GETapi-wishlist">
                                <a href="#wishlist-GETapi-wishlist">List wishlist items</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="wishlist-POSTapi-wishlist">
                                <a href="#wishlist-POSTapi-wishlist">Add to wishlist</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="wishlist-DELETEapi-wishlist--productId-">
                                <a href="#wishlist-DELETEapi-wishlist--productId-">Remove from wishlist</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="wishlist-GETapi-wishlist-check--productId-">
                                <a href="#wishlist-GETapi-wishlist-check--productId-">Check if in wishlist</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="wishlist-DELETEapi-wishlist">
                                <a href="#wishlist-DELETEapi-wishlist">Clear wishlist</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-contact-us">
                                <a href="#endpoints-GETapi-contact-us">GET api/contact-us</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-addresses">
                                <a href="#endpoints-GETapi-addresses">Display a listing of the user's addresses.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-addresses">
                                <a href="#endpoints-POSTapi-addresses">Store a newly created address.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-addresses--address_id-">
                                <a href="#endpoints-GETapi-addresses--address_id-">Display the specified address.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-addresses--address_id-">
                                <a href="#endpoints-PUTapi-addresses--address_id-">Update the specified address.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-addresses--address_id-">
                                <a href="#endpoints-DELETEapi-addresses--address_id-">Remove the specified address.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PATCHapi-addresses--address_id--default">
                                <a href="#endpoints-PATCHapi-addresses--address_id--default">Set an address as default.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-contact-inquiries">
                                <a href="#endpoints-GETapi-contact-inquiries">Display a listing of contact inquiries.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-contact-inquiries">
                                <a href="#endpoints-POSTapi-contact-inquiries">Store a newly created contact inquiry in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-contact-inquiries--inquiry_id-">
                                <a href="#endpoints-GETapi-contact-inquiries--inquiry_id-">Display the specified contact inquiry.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-contact-inquiries--inquiry_id-">
                                <a href="#endpoints-PUTapi-contact-inquiries--inquiry_id-">Update the specified contact inquiry in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PATCHapi-contact-inquiries--inquiry_id-">
                                <a href="#endpoints-PATCHapi-contact-inquiries--inquiry_id-">Partially update the specified contact inquiry in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-contact-inquiries--inquiry_id--reply">
                                <a href="#endpoints-POSTapi-contact-inquiries--inquiry_id--reply">Reply to a contact inquiry.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-contact-inquiries--inquiry_id-">
                                <a href="#endpoints-DELETEapi-contact-inquiries--inquiry_id-">Remove the specified contact inquiry from storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-payment-process">
                                <a href="#endpoints-POSTapi-payment-process">Process payment and return payment key/iframe URL</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-payment-callback">
                                <a href="#endpoints-GETapi-payment-callback">Handle payment callback from Paymob</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-payment-webhook">
                                <a href="#endpoints-POSTapi-payment-webhook">Handle payment webhook from Paymob</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-shipments">
                                <a href="#endpoints-POSTapi-shipments">POST api/shipments</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-shipments--tracking_number-">
                                <a href="#endpoints-GETapi-shipments--tracking_number-">GET api/shipments/{tracking_number}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-shipments--tracking_number-">
                                <a href="#endpoints-PUTapi-shipments--tracking_number-">PUT api/shipments/{tracking_number}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-pickups">
                                <a href="#endpoints-POSTapi-pickups">POST api/pickups</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-webhook-bosta">
                                <a href="#endpoints-POSTapi-webhook-bosta">POST api/webhook/bosta</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-test-webhook-bosta">
                                <a href="#endpoints-POSTapi-test-webhook-bosta">Test webhook endpoint for development</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-settings-env">
                                <a href="#endpoints-POSTapi-settings-env">POST api/settings/env</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-settings-env-debug">
                                <a href="#endpoints-GETapi-settings-env-debug">GET api/settings/env/debug</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: January 21, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>E-commerce API for managing products, categories, cart, orders, and more.</p>
<aside>
    <strong>Base URL</strong>: <code>http://127.0.0.1:8000</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;

## Authentication

This API uses **Laravel Sanctum** for authentication. To authenticate, you need to:

1. Register or login to get an API token
2. Include the token in subsequent requests using the `Authorization` header:
   ```
   Authorization: Bearer {YOUR_API_TOKEN}
   ```

Endpoints marked with a 🔒 require authentication.</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_API_TOKEN}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by logging in via the <code>/api/login</code> endpoint. The token should be passed in the <code>Authorization</code> header as a Bearer token.</p>

        <h1 id="authentication">Authentication</h1>

    

                                <h2 id="authentication-GETapi-user">Get authenticated user

Retrieve the currently authenticated user&#039;s information.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/user" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/user"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/user';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;name&quot;: &quot;John Doe&quot;,
    &quot;email&quot;: &quot;john@example.com&quot;,
    &quot;email_verified_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
    &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-user"
               value="Bearer {YOUR_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentication-POSTapi-register">Register a new user

Create a new user account and receive an API token.
If the user has items in their guest cart, they will be migrated to the new account.</h2>

<p>
</p>



<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"John Doe\",
    \"email\": \"john@example.com\",
    \"password\": \"password123\",
    \"password_confirmation\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/register';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'John Doe',
            'email' =&gt; 'john@example.com',
            'password' =&gt; 'password123',
            'password_confirmation' =&gt; 'password123',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;John Doe&quot;,
        &quot;email&quot;: &quot;john@example.com&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
        &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
    },
    &quot;token&quot;: &quot;1|abc123def456...&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The email has already been taken.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The email has already been taken.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-register"
               value="John Doe"
               data-component="body">
    <br>
<p>The user's full name. Example: <code>John Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-register"
               value="john@example.com"
               data-component="body">
    <br>
<p>The user's email address (must be unique). Example: <code>john@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-register"
               value="password123"
               data-component="body">
    <br>
<p>The password (minimum 8 characters). Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-register"
               value="password123"
               data-component="body">
    <br>
<p>Password confirmation (must match password). Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-login">Login

Authenticate a user and receive an API token.
If the user has items in their guest cart, they will be migrated to their account.</h2>

<p>
</p>



<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"john@example.com\",
    \"password\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "john@example.com",
    "password": "password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/login';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'john@example.com',
            'password' =&gt; 'password123',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;John Doe&quot;,
        &quot;email&quot;: &quot;john@example.com&quot;,
        &quot;email_verified_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
        &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
    },
    &quot;token&quot;: &quot;1|abc123def456...&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Invalid Credentials):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invalid credentials&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The email field is required.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The email field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-login"
               value="john@example.com"
               data-component="body">
    <br>
<p>The user's email address. Example: <code>john@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-login"
               value="password123"
               data-component="body">
    <br>
<p>The user's password. Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-logout">Logout

Invalidate the current API token and log out the user.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/logout" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/logout"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/logout';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Logged out successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logout"
                    onclick="tryItOut('POSTapi-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logout"
                    onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-logout"
               value="Bearer {YOUR_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="products">Products</h1>

    <p>APIs for browsing and managing products.</p>
<p>Public endpoints for listing and viewing products do not require authentication.
Admin endpoints for creating, updating, and deleting products require authentication.</p>

                                <h2 id="products-GETapi-products">List all products</h2>

<p>
</p>

<p>Get a paginated list of all active products with optional filtering, searching, and sorting.
Returns product data in both English and Arabic.</p>

<span id="example-requests-GETapi-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/products?category_id=1&amp;search=coffee&amp;sort_by=price&amp;sort_direction=desc&amp;per_page=10" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/products"
);

const params = {
    "category_id": "1",
    "search": "coffee",
    "sort_by": "price",
    "sort_direction": "desc",
    "per_page": "10",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/products';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'category_id' =&gt; '1',
            'search' =&gt; 'coffee',
            'sort_by' =&gt; 'price',
            'sort_direction' =&gt; 'desc',
            'per_page' =&gt; '10',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-products">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;en&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Premium Coffee Beans&quot;,
                &quot;description&quot;: &quot;High-quality arabica coffee beans&quot;,
                &quot;price&quot;: 25,
                &quot;cost&quot;: 15,
                &quot;stock&quot;: 100,
                &quot;sku&quot;: &quot;COF-001&quot;,
                &quot;category_id&quot;: 1,
                &quot;is_active&quot;: true,
                &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
                &quot;grind_type&quot;: {
                    &quot;en&quot;: &quot;Whole Bean&quot;,
                    &quot;ar&quot;: &quot;حبوب كاملة&quot;
                },
                &quot;weight&quot;: 0.5,
                &quot;weight_label&quot;: &quot;500g&quot;,
                &quot;product_details&quot;: [
                    {
                        &quot;title&quot;: &quot;Origin&quot;,
                        &quot;value&quot;: &quot;Ethiopia&quot;
                    },
                    {
                        &quot;title&quot;: &quot;Roast Level&quot;,
                        &quot;value&quot;: &quot;Medium&quot;
                    }
                ],
                &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;images&quot;: [
                    {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;coffee-beans-front&quot;,
                        &quot;file_name&quot;: &quot;coffee-beans-front.jpg&quot;,
                        &quot;mime_type&quot;: &quot;image/jpeg&quot;,
                        &quot;size&quot;: 102400,
                        &quot;url&quot;: &quot;https://example.com/storage/products/coffee-beans-front.jpg&quot;
                    }
                ]
            }
        ],
        &quot;ar&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;حبوب قهوة ممتازة&quot;,
                &quot;description&quot;: &quot;حبوب قهوة أرابيكا عالية الجودة&quot;,
                &quot;price&quot;: 25,
                &quot;cost&quot;: 15,
                &quot;stock&quot;: 100,
                &quot;sku&quot;: &quot;COF-001&quot;,
                &quot;category_id&quot;: 1,
                &quot;is_active&quot;: true,
                &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
                &quot;grind_type&quot;: {
                    &quot;en&quot;: &quot;Whole Bean&quot;,
                    &quot;ar&quot;: &quot;حبوب كاملة&quot;
                },
                &quot;weight&quot;: 0.5,
                &quot;weight_label&quot;: &quot;500g&quot;,
                &quot;product_details&quot;: [
                    {
                        &quot;title&quot;: &quot;المنشأ&quot;,
                        &quot;value&quot;: &quot;إثيوبيا&quot;
                    },
                    {
                        &quot;title&quot;: &quot;درجة التحميص&quot;,
                        &quot;value&quot;: &quot;متوسط&quot;
                    }
                ],
                &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;images&quot;: [
                    {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;coffee-beans-front&quot;,
                        &quot;file_name&quot;: &quot;coffee-beans-front.jpg&quot;,
                        &quot;mime_type&quot;: &quot;image/jpeg&quot;,
                        &quot;size&quot;: 102400,
                        &quot;url&quot;: &quot;https://example.com/storage/products/coffee-beans-front.jpg&quot;
                    }
                ]
            }
        ],
        &quot;pagination&quot;: {
            &quot;current_page&quot;: 1,
            &quot;last_page&quot;: 5,
            &quot;per_page&quot;: 15,
            &quot;total&quot;: 75
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-products" data-method="GET"
      data-path="api/products"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products"
                    onclick="tryItOut('GETapi-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products"
                    onclick="cancelTryOut('GETapi-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="GETapi-products"
               value="1"
               data-component="query">
    <br>
<p>Filter products by category ID. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-products"
               value="coffee"
               data-component="query">
    <br>
<p>Search products by name or description. Example: <code>coffee</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_by</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_by"                data-endpoint="GETapi-products"
               value="price"
               data-component="query">
    <br>
<p>Sort field (price, name, created_at). Example: <code>price</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_direction</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_direction"                data-endpoint="GETapi-products"
               value="desc"
               data-component="query">
    <br>
<p>Sort direction (asc, desc). Default: asc. Example: <code>desc</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-products"
               value="10"
               data-component="query">
    <br>
<p>Number of items per page. Default: 15. Example: <code>10</code></p>
            </div>
                </form>

                    <h2 id="products-GETapi-products--product_id-">Get product details</h2>

<p>
</p>

<p>Retrieve detailed information about a specific product.
Returns product data in both English and Arabic.</p>

<span id="example-requests-GETapi-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/products/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/products/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-products--product_id-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;en&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Premium Coffee Beans&quot;,
            &quot;description&quot;: &quot;High-quality arabica coffee beans&quot;,
            &quot;price&quot;: 25,
            &quot;cost&quot;: 15,
            &quot;stock&quot;: 100,
            &quot;sku&quot;: &quot;COF-001&quot;,
            &quot;category_id&quot;: 1,
            &quot;is_active&quot;: true,
            &quot;grind_type&quot;: &quot;whole_bean&quot;,
            &quot;grind_type_label&quot;: &quot;Whole Bean&quot;,
            &quot;weight&quot;: 0.5,
            &quot;weight_label&quot;: &quot;500g&quot;,
            &quot;product_details&quot;: [
                {
                    &quot;title&quot;: &quot;Origin&quot;,
                    &quot;value&quot;: &quot;Ethiopia&quot;
                },
                {
                    &quot;title&quot;: &quot;Roast Level&quot;,
                    &quot;value&quot;: &quot;Medium&quot;
                }
            ],
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Coffee Beans&quot;,
                &quot;slug&quot;: &quot;coffee-beans&quot;
            },
            &quot;images&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;coffee-beans-front&quot;,
                    &quot;file_name&quot;: &quot;coffee-beans-front.jpg&quot;,
                    &quot;mime_type&quot;: &quot;image/jpeg&quot;,
                    &quot;size&quot;: 102400,
                    &quot;url&quot;: &quot;https://example.com/storage/products/coffee-beans-front.jpg&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
        },
        &quot;ar&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;حبوب قهوة ممتازة&quot;,
            &quot;description&quot;: &quot;حبوب قهوة أرابيكا عالية الجودة&quot;,
            &quot;price&quot;: 25,
            &quot;cost&quot;: 15,
            &quot;stock&quot;: 100,
            &quot;sku&quot;: &quot;COF-001&quot;,
            &quot;category_id&quot;: 1,
            &quot;is_active&quot;: true,
            &quot;grind_type_label&quot;: &quot;حبوب كاملة&quot;,
            &quot;weight&quot;: 0.5,
            &quot;weight_label&quot;: &quot;500g&quot;,
            &quot;product_details&quot;: [
                {
                    &quot;title&quot;: &quot;المنشأ&quot;,
                    &quot;value&quot;: &quot;إثيوبيا&quot;
                },
                {
                    &quot;title&quot;: &quot;درجة التحميص&quot;,
                    &quot;value&quot;: &quot;متوسط&quot;
                }
            ],
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;حبوب القهوة&quot;,
                &quot;slug&quot;: &quot;coffee-beans&quot;
            },
            &quot;images&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;coffee-beans-front&quot;,
                    &quot;file_name&quot;: &quot;coffee-beans-front.jpg&quot;,
                    &quot;mime_type&quot;: &quot;image/jpeg&quot;,
                    &quot;size&quot;: 102400,
                    &quot;url&quot;: &quot;https://example.com/storage/products/coffee-beans-front.jpg&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Product not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-products--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-products--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-products--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-products--product_id-" data-method="GET"
      data-path="api/products/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products--product_id-"
                    onclick="tryItOut('GETapi-products--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products--product_id-"
                    onclick="cancelTryOut('GETapi-products--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="GETapi-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product"                data-endpoint="GETapi-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The product ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="categories">Categories</h1>

    <p>APIs for browsing and managing product categories.</p>
<p>Public endpoints for listing and viewing categories do not require authentication.
Admin endpoints for creating, updating, and deleting categories require authentication.</p>

                                <h2 id="categories-GETapi-categories">List all categories</h2>

<p>
</p>

<p>Get a paginated list of all active categories with optional filtering and sorting.
Returns category data in both English and Arabic.</p>

<span id="example-requests-GETapi-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/categories?search=coffee&amp;sort_by=name&amp;sort_direction=desc&amp;per_page=10" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/categories"
);

const params = {
    "search": "coffee",
    "sort_by": "name",
    "sort_direction": "desc",
    "per_page": "10",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/categories';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'search' =&gt; 'coffee',
            'sort_by' =&gt; 'name',
            'sort_direction' =&gt; 'desc',
            'per_page' =&gt; '10',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-categories">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;en&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Coffee Beans&quot;,
                &quot;description&quot;: &quot;Premium coffee beans from around the world&quot;,
                &quot;slug&quot;: &quot;coffee-beans&quot;,
                &quot;is_active&quot;: true,
                &quot;product_count&quot;: 15,
                &quot;image_url&quot;: &quot;https://example.com/images/coffee-beans.jpg&quot;
            }
        ],
        &quot;ar&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;حبوب القهوة&quot;,
                &quot;description&quot;: &quot;حبوب قهوة ممتازة من جميع أنحاء العالم&quot;,
                &quot;slug&quot;: &quot;coffee-beans&quot;,
                &quot;is_active&quot;: true,
                &quot;product_count&quot;: 15,
                &quot;image_url&quot;: &quot;https://example.com/images/coffee-beans.jpg&quot;
            }
        ]
    },
    &quot;pagination&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 3,
        &quot;per_page&quot;: 15,
        &quot;total&quot;: 45
    },
    &quot;meta&quot;: {
        &quot;total_categories&quot;: 45,
        &quot;active_categories&quot;: 42
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-categories" data-method="GET"
      data-path="api/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-categories"
                    onclick="tryItOut('GETapi-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-categories"
                    onclick="cancelTryOut('GETapi-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-categories"
               value="coffee"
               data-component="query">
    <br>
<p>Search categories by name or description. Example: <code>coffee</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_by</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_by"                data-endpoint="GETapi-categories"
               value="name"
               data-component="query">
    <br>
<p>Sort field (name, created_at). Example: <code>name</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_direction</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_direction"                data-endpoint="GETapi-categories"
               value="desc"
               data-component="query">
    <br>
<p>Sort direction (asc, desc). Default: asc. Example: <code>desc</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-categories"
               value="10"
               data-component="query">
    <br>
<p>Number of items per page. Default: 15. Example: <code>10</code></p>
            </div>
                </form>

                    <h2 id="categories-GETapi-categories--category_id-">Get category details</h2>

<p>
</p>

<p>Retrieve detailed information about a specific active category including related products.
Returns data in both English and Arabic.</p>

<span id="example-requests-GETapi-categories--category_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/categories/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-categories--category_id-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;en&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Coffee Beans&quot;,
            &quot;description&quot;: &quot;Premium coffee beans from around the world&quot;,
            &quot;slug&quot;: &quot;coffee-beans&quot;,
            &quot;is_active&quot;: true,
            &quot;product_count&quot;: 15,
            &quot;image_url&quot;: &quot;https://example.com/images/coffee-beans.jpg&quot;,
            &quot;products&quot;: [
                {
                    &quot;en&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Premium Coffee Beans&quot;,
                        &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
                        &quot;price&quot;: 25,
                        &quot;stock&quot;: 100,
                        &quot;sku&quot;: &quot;COF-001&quot;,
                        &quot;is_active&quot;: true,
                        &quot;image_url&quot;: &quot;https://example.com/images/product.jpg&quot;
                    },
                    &quot;ar&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;حبوب قهوة ممتازة&quot;,
                        &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
                        &quot;price&quot;: 25,
                        &quot;stock&quot;: 100,
                        &quot;sku&quot;: &quot;COF-001&quot;,
                        &quot;is_active&quot;: true,
                        &quot;image_url&quot;: &quot;https://example.com/images/product.jpg&quot;
                    }
                }
            ]
        },
        &quot;ar&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;حبوب القهوة&quot;,
            &quot;description&quot;: &quot;حبوب قهوة ممتازة من جميع أنحاء العالم&quot;,
            &quot;slug&quot;: &quot;coffee-beans&quot;,
            &quot;is_active&quot;: true,
            &quot;product_count&quot;: 15,
            &quot;image_url&quot;: &quot;https://example.com/images/coffee-beans.jpg&quot;,
            &quot;products&quot;: [
                {
                    &quot;en&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Premium Coffee Beans&quot;,
                        &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
                        &quot;price&quot;: 25,
                        &quot;stock&quot;: 100,
                        &quot;sku&quot;: &quot;COF-001&quot;,
                        &quot;is_active&quot;: true,
                        &quot;image_url&quot;: &quot;https://example.com/images/product.jpg&quot;
                    },
                    &quot;ar&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;حبوب قهوة ممتازة&quot;,
                        &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
                        &quot;price&quot;: 25,
                        &quot;stock&quot;: 100,
                        &quot;sku&quot;: &quot;COF-001&quot;,
                        &quot;is_active&quot;: true,
                        &quot;image_url&quot;: &quot;https://example.com/images/product.jpg&quot;
                    }
                }
            ]
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Category not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-categories--category_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-categories--category_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-categories--category_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-categories--category_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-categories--category_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-categories--category_id-" data-method="GET"
      data-path="api/categories/{category_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-categories--category_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-categories--category_id-"
                    onclick="tryItOut('GETapi-categories--category_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-categories--category_id-"
                    onclick="cancelTryOut('GETapi-categories--category_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-categories--category_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/categories/{category_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="GETapi-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category"                data-endpoint="GETapi-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The category ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="cart">Cart</h1>

    <p>APIs for managing the shopping cart.</p>
<p>The cart system supports both guest users (session-based) and authenticated users (database-based).
When a guest user logs in, their session cart is automatically migrated to their user account.</p>

                                <h2 id="cart-GETapi-cart">Get cart items</h2>

<p>
</p>

<p>Retrieve all items in the user's cart with localized product information.
Works for both guest and authenticated users.</p>

<span id="example-requests-GETapi-cart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/cart" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/cart"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/cart';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-cart">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;en&quot;: {
            &quot;items&quot;: [
                {
                    &quot;product_id&quot;: 1,
                    &quot;name&quot;: &quot;Premium Coffee&quot;,
                    &quot;price&quot;: 25,
                    &quot;quantity&quot;: 2,
                    &quot;subtotal&quot;: 50,
                    &quot;image_url&quot;: &quot;https://example.com/images/coffee.jpg&quot;
                }
            ],
            &quot;count&quot;: 2
        },
        &quot;ar&quot;: {
            &quot;items&quot;: [
                {
                    &quot;product_id&quot;: 1,
                    &quot;name&quot;: &quot;قهوة ممتازة&quot;,
                    &quot;price&quot;: 25,
                    &quot;quantity&quot;: 2,
                    &quot;subtotal&quot;: 50,
                    &quot;image_url&quot;: &quot;https://example.com/images/coffee.jpg&quot;
                }
            ],
            &quot;count&quot;: 2
        },
        &quot;summary&quot;: {
            &quot;subtotal&quot;: 50,
            &quot;tax&quot;: 5,
            &quot;shipping&quot;: 10,
            &quot;total&quot;: 65
        },
        &quot;is_guest&quot;: false
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-cart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-cart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-cart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-cart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-cart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-cart" data-method="GET"
      data-path="api/cart"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-cart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-cart"
                    onclick="tryItOut('GETapi-cart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-cart"
                    onclick="cancelTryOut('GETapi-cart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-cart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/cart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="cart-POSTapi-cart-add">Add item to cart</h2>

<p>
</p>

<p>Add a product to the shopping cart. If the product already exists in the cart,
the quantity will be increased. Works for both guest and authenticated users.</p>

<span id="example-requests-POSTapi-cart-add">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/cart/add" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"product_id\": 1,
    \"quantity\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/cart/add"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "product_id": 1,
    "quantity": 2
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/cart/add';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'product_id' =&gt; 1,
            'quantity' =&gt; 2,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-cart-add">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Item added to cart&quot;,
    &quot;cart_summary&quot;: {
        &quot;subtotal&quot;: 50,
        &quot;tax&quot;: 5,
        &quot;shipping&quot;: 10,
        &quot;total&quot;: 65,
        &quot;item_count&quot;: 2
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The product id field is required.&quot;,
    &quot;errors&quot;: {
        &quot;product_id&quot;: [
            &quot;The product id field is required.&quot;
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Out of Stock):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Product is out of stock.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-cart-add" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-cart-add"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-cart-add"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-cart-add" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-cart-add">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-cart-add" data-method="POST"
      data-path="api/cart/add"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-cart-add', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-cart-add"
                    onclick="tryItOut('POSTapi-cart-add');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-cart-add"
                    onclick="cancelTryOut('POSTapi-cart-add');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-cart-add"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/cart/add</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-cart-add"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-cart-add"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="POSTapi-cart-add"
               value="1"
               data-component="body">
    <br>
<p>The ID of the product to add. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quantity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="quantity"                data-endpoint="POSTapi-cart-add"
               value="2"
               data-component="body">
    <br>
<p>The quantity to add (minimum 1). Example: <code>2</code></p>
        </div>
        </form>

                    <h2 id="cart-PUTapi-cart--productId-">Update cart item quantity</h2>

<p>
</p>

<p>Update the quantity of a specific item in the cart.
Setting quantity to 0 will remove the item from the cart.
Works for both guest and authenticated users.</p>

<span id="example-requests-PUTapi-cart--productId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/cart/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"quantity\": 3
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/cart/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "quantity": 3
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/cart/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'quantity' =&gt; 3,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-PUTapi-cart--productId-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Cart updated&quot;,
    &quot;cart_summary&quot;: {
        &quot;subtotal&quot;: 75,
        &quot;tax&quot;: 7.5,
        &quot;shipping&quot;: 10,
        &quot;total&quot;: 92.5,
        &quot;item_count&quot;: 3
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Product Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Product not found&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Insufficient Stock):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Requested quantity exceeds available stock.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-cart--productId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-cart--productId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-cart--productId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-cart--productId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-cart--productId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-cart--productId-" data-method="PUT"
      data-path="api/cart/{productId}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-cart--productId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-cart--productId-"
                    onclick="tryItOut('PUTapi-cart--productId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-cart--productId-"
                    onclick="cancelTryOut('PUTapi-cart--productId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-cart--productId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/cart/{productId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-cart--productId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-cart--productId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>productId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="productId"                data-endpoint="PUTapi-cart--productId-"
               value="1"
               data-component="url">
    <br>
<p>The product ID to update. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quantity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="quantity"                data-endpoint="PUTapi-cart--productId-"
               value="3"
               data-component="body">
    <br>
<p>The new quantity (0 to remove). Example: <code>3</code></p>
        </div>
        </form>

                    <h2 id="cart-DELETEapi-cart--productId-">Remove item from cart</h2>

<p>
</p>

<p>Remove a specific product from the shopping cart.
Works for both guest and authenticated users.</p>

<span id="example-requests-DELETEapi-cart--productId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/cart/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/cart/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/cart/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-DELETEapi-cart--productId-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Item removed from cart&quot;,
    &quot;cart_summary&quot;: {
        &quot;subtotal&quot;: 25,
        &quot;tax&quot;: 2.5,
        &quot;shipping&quot;: 10,
        &quot;total&quot;: 37.5,
        &quot;item_count&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-cart--productId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-cart--productId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-cart--productId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-cart--productId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-cart--productId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-cart--productId-" data-method="DELETE"
      data-path="api/cart/{productId}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-cart--productId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-cart--productId-"
                    onclick="tryItOut('DELETEapi-cart--productId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-cart--productId-"
                    onclick="cancelTryOut('DELETEapi-cart--productId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-cart--productId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/cart/{productId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-cart--productId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-cart--productId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>productId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="productId"                data-endpoint="DELETEapi-cart--productId-"
               value="1"
               data-component="url">
    <br>
<p>The product ID to remove. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="cart-DELETEapi-cart">Clear cart</h2>

<p>
</p>

<p>Remove all items from the shopping cart.
Works for both guest and authenticated users.</p>

<span id="example-requests-DELETEapi-cart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/cart" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/cart"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/cart';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-DELETEapi-cart">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Cart cleared&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-cart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-cart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-cart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-cart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-cart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-cart" data-method="DELETE"
      data-path="api/cart"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-cart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-cart"
                    onclick="tryItOut('DELETEapi-cart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-cart"
                    onclick="cancelTryOut('DELETEapi-cart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-cart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/cart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="cart-GETapi-cart-summary">Get cart summary</h2>

<p>
</p>

<p>Get a summary of the cart including subtotal, tax, shipping, and total.
Works for both guest and authenticated users.</p>

<span id="example-requests-GETapi-cart-summary">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/cart/summary" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/cart/summary"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/cart/summary';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-cart-summary">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;subtotal&quot;: 100,
        &quot;tax&quot;: 10,
        &quot;shipping&quot;: 15,
        &quot;total&quot;: 125,
        &quot;item_count&quot;: 4,
        &quot;discount&quot;: 0
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-cart-summary" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-cart-summary"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-cart-summary"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-cart-summary" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-cart-summary">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-cart-summary" data-method="GET"
      data-path="api/cart/summary"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-cart-summary', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-cart-summary"
                    onclick="tryItOut('GETapi-cart-summary');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-cart-summary"
                    onclick="cancelTryOut('GETapi-cart-summary');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-cart-summary"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/cart/summary</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-cart-summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-cart-summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="cart-GETapi-cart-count">Get cart item count</h2>

<p>
</p>

<p>Get the total number of items in the cart and check if it's empty.
Useful for displaying cart badge counts in the UI.
Works for both guest and authenticated users.</p>

<span id="example-requests-GETapi-cart-count">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/cart/count" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/cart/count"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/cart/count';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-cart-count">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;item_count&quot;: 3,
        &quot;is_empty&quot;: false,
        &quot;is_guest&quot;: true
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Empty Cart):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;item_count&quot;: 0,
        &quot;is_empty&quot;: true,
        &quot;is_guest&quot;: false
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-cart-count" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-cart-count"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-cart-count"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-cart-count" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-cart-count">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-cart-count" data-method="GET"
      data-path="api/cart/count"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-cart-count', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-cart-count"
                    onclick="tryItOut('GETapi-cart-count');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-cart-count"
                    onclick="cancelTryOut('GETapi-cart-count');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-cart-count"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/cart/count</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-cart-count"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-cart-count"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="checkout">Checkout</h1>

    <p>APIs for the checkout process.</p>
<p>The checkout flow consists of:</p>
<ol>
<li><strong>Initiate checkout</strong> - Validates cart, creates shipment with Bosta, initiates payment with Paymob, and returns payment URL</li>
<li><strong>Payment processing</strong> - Customer completes payment on Paymob iframe</li>
<li><strong>Complete callback</strong> - Called after successful payment to create the final order</li>
<li><strong>Fail callback</strong> - Called if payment fails, cleans up pending data</li>
</ol>
<p>Supports both guest checkout and authenticated user checkout.
Guest carts are session-based and migrate to user account upon login.</p>

                                <h2 id="checkout-POSTapi-checkout-initiate">Initiate checkout</h2>

<p>
</p>

<p>Start the checkout process by validating the cart, creating a shipment with Bosta,
initiating payment with Paymob, and returning the payment iframe URL.
Supports both guest and authenticated users.</p>
<p>The checkout creates a pending checkout record that expires after 24 hours.
Once payment is completed, the pending checkout is converted to a real order.</p>

<span id="example-requests-POSTapi-checkout-initiate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/checkout/initiate" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"shipping_address_id\": 1,
    \"billing_address_id\": 1,
    \"shipping_address\": {
        \"street\": \"123 Main St\",
        \"city\": \"Cairo\",
        \"zip_code\": \"12345\",
        \"country\": \"Egypt\",
        \"building_number\": \"15\",
        \"floor\": \"3\",
        \"apartment\": \"5A\",
        \"zone\": \"Maadi\"
    },
    \"billing_address\": {
        \"first_name\": \"John\",
        \"last_name\": \"Doe\",
        \"email\": \"john@example.com\",
        \"phone\": \"+201234567890\",
        \"street\": \"123 Main St\",
        \"city\": \"Cairo\",
        \"zip_code\": \"12345\",
        \"country\": \"Egypt\",
        \"floor\": \"3\",
        \"apartment\": \"5A\"
    },
    \"notes\": \"Please deliver in the morning\",
    \"user_id\": 16
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/checkout/initiate"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "shipping_address_id": 1,
    "billing_address_id": 1,
    "shipping_address": {
        "street": "123 Main St",
        "city": "Cairo",
        "zip_code": "12345",
        "country": "Egypt",
        "building_number": "15",
        "floor": "3",
        "apartment": "5A",
        "zone": "Maadi"
    },
    "billing_address": {
        "first_name": "John",
        "last_name": "Doe",
        "email": "john@example.com",
        "phone": "+201234567890",
        "street": "123 Main St",
        "city": "Cairo",
        "zip_code": "12345",
        "country": "Egypt",
        "floor": "3",
        "apartment": "5A"
    },
    "notes": "Please deliver in the morning",
    "user_id": 16
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/checkout/initiate';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'shipping_address_id' =&gt; 1,
            'billing_address_id' =&gt; 1,
            'shipping_address' =&gt; [
                'street' =&gt; '123 Main St',
                'city' =&gt; 'Cairo',
                'zip_code' =&gt; '12345',
                'country' =&gt; 'Egypt',
                'building_number' =&gt; '15',
                'floor' =&gt; '3',
                'apartment' =&gt; '5A',
                'zone' =&gt; 'Maadi',
            ],
            'billing_address' =&gt; [
                'first_name' =&gt; 'John',
                'last_name' =&gt; 'Doe',
                'email' =&gt; 'john@example.com',
                'phone' =&gt; '+201234567890',
                'street' =&gt; '123 Main St',
                'city' =&gt; 'Cairo',
                'zip_code' =&gt; '12345',
                'country' =&gt; 'Egypt',
                'floor' =&gt; '3',
                'apartment' =&gt; '5A',
            ],
            'notes' =&gt; 'Please deliver in the morning',
            'user_id' =&gt; 16,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-checkout-initiate">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Checkout initiated successfully&quot;,
    &quot;data&quot;: {
        &quot;payment_key&quot;: &quot;ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5...&quot;,
        &quot;iframe_url&quot;: &quot;https://accept.paymob.com/api/acceptance/iframes/123456?payment_token=ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5...&quot;,
        &quot;temp_order_id&quot;: &quot;149823756&quot;,
        &quot;tracking_number&quot;: &quot;BOSTA-123456789&quot;,
        &quot;cost_breakdown&quot;: {
            &quot;subtotal&quot;: 250,
            &quot;tax&quot;: 35,
            &quot;shipping&quot;: 80,
            &quot;total&quot;: 365,
            &quot;item_count&quot;: 3
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Saved Address Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Shipping address not found&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Empty Cart):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Cart is empty&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Shipment Creation Failed):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Failed to create shipment&quot;,
    &quot;error&quot;: &quot;Invalid zone specified for delivery&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Payment Initiation Failed):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Payment initiation failed&quot;,
    &quot;error&quot;: &quot;Invalid billing data&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The shipping address.street field is required.&quot;,
    &quot;errors&quot;: {
        &quot;shipping_address.street&quot;: [
            &quot;The shipping address.street field is required.&quot;
        ],
        &quot;shipping_address.city&quot;: [
            &quot;The shipping address.city field is required.&quot;
        ],
        &quot;billing_address.email&quot;: [
            &quot;The billing address.email must be a valid email address.&quot;
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (500, Server Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Checkout failed: Connection to payment gateway timed out&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-checkout-initiate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-checkout-initiate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-checkout-initiate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-checkout-initiate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-checkout-initiate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-checkout-initiate" data-method="POST"
      data-path="api/checkout/initiate"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-checkout-initiate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-checkout-initiate"
                    onclick="tryItOut('POSTapi-checkout-initiate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-checkout-initiate"
                    onclick="cancelTryOut('POSTapi-checkout-initiate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-checkout-initiate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/checkout/initiate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-checkout-initiate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-checkout-initiate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>shipping_address_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="shipping_address_id"                data-endpoint="POSTapi-checkout-initiate"
               value="1"
               data-component="body">
    <br>
<p>Use a saved shipping address by ID (for authenticated users). Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>billing_address_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="billing_address_id"                data-endpoint="POSTapi-checkout-initiate"
               value="1"
               data-component="body">
    <br>
<p>Use a saved billing address by ID (for authenticated users). Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>shipping_address</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Required if shipping_address_id not provided. The shipping address details.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>street</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="shipping_address.street"                data-endpoint="POSTapi-checkout-initiate"
               value="123 Main St"
               data-component="body">
    <br>
<p>The street address. Example: <code>123 Main St</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="shipping_address.city"                data-endpoint="POSTapi-checkout-initiate"
               value="Cairo"
               data-component="body">
    <br>
<p>The city name (used for shipping cost calculation). Example: <code>Cairo</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>zip_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="shipping_address.zip_code"                data-endpoint="POSTapi-checkout-initiate"
               value="12345"
               data-component="body">
    <br>
<p>The postal/zip code. Example: <code>12345</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="shipping_address.country"                data-endpoint="POSTapi-checkout-initiate"
               value="Egypt"
               data-component="body">
    <br>
<p>The country name. Example: <code>Egypt</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>building_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="shipping_address.building_number"                data-endpoint="POSTapi-checkout-initiate"
               value="15"
               data-component="body">
    <br>
<p>The building number. Example: <code>15</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>floor</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="shipping_address.floor"                data-endpoint="POSTapi-checkout-initiate"
               value="3"
               data-component="body">
    <br>
<p>The floor number (optional). Example: <code>3</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>apartment</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="shipping_address.apartment"                data-endpoint="POSTapi-checkout-initiate"
               value="5A"
               data-component="body">
    <br>
<p>The apartment number (optional). Example: <code>5A</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>zone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="shipping_address.zone"                data-endpoint="POSTapi-checkout-initiate"
               value="Maadi"
               data-component="body">
    <br>
<p>The zone/district for Bosta delivery. Example: <code>Maadi</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>billing_address</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Required if billing_address_id not provided. The billing and contact details for payment.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="billing_address.first_name"                data-endpoint="POSTapi-checkout-initiate"
               value="John"
               data-component="body">
    <br>
<p>Customer's first name. Example: <code>John</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="billing_address.last_name"                data-endpoint="POSTapi-checkout-initiate"
               value="Doe"
               data-component="body">
    <br>
<p>Customer's last name. Example: <code>Doe</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="billing_address.email"                data-endpoint="POSTapi-checkout-initiate"
               value="john@example.com"
               data-component="body">
    <br>
<p>Customer's email for order confirmation. Example: <code>john@example.com</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="billing_address.phone"                data-endpoint="POSTapi-checkout-initiate"
               value="+201234567890"
               data-component="body">
    <br>
<p>Customer's phone for delivery contact. Example: <code>+201234567890</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>street</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="billing_address.street"                data-endpoint="POSTapi-checkout-initiate"
               value="123 Main St"
               data-component="body">
    <br>
<p>The billing street address. Example: <code>123 Main St</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="billing_address.city"                data-endpoint="POSTapi-checkout-initiate"
               value="Cairo"
               data-component="body">
    <br>
<p>The billing city. Example: <code>Cairo</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>zip_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="billing_address.zip_code"                data-endpoint="POSTapi-checkout-initiate"
               value="12345"
               data-component="body">
    <br>
<p>The billing postal/zip code. Example: <code>12345</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="billing_address.country"                data-endpoint="POSTapi-checkout-initiate"
               value="Egypt"
               data-component="body">
    <br>
<p>The billing country. Example: <code>Egypt</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>floor</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="billing_address.floor"                data-endpoint="POSTapi-checkout-initiate"
               value="3"
               data-component="body">
    <br>
<p>The floor number (optional, defaults to NA for Paymob). Example: <code>3</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>apartment</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="billing_address.apartment"                data-endpoint="POSTapi-checkout-initiate"
               value="5A"
               data-component="body">
    <br>
<p>The apartment number (optional, defaults to NA for Paymob). Example: <code>5A</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-checkout-initiate"
               value="Please deliver in the morning"
               data-component="body">
    <br>
<p>Optional order notes for delivery instructions. Example: <code>Please deliver in the morning</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="POSTapi-checkout-initiate"
               value="16"
               data-component="body">
    <br>
<p>Optional user ID for associating guest checkout with a user. Example: <code>16</code></p>
        </div>
        </form>

                    <h2 id="checkout-GETapi-checkout-complete">Complete checkout</h2>

<p>
</p>

<p>Finalize the checkout process after successful payment.
This endpoint is called by the Paymob payment gateway callback (redirect) or webhook.
It retrieves the pending checkout data, creates the final order, and clears the cart.</p>
<p>For GET requests (browser redirects from Paymob), the order_id can be retrieved from the session.
For POST requests (webhooks), the order_id must be provided in the request body.</p>

<span id="example-requests-GETapi-checkout-complete">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/checkout/complete?order_id=149823756&amp;payment_id=98765432" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"order_id\": \"149823756\",
    \"payment_id\": \"98765432\",
    \"success\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/checkout/complete"
);

const params = {
    "order_id": "149823756",
    "payment_id": "98765432",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "order_id": "149823756",
    "payment_id": "98765432",
    "success": true
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/checkout/complete';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'order_id' =&gt; '149823756',
            'payment_id' =&gt; '98765432',
        ],
        'json' =&gt; [
            'order_id' =&gt; '149823756',
            'payment_id' =&gt; '98765432',
            'success' =&gt; true,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-checkout-complete">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Order created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 42,
        &quot;order_number&quot;: &quot;ORD-2024-00042&quot;,
        &quot;user_id&quot;: 1,
        &quot;status&quot;: &quot;processing&quot;,
        &quot;status_ar&quot;: &quot;قيد المعالجة&quot;,
        &quot;payment_status&quot;: &quot;paid&quot;,
        &quot;subtotal&quot;: 250,
        &quot;tax&quot;: 35,
        &quot;shipping_cost&quot;: 80,
        &quot;total_amount&quot;: 365,
        &quot;shipping_address&quot;: {
            &quot;street&quot;: &quot;123 Main St&quot;,
            &quot;city&quot;: &quot;Cairo&quot;,
            &quot;zip_code&quot;: &quot;12345&quot;,
            &quot;country&quot;: &quot;Egypt&quot;,
            &quot;building_number&quot;: &quot;15&quot;,
            &quot;floor&quot;: &quot;3&quot;,
            &quot;apartment&quot;: &quot;5A&quot;,
            &quot;zone&quot;: &quot;Maadi&quot;
        },
        &quot;billing_address&quot;: {
            &quot;first_name&quot;: &quot;John&quot;,
            &quot;last_name&quot;: &quot;Doe&quot;,
            &quot;email&quot;: &quot;john@example.com&quot;,
            &quot;phone&quot;: &quot;+201234567890&quot;,
            &quot;street&quot;: &quot;123 Main St&quot;,
            &quot;city&quot;: &quot;Cairo&quot;,
            &quot;zip_code&quot;: &quot;12345&quot;,
            &quot;country&quot;: &quot;Egypt&quot;
        },
        &quot;notes&quot;: &quot;Please deliver in the morning&quot;,
        &quot;created_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
        &quot;items&quot;: [
            {
                &quot;id&quot;: 101,
                &quot;order_id&quot;: 42,
                &quot;product_id&quot;: 5,
                &quot;quantity&quot;: 2,
                &quot;price&quot;: 75,
                &quot;total&quot;: 150,
                &quot;product&quot;: {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Premium Coffee Beans&quot;,
                    &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
                    &quot;price&quot;: 75,
                    &quot;sku&quot;: &quot;COF-005&quot;,
                    &quot;images&quot;: [
                        {
                            &quot;id&quot;: 1,
                            &quot;url&quot;: &quot;https://example.com/storage/products/coffee.jpg&quot;
                        }
                    ]
                }
            },
            {
                &quot;id&quot;: 102,
                &quot;order_id&quot;: 42,
                &quot;product_id&quot;: 8,
                &quot;quantity&quot;: 1,
                &quot;price&quot;: 100,
                &quot;total&quot;: 100,
                &quot;product&quot;: {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Coffee Grinder&quot;,
                    &quot;slug&quot;: &quot;coffee-grinder&quot;,
                    &quot;price&quot;: 100,
                    &quot;sku&quot;: &quot;GRN-008&quot;,
                    &quot;images&quot;: [
                        {
                            &quot;id&quot;: 3,
                            &quot;url&quot;: &quot;https://example.com/storage/products/grinder.jpg&quot;
                        }
                    ]
                }
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Order ID Required):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Order ID is required&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Checkout Not Found or Expired):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;No pending checkout found&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Payment Not Successful):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Payment was not successful&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (500, Order Creation Failed):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Order creation failed: Database connection error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-checkout-complete" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-checkout-complete"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-checkout-complete"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-checkout-complete" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-checkout-complete">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-checkout-complete" data-method="GET"
      data-path="api/checkout/complete"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-checkout-complete', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-checkout-complete"
                    onclick="tryItOut('GETapi-checkout-complete');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-checkout-complete"
                    onclick="cancelTryOut('GETapi-checkout-complete');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-checkout-complete"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/checkout/complete</code></b>
        </p>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/checkout/complete</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-checkout-complete"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-checkout-complete"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="order_id"                data-endpoint="GETapi-checkout-complete"
               value="149823756"
               data-component="query">
    <br>
<p>The temporary order ID from Paymob (returned during checkout initiation). Example: <code>149823756</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>payment_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_id"                data-endpoint="GETapi-checkout-complete"
               value="98765432"
               data-component="query">
    <br>
<p>The payment transaction ID from Paymob. Example: <code>98765432</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="order_id"                data-endpoint="GETapi-checkout-complete"
               value="149823756"
               data-component="body">
    <br>
<p>The temporary order ID (for webhook POST requests). Example: <code>149823756</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_id"                data-endpoint="GETapi-checkout-complete"
               value="98765432"
               data-component="body">
    <br>
<p>The payment transaction ID (for webhook POST requests). Example: <code>98765432</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>success</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="GETapi-checkout-complete" style="display: none">
            <input type="radio" name="success"
                   value="true"
                   data-endpoint="GETapi-checkout-complete"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-checkout-complete" style="display: none">
            <input type="radio" name="success"
                   value="false"
                   data-endpoint="GETapi-checkout-complete"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Payment success status (for webhook POST requests). Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="checkout-GETapi-checkout-fail">Handle checkout failure</h2>

<p>
</p>

<p>Handle failed checkout due to payment decline, cancellation, or gateway error.
Clears all pending checkout data from both session and database.</p>
<p>For web requests (GET), redirects to the payment failed page.
For API requests (expects JSON), returns a JSON error response.</p>

<span id="example-requests-GETapi-checkout-fail">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/checkout/fail?error=Payment+declined+by+bank&amp;order_id=149823756&amp;txn_response_code=DECLINED" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/checkout/fail"
);

const params = {
    "error": "Payment declined by bank",
    "order_id": "149823756",
    "txn_response_code": "DECLINED",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/checkout/fail';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'error' =&gt; 'Payment declined by bank',
            'order_id' =&gt; '149823756',
            'txn_response_code' =&gt; 'DECLINED',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-checkout-fail">
            <blockquote>
            <p>Example response (200, API Request):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Checkout failed&quot;,
    &quot;error&quot;: &quot;Payment declined by bank&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Unknown Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Checkout failed&quot;,
    &quot;error&quot;: &quot;Unknown error&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (302, Web Request):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">Redirects to /payment-failed</code>
 </pre>
    </span>
<span id="execution-results-GETapi-checkout-fail" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-checkout-fail"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-checkout-fail"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-checkout-fail" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-checkout-fail">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-checkout-fail" data-method="GET"
      data-path="api/checkout/fail"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-checkout-fail', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-checkout-fail"
                    onclick="tryItOut('GETapi-checkout-fail');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-checkout-fail"
                    onclick="cancelTryOut('GETapi-checkout-fail');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-checkout-fail"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/checkout/fail</code></b>
        </p>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/checkout/fail</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-checkout-fail"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-checkout-fail"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>error</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="error"                data-endpoint="GETapi-checkout-fail"
               value="Payment declined by bank"
               data-component="query">
    <br>
<p>The error message or code from the payment gateway. Example: <code>Payment declined by bank</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="order_id"                data-endpoint="GETapi-checkout-fail"
               value="149823756"
               data-component="query">
    <br>
<p>The temporary order ID that failed. Example: <code>149823756</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>txn_response_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="txn_response_code"                data-endpoint="GETapi-checkout-fail"
               value="DECLINED"
               data-component="query">
    <br>
<p>Transaction response code from Paymob. Example: <code>DECLINED</code></p>
            </div>
                </form>

                    <h2 id="checkout-GETapi-checkout-status">Get checkout status</h2>

<p>
</p>

<p>Check if there's a pending checkout session and get current cart summary.
Useful for:</p>
<ul>
<li>Resuming interrupted checkout flows</li>
<li>Checking if user has abandoned checkout</li>
<li>Displaying cart summary before checkout</li>
</ul>
<p>Checks both session storage and database for pending checkouts.</p>

<span id="example-requests-GETapi-checkout-status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/checkout/status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/checkout/status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/checkout/status';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-checkout-status">
            <blockquote>
            <p>Example response (200, Has Pending Checkout):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;has_pending_checkout&quot;: true,
        &quot;cart_summary&quot;: {
            &quot;subtotal&quot;: 250,
            &quot;tax&quot;: 35,
            &quot;shipping&quot;: 80,
            &quot;total&quot;: 365,
            &quot;item_count&quot;: 3,
            &quot;discount&quot;: 0
        },
        &quot;cart_items_count&quot;: 3
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, No Pending Checkout):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;has_pending_checkout&quot;: false,
        &quot;cart_summary&quot;: {
            &quot;subtotal&quot;: 0,
            &quot;tax&quot;: 0,
            &quot;shipping&quot;: 0,
            &quot;total&quot;: 0,
            &quot;item_count&quot;: 0,
            &quot;discount&quot;: 0
        },
        &quot;cart_items_count&quot;: 0
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Cart With Items But No Checkout Started):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;has_pending_checkout&quot;: false,
        &quot;cart_summary&quot;: {
            &quot;subtotal&quot;: 150,
            &quot;tax&quot;: 21,
            &quot;shipping&quot;: 80,
            &quot;total&quot;: 251,
            &quot;item_count&quot;: 2,
            &quot;discount&quot;: 0
        },
        &quot;cart_items_count&quot;: 2
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-checkout-status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-checkout-status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-checkout-status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-checkout-status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-checkout-status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-checkout-status" data-method="GET"
      data-path="api/checkout/status"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-checkout-status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-checkout-status"
                    onclick="tryItOut('GETapi-checkout-status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-checkout-status"
                    onclick="cancelTryOut('GETapi-checkout-status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-checkout-status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/checkout/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-checkout-status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-checkout-status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="checkout-POSTapi-checkout-test-complete">Test checkout completion</h2>

<p>
</p>

<p>Test endpoint to simulate completing a checkout with real pending checkout data.
This is useful for development and testing the checkout flow without going through
the actual Paymob payment process.</p>
<p><strong>Warning:</strong> This endpoint should be disabled or protected in production environments.</p>

<span id="example-requests-POSTapi-checkout-test-complete">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/checkout/test-complete" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/checkout/test-complete"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/checkout/test-complete';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-checkout-test-complete">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Order created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 42,
        &quot;order_number&quot;: &quot;ORD-2024-00042&quot;,
        &quot;user_id&quot;: 1,
        &quot;status&quot;: &quot;processing&quot;,
        &quot;status_ar&quot;: &quot;قيد المعالجة&quot;,
        &quot;payment_status&quot;: &quot;paid&quot;,
        &quot;subtotal&quot;: 250,
        &quot;tax&quot;: 35,
        &quot;shipping_cost&quot;: 80,
        &quot;total_amount&quot;: 365,
        &quot;shipping_address&quot;: {
            &quot;street&quot;: &quot;123 Main St&quot;,
            &quot;city&quot;: &quot;Cairo&quot;,
            &quot;zip_code&quot;: &quot;12345&quot;,
            &quot;country&quot;: &quot;Egypt&quot;,
            &quot;building_number&quot;: &quot;15&quot;,
            &quot;floor&quot;: &quot;3&quot;,
            &quot;apartment&quot;: &quot;5A&quot;,
            &quot;zone&quot;: &quot;Maadi&quot;
        },
        &quot;notes&quot;: &quot;Test order&quot;,
        &quot;created_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
        &quot;items&quot;: [
            {
                &quot;id&quot;: 101,
                &quot;order_id&quot;: 42,
                &quot;product_id&quot;: 5,
                &quot;quantity&quot;: 2,
                &quot;price&quot;: 75,
                &quot;total&quot;: 150,
                &quot;product&quot;: {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Premium Coffee Beans&quot;,
                    &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
                    &quot;price&quot;: 75,
                    &quot;sku&quot;: &quot;COF-005&quot;
                }
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, No Pending Checkout):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;No active pending checkout found for testing&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (500, Test Failed):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Test failed: Order creation error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-checkout-test-complete" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-checkout-test-complete"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-checkout-test-complete"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-checkout-test-complete" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-checkout-test-complete">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-checkout-test-complete" data-method="POST"
      data-path="api/checkout/test-complete"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-checkout-test-complete', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-checkout-test-complete"
                    onclick="tryItOut('POSTapi-checkout-test-complete');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-checkout-test-complete"
                    onclick="cancelTryOut('POSTapi-checkout-test-complete');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-checkout-test-complete"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/checkout/test-complete</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-checkout-test-complete"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-checkout-test-complete"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="orders">Orders</h1>

    <p>APIs for managing customer orders.</p>
<p>All endpoints in this group require authentication via Laravel Sanctum.</p>

                                <h2 id="orders-GETapi-orders">List all orders</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of orders for the authenticated user.</p>

<span id="example-requests-GETapi-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/orders?status=pending&amp;payment_status=paid&amp;per_page=10" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/orders"
);

const params = {
    "status": "pending",
    "payment_status": "paid",
    "per_page": "10",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/orders';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'status' =&gt; 'pending',
            'payment_status' =&gt; 'paid',
            'per_page' =&gt; '10',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-orders">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;success&quot;: true,
        &quot;en&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;order_number&quot;: &quot;ORD-2024-001&quot;,
                &quot;user_id&quot;: 1,
                &quot;status&quot;: &quot;pending&quot;,
                &quot;payment_status&quot;: &quot;pending&quot;,
                &quot;subtotal&quot;: 100,
                &quot;tax&quot;: 10,
                &quot;shipping_cost&quot;: 15,
                &quot;total_amount&quot;: 125,
                &quot;shipping_address&quot;: {
                    &quot;street&quot;: &quot;123 Main St&quot;,
                    &quot;city&quot;: &quot;Cairo&quot;,
                    &quot;zip_code&quot;: &quot;12345&quot;,
                    &quot;country&quot;: &quot;Egypt&quot;,
                    &quot;building_number&quot;: &quot;15&quot;,
                    &quot;floor&quot;: &quot;3&quot;,
                    &quot;apartment&quot;: &quot;5A&quot;,
                    &quot;zone&quot;: &quot;Maadi&quot;
                },
                &quot;notes&quot;: &quot;Please deliver in the morning&quot;,
                &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
            }
        ],
        &quot;ar&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;order_number&quot;: &quot;ORD-2024-001&quot;,
                &quot;user_id&quot;: 1,
                &quot;status&quot;: &quot;قيد الانتظار&quot;,
                &quot;payment_status&quot;: &quot;pending&quot;,
                &quot;subtotal&quot;: 100,
                &quot;tax&quot;: 10,
                &quot;shipping_cost&quot;: 15,
                &quot;total_amount&quot;: 125,
                &quot;shipping_address&quot;: {
                    &quot;street&quot;: &quot;123 الشارع الرئيسي&quot;,
                    &quot;city&quot;: &quot;القاهرة&quot;,
                    &quot;zip_code&quot;: &quot;12345&quot;,
                    &quot;country&quot;: &quot;مصر&quot;,
                    &quot;building_number&quot;: &quot;15&quot;,
                    &quot;floor&quot;: &quot;3&quot;,
                    &quot;apartment&quot;: &quot;5A&quot;,
                    &quot;zone&quot;: &quot;المعادي&quot;
                },
                &quot;notes&quot;: &quot;يرجى التسليم في الصباح&quot;,
                &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
            }
        ],
        &quot;pagination&quot;: {
            &quot;current_page&quot;: 1,
            &quot;last_page&quot;: 5,
            &quot;per_page&quot;: 15,
            &quot;total&quot;: 75
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-orders" data-method="GET"
      data-path="api/orders"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-orders"
                    onclick="tryItOut('GETapi-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-orders"
                    onclick="cancelTryOut('GETapi-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-orders"
               value="Bearer {YOUR_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-orders"
               value="pending"
               data-component="query">
    <br>
<p>Filter by order status. Example: <code>pending</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>payment_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_status"                data-endpoint="GETapi-orders"
               value="paid"
               data-component="query">
    <br>
<p>Filter by payment status. Example: <code>paid</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-orders"
               value="10"
               data-component="query">
    <br>
<p>Number of items per page. Default: 15. Example: <code>10</code></p>
            </div>
                </form>

                    <h2 id="orders-POSTapi-orders">Create order (Deprecated)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
<small class="badge badge-darkgoldenrod">deprecated:Use POST /api/checkout/initiate instead</small>
</p>

<p>This endpoint is deprecated. Orders are now created only through the checkout flow after successful payment.</p>

<span id="example-requests-POSTapi-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/orders" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/orders"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/orders';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-orders">
            <blockquote>
            <p>Example response (422, Deprecated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Direct order creation is deprecated. Please use the checkout flow: POST /checkout/initiate&quot;,
    &quot;checkout_url&quot;: &quot;/checkout/initiate&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-orders" data-method="POST"
      data-path="api/orders"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-orders"
                    onclick="tryItOut('POSTapi-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-orders"
                    onclick="cancelTryOut('POSTapi-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-orders"
               value="Bearer {YOUR_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="orders-GETapi-orders--order_id-">Get order details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve details of a specific order including all items.</p>

<span id="example-requests-GETapi-orders--order_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/orders/16" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/orders/16"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/orders/16';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-orders--order_id-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;order_number&quot;: &quot;ORD-2024-001&quot;,
        &quot;user_id&quot;: 1,
        &quot;status&quot;: &quot;pending&quot;,
        &quot;payment_status&quot;: &quot;paid&quot;,
        &quot;subtotal&quot;: 100,
        &quot;tax&quot;: 10,
        &quot;shipping_cost&quot;: 15,
        &quot;total_amount&quot;: 125,
        &quot;items&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;product_id&quot;: 5,
                &quot;quantity&quot;: 2,
                &quot;price&quot;: 50,
                &quot;product&quot;: {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Premium Coffee&quot;
                }
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Order not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-orders--order_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-orders--order_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-orders--order_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-orders--order_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-orders--order_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-orders--order_id-" data-method="GET"
      data-path="api/orders/{order_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-orders--order_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-orders--order_id-"
                    onclick="tryItOut('GETapi-orders--order_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-orders--order_id-"
                    onclick="cancelTryOut('GETapi-orders--order_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-orders--order_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/orders/{order_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-orders--order_id-"
               value="Bearer {YOUR_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-orders--order_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-orders--order_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="GETapi-orders--order_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order"                data-endpoint="GETapi-orders--order_id-"
               value="1"
               data-component="url">
    <br>
<p>The order ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="orders-PATCHapi-orders--order_id--status">Update order status</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update the status of an order. This endpoint is typically used by administrators.</p>

<span id="example-requests-PATCHapi-orders--order_id--status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://127.0.0.1:8000/api/orders/16/status" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"shipped\",
    \"status_ar\": \"تم الشحن\",
    \"payment_status\": \"paid\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/orders/16/status"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "shipped",
    "status_ar": "تم الشحن",
    "payment_status": "paid"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/orders/16/status';
$response = $client-&gt;patch(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'status' =&gt; 'shipped',
            'status_ar' =&gt; 'تم الشحن',
            'payment_status' =&gt; 'paid',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-PATCHapi-orders--order_id--status">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Order status updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;order_number&quot;: &quot;ORD-2024-001&quot;,
        &quot;status&quot;: &quot;shipped&quot;,
        &quot;payment_status&quot;: &quot;paid&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The status field is required.&quot;,
    &quot;errors&quot;: {
        &quot;status&quot;: [
            &quot;The status field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PATCHapi-orders--order_id--status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-orders--order_id--status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-orders--order_id--status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-orders--order_id--status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-orders--order_id--status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-orders--order_id--status" data-method="PATCH"
      data-path="api/orders/{order_id}/status"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-orders--order_id--status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-orders--order_id--status"
                    onclick="tryItOut('PATCHapi-orders--order_id--status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-orders--order_id--status"
                    onclick="cancelTryOut('PATCHapi-orders--order_id--status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-orders--order_id--status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/orders/{order_id}/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHapi-orders--order_id--status"
               value="Bearer {YOUR_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-orders--order_id--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-orders--order_id--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="PATCHapi-orders--order_id--status"
               value="16"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order"                data-endpoint="PATCHapi-orders--order_id--status"
               value="1"
               data-component="url">
    <br>
<p>The order ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PATCHapi-orders--order_id--status"
               value="shipped"
               data-component="body">
    <br>
<p>The new order status. Example: <code>shipped</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status_ar"                data-endpoint="PATCHapi-orders--order_id--status"
               value="تم الشحن"
               data-component="body">
    <br>
<p>Optional Arabic status text. Example: <code>تم الشحن</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_status"                data-endpoint="PATCHapi-orders--order_id--status"
               value="paid"
               data-component="body">
    <br>
<p>Optional payment status update. Example: <code>paid</code></p>
        </div>
        </form>

                    <h2 id="orders-POSTapi-orders--order_id--cancel">Cancel order</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Cancel an existing order. Only orders that haven't been shipped can be cancelled.</p>

<span id="example-requests-POSTapi-orders--order_id--cancel">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/orders/16/cancel" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/orders/16/cancel"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/orders/16/cancel';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-orders--order_id--cancel">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Order cancelled successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;order_number&quot;: &quot;ORD-2024-001&quot;,
        &quot;status&quot;: &quot;cancelled&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Cannot Cancel):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Order cannot be cancelled after shipping.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-orders--order_id--cancel" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-orders--order_id--cancel"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-orders--order_id--cancel"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-orders--order_id--cancel" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-orders--order_id--cancel">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-orders--order_id--cancel" data-method="POST"
      data-path="api/orders/{order_id}/cancel"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-orders--order_id--cancel', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-orders--order_id--cancel"
                    onclick="tryItOut('POSTapi-orders--order_id--cancel');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-orders--order_id--cancel"
                    onclick="cancelTryOut('POSTapi-orders--order_id--cancel');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-orders--order_id--cancel"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/orders/{order_id}/cancel</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-orders--order_id--cancel"
               value="Bearer {YOUR_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-orders--order_id--cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-orders--order_id--cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="POSTapi-orders--order_id--cancel"
               value="16"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order"                data-endpoint="POSTapi-orders--order_id--cancel"
               value="1"
               data-component="url">
    <br>
<p>The order ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="wishlist">Wishlist</h1>

    <p>APIs for managing user wishlists.</p>
<p>All endpoints in this group require authentication via Laravel Sanctum.
Users can save products to their wishlist for later purchase.</p>

                                <h2 id="wishlist-GETapi-wishlist">List wishlist items</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get all products in the authenticated user's wishlist.
Returns product data in both English and Arabic.</p>

<span id="example-requests-GETapi-wishlist">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/wishlist" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/wishlist"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/wishlist';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-wishlist">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;en&quot;: {
        &quot;products&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Premium Coffee Beans&quot;,
                &quot;description&quot;: &quot;High-quality arabica coffee beans&quot;,
                &quot;wishlist_item_id&quot;: 5,
                &quot;added_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
                &quot;price&quot;: 25,
                &quot;cost&quot;: 15,
                &quot;stock&quot;: 100,
                &quot;sku&quot;: &quot;COF-001&quot;,
                &quot;is_active&quot;: true,
                &quot;category_id&quot;: 1,
                &quot;grind_type&quot;: &quot;whole_bean&quot;,
                &quot;weight&quot;: 0.5,
                &quot;product_details&quot;: [
                    {
                        &quot;title&quot;: &quot;Origin&quot;,
                        &quot;value&quot;: &quot;Ethiopia&quot;
                    },
                    {
                        &quot;title&quot;: &quot;Roast Level&quot;,
                        &quot;value&quot;: &quot;Medium&quot;
                    }
                ],
                &quot;image&quot;: &quot;https://example.com/images/coffee.jpg&quot;,
                &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
            }
        ],
        &quot;count&quot;: 1
    },
    &quot;ar&quot;: {
        &quot;products&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;حبوب قهوة ممتازة&quot;,
                &quot;description&quot;: &quot;حبوب قهوة أرابيكا عالية الجودة&quot;,
                &quot;wishlist_item_id&quot;: 5,
                &quot;added_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
                &quot;price&quot;: 25,
                &quot;cost&quot;: 15,
                &quot;stock&quot;: 100,
                &quot;sku&quot;: &quot;COF-001&quot;,
                &quot;is_active&quot;: true,
                &quot;category_id&quot;: 1,
                &quot;grind_type&quot;: &quot;whole_bean&quot;,
                &quot;weight&quot;: 0.5,
                &quot;product_details&quot;: [
                    {
                        &quot;title&quot;: &quot;المنشأ&quot;,
                        &quot;value&quot;: &quot;إثيوبيا&quot;
                    },
                    {
                        &quot;title&quot;: &quot;درجة التحميص&quot;,
                        &quot;value&quot;: &quot;متوسط&quot;
                    }
                ],
                &quot;image&quot;: &quot;https://example.com/images/coffee.jpg&quot;,
                &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
            }
        ],
        &quot;count&quot;: 1
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-wishlist" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-wishlist"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-wishlist"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-wishlist" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-wishlist">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-wishlist" data-method="GET"
      data-path="api/wishlist"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-wishlist', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-wishlist"
                    onclick="tryItOut('GETapi-wishlist');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-wishlist"
                    onclick="cancelTryOut('GETapi-wishlist');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-wishlist"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/wishlist</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-wishlist"
               value="Bearer {YOUR_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-wishlist"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-wishlist"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="wishlist-POSTapi-wishlist">Add to wishlist</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Add a product to the authenticated user's wishlist.</p>

<span id="example-requests-POSTapi-wishlist">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/wishlist" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"product_id\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/wishlist"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "product_id": 1
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/wishlist';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'product_id' =&gt; 1,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-wishlist">
            <blockquote>
            <p>Example response (201, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Product added to wishlist successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 5,
        &quot;product_id&quot;: 1,
        &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Already in Wishlist):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Product is already in your wishlist&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Product Unavailable):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Product is not available&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-wishlist" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-wishlist"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-wishlist"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-wishlist" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-wishlist">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-wishlist" data-method="POST"
      data-path="api/wishlist"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-wishlist', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-wishlist"
                    onclick="tryItOut('POSTapi-wishlist');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-wishlist"
                    onclick="cancelTryOut('POSTapi-wishlist');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-wishlist"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/wishlist</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-wishlist"
               value="Bearer {YOUR_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-wishlist"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-wishlist"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="POSTapi-wishlist"
               value="1"
               data-component="body">
    <br>
<p>The ID of the product to add. Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="wishlist-DELETEapi-wishlist--productId-">Remove from wishlist</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Remove a product from the authenticated user's wishlist.</p>

<span id="example-requests-DELETEapi-wishlist--productId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/wishlist/1" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/wishlist/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/wishlist/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-DELETEapi-wishlist--productId-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Product removed from wishlist successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Product not found in your wishlist&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-wishlist--productId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-wishlist--productId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-wishlist--productId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-wishlist--productId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-wishlist--productId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-wishlist--productId-" data-method="DELETE"
      data-path="api/wishlist/{productId}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-wishlist--productId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-wishlist--productId-"
                    onclick="tryItOut('DELETEapi-wishlist--productId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-wishlist--productId-"
                    onclick="cancelTryOut('DELETEapi-wishlist--productId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-wishlist--productId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/wishlist/{productId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-wishlist--productId-"
               value="Bearer {YOUR_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-wishlist--productId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-wishlist--productId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>productId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="productId"                data-endpoint="DELETEapi-wishlist--productId-"
               value="1"
               data-component="url">
    <br>
<p>The product ID to remove. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="wishlist-GETapi-wishlist-check--productId-">Check if in wishlist</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Check if a specific product is in the authenticated user's wishlist.</p>

<span id="example-requests-GETapi-wishlist-check--productId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/wishlist/check/1" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/wishlist/check/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/wishlist/check/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-wishlist-check--productId-">
            <blockquote>
            <p>Example response (200, In Wishlist):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;in_wishlist&quot;: true
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Not in Wishlist):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;in_wishlist&quot;: false
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-wishlist-check--productId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-wishlist-check--productId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-wishlist-check--productId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-wishlist-check--productId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-wishlist-check--productId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-wishlist-check--productId-" data-method="GET"
      data-path="api/wishlist/check/{productId}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-wishlist-check--productId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-wishlist-check--productId-"
                    onclick="tryItOut('GETapi-wishlist-check--productId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-wishlist-check--productId-"
                    onclick="cancelTryOut('GETapi-wishlist-check--productId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-wishlist-check--productId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/wishlist/check/{productId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-wishlist-check--productId-"
               value="Bearer {YOUR_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-wishlist-check--productId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-wishlist-check--productId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>productId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="productId"                data-endpoint="GETapi-wishlist-check--productId-"
               value="1"
               data-component="url">
    <br>
<p>The product ID to check. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="wishlist-DELETEapi-wishlist">Clear wishlist</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Remove all products from the authenticated user's wishlist.</p>

<span id="example-requests-DELETEapi-wishlist">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/wishlist" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/wishlist"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/wishlist';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-DELETEapi-wishlist">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Wishlist cleared successfully&quot;,
    &quot;deleted_count&quot;: 5
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-wishlist" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-wishlist"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-wishlist"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-wishlist" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-wishlist">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-wishlist" data-method="DELETE"
      data-path="api/wishlist"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-wishlist', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-wishlist"
                    onclick="tryItOut('DELETEapi-wishlist');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-wishlist"
                    onclick="cancelTryOut('DELETEapi-wishlist');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-wishlist"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/wishlist</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-wishlist"
               value="Bearer {YOUR_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-wishlist"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-wishlist"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-contact-us">GET api/contact-us</h2>

<p>
</p>



<span id="example-requests-GETapi-contact-us">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/contact-us" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-us"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/contact-us';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-contact-us">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
set-cookie: laravel-session=eyJpdiI6IkxzclVJQnQvVnB5TXh6dzg2ekxlMWc9PSIsInZhbHVlIjoiLzBQYXluNEloNXVFY29hbW9lTElPUVN2Q3hwT0lDem9ZdE9FWkdLZUM2QndHekhHMjFSMnhYVXhVYlM4QXh6Z0FmcHVzQ2RwanBuSEo0QVcvZTNtZjB5MUdwL3cxZDB2ak12emFmYmh1ekhCZE8rdmtrVStoMU1XTW1DQmRMbjgiLCJtYWMiOiI0OGZhYTgyMGJkN2Y0NTQxNDNmNjE1ODQzZmJmNGRkMWEyYmI5MjA0YjkyZjIyYzcyM2QwMjMwNjIxNzRkMjllIiwidGFnIjoiIn0%3D; expires=Wed, 21 Jan 2026 11:38:44 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;en&quot;: {
            &quot;phones&quot;: [
                &quot;+1234567890&quot;,
                &quot;+0987654321&quot;
            ],
            &quot;emails&quot;: [
                &quot;info@example.com&quot;,
                &quot;support@example.com&quot;
            ],
            &quot;addresses&quot;: [
                &quot;123 Main St, City, Country&quot;
            ],
            &quot;working_hours&quot;: [
                &quot;Mon-Fri: 9AM-6PM&quot;,
                &quot;Sat: 10AM-4PM&quot;
            ]
        },
        &quot;ar&quot;: {
            &quot;phones&quot;: [
                &quot;+1234567890&quot;,
                &quot;+0987654321&quot;
            ],
            &quot;emails&quot;: [
                &quot;info@example.com&quot;,
                &quot;support@example.com&quot;
            ],
            &quot;addresses&quot;: [
                &quot;123 شارع الرئيسي، المدينة، البلد&quot;
            ],
            &quot;working_hours&quot;: [
                &quot;الاثنين-الجمعة: 9ص-6م&quot;,
                &quot;السبت: 10ص-4م&quot;
            ]
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-contact-us" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-contact-us"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-contact-us"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-contact-us" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-contact-us">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-contact-us" data-method="GET"
      data-path="api/contact-us"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-contact-us', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-contact-us"
                    onclick="tryItOut('GETapi-contact-us');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-contact-us"
                    onclick="cancelTryOut('GETapi-contact-us');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-contact-us"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/contact-us</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-contact-us"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-contact-us"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-addresses">Display a listing of the user&#039;s addresses.</h2>

<p>
</p>



<span id="example-requests-GETapi-addresses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/addresses" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/addresses"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/addresses';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-addresses">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
set-cookie: laravel-session=eyJpdiI6IlRHYXFtcnNOY2ZBbkM4NStEd3F5OWc9PSIsInZhbHVlIjoiVEZPZUZiZktrQi9KeVd5NUVkU3I3QTcrc3pVRkh3YUxkeS9KQlg4dnRVY0VxbHNDNGFvck5PUEFYZjdTaVBGbU81bzVNT0NwV3plY2JzWXZUdzNINjBrSU1CcUd6TXR2VUhtWUdERTdKMFRzMjZLa0R2UVBEUkYyeGtRcFdOdkMiLCJtYWMiOiJlZDAzNjFiNDI1ZmI1MjZlNWZhMDhhNjAzYzM2ZDRlZmRiMGFjZDIwOTIyNzIxZjE4YWNmNDY1MjhlZjJhYzE0IiwidGFnIjoiIn0%3D; expires=Wed, 21 Jan 2026 11:38:44 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-addresses" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-addresses"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-addresses"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-addresses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-addresses">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-addresses" data-method="GET"
      data-path="api/addresses"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-addresses', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-addresses"
                    onclick="tryItOut('GETapi-addresses');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-addresses"
                    onclick="cancelTryOut('GETapi-addresses');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-addresses"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/addresses</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-addresses">Store a newly created address.</h2>

<p>
</p>



<span id="example-requests-POSTapi-addresses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/addresses" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"label\": \"b\",
    \"name\": \"n\",
    \"phone\": \"gzmiyvdljnikhway\",
    \"address\": \"architecto\",
    \"city\": \"n\",
    \"zip_code\": \"gzmiyvdljnikhway\",
    \"country\": \"k\",
    \"state\": \"c\",
    \"is_default\": false,
    \"is_billing\": true,
    \"is_shipping\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/addresses"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "label": "b",
    "name": "n",
    "phone": "gzmiyvdljnikhway",
    "address": "architecto",
    "city": "n",
    "zip_code": "gzmiyvdljnikhway",
    "country": "k",
    "state": "c",
    "is_default": false,
    "is_billing": true,
    "is_shipping": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/addresses';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'label' =&gt; 'b',
            'name' =&gt; 'n',
            'phone' =&gt; 'gzmiyvdljnikhway',
            'address' =&gt; 'architecto',
            'city' =&gt; 'n',
            'zip_code' =&gt; 'gzmiyvdljnikhway',
            'country' =&gt; 'k',
            'state' =&gt; 'c',
            'is_default' =&gt; false,
            'is_billing' =&gt; true,
            'is_shipping' =&gt; false,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-addresses">
</span>
<span id="execution-results-POSTapi-addresses" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-addresses"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-addresses"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-addresses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-addresses">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-addresses" data-method="POST"
      data-path="api/addresses"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-addresses', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-addresses"
                    onclick="tryItOut('POSTapi-addresses');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-addresses"
                    onclick="cancelTryOut('POSTapi-addresses');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-addresses"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/addresses</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>label</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="label"                data-endpoint="POSTapi-addresses"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-addresses"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-addresses"
               value="gzmiyvdljnikhway"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>gzmiyvdljnikhway</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-addresses"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="POSTapi-addresses"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>zip_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="zip_code"                data-endpoint="POSTapi-addresses"
               value="gzmiyvdljnikhway"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>gzmiyvdljnikhway</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="country"                data-endpoint="POSTapi-addresses"
               value="k"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>k</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>state</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="state"                data-endpoint="POSTapi-addresses"
               value="c"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>c</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_default</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-addresses" style="display: none">
            <input type="radio" name="is_default"
                   value="true"
                   data-endpoint="POSTapi-addresses"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-addresses" style="display: none">
            <input type="radio" name="is_default"
                   value="false"
                   data-endpoint="POSTapi-addresses"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_billing</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-addresses" style="display: none">
            <input type="radio" name="is_billing"
                   value="true"
                   data-endpoint="POSTapi-addresses"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-addresses" style="display: none">
            <input type="radio" name="is_billing"
                   value="false"
                   data-endpoint="POSTapi-addresses"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_shipping</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-addresses" style="display: none">
            <input type="radio" name="is_shipping"
                   value="true"
                   data-endpoint="POSTapi-addresses"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-addresses" style="display: none">
            <input type="radio" name="is_shipping"
                   value="false"
                   data-endpoint="POSTapi-addresses"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-addresses--address_id-">Display the specified address.</h2>

<p>
</p>



<span id="example-requests-GETapi-addresses--address_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/addresses/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/addresses/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/addresses/16';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-addresses--address_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
set-cookie: laravel-session=eyJpdiI6Ill2OEx6YURONFBxazVBMjdXWWVwNXc9PSIsInZhbHVlIjoiMUF6LzNPWitValcxczhWVzd1QWMranY0WDJoVi9LeUFvT3RYeG5kSGJldEpkMWg3ZFlSUnkrd3V3cDVUTWJBalRJNGVKL1Nic3BhYm1Wb0NrYmxrYzJqMGtkYkg2emF1NnpWc05tc1BhUGxPd1JqN1BWVXRKbE5CTmdUS3hWNS8iLCJtYWMiOiJlOTc0ZjkwN2E3ZDY0MmE0MmE2ZDIzZjhmYTgwNWNiNTQzZjg3ZmVlZTg1ZTYzZWNhMjVkYjM4MDE2MzAwOWM5IiwidGFnIjoiIn0%3D; expires=Wed, 21 Jan 2026 11:38:44 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-addresses--address_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-addresses--address_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-addresses--address_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-addresses--address_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-addresses--address_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-addresses--address_id-" data-method="GET"
      data-path="api/addresses/{address_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-addresses--address_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-addresses--address_id-"
                    onclick="tryItOut('GETapi-addresses--address_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-addresses--address_id-"
                    onclick="cancelTryOut('GETapi-addresses--address_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-addresses--address_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/addresses/{address_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-addresses--address_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-addresses--address_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address_id"                data-endpoint="GETapi-addresses--address_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-addresses--address_id-">Update the specified address.</h2>

<p>
</p>



<span id="example-requests-PUTapi-addresses--address_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/addresses/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"label\": \"b\",
    \"name\": \"n\",
    \"phone\": \"gzmiyvdljnikhway\",
    \"address\": \"architecto\",
    \"city\": \"n\",
    \"zip_code\": \"gzmiyvdljnikhway\",
    \"country\": \"k\",
    \"state\": \"c\",
    \"is_default\": true,
    \"is_billing\": false,
    \"is_shipping\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/addresses/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "label": "b",
    "name": "n",
    "phone": "gzmiyvdljnikhway",
    "address": "architecto",
    "city": "n",
    "zip_code": "gzmiyvdljnikhway",
    "country": "k",
    "state": "c",
    "is_default": true,
    "is_billing": false,
    "is_shipping": false
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/addresses/16';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'label' =&gt; 'b',
            'name' =&gt; 'n',
            'phone' =&gt; 'gzmiyvdljnikhway',
            'address' =&gt; 'architecto',
            'city' =&gt; 'n',
            'zip_code' =&gt; 'gzmiyvdljnikhway',
            'country' =&gt; 'k',
            'state' =&gt; 'c',
            'is_default' =&gt; true,
            'is_billing' =&gt; false,
            'is_shipping' =&gt; false,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-PUTapi-addresses--address_id-">
</span>
<span id="execution-results-PUTapi-addresses--address_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-addresses--address_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-addresses--address_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-addresses--address_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-addresses--address_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-addresses--address_id-" data-method="PUT"
      data-path="api/addresses/{address_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-addresses--address_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-addresses--address_id-"
                    onclick="tryItOut('PUTapi-addresses--address_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-addresses--address_id-"
                    onclick="cancelTryOut('PUTapi-addresses--address_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-addresses--address_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/addresses/{address_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-addresses--address_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-addresses--address_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address_id"                data-endpoint="PUTapi-addresses--address_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>label</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="label"                data-endpoint="PUTapi-addresses--address_id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-addresses--address_id-"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-addresses--address_id-"
               value="gzmiyvdljnikhway"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>gzmiyvdljnikhway</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-addresses--address_id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="PUTapi-addresses--address_id-"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>zip_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="zip_code"                data-endpoint="PUTapi-addresses--address_id-"
               value="gzmiyvdljnikhway"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>gzmiyvdljnikhway</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="country"                data-endpoint="PUTapi-addresses--address_id-"
               value="k"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>k</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>state</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="state"                data-endpoint="PUTapi-addresses--address_id-"
               value="c"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>c</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_default</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-addresses--address_id-" style="display: none">
            <input type="radio" name="is_default"
                   value="true"
                   data-endpoint="PUTapi-addresses--address_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-addresses--address_id-" style="display: none">
            <input type="radio" name="is_default"
                   value="false"
                   data-endpoint="PUTapi-addresses--address_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_billing</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-addresses--address_id-" style="display: none">
            <input type="radio" name="is_billing"
                   value="true"
                   data-endpoint="PUTapi-addresses--address_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-addresses--address_id-" style="display: none">
            <input type="radio" name="is_billing"
                   value="false"
                   data-endpoint="PUTapi-addresses--address_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_shipping</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-addresses--address_id-" style="display: none">
            <input type="radio" name="is_shipping"
                   value="true"
                   data-endpoint="PUTapi-addresses--address_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-addresses--address_id-" style="display: none">
            <input type="radio" name="is_shipping"
                   value="false"
                   data-endpoint="PUTapi-addresses--address_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-addresses--address_id-">Remove the specified address.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-addresses--address_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/addresses/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/addresses/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/addresses/16';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-DELETEapi-addresses--address_id-">
</span>
<span id="execution-results-DELETEapi-addresses--address_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-addresses--address_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-addresses--address_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-addresses--address_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-addresses--address_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-addresses--address_id-" data-method="DELETE"
      data-path="api/addresses/{address_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-addresses--address_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-addresses--address_id-"
                    onclick="tryItOut('DELETEapi-addresses--address_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-addresses--address_id-"
                    onclick="cancelTryOut('DELETEapi-addresses--address_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-addresses--address_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/addresses/{address_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-addresses--address_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-addresses--address_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address_id"                data-endpoint="DELETEapi-addresses--address_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PATCHapi-addresses--address_id--default">Set an address as default.</h2>

<p>
</p>



<span id="example-requests-PATCHapi-addresses--address_id--default">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://127.0.0.1:8000/api/addresses/16/default" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/addresses/16/default"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/addresses/16/default';
$response = $client-&gt;patch(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-PATCHapi-addresses--address_id--default">
</span>
<span id="execution-results-PATCHapi-addresses--address_id--default" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-addresses--address_id--default"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-addresses--address_id--default"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-addresses--address_id--default" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-addresses--address_id--default">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-addresses--address_id--default" data-method="PATCH"
      data-path="api/addresses/{address_id}/default"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-addresses--address_id--default', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-addresses--address_id--default"
                    onclick="tryItOut('PATCHapi-addresses--address_id--default');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-addresses--address_id--default"
                    onclick="cancelTryOut('PATCHapi-addresses--address_id--default');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-addresses--address_id--default"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/addresses/{address_id}/default</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-addresses--address_id--default"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-addresses--address_id--default"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address_id"                data-endpoint="PATCHapi-addresses--address_id--default"
               value="16"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-contact-inquiries">Display a listing of contact inquiries.</h2>

<p>
</p>



<span id="example-requests-GETapi-contact-inquiries">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/contact-inquiries" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/contact-inquiries';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-contact-inquiries">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
set-cookie: laravel-session=eyJpdiI6Ino1eGhLMWxXNnF1eDZRdklBR3NuMGc9PSIsInZhbHVlIjoicUFHSklhOEppcU9YSkdXSUpTS2tIbTBPODBvQ05hWmhNbTI2eWQzNUhXczh1b2xxbkkvWDY1WUVKWWVUMWg4aEY0S3BIazRCbGdLWlFGdzY2Zk1aTXRZdUpSL2libUsrYUR3NERDU091RjFxb01UOWQ2SEl2T3p5bk54cEVUeDciLCJtYWMiOiJiMmNlZjYwNTVlNzhkZmE5MmFjMTcwMmIwMWE1NjBhYWUxZGFhZDg5NTE1YjljZWNkZjFlZjk2ZTNlMzllOGU1IiwidGFnIjoiIn0%3D; expires=Wed, 21 Jan 2026 11:38:44 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://127.0.0.1:8000/api/contact-inquiries?page=1&quot;,
        &quot;last&quot;: &quot;http://127.0.0.1:8000/api/contact-inquiries?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: null,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:8000/api/contact-inquiries?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://127.0.0.1:8000/api/contact-inquiries&quot;,
        &quot;per_page&quot;: 15,
        &quot;to&quot;: null,
        &quot;total&quot;: 0
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-contact-inquiries" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-contact-inquiries"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-contact-inquiries"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-contact-inquiries" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-contact-inquiries">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-contact-inquiries" data-method="GET"
      data-path="api/contact-inquiries"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-contact-inquiries', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-contact-inquiries"
                    onclick="tryItOut('GETapi-contact-inquiries');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-contact-inquiries"
                    onclick="cancelTryOut('GETapi-contact-inquiries');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-contact-inquiries"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/contact-inquiries</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-contact-inquiries"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-contact-inquiries"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-contact-inquiries">Store a newly created contact inquiry in storage.</h2>

<p>
</p>



<span id="example-requests-POSTapi-contact-inquiries">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/contact-inquiries" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"full_name\": \"b\",
    \"email\": \"zbailey@example.net\",
    \"phone\": \"iyvdljnikhwaykcm\",
    \"company\": \"y\",
    \"service\": \"u\",
    \"message\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "full_name": "b",
    "email": "zbailey@example.net",
    "phone": "iyvdljnikhwaykcm",
    "company": "y",
    "service": "u",
    "message": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/contact-inquiries';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'full_name' =&gt; 'b',
            'email' =&gt; 'zbailey@example.net',
            'phone' =&gt; 'iyvdljnikhwaykcm',
            'company' =&gt; 'y',
            'service' =&gt; 'u',
            'message' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-contact-inquiries">
</span>
<span id="execution-results-POSTapi-contact-inquiries" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-contact-inquiries"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-contact-inquiries"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-contact-inquiries" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-contact-inquiries">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-contact-inquiries" data-method="POST"
      data-path="api/contact-inquiries"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-contact-inquiries', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-contact-inquiries"
                    onclick="tryItOut('POSTapi-contact-inquiries');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-contact-inquiries"
                    onclick="cancelTryOut('POSTapi-contact-inquiries');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-contact-inquiries"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/contact-inquiries</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-contact-inquiries"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-contact-inquiries"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>full_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="full_name"                data-endpoint="POSTapi-contact-inquiries"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-contact-inquiries"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>zbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-contact-inquiries"
               value="iyvdljnikhwaykcm"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>iyvdljnikhwaykcm</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>company</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="company"                data-endpoint="POSTapi-contact-inquiries"
               value="y"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>y</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service_id"                data-endpoint="POSTapi-contact-inquiries"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the services table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service"                data-endpoint="POSTapi-contact-inquiries"
               value="u"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>u</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>message</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="message"                data-endpoint="POSTapi-contact-inquiries"
               value="architecto"
               data-component="body">
    <br>
<p>Keep for backward compatibility. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-contact-inquiries--inquiry_id-">Display the specified contact inquiry.</h2>

<p>
</p>



<span id="example-requests-GETapi-contact-inquiries--inquiry_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/contact-inquiries/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/contact-inquiries/16';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-contact-inquiries--inquiry_id-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
set-cookie: laravel-session=eyJpdiI6InRYY2hsQnFsY2JHQnFwYm9aRmNnU0E9PSIsInZhbHVlIjoiN0ovTHJGVFUrRnNReE83KzNSeDNJS2hiRmhyd1o5TFJjL3daeWRDS05rTTM0ZFdtaDBIU1FwZDlJT1VTYWJuZHpTc3BEOUI1Ym9OQ1ZXZlAzdHFBWEJoSnVNbVpUWXBuMGRBcm9GenFoOExpVXNjYjNhMlY0bGNacXMzRFZ4SmsiLCJtYWMiOiIwM2M0ZGQ5OGNmNTNiZDgwMmY3NmU1OGE5NDdlOTc2NjQ2ZGU3NWUzMzgzNmM1NjNmNmZmMzQzMmMyMDNjODA4IiwidGFnIjoiIn0%3D; expires=Wed, 21 Jan 2026 11:38:44 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\ContactInquiry] 16&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-contact-inquiries--inquiry_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-contact-inquiries--inquiry_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-contact-inquiries--inquiry_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-contact-inquiries--inquiry_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-contact-inquiries--inquiry_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-contact-inquiries--inquiry_id-" data-method="GET"
      data-path="api/contact-inquiries/{inquiry_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-contact-inquiries--inquiry_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-contact-inquiries--inquiry_id-"
                    onclick="tryItOut('GETapi-contact-inquiries--inquiry_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-contact-inquiries--inquiry_id-"
                    onclick="cancelTryOut('GETapi-contact-inquiries--inquiry_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-contact-inquiries--inquiry_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/contact-inquiries/{inquiry_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-contact-inquiries--inquiry_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-contact-inquiries--inquiry_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>inquiry_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inquiry_id"                data-endpoint="GETapi-contact-inquiries--inquiry_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the inquiry. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-contact-inquiries--inquiry_id-">Update the specified contact inquiry in storage.</h2>

<p>
</p>



<span id="example-requests-PUTapi-contact-inquiries--inquiry_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/contact-inquiries/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"full_name\": \"b\",
    \"email\": \"zbailey@example.net\",
    \"phone\": \"iyvdljnikhwaykcm\",
    \"company\": \"y\",
    \"service\": \"u\",
    \"message\": \"architecto\",
    \"status\": \"replied\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "full_name": "b",
    "email": "zbailey@example.net",
    "phone": "iyvdljnikhwaykcm",
    "company": "y",
    "service": "u",
    "message": "architecto",
    "status": "replied"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/contact-inquiries/16';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'full_name' =&gt; 'b',
            'email' =&gt; 'zbailey@example.net',
            'phone' =&gt; 'iyvdljnikhwaykcm',
            'company' =&gt; 'y',
            'service' =&gt; 'u',
            'message' =&gt; 'architecto',
            'status' =&gt; 'replied',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-PUTapi-contact-inquiries--inquiry_id-">
</span>
<span id="execution-results-PUTapi-contact-inquiries--inquiry_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-contact-inquiries--inquiry_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-contact-inquiries--inquiry_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-contact-inquiries--inquiry_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-contact-inquiries--inquiry_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-contact-inquiries--inquiry_id-" data-method="PUT"
      data-path="api/contact-inquiries/{inquiry_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-contact-inquiries--inquiry_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-contact-inquiries--inquiry_id-"
                    onclick="tryItOut('PUTapi-contact-inquiries--inquiry_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-contact-inquiries--inquiry_id-"
                    onclick="cancelTryOut('PUTapi-contact-inquiries--inquiry_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-contact-inquiries--inquiry_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/contact-inquiries/{inquiry_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>inquiry_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inquiry_id"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the inquiry. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>full_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="full_name"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>zbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="iyvdljnikhwaykcm"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>iyvdljnikhwaykcm</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>company</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="company"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="y"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>y</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service_id"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the services table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="u"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>u</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>message</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="message"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="replied"
               data-component="body">
    <br>
<p>Example: <code>replied</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>pending</code></li> <li><code>replied</code></li> <li><code>closed</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-PATCHapi-contact-inquiries--inquiry_id-">Partially update the specified contact inquiry in storage.</h2>

<p>
</p>



<span id="example-requests-PATCHapi-contact-inquiries--inquiry_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://127.0.0.1:8000/api/contact-inquiries/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/contact-inquiries/16';
$response = $client-&gt;patch(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-PATCHapi-contact-inquiries--inquiry_id-">
</span>
<span id="execution-results-PATCHapi-contact-inquiries--inquiry_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-contact-inquiries--inquiry_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-contact-inquiries--inquiry_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-contact-inquiries--inquiry_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-contact-inquiries--inquiry_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-contact-inquiries--inquiry_id-" data-method="PATCH"
      data-path="api/contact-inquiries/{inquiry_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-contact-inquiries--inquiry_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-contact-inquiries--inquiry_id-"
                    onclick="tryItOut('PATCHapi-contact-inquiries--inquiry_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-contact-inquiries--inquiry_id-"
                    onclick="cancelTryOut('PATCHapi-contact-inquiries--inquiry_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-contact-inquiries--inquiry_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/contact-inquiries/{inquiry_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-contact-inquiries--inquiry_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-contact-inquiries--inquiry_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>inquiry_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inquiry_id"                data-endpoint="PATCHapi-contact-inquiries--inquiry_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the inquiry. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-contact-inquiries--inquiry_id--reply">Reply to a contact inquiry.</h2>

<p>
</p>



<span id="example-requests-POSTapi-contact-inquiries--inquiry_id--reply">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/contact-inquiries/16/reply" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reply_message\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries/16/reply"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reply_message": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/contact-inquiries/16/reply';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'reply_message' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-contact-inquiries--inquiry_id--reply">
</span>
<span id="execution-results-POSTapi-contact-inquiries--inquiry_id--reply" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-contact-inquiries--inquiry_id--reply"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-contact-inquiries--inquiry_id--reply"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-contact-inquiries--inquiry_id--reply" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-contact-inquiries--inquiry_id--reply">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-contact-inquiries--inquiry_id--reply" data-method="POST"
      data-path="api/contact-inquiries/{inquiry_id}/reply"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-contact-inquiries--inquiry_id--reply', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-contact-inquiries--inquiry_id--reply"
                    onclick="tryItOut('POSTapi-contact-inquiries--inquiry_id--reply');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-contact-inquiries--inquiry_id--reply"
                    onclick="cancelTryOut('POSTapi-contact-inquiries--inquiry_id--reply');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-contact-inquiries--inquiry_id--reply"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/contact-inquiries/{inquiry_id}/reply</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-contact-inquiries--inquiry_id--reply"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-contact-inquiries--inquiry_id--reply"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>inquiry_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inquiry_id"                data-endpoint="POSTapi-contact-inquiries--inquiry_id--reply"
               value="16"
               data-component="url">
    <br>
<p>The ID of the inquiry. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reply_message</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reply_message"                data-endpoint="POSTapi-contact-inquiries--inquiry_id--reply"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-contact-inquiries--inquiry_id-">Remove the specified contact inquiry from storage.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-contact-inquiries--inquiry_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/contact-inquiries/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/contact-inquiries/16';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-DELETEapi-contact-inquiries--inquiry_id-">
</span>
<span id="execution-results-DELETEapi-contact-inquiries--inquiry_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-contact-inquiries--inquiry_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-contact-inquiries--inquiry_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-contact-inquiries--inquiry_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-contact-inquiries--inquiry_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-contact-inquiries--inquiry_id-" data-method="DELETE"
      data-path="api/contact-inquiries/{inquiry_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-contact-inquiries--inquiry_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-contact-inquiries--inquiry_id-"
                    onclick="tryItOut('DELETEapi-contact-inquiries--inquiry_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-contact-inquiries--inquiry_id-"
                    onclick="cancelTryOut('DELETEapi-contact-inquiries--inquiry_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-contact-inquiries--inquiry_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/contact-inquiries/{inquiry_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-contact-inquiries--inquiry_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-contact-inquiries--inquiry_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>inquiry_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inquiry_id"                data-endpoint="DELETEapi-contact-inquiries--inquiry_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the inquiry. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-payment-process">Process payment and return payment key/iframe URL</h2>

<p>
</p>



<span id="example-requests-POSTapi-payment-process">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/payment/process" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/payment/process"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/payment/process';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-payment-process">
</span>
<span id="execution-results-POSTapi-payment-process" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-payment-process"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-payment-process"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-payment-process" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-payment-process">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-payment-process" data-method="POST"
      data-path="api/payment/process"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-payment-process', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-payment-process"
                    onclick="tryItOut('POSTapi-payment-process');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-payment-process"
                    onclick="cancelTryOut('POSTapi-payment-process');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-payment-process"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/payment/process</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-payment-process"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-payment-process"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-payment-callback">Handle payment callback from Paymob</h2>

<p>
</p>



<span id="example-requests-GETapi-payment-callback">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/payment/callback" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/payment/callback"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/payment/callback';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-payment-callback">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
set-cookie: laravel-session=eyJpdiI6IlRVRE1UUGNSWUp5WmZXRXpVcGcwZGc9PSIsInZhbHVlIjoicDRBT05EWDd5YTRVbkRsVnJDalhBOUN0VXdjSmZrWjNEeXA0dWx1LzBGeng3RTVwYkZpMWYvcjh0OEJ5c05leVkwTFhIbE4yN2xMSjJRZ25Icm1CNEZNeEJHelMyaGpPcWNhYWNHTlVuQzFyalhFOUdOZFZZemNZQWdHTnk4Q1ciLCJtYWMiOiI0M2RhYWI2ZGU3YWYwMDdmOTc0ZGQ1NTQ3NmQ2ODUxZGU2NTM5ZWVjNjRmZTk2NDNlZGExMjkyMjUxMTg0YmJkIiwidGFnIjoiIn0%3D; expires=Wed, 21 Jan 2026 11:38:44 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;payment_status&quot;: &quot;failed&quot;,
    &quot;order_id&quot;: null,
    &quot;payment_id&quot;: null,
    &quot;tracking_number&quot;: null
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-payment-callback" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-payment-callback"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-payment-callback"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-payment-callback" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-payment-callback">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-payment-callback" data-method="GET"
      data-path="api/payment/callback"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-payment-callback', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-payment-callback"
                    onclick="tryItOut('GETapi-payment-callback');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-payment-callback"
                    onclick="cancelTryOut('GETapi-payment-callback');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-payment-callback"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/payment/callback</code></b>
        </p>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/payment/callback</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-payment-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-payment-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-payment-webhook">Handle payment webhook from Paymob</h2>

<p>
</p>



<span id="example-requests-POSTapi-payment-webhook">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/payment/webhook" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/payment/webhook"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/payment/webhook';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-payment-webhook">
</span>
<span id="execution-results-POSTapi-payment-webhook" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-payment-webhook"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-payment-webhook"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-payment-webhook" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-payment-webhook">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-payment-webhook" data-method="POST"
      data-path="api/payment/webhook"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-payment-webhook', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-payment-webhook"
                    onclick="tryItOut('POSTapi-payment-webhook');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-payment-webhook"
                    onclick="cancelTryOut('POSTapi-payment-webhook');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-payment-webhook"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/payment/webhook</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-payment-webhook"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-payment-webhook"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-shipments">POST api/shipments</h2>

<p>
</p>



<span id="example-requests-POSTapi-shipments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/shipments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"receiver_first_name\": \"architecto\",
    \"receiver_last_name\": \"architecto\",
    \"receiver_phone\": \"architecto\",
    \"receiver_email\": \"zbailey@example.net\",
    \"building_number\": 16,
    \"first_line\": \"architecto\",
    \"city\": \"architecto\",
    \"zone\": \"architecto\",
    \"cod\": 39,
    \"order_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/shipments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "receiver_first_name": "architecto",
    "receiver_last_name": "architecto",
    "receiver_phone": "architecto",
    "receiver_email": "zbailey@example.net",
    "building_number": 16,
    "first_line": "architecto",
    "city": "architecto",
    "zone": "architecto",
    "cod": 39,
    "order_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/shipments';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'receiver_first_name' =&gt; 'architecto',
            'receiver_last_name' =&gt; 'architecto',
            'receiver_phone' =&gt; 'architecto',
            'receiver_email' =&gt; 'zbailey@example.net',
            'building_number' =&gt; 16,
            'first_line' =&gt; 'architecto',
            'city' =&gt; 'architecto',
            'zone' =&gt; 'architecto',
            'cod' =&gt; 39,
            'order_id' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-shipments">
</span>
<span id="execution-results-POSTapi-shipments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-shipments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-shipments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-shipments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-shipments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-shipments" data-method="POST"
      data-path="api/shipments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-shipments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-shipments"
                    onclick="tryItOut('POSTapi-shipments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-shipments"
                    onclick="cancelTryOut('POSTapi-shipments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-shipments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/shipments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-shipments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-shipments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>receiver_first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="receiver_first_name"                data-endpoint="POSTapi-shipments"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>receiver_last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="receiver_last_name"                data-endpoint="POSTapi-shipments"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>receiver_phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="receiver_phone"                data-endpoint="POSTapi-shipments"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>receiver_email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="receiver_email"                data-endpoint="POSTapi-shipments"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>zbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>building_number</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="building_number"                data-endpoint="POSTapi-shipments"
               value="16"
               data-component="body">
    <br>
<p>Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>floor</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="floor"                data-endpoint="POSTapi-shipments"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>apartment</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="apartment"                data-endpoint="POSTapi-shipments"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_line</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_line"                data-endpoint="POSTapi-shipments"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="POSTapi-shipments"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>zone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="zone"                data-endpoint="POSTapi-shipments"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-shipments"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cod</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cod"                data-endpoint="POSTapi-shipments"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>business_reference</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="business_reference"                data-endpoint="POSTapi-shipments"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="order_id"                data-endpoint="POSTapi-shipments"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the orders table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-shipments--tracking_number-">GET api/shipments/{tracking_number}</h2>

<p>
</p>



<span id="example-requests-GETapi-shipments--tracking_number-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/shipments/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/shipments/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/shipments/architecto';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-shipments--tracking_number-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
set-cookie: laravel-session=eyJpdiI6IlFNR2s3UXNLUHg0TWFkdmhsMng0MHc9PSIsInZhbHVlIjoicGtWbGt3NjdPWWRydU5Sd3RGdFloWHdpTExQQjVLdjI0Qis2RTROZ0piclQxbStRVnJtbHNEMUZicDNOYTJNNVF1Zy9VeUZsYjErRm9ybXJrTnZmZEhmQkhmRXN1L2tZOWJjVCtYOXliSmJ5SnE5VkI4L2FFYVduS2dWZFE4bTQiLCJtYWMiOiIzZjUyOGFiNDE1ZDBkNGVmOTBiNTA1ZTQ3YTFhYzU4ZGIxNWM1NmExZmZlMjkyNTc0MjRlN2QyMjNhMDg0ZTMyIiwidGFnIjoiIn0%3D; expires=Wed, 21 Jan 2026 11:38:45 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Tracking number not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-shipments--tracking_number-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-shipments--tracking_number-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-shipments--tracking_number-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-shipments--tracking_number-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-shipments--tracking_number-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-shipments--tracking_number-" data-method="GET"
      data-path="api/shipments/{tracking_number}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-shipments--tracking_number-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-shipments--tracking_number-"
                    onclick="tryItOut('GETapi-shipments--tracking_number-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-shipments--tracking_number-"
                    onclick="cancelTryOut('GETapi-shipments--tracking_number-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-shipments--tracking_number-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/shipments/{tracking_number}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-shipments--tracking_number-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-shipments--tracking_number-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tracking_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tracking_number"                data-endpoint="GETapi-shipments--tracking_number-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-shipments--tracking_number-">PUT api/shipments/{tracking_number}</h2>

<p>
</p>



<span id="example-requests-PUTapi-shipments--tracking_number-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/shipments/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"architecto\",
    \"notes\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/shipments/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "architecto",
    "notes": "architecto"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/shipments/architecto';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'status' =&gt; 'architecto',
            'notes' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-PUTapi-shipments--tracking_number-">
</span>
<span id="execution-results-PUTapi-shipments--tracking_number-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-shipments--tracking_number-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-shipments--tracking_number-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-shipments--tracking_number-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-shipments--tracking_number-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-shipments--tracking_number-" data-method="PUT"
      data-path="api/shipments/{tracking_number}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-shipments--tracking_number-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-shipments--tracking_number-"
                    onclick="tryItOut('PUTapi-shipments--tracking_number-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-shipments--tracking_number-"
                    onclick="cancelTryOut('PUTapi-shipments--tracking_number-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-shipments--tracking_number-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/shipments/{tracking_number}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-shipments--tracking_number-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-shipments--tracking_number-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tracking_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tracking_number"                data-endpoint="PUTapi-shipments--tracking_number-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-shipments--tracking_number-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="PUTapi-shipments--tracking_number-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-pickups">POST api/pickups</h2>

<p>
</p>



<span id="example-requests-POSTapi-pickups">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/pickups" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"scheduledDate\": \"2052-02-14\",
    \"businessLocationId\": \"architecto\",
    \"contactPerson\": {
        \"name\": \"architecto\",
        \"phone\": \"architecto\",
        \"secPhone\": \"architecto\",
        \"email\": \"zbailey@example.net\"
    },
    \"notes\": \"architecto\",
    \"noOfPackages\": 22,
    \"packageType\": \"Heavy Bulky\",
    \"repeatedData\": {
        \"repeatedType\": \"Weekly\",
        \"days\": [
            \"Monday\"
        ],
        \"startDate\": \"2026-01-21T09:38:45\",
        \"endDate\": \"2052-02-14\"
    }
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/pickups"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "scheduledDate": "2052-02-14",
    "businessLocationId": "architecto",
    "contactPerson": {
        "name": "architecto",
        "phone": "architecto",
        "secPhone": "architecto",
        "email": "zbailey@example.net"
    },
    "notes": "architecto",
    "noOfPackages": 22,
    "packageType": "Heavy Bulky",
    "repeatedData": {
        "repeatedType": "Weekly",
        "days": [
            "Monday"
        ],
        "startDate": "2026-01-21T09:38:45",
        "endDate": "2052-02-14"
    }
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/pickups';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'scheduledDate' =&gt; '2052-02-14',
            'businessLocationId' =&gt; 'architecto',
            'contactPerson' =&gt; [
                'name' =&gt; 'architecto',
                'phone' =&gt; 'architecto',
                'secPhone' =&gt; 'architecto',
                'email' =&gt; 'zbailey@example.net',
            ],
            'notes' =&gt; 'architecto',
            'noOfPackages' =&gt; 22,
            'packageType' =&gt; 'Heavy Bulky',
            'repeatedData' =&gt; [
                'repeatedType' =&gt; 'Weekly',
                'days' =&gt; [
                    'Monday',
                ],
                'startDate' =&gt; '2026-01-21T09:38:45',
                'endDate' =&gt; '2052-02-14',
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-pickups">
</span>
<span id="execution-results-POSTapi-pickups" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-pickups"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-pickups"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-pickups" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-pickups">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-pickups" data-method="POST"
      data-path="api/pickups"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-pickups', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-pickups"
                    onclick="tryItOut('POSTapi-pickups');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-pickups"
                    onclick="cancelTryOut('POSTapi-pickups');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-pickups"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/pickups</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-pickups"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-pickups"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>scheduledDate</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="scheduledDate"                data-endpoint="POSTapi-pickups"
               value="2052-02-14"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after <code>today</code>. Example: <code>2052-02-14</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>businessLocationId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="businessLocationId"                data-endpoint="POSTapi-pickups"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>contactPerson</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="contactPerson.name"                data-endpoint="POSTapi-pickups"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="contactPerson.phone"                data-endpoint="POSTapi-pickups"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>secPhone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="contactPerson.secPhone"                data-endpoint="POSTapi-pickups"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="contactPerson.email"                data-endpoint="POSTapi-pickups"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>zbailey@example.net</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-pickups"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>noOfPackages</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="noOfPackages"                data-endpoint="POSTapi-pickups"
               value="22"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>22</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>packageType</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="packageType"                data-endpoint="POSTapi-pickups"
               value="Heavy Bulky"
               data-component="body">
    <br>
<p>Example: <code>Heavy Bulky</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Normal</code></li> <li><code>Light Bulky</code></li> <li><code>Heavy Bulky</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>repeatedData</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>repeatedType</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="repeatedData.repeatedType"                data-endpoint="POSTapi-pickups"
               value="Weekly"
               data-component="body">
    <br>
<p>Example: <code>Weekly</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>One Time</code></li> <li><code>Daily</code></li> <li><code>Weekly</code></li></ul>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>days</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="repeatedData.days[0]"                data-endpoint="POSTapi-pickups"
               data-component="body">
        <input type="text" style="display: none"
               name="repeatedData.days[1]"                data-endpoint="POSTapi-pickups"
               data-component="body">
    <br>

Must be one of:
<ul style="list-style-type: square;"><li><code>Sunday</code></li> <li><code>Monday</code></li> <li><code>Tuesday</code></li> <li><code>Wednesday</code></li> <li><code>Thursday</code></li> <li><code>Friday</code></li> <li><code>Saturday</code></li></ul>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>startDate</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="repeatedData.startDate"                data-endpoint="POSTapi-pickups"
               value="2026-01-21T09:38:45"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-01-21T09:38:45</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>endDate</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="repeatedData.endDate"                data-endpoint="POSTapi-pickups"
               value="2052-02-14"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after <code>repeatedData.startDate</code>. Example: <code>2052-02-14</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-webhook-bosta">POST api/webhook/bosta</h2>

<p>
</p>



<span id="example-requests-POSTapi-webhook-bosta">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/webhook/bosta" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/webhook/bosta"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/webhook/bosta';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-webhook-bosta">
</span>
<span id="execution-results-POSTapi-webhook-bosta" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-webhook-bosta"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-webhook-bosta"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-webhook-bosta" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-webhook-bosta">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-webhook-bosta" data-method="POST"
      data-path="api/webhook/bosta"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-webhook-bosta', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-webhook-bosta"
                    onclick="tryItOut('POSTapi-webhook-bosta');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-webhook-bosta"
                    onclick="cancelTryOut('POSTapi-webhook-bosta');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-webhook-bosta"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/webhook/bosta</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-webhook-bosta"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-webhook-bosta"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-test-webhook-bosta">Test webhook endpoint for development</h2>

<p>
</p>



<span id="example-requests-POSTapi-test-webhook-bosta">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/test/webhook/bosta" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/test/webhook/bosta"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/test/webhook/bosta';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-test-webhook-bosta">
</span>
<span id="execution-results-POSTapi-test-webhook-bosta" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-test-webhook-bosta"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-test-webhook-bosta"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-test-webhook-bosta" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-test-webhook-bosta">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-test-webhook-bosta" data-method="POST"
      data-path="api/test/webhook/bosta"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-test-webhook-bosta', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-test-webhook-bosta"
                    onclick="tryItOut('POSTapi-test-webhook-bosta');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-test-webhook-bosta"
                    onclick="cancelTryOut('POSTapi-test-webhook-bosta');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-test-webhook-bosta"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/test/webhook/bosta</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-test-webhook-bosta"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-test-webhook-bosta"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-settings-env">POST api/settings/env</h2>

<p>
</p>



<span id="example-requests-POSTapi-settings-env">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/settings/env" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"PAYMOB_BASE_URL\": \"http:\\/\\/www.bailey.biz\\/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html\",
    \"PAYMOB_API_KEY\": \"architecto\",
    \"PAYMOB_INTEGRATION_ID\": 4326.41688,
    \"PAYMOB_IFRAME_ID\": 4326.41688,
    \"BOSTA_API_KEY\": \"architecto\",
    \"BOSTA_BASE_URL\": \"http:\\/\\/bailey.com\\/\",
    \"MAIL_MAILER\": \"architecto\",
    \"MAIL_SCHEME\": \"architecto\",
    \"MAIL_HOST\": \"architecto\",
    \"MAIL_PORT\": 4326.41688,
    \"MAIL_USERNAME\": \"architecto\",
    \"MAIL_PASSWORD\": \"architecto\",
    \"MAIL_FROM_ADDRESS\": \"zbailey@example.net\",
    \"MAIL_FROM_NAME\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/settings/env"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "PAYMOB_BASE_URL": "http:\/\/www.bailey.biz\/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html",
    "PAYMOB_API_KEY": "architecto",
    "PAYMOB_INTEGRATION_ID": 4326.41688,
    "PAYMOB_IFRAME_ID": 4326.41688,
    "BOSTA_API_KEY": "architecto",
    "BOSTA_BASE_URL": "http:\/\/bailey.com\/",
    "MAIL_MAILER": "architecto",
    "MAIL_SCHEME": "architecto",
    "MAIL_HOST": "architecto",
    "MAIL_PORT": 4326.41688,
    "MAIL_USERNAME": "architecto",
    "MAIL_PASSWORD": "architecto",
    "MAIL_FROM_ADDRESS": "zbailey@example.net",
    "MAIL_FROM_NAME": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/settings/env';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'PAYMOB_BASE_URL' =&gt; 'http://www.bailey.biz/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html',
            'PAYMOB_API_KEY' =&gt; 'architecto',
            'PAYMOB_INTEGRATION_ID' =&gt; 4326.41688,
            'PAYMOB_IFRAME_ID' =&gt; 4326.41688,
            'BOSTA_API_KEY' =&gt; 'architecto',
            'BOSTA_BASE_URL' =&gt; 'http://bailey.com/',
            'MAIL_MAILER' =&gt; 'architecto',
            'MAIL_SCHEME' =&gt; 'architecto',
            'MAIL_HOST' =&gt; 'architecto',
            'MAIL_PORT' =&gt; 4326.41688,
            'MAIL_USERNAME' =&gt; 'architecto',
            'MAIL_PASSWORD' =&gt; 'architecto',
            'MAIL_FROM_ADDRESS' =&gt; 'zbailey@example.net',
            'MAIL_FROM_NAME' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-settings-env">
</span>
<span id="execution-results-POSTapi-settings-env" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-settings-env"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-settings-env"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-settings-env" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-settings-env">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-settings-env" data-method="POST"
      data-path="api/settings/env"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-settings-env', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-settings-env"
                    onclick="tryItOut('POSTapi-settings-env');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-settings-env"
                    onclick="cancelTryOut('POSTapi-settings-env');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-settings-env"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/settings/env</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-settings-env"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-settings-env"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>PAYMOB_BASE_URL</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="PAYMOB_BASE_URL"                data-endpoint="POSTapi-settings-env"
               value="http://www.bailey.biz/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html"
               data-component="body">
    <br>
<p>Must be a valid URL. Example: <code>http://www.bailey.biz/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>PAYMOB_API_KEY</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="PAYMOB_API_KEY"                data-endpoint="POSTapi-settings-env"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>PAYMOB_INTEGRATION_ID</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="PAYMOB_INTEGRATION_ID"                data-endpoint="POSTapi-settings-env"
               value="4326.41688"
               data-component="body">
    <br>
<p>Example: <code>4326.41688</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>PAYMOB_IFRAME_ID</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="PAYMOB_IFRAME_ID"                data-endpoint="POSTapi-settings-env"
               value="4326.41688"
               data-component="body">
    <br>
<p>Example: <code>4326.41688</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>BOSTA_API_KEY</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="BOSTA_API_KEY"                data-endpoint="POSTapi-settings-env"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>BOSTA_BASE_URL</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="BOSTA_BASE_URL"                data-endpoint="POSTapi-settings-env"
               value="http://bailey.com/"
               data-component="body">
    <br>
<p>Must be a valid URL. Example: <code>http://bailey.com/</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>MAIL_MAILER</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="MAIL_MAILER"                data-endpoint="POSTapi-settings-env"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>MAIL_SCHEME</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="MAIL_SCHEME"                data-endpoint="POSTapi-settings-env"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>MAIL_HOST</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="MAIL_HOST"                data-endpoint="POSTapi-settings-env"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>MAIL_PORT</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="MAIL_PORT"                data-endpoint="POSTapi-settings-env"
               value="4326.41688"
               data-component="body">
    <br>
<p>Example: <code>4326.41688</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>MAIL_USERNAME</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="MAIL_USERNAME"                data-endpoint="POSTapi-settings-env"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>MAIL_PASSWORD</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="MAIL_PASSWORD"                data-endpoint="POSTapi-settings-env"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>MAIL_FROM_ADDRESS</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="MAIL_FROM_ADDRESS"                data-endpoint="POSTapi-settings-env"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>zbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>MAIL_FROM_NAME</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="MAIL_FROM_NAME"                data-endpoint="POSTapi-settings-env"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-settings-env-debug">GET api/settings/env/debug</h2>

<p>
</p>



<span id="example-requests-GETapi-settings-env-debug">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/settings/env/debug" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/settings/env/debug"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/settings/env/debug';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-settings-env-debug">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
set-cookie: laravel-session=eyJpdiI6ImI4OFVTeGVnSk5GZW8yTHJKM0hxNWc9PSIsInZhbHVlIjoiSWZ5eFp1Mi9uRXRxSDA4Z0FWNnF1a0wyaFZPaEFud25rZ21uU21TWDZsNFYvdHRBelpYMm54bmpyMkcvY1dRZm96WklBbHZyOTJjVVB4Zmg1ejZhODI3SzU4d2M1Y213MjkzMVpiYnMvbVVnaDhPbzFpa2orbGpKUFJvOWtxR04iLCJtYWMiOiJmMzdiMWUwMGE3NzFkNjk3MjNiN2RjZDAwZTczZGUzY2QzMTIxYmYyMzY4OTU3NjNhYjk4MGQxZWE3NjA2YjBmIiwidGFnIjoiIn0%3D; expires=Wed, 21 Jan 2026 11:38:45 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: {
        &quot;file_path&quot;: &quot;D:\\code\\ecommerce-api\\.env&quot;,
        &quot;is_writable&quot;: true,
        &quot;config_cached&quot;: false
    },
    &quot;laravel_active_values&quot;: {
        &quot;PAYMOB_BASE_URL&quot;: &quot;https://accept.paymob.com&quot;,
        &quot;PAYMOB_API_KEY&quot;: &quot;ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2TVRFeE16STRPU3dpYm1GdFpTSTZJbWx1YVhScFlXd2lmUS5NSF96bVNyVWZDTDZFeURYNjdpREstY3pxUUF0MUJoZ1d1SmFEd2xpcGstLXN1MWJ6YkZPSTVTbC15VkFNWG5GbktpZi1NQ0w1QldyYV9xZEVSM0ZRUQ==&quot;,
        &quot;BOSTA_API_KEY&quot;: &quot;b286cff91b7015a1ef89aea14d750f4f1e241fd3b96486a7d87a47d21ff4933f&quot;,
        &quot;MAIL_MAILER&quot;: &quot;smtp&quot;,
        &quot;MAIL_SCHEME&quot;: null,
        &quot;MAIL_HOST&quot;: &quot;smtp.gmail.com&quot;,
        &quot;MAIL_PORT&quot;: &quot;465&quot;,
        &quot;MAIL_USERNAME&quot;: &quot;ahmadkholy98@gmail.com&quot;,
        &quot;MAIL_PASSWORD&quot;: &quot;akcynlcfghdfxjrq&quot;,
        &quot;MAIL_FROM_ADDRESS&quot;: &quot;ahmadkholy98@gmail.com&quot;,
        &quot;MAIL_FROM_NAME&quot;: &quot;Laravel&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-settings-env-debug" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-settings-env-debug"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-settings-env-debug"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-settings-env-debug" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-settings-env-debug">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-settings-env-debug" data-method="GET"
      data-path="api/settings/env/debug"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-settings-env-debug', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-settings-env-debug"
                    onclick="tryItOut('GETapi-settings-env-debug');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-settings-env-debug"
                    onclick="cancelTryOut('GETapi-settings-env-debug');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-settings-env-debug"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/settings/env/debug</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-settings-env-debug"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-settings-env-debug"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                                        <button type="button" class="lang-button" data-language-name="php">php</button>
                            </div>
            </div>
</div>
</body>
</html>
