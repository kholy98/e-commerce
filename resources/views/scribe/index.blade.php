<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Al-Atheer Ecommerce API Documentation</title>

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
                                                                                <li class="tocify-item level-2" data-unique="products-POSTapi-products-find">
                                <a href="#products-POSTapi-products-find">Find product by specifications</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="products-GETapi-products--identifier-">
                                <a href="#products-GETapi-products--identifier-">Get product details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="products-GETapi-admin-products">
                                <a href="#products-GETapi-admin-products">List all products (Admin)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="products-POSTapi-admin-products">
                                <a href="#products-POSTapi-admin-products">Create a new product (Admin only)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="products-PUTapi-admin-products--product_id-">
                                <a href="#products-PUTapi-admin-products--product_id-">Update a product (Admin only)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="products-DELETEapi-admin-products--product_id-">
                                <a href="#products-DELETEapi-admin-products--product_id-">Delete a product (Admin only)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="products-GETapi-admin-products-low-stock">
                                <a href="#products-GETapi-admin-products-low-stock">Get low stock products (Admin only)</a>
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
                                                                                <li class="tocify-item level-2" data-unique="categories-GETapi-admin-categories">
                                <a href="#categories-GETapi-admin-categories">List all categories (Admin)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-POSTapi-admin-categories">
                                <a href="#categories-POSTapi-admin-categories">Create category</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-GETapi-admin-categories--category_id-">
                                <a href="#categories-GETapi-admin-categories--category_id-">Get category details (Admin)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-PUTapi-admin-categories--category_id-">
                                <a href="#categories-PUTapi-admin-categories--category_id-">Update category</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-DELETEapi-admin-categories--category_id-">
                                <a href="#categories-DELETEapi-admin-categories--category_id-">Delete category</a>
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
                                <a href="#checkout-GETapi-checkout-complete">Complete checkout (Redirect)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="checkout-POSTapi-checkout-complete">
                                <a href="#checkout-POSTapi-checkout-complete">Complete checkout (Webhook)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="checkout-GETapi-checkout-fail">
                                <a href="#checkout-GETapi-checkout-fail">Handle checkout failure (GET)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="checkout-POSTapi-checkout-fail">
                                <a href="#checkout-POSTapi-checkout-fail">Handle checkout failure (POST)</a>
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
                                                                                <li class="tocify-item level-2" data-unique="orders-GETapi-admin-orders-statistics">
                                <a href="#orders-GETapi-admin-orders-statistics">Get order statistics</a>
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
                    <ul id="tocify-header-team-members" class="tocify-header">
                <li class="tocify-item level-1" data-unique="team-members">
                    <a href="#team-members">Team Members</a>
                </li>
                                    <ul id="tocify-subheader-team-members" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="team-members-GETapi-admin-team-members">
                                <a href="#team-members-GETapi-admin-team-members">List all team members</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="team-members-GETapi-admin-team-members--teamMember_id-">
                                <a href="#team-members-GETapi-admin-team-members--teamMember_id-">Get a single team member</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-contact-inquiries" class="tocify-header">
                <li class="tocify-item level-1" data-unique="contact-inquiries">
                    <a href="#contact-inquiries">Contact Inquiries</a>
                </li>
                                    <ul id="tocify-subheader-contact-inquiries" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="contact-inquiries-GETapi-contact-inquiries-published">
                                <a href="#contact-inquiries-GETapi-contact-inquiries-published">Display a listing of published inquiries (for testimonials).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="contact-inquiries-GETapi-contact-inquiries">
                                <a href="#contact-inquiries-GETapi-contact-inquiries">Display a listing of contact inquiries.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="contact-inquiries-POSTapi-contact-inquiries">
                                <a href="#contact-inquiries-POSTapi-contact-inquiries">Store a newly created contact inquiry in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="contact-inquiries-GETapi-contact-inquiries--inquiry_id-">
                                <a href="#contact-inquiries-GETapi-contact-inquiries--inquiry_id-">Display the specified contact inquiry.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="contact-inquiries-PUTapi-contact-inquiries--inquiry_id-">
                                <a href="#contact-inquiries-PUTapi-contact-inquiries--inquiry_id-">Update the specified contact inquiry in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="contact-inquiries-PATCHapi-contact-inquiries--inquiry_id-">
                                <a href="#contact-inquiries-PATCHapi-contact-inquiries--inquiry_id-">Partially update the specified contact inquiry in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="contact-inquiries-POSTapi-contact-inquiries--inquiry_id--reply">
                                <a href="#contact-inquiries-POSTapi-contact-inquiries--inquiry_id--reply">Reply to a contact inquiry.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="contact-inquiries-DELETEapi-contact-inquiries--inquiry_id-">
                                <a href="#contact-inquiries-DELETEapi-contact-inquiries--inquiry_id-">Remove the specified contact inquiry from storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="contact-inquiries-admin-management">
                                <a href="#contact-inquiries-admin-management">Admin Management</a>
                            </li>
                                                            <ul id="tocify-subheader-contact-inquiries-admin-management" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="contact-inquiries-GETapi-admin-inquiries">
                                            <a href="#contact-inquiries-GETapi-admin-inquiries">Display a listing of all inquiries (admin view).</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="contact-inquiries-POSTapi-admin-inquiries--inquiry_id--publish">
                                            <a href="#contact-inquiries-POSTapi-admin-inquiries--inquiry_id--publish">Publish a contact inquiry.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="contact-inquiries-POSTapi-admin-inquiries--inquiry_id--unpublish">
                                            <a href="#contact-inquiries-POSTapi-admin-inquiries--inquiry_id--unpublish">Unpublish a contact inquiry.</a>
                                        </li>
                                                                    </ul>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-customer-addresses" class="tocify-header">
                <li class="tocify-item level-1" data-unique="customer-addresses">
                    <a href="#customer-addresses">Customer Addresses</a>
                </li>
                                    <ul id="tocify-subheader-customer-addresses" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="customer-addresses-GETapi-addresses">
                                <a href="#customer-addresses-GETapi-addresses">List all customer addresses</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="customer-addresses-POSTapi-addresses">
                                <a href="#customer-addresses-POSTapi-addresses">Create a new customer address</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="customer-addresses-GETapi-addresses--address_id-">
                                <a href="#customer-addresses-GETapi-addresses--address_id-">Get a specific customer address</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="customer-addresses-PUTapi-addresses--address_id-">
                                <a href="#customer-addresses-PUTapi-addresses--address_id-">Update a customer address</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="customer-addresses-DELETEapi-addresses--address_id-">
                                <a href="#customer-addresses-DELETEapi-addresses--address_id-">Delete a customer address</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="customer-addresses-PATCHapi-addresses--address_id--default">
                                <a href="#customer-addresses-PATCHapi-addresses--address_id--default">Set address as default</a>
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
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-admin-dashboard-stats">
                                <a href="#endpoints-GETapi-admin-dashboard-stats">Get dashboard statistics</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-admin-dashboard-products">
                                <a href="#endpoints-GETapi-admin-dashboard-products">Get recent products</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-admin-dashboard-categories">
                                <a href="#endpoints-GETapi-admin-dashboard-categories">Get all categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-admin-dashboard-revenue">
                                <a href="#endpoints-GETapi-admin-dashboard-revenue">Get revenue chart data</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-admin-dashboard-best-sellers">
                                <a href="#endpoints-GETapi-admin-dashboard-best-sellers">Get best selling products</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-supplier-dashboard-stats">
                                <a href="#endpoints-GETapi-supplier-dashboard-stats">GET api/supplier/dashboard/stats</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-supplier-orders">
                                <a href="#endpoints-GETapi-supplier-orders">GET api/supplier/orders</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PATCHapi-supplier-orders--order_id--status">
                                <a href="#endpoints-PATCHapi-supplier-orders--order_id--status">PATCH api/supplier/orders/{order_id}/status</a>
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
                    <ul id="tocify-header-user-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="user-management">
                    <a href="#user-management">User Management</a>
                </li>
                                    <ul id="tocify-subheader-user-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="user-management-GETapi-user">
                                <a href="#user-management-GETapi-user">Get authenticated user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-management-PUTapi-user">
                                <a href="#user-management-PUTapi-user">Update authenticated user</a>
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
        <li>Last updated: March 29, 2026</li>
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
    \"password_confirmation\": \"password123\",
    \"phone\": \"+1234567890\"
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
    "password_confirmation": "password123",
    "phone": "+1234567890"
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
            'phone' =&gt; '+1234567890',
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
        &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
        &quot;addresses&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;user_id&quot;: 1,
                &quot;label&quot;: &quot;Home&quot;,
                &quot;name&quot;: &quot;John Doe&quot;,
                &quot;phone&quot;: &quot;+1234567890&quot;,
                &quot;address&quot;: &quot;123 Main St, Cairo, Egypt&quot;,
                &quot;street&quot;: &quot;123 Main St&quot;,
                &quot;building_number&quot;: &quot;15&quot;,
                &quot;floor&quot;: &quot;3&quot;,
                &quot;apartment&quot;: &quot;5A&quot;,
                &quot;zone&quot;: &quot;Maadi&quot;,
                &quot;city&quot;: &quot;Cairo&quot;,
                &quot;zip_code&quot;: &quot;12345&quot;,
                &quot;country&quot;: &quot;Egypt&quot;,
                &quot;state&quot;: &quot;Cairo&quot;,
                &quot;is_default&quot;: true,
                &quot;is_billing&quot;: true,
                &quot;is_shipping&quot;: true,
                &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
            }
        ]
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
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-register"
               value="+1234567890"
               data-component="body">
    <br>
<p>optional The user's phone number. Example: <code>+1234567890</code></p>
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

                    <h2 id="products-POSTapi-products-find">Find product by specifications</h2>

<p>
</p>

<p>Retrieve a specific product by matching category, weight, and grind type.
Useful for finding the exact product variant for shopping cart additions.
Returns product data in both English and Arabic.</p>

<span id="example-requests-POSTapi-products-find">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/products/find" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"category\": \"\\\"Coffee Beans\\\"\",
    \"weight\": 0.25,
    \"grind_type\": \"\\\"medium\\\"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/products/find"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "category": "\"Coffee Beans\"",
    "weight": 0.25,
    "grind_type": "\"medium\""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/products/find';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'category' =&gt; '"Coffee Beans"',
            'weight' =&gt; 0.25,
            'grind_type' =&gt; '"medium"',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-products-find">
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
            &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
            &quot;description&quot;: &quot;High-quality arabica coffee beans&quot;,
            &quot;price&quot;: 25,
            &quot;cost&quot;: 15,
            &quot;stock&quot;: 100,
            &quot;sku&quot;: &quot;COF-001&quot;,
            &quot;is_active&quot;: true,
            &quot;grind_type&quot;: &quot;medium&quot;,
            &quot;grind_type_label&quot;: &quot;Medium Grind&quot;,
            &quot;weight&quot;: 0.25,
            &quot;weight_label&quot;: &quot;250g&quot;,
            &quot;category&quot;: {
                &quot;name&quot;: &quot;Coffee Beans&quot;,
                &quot;slug&quot;: &quot;coffee-beans&quot;
            },
            &quot;images&quot;: [
                {
                    &quot;url&quot;: &quot;https://example.com/storage/products/coffee-beans.jpg&quot;
                }
            ]
        },
        &quot;ar&quot;: {
            &quot;name&quot;: &quot;حبوب قهوة ممتازة&quot;,
            &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
            &quot;description&quot;: &quot;حبوب قهوة أرابيكا عالية الجودة&quot;,
            &quot;price&quot;: 25,
            &quot;cost&quot;: 15,
            &quot;stock&quot;: 100,
            &quot;sku&quot;: &quot;COF-001&quot;,
            &quot;is_active&quot;: true,
            &quot;grind_type&quot;: &quot;medium&quot;,
            &quot;grind_type_label&quot;: &quot;طحن متوسط&quot;,
            &quot;weight&quot;: 0.25,
            &quot;weight_label&quot;: &quot;250 غرام&quot;,
            &quot;category&quot;: {
                &quot;name&quot;: &quot;حبوب القهوة&quot;,
                &quot;slug&quot;: &quot;coffee-beans&quot;
            },
            &quot;images&quot;: [
                {
                    &quot;url&quot;: &quot;https://example.com/storage/products/coffee-beans.jpg&quot;
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
    &quot;message&quot;: &quot;Product not found with these specifications&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Validation failed&quot;,
    &quot;errors&quot;: {
        &quot;category&quot;: [
            &quot;Invalid category. Valid categories are: Coffee Beans, Espresso, Tea&quot;
        ],
        &quot;grind_type&quot;: [
            &quot;Invalid grind type. Valid types are: whole_bean, coarse, medium, fine, extra_fine&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-products-find" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-products-find"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-products-find"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-products-find" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-products-find">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-products-find" data-method="POST"
      data-path="api/products/find"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-products-find', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-products-find"
                    onclick="tryItOut('POSTapi-products-find');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-products-find"
                    onclick="cancelTryOut('POSTapi-products-find');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-products-find"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/products/find</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-products-find"
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
                              name="Accept"                data-endpoint="POSTapi-products-find"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category"                data-endpoint="POSTapi-products-find"
               value=""Coffee Beans""
               data-component="body">
    <br>
<p>Category name, slug, or Arabic name. Example: <code>"Coffee Beans"</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>weight</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="weight"                data-endpoint="POSTapi-products-find"
               value="0.25"
               data-component="body">
    <br>
<p>Product weight in kg. Example: <code>0.25</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>grind_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="grind_type"                data-endpoint="POSTapi-products-find"
               value=""medium""
               data-component="body">
    <br>
<p>Grind type (whole_bean, coarse, medium, fine, extra_fine). Example: <code>"medium"</code></p>
        </div>
        </form>

                    <h2 id="products-GETapi-products--identifier-">Get product details</h2>

<p>
</p>

<p>Retrieve detailed information about a specific product.
Returns product data in both English and Arabic.
Accepts either product ID or slug as the identifier.</p>

<span id="example-requests-GETapi-products--identifier-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/products/1 or &amp;quot;premium-coffee-beans&amp;quot;" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/products/1 or &amp;quot;premium-coffee-beans&amp;quot;"
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
$url = 'http://127.0.0.1:8000/api/products/1 or "premium-coffee-beans"';
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

<span id="example-responses-GETapi-products--identifier-">
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
            &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
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
            &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
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
<span id="execution-results-GETapi-products--identifier-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-products--identifier-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products--identifier-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products--identifier-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-products--identifier-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-products--identifier-" data-method="GET"
      data-path="api/products/{identifier}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products--identifier-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products--identifier-"
                    onclick="tryItOut('GETapi-products--identifier-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products--identifier-"
                    onclick="cancelTryOut('GETapi-products--identifier-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products--identifier-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products/{identifier}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products--identifier-"
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
                              name="Accept"                data-endpoint="GETapi-products--identifier-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>identifier</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="identifier"                data-endpoint="GETapi-products--identifier-"
               value="1 or "premium-coffee-beans""
               data-component="url">
    <br>
<p>integer|string required The product ID or slug. Example: <code>1 or "premium-coffee-beans"</code></p>
            </div>
                    </form>

                    <h2 id="products-GETapi-admin-products">List all products (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of all products (including inactive) for admin management.
Same as public endpoint but shows all products regardless of active status.</p>

<span id="example-requests-GETapi-admin-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/products?category_id=1&amp;search=coffee&amp;sort_by=price&amp;sort_direction=desc&amp;per_page=10" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/products"
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
$url = 'http://127.0.0.1:8000/api/admin/products';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
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

<span id="example-responses-GETapi-admin-products">
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
<span id="execution-results-GETapi-admin-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-products" data-method="GET"
      data-path="api/admin/products"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-products"
                    onclick="tryItOut('GETapi-admin-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-products"
                    onclick="cancelTryOut('GETapi-admin-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-products"
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
                              name="Content-Type"                data-endpoint="GETapi-admin-products"
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
                              name="Accept"                data-endpoint="GETapi-admin-products"
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
               step="any"               name="category_id"                data-endpoint="GETapi-admin-products"
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
                              name="search"                data-endpoint="GETapi-admin-products"
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
                              name="sort_by"                data-endpoint="GETapi-admin-products"
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
                              name="sort_direction"                data-endpoint="GETapi-admin-products"
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
               step="any"               name="per_page"                data-endpoint="GETapi-admin-products"
               value="10"
               data-component="query">
    <br>
<p>Number of items per page. Default: 15. Example: <code>10</code></p>
            </div>
                </form>

                    <h2 id="products-POSTapi-admin-products">Create a new product (Admin only)</h2>

<p>
</p>



<span id="example-requests-POSTapi-admin-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/admin/products" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "name=b"\
    --form "name_ar=n"\
    --form "description=Eius et animi quos velit et."\
    --form "description_ar=architecto"\
    --form "price=39"\
    --form "cost=84"\
    --form "stock=12"\
    --form "sku=architecto"\
    --form "category_id=architecto"\
    --form "product_details[][title_en]=n"\
    --form "product_details[][title_ar]=g"\
    --form "product_details[][value_en]=z"\
    --form "product_details[][value_ar]=m"\
    --form "images[]=@C:\Users\adshift FrontEnd\AppData\Local\Temp\phpD97E.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/products"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'b');
body.append('name_ar', 'n');
body.append('description', 'Eius et animi quos velit et.');
body.append('description_ar', 'architecto');
body.append('price', '39');
body.append('cost', '84');
body.append('stock', '12');
body.append('sku', 'architecto');
body.append('category_id', 'architecto');
body.append('product_details[][title_en]', 'n');
body.append('product_details[][title_ar]', 'g');
body.append('product_details[][value_en]', 'z');
body.append('product_details[][value_ar]', 'm');
body.append('images[]', document.querySelector('input[name="images[]"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/admin/products';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'multipart/form-data',
            'Accept' =&gt; 'application/json',
        ],
        'multipart' =&gt; [
            [
                'name' =&gt; 'name',
                'contents' =&gt; 'b'
            ],
            [
                'name' =&gt; 'name_ar',
                'contents' =&gt; 'n'
            ],
            [
                'name' =&gt; 'description',
                'contents' =&gt; 'Eius et animi quos velit et.'
            ],
            [
                'name' =&gt; 'description_ar',
                'contents' =&gt; 'architecto'
            ],
            [
                'name' =&gt; 'price',
                'contents' =&gt; '39'
            ],
            [
                'name' =&gt; 'cost',
                'contents' =&gt; '84'
            ],
            [
                'name' =&gt; 'stock',
                'contents' =&gt; '12'
            ],
            [
                'name' =&gt; 'sku',
                'contents' =&gt; 'architecto'
            ],
            [
                'name' =&gt; 'category_id',
                'contents' =&gt; 'architecto'
            ],
            [
                'name' =&gt; 'product_details[][title_en]',
                'contents' =&gt; 'n'
            ],
            [
                'name' =&gt; 'product_details[][title_ar]',
                'contents' =&gt; 'g'
            ],
            [
                'name' =&gt; 'product_details[][value_en]',
                'contents' =&gt; 'z'
            ],
            [
                'name' =&gt; 'product_details[][value_ar]',
                'contents' =&gt; 'm'
            ],
            [
                'name' =&gt; 'images[]',
                'contents' =&gt; fopen('C:\Users\adshift FrontEnd\AppData\Local\Temp\phpD97E.tmp', 'r')
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-products">
</span>
<span id="execution-results-POSTapi-admin-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-products" data-method="POST"
      data-path="api/admin/products"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-products"
                    onclick="tryItOut('POSTapi-admin-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-products"
                    onclick="cancelTryOut('POSTapi-admin-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-products"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-products"
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
                              name="name"                data-endpoint="POSTapi-admin-products"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name_ar"                data-endpoint="POSTapi-admin-products"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-admin-products"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description_ar"                data-endpoint="POSTapi-admin-products"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-admin-products"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0.01. Example: <code>39</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cost</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cost"                data-endpoint="POSTapi-admin-products"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>stock</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="stock"                data-endpoint="POSTapi-admin-products"
               value="12"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>12</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sku</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sku"                data-endpoint="POSTapi-admin-products"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category_id"                data-endpoint="POSTapi-admin-products"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the categories table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>grind_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="grind_type"                data-endpoint="POSTapi-admin-products"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>weight</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="weight"                data-endpoint="POSTapi-admin-products"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>product_details</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>title_en</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_details.0.title_en"                data-endpoint="POSTapi-admin-products"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>title_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_details.0.title_ar"                data-endpoint="POSTapi-admin-products"
               value="g"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>g</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>value_en</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_details.0.value_en"                data-endpoint="POSTapi-admin-products"
               value="z"
               data-component="body">
    <br>
<p>Must not be greater than 1000 characters. Example: <code>z</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>value_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_details.0.value_ar"                data-endpoint="POSTapi-admin-products"
               value="m"
               data-component="body">
    <br>
<p>Must not be greater than 1000 characters. Example: <code>m</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>images</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="images[0]"                data-endpoint="POSTapi-admin-products"
               data-component="body">
        <input type="file" style="display: none"
               name="images[1]"                data-endpoint="POSTapi-admin-products"
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes.</p>
        </div>
        </form>

                    <h2 id="products-PUTapi-admin-products--product_id-">Update a product (Admin only)</h2>

<p>
</p>



<span id="example-requests-PUTapi-admin-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/admin/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/products/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/admin/products/1';
$response = $client-&gt;put(
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

<span id="example-responses-PUTapi-admin-products--product_id-">
</span>
<span id="execution-results-PUTapi-admin-products--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-admin-products--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-admin-products--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-admin-products--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-admin-products--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-admin-products--product_id-" data-method="PUT"
      data-path="api/admin/products/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-admin-products--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-admin-products--product_id-"
                    onclick="tryItOut('PUTapi-admin-products--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-admin-products--product_id-"
                    onclick="cancelTryOut('PUTapi-admin-products--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-admin-products--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/admin/products/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-admin-products--product_id-"
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
                              name="Accept"                data-endpoint="PUTapi-admin-products--product_id-"
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
               step="any"               name="product_id"                data-endpoint="PUTapi-admin-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="products-DELETEapi-admin-products--product_id-">Delete a product (Admin only)</h2>

<p>
</p>



<span id="example-requests-DELETEapi-admin-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/admin/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/products/1"
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
$url = 'http://127.0.0.1:8000/api/admin/products/1';
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

<span id="example-responses-DELETEapi-admin-products--product_id-">
</span>
<span id="execution-results-DELETEapi-admin-products--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-admin-products--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-admin-products--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-admin-products--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-admin-products--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-admin-products--product_id-" data-method="DELETE"
      data-path="api/admin/products/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-admin-products--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-admin-products--product_id-"
                    onclick="tryItOut('DELETEapi-admin-products--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-admin-products--product_id-"
                    onclick="cancelTryOut('DELETEapi-admin-products--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-admin-products--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/admin/products/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-admin-products--product_id-"
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
                              name="Accept"                data-endpoint="DELETEapi-admin-products--product_id-"
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
               step="any"               name="product_id"                data-endpoint="DELETEapi-admin-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="products-GETapi-admin-products-low-stock">Get low stock products (Admin only)</h2>

<p>
</p>



<span id="example-requests-GETapi-admin-products-low-stock">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/products/low-stock" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/products/low-stock"
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
$url = 'http://127.0.0.1:8000/api/admin/products/low-stock';
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

<span id="example-responses-GETapi-admin-products-low-stock">
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
access-control-expose-headers: X-Session-Token
set-cookie: al-atheer-ecommerce-session=eyJpdiI6IllQKzBDRDQ4QU9UTG9FZVl2R3QreVE9PSIsInZhbHVlIjoiK09VVFI3WTc0YUd6eFBDMktxdnFSRGQxa0U5ZGJubytIRWh6bktyYmZWY1cvUzhSN0dXQzFONmZNY1lxSUdkT2hXWDhmTXRsbHhrVmplOWp5VXY2Y25YZmZzWXdCaUZtVks4cXZnTzlnY0lSWmtQaUdTVnBsM21SdkY0N0o2U08iLCJtYWMiOiJiZTFlNWI1ODQzYzU2MGY1ZDQzMjQ3N2NhZDExYmE3NTc1MjhhMTcyNmM1YzdlOGFjYjFhMWM0MDc3ZmJkNzU5IiwidGFnIjoiIn0%3D; expires=Sun, 29 Mar 2026 14:15:13 GMT; Max-Age=7200; path=/; secure; httponly; samesite=none
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-products-low-stock" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-products-low-stock"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-products-low-stock"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-products-low-stock" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-products-low-stock">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-products-low-stock" data-method="GET"
      data-path="api/admin/products/low-stock"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-products-low-stock', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-products-low-stock"
                    onclick="tryItOut('GETapi-admin-products-low-stock');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-products-low-stock"
                    onclick="cancelTryOut('GETapi-admin-products-low-stock');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-products-low-stock"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/products/low-stock</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-products-low-stock"
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
                              name="Accept"                data-endpoint="GETapi-admin-products-low-stock"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
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

                    <h2 id="categories-GETapi-admin-categories">List all categories (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of all categories with optional filtering and sorting.
This endpoint is intended for admin use and returns all categories including inactive ones.</p>

<span id="example-requests-GETapi-admin-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/categories?search=coffee&amp;is_active=1&amp;sort_by=name&amp;sort_direction=desc&amp;per_page=10" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/categories"
);

const params = {
    "search": "coffee",
    "is_active": "1",
    "sort_by": "name",
    "sort_direction": "desc",
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
$url = 'http://127.0.0.1:8000/api/admin/categories';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'search' =&gt; 'coffee',
            'is_active' =&gt; '1',
            'sort_by' =&gt; 'name',
            'sort_direction' =&gt; 'desc',
            'per_page' =&gt; '10',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-categories">
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
                &quot;name&quot;: &quot;Coffee Beans&quot;,
                &quot;name_ar&quot;: &quot;حبوب القهوة&quot;,
                &quot;description&quot;: &quot;Premium coffee beans from around the world&quot;,
                &quot;description_ar&quot;: &quot;حبوب قهوة ممتازة من جميع أنحاء العالم&quot;,
                &quot;slug&quot;: &quot;coffee-beans&quot;,
                &quot;is_active&quot;: true,
                &quot;product_count&quot;: 15,
                &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
            }
        ],
        &quot;ar&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;حبوب القهوة&quot;,
                &quot;name_ar&quot;: &quot;حبوب القهوة&quot;,
                &quot;description&quot;: &quot;حبوب قهوة ممتازة من جميع أنحاء العالم&quot;,
                &quot;description_ar&quot;: &quot;حبوب قهوة ممتازة من جميع أنحاء العالم&quot;,
                &quot;slug&quot;: &quot;coffee-beans&quot;,
                &quot;is_active&quot;: true,
                &quot;product_count&quot;: 15,
                &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
            }
        ],
        &quot;pagination&quot;: {
            &quot;current_page&quot;: 1,
            &quot;last_page&quot;: 3,
            &quot;per_page&quot;: 15,
            &quot;total&quot;: 45
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-categories" data-method="GET"
      data-path="api/admin/categories"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-categories"
                    onclick="tryItOut('GETapi-admin-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-categories"
                    onclick="cancelTryOut('GETapi-admin-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-categories"
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
                              name="Content-Type"                data-endpoint="GETapi-admin-categories"
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
                              name="Accept"                data-endpoint="GETapi-admin-categories"
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
                              name="search"                data-endpoint="GETapi-admin-categories"
               value="coffee"
               data-component="query">
    <br>
<p>Search categories by name or description. Example: <code>coffee</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>is_active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="GETapi-admin-categories" style="display: none">
            <input type="radio" name="is_active"
                   value="1"
                   data-endpoint="GETapi-admin-categories"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-admin-categories" style="display: none">
            <input type="radio" name="is_active"
                   value="0"
                   data-endpoint="GETapi-admin-categories"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Filter by active status. Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_by</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_by"                data-endpoint="GETapi-admin-categories"
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
                              name="sort_direction"                data-endpoint="GETapi-admin-categories"
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
               step="any"               name="per_page"                data-endpoint="GETapi-admin-categories"
               value="10"
               data-component="query">
    <br>
<p>Number of items per page. Default: 15. Example: <code>10</code></p>
            </div>
                </form>

                    <h2 id="categories-POSTapi-admin-categories">Create category</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new product category. Requires admin authentication.</p>

<span id="example-requests-POSTapi-admin-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/admin/categories" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "name=Coffee Beans"\
    --form "name_ar=حبوب القهوة"\
    --form "description=Premium coffee beans from around the world"\
    --form "description_ar=حبوب قهوة ممتازة من جميع أنحاء العالم"\
    --form "is_active=1"\
    --form "image=@C:\Users\adshift FrontEnd\AppData\Local\Temp\phpD9A0.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/categories"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'Coffee Beans');
body.append('name_ar', 'حبوب القهوة');
body.append('description', 'Premium coffee beans from around the world');
body.append('description_ar', 'حبوب قهوة ممتازة من جميع أنحاء العالم');
body.append('is_active', '1');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/admin/categories';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'multipart/form-data',
            'Accept' =&gt; 'application/json',
        ],
        'multipart' =&gt; [
            [
                'name' =&gt; 'name',
                'contents' =&gt; 'Coffee Beans'
            ],
            [
                'name' =&gt; 'name_ar',
                'contents' =&gt; 'حبوب القهوة'
            ],
            [
                'name' =&gt; 'description',
                'contents' =&gt; 'Premium coffee beans from around the world'
            ],
            [
                'name' =&gt; 'description_ar',
                'contents' =&gt; 'حبوب قهوة ممتازة من جميع أنحاء العالم'
            ],
            [
                'name' =&gt; 'is_active',
                'contents' =&gt; '1'
            ],
            [
                'name' =&gt; 'image',
                'contents' =&gt; fopen('C:\Users\adshift FrontEnd\AppData\Local\Temp\phpD9A0.tmp', 'r')
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-categories">
            <blockquote>
            <p>Example response (201, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Category created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Coffee Beans&quot;,
        &quot;name_ar&quot;: &quot;حبوب القهوة&quot;,
        &quot;description&quot;: &quot;Premium coffee beans from around the world&quot;,
        &quot;slug&quot;: &quot;coffee-beans&quot;,
        &quot;is_active&quot;: true,
        &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The name field is required.&quot;,
    &quot;errors&quot;: {
        &quot;name&quot;: [
            &quot;The name field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-categories" data-method="POST"
      data-path="api/admin/categories"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-categories"
                    onclick="tryItOut('POSTapi-admin-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-categories"
                    onclick="cancelTryOut('POSTapi-admin-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-categories"
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
                              name="Content-Type"                data-endpoint="POSTapi-admin-categories"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-categories"
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
                              name="name"                data-endpoint="POSTapi-admin-categories"
               value="Coffee Beans"
               data-component="body">
    <br>
<p>The category name in English. Example: <code>Coffee Beans</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name_ar"                data-endpoint="POSTapi-admin-categories"
               value="حبوب القهوة"
               data-component="body">
    <br>
<p>The category name in Arabic. Example: <code>حبوب القهوة</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-admin-categories"
               value="Premium coffee beans from around the world"
               data-component="body">
    <br>
<p>The category description in English. Example: <code>Premium coffee beans from around the world</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description_ar"                data-endpoint="POSTapi-admin-categories"
               value="حبوب قهوة ممتازة من جميع أنحاء العالم"
               data-component="body">
    <br>
<p>The category description in Arabic. Example: <code>حبوب قهوة ممتازة من جميع أنحاء العالم</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-admin-categories" style="display: none">
            <input type="radio" name="is_active"
                   value="true"
                   data-endpoint="POSTapi-admin-categories"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-admin-categories" style="display: none">
            <input type="radio" name="is_active"
                   value="false"
                   data-endpoint="POSTapi-admin-categories"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Whether the category is active. Default: true. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="POSTapi-admin-categories"
               value=""
               data-component="body">
    <br>
<p>The category image (jpeg, png, jpg, gif, webp, max 2MB). Example: <code>C:\Users\adshift FrontEnd\AppData\Local\Temp\phpD9A0.tmp</code></p>
        </div>
        </form>

                    <h2 id="categories-GETapi-admin-categories--category_id-">Get category details (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve detailed information about a specific category including related products.</p>

<span id="example-requests-GETapi-admin-categories--category_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/categories/1" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/categories/1"
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
$url = 'http://127.0.0.1:8000/api/admin/categories/1';
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

<span id="example-responses-GETapi-admin-categories--category_id-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Coffee Beans&quot;,
        &quot;name_ar&quot;: &quot;حبوب القهوة&quot;,
        &quot;description&quot;: &quot;Premium coffee beans from around the world&quot;,
        &quot;slug&quot;: &quot;coffee-beans&quot;,
        &quot;is_active&quot;: true,
        &quot;products&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Premium Coffee Beans&quot;,
                &quot;slug&quot;: &quot;premium-coffee-beans&quot;,
                &quot;price&quot;: 25,
                &quot;stock&quot;: 100,
                &quot;is_active&quot;: true
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-categories--category_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-categories--category_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-categories--category_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-categories--category_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-categories--category_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-categories--category_id-" data-method="GET"
      data-path="api/admin/categories/{category_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-categories--category_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-categories--category_id-"
                    onclick="tryItOut('GETapi-admin-categories--category_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-categories--category_id-"
                    onclick="cancelTryOut('GETapi-admin-categories--category_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-categories--category_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/categories/{category_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-categories--category_id-"
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
                              name="Content-Type"                data-endpoint="GETapi-admin-categories--category_id-"
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
                              name="Accept"                data-endpoint="GETapi-admin-categories--category_id-"
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
               step="any"               name="category_id"                data-endpoint="GETapi-admin-categories--category_id-"
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
               step="any"               name="category"                data-endpoint="GETapi-admin-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The category ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="categories-PUTapi-admin-categories--category_id-">Update category</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update an existing product category. Requires admin authentication.</p>

<span id="example-requests-PUTapi-admin-categories--category_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/admin/categories/1" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "name=Coffee Beans"\
    --form "name_ar=حبوب القهوة"\
    --form "description=Premium coffee beans"\
    --form "description_ar=architecto"\
    --form "is_active=1"\
    --form "remove_image="\
    --form "image=@C:\Users\adshift FrontEnd\AppData\Local\Temp\phpD9A2.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/categories/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'Coffee Beans');
body.append('name_ar', 'حبوب القهوة');
body.append('description', 'Premium coffee beans');
body.append('description_ar', 'architecto');
body.append('is_active', '1');
body.append('remove_image', '');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/admin/categories/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'multipart/form-data',
            'Accept' =&gt; 'application/json',
        ],
        'multipart' =&gt; [
            [
                'name' =&gt; 'name',
                'contents' =&gt; 'Coffee Beans'
            ],
            [
                'name' =&gt; 'name_ar',
                'contents' =&gt; 'حبوب القهوة'
            ],
            [
                'name' =&gt; 'description',
                'contents' =&gt; 'Premium coffee beans'
            ],
            [
                'name' =&gt; 'description_ar',
                'contents' =&gt; 'architecto'
            ],
            [
                'name' =&gt; 'is_active',
                'contents' =&gt; '1'
            ],
            [
                'name' =&gt; 'remove_image',
                'contents' =&gt; ''
            ],
            [
                'name' =&gt; 'image',
                'contents' =&gt; fopen('C:\Users\adshift FrontEnd\AppData\Local\Temp\phpD9A2.tmp', 'r')
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-PUTapi-admin-categories--category_id-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Category updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Coffee Beans&quot;,
        &quot;name_ar&quot;: &quot;حبوب القهوة&quot;,
        &quot;description&quot;: &quot;Premium coffee beans&quot;,
        &quot;slug&quot;: &quot;coffee-beans&quot;,
        &quot;is_active&quot;: true
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-admin-categories--category_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-admin-categories--category_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-admin-categories--category_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-admin-categories--category_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-admin-categories--category_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-admin-categories--category_id-" data-method="PUT"
      data-path="api/admin/categories/{category_id}"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-admin-categories--category_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-admin-categories--category_id-"
                    onclick="tryItOut('PUTapi-admin-categories--category_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-admin-categories--category_id-"
                    onclick="cancelTryOut('PUTapi-admin-categories--category_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-admin-categories--category_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/admin/categories/{category_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-admin-categories--category_id-"
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
                              name="Content-Type"                data-endpoint="PUTapi-admin-categories--category_id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-admin-categories--category_id-"
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
               step="any"               name="category_id"                data-endpoint="PUTapi-admin-categories--category_id-"
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
               step="any"               name="category"                data-endpoint="PUTapi-admin-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The category ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-admin-categories--category_id-"
               value="Coffee Beans"
               data-component="body">
    <br>
<p>The category name in English. Example: <code>Coffee Beans</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name_ar"                data-endpoint="PUTapi-admin-categories--category_id-"
               value="حبوب القهوة"
               data-component="body">
    <br>
<p>The category name in Arabic. Example: <code>حبوب القهوة</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-admin-categories--category_id-"
               value="Premium coffee beans"
               data-component="body">
    <br>
<p>The category description in English. Example: <code>Premium coffee beans</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description_ar"                data-endpoint="PUTapi-admin-categories--category_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The category description in Arabic. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-admin-categories--category_id-" style="display: none">
            <input type="radio" name="is_active"
                   value="true"
                   data-endpoint="PUTapi-admin-categories--category_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-admin-categories--category_id-" style="display: none">
            <input type="radio" name="is_active"
                   value="false"
                   data-endpoint="PUTapi-admin-categories--category_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Whether the category is active. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="PUTapi-admin-categories--category_id-"
               value=""
               data-component="body">
    <br>
<p>The new category image (jpeg, png, jpg, gif, webp, max 2MB). Example: <code>C:\Users\adshift FrontEnd\AppData\Local\Temp\phpD9A2.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>remove_image</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-admin-categories--category_id-" style="display: none">
            <input type="radio" name="remove_image"
                   value="true"
                   data-endpoint="PUTapi-admin-categories--category_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-admin-categories--category_id-" style="display: none">
            <input type="radio" name="remove_image"
                   value="false"
                   data-endpoint="PUTapi-admin-categories--category_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Set to true to remove the current image. Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="categories-DELETEapi-admin-categories--category_id-">Delete category</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Delete a product category. Categories with existing products cannot be deleted.
Requires admin authentication.</p>

<span id="example-requests-DELETEapi-admin-categories--category_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/admin/categories/1" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/categories/1"
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
$url = 'http://127.0.0.1:8000/api/admin/categories/1';
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

<span id="example-responses-DELETEapi-admin-categories--category_id-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Category deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Has Products):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Cannot delete category with existing products&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-admin-categories--category_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-admin-categories--category_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-admin-categories--category_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-admin-categories--category_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-admin-categories--category_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-admin-categories--category_id-" data-method="DELETE"
      data-path="api/admin/categories/{category_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-admin-categories--category_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-admin-categories--category_id-"
                    onclick="tryItOut('DELETEapi-admin-categories--category_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-admin-categories--category_id-"
                    onclick="cancelTryOut('DELETEapi-admin-categories--category_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-admin-categories--category_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/admin/categories/{category_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-admin-categories--category_id-"
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
                              name="Content-Type"                data-endpoint="DELETEapi-admin-categories--category_id-"
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
                              name="Accept"                data-endpoint="DELETEapi-admin-categories--category_id-"
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
               step="any"               name="category_id"                data-endpoint="DELETEapi-admin-categories--category_id-"
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
               step="any"               name="category"                data-endpoint="DELETEapi-admin-categories--category_id-"
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
    \"user_id\": 16,
    \"payment_method\": \"cod\"
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
    "user_id": 16,
    "payment_method": "cod"
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
            'payment_method' =&gt; 'cod',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-checkout-initiate">
            <blockquote>
            <p>Example response (200, Success (Online Payment)):</p>
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
            <p>Example response (200, Success (Cash on Delivery)):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Order created successfully with Cash on Delivery&quot;,
    &quot;data&quot;: {
        &quot;order_id&quot;: 42,
        &quot;order_number&quot;: &quot;ORD-20240329143000-A1B2C3&quot;,
        &quot;payment_method&quot;: &quot;cod&quot;,
        &quot;payment_status&quot;: &quot;pending&quot;,
        &quot;status&quot;: &quot;processing&quot;,
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
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_method</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_method"                data-endpoint="POSTapi-checkout-initiate"
               value="cod"
               data-component="body">
    <br>
<p>The payment method. Use &quot;online&quot; for Paymob card payment (default), or &quot;cod&quot; for Cash on Delivery. Example: <code>cod</code></p>
        </div>
        </form>

                    <h2 id="checkout-GETapi-checkout-complete">Complete checkout (Redirect)</h2>

<p>
</p>

<p>Finalize the checkout process after successful payment.
This endpoint is intended to be called when the user is redirected back from the Paymob payment gateway.</p>

<span id="example-requests-GETapi-checkout-complete">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/checkout/complete?order_id=149823756&amp;payment_id=98765432" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


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

fetch(url, {
    method: "GET",
    headers,
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
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="order_id"                data-endpoint="GETapi-checkout-complete"
               value="149823756"
               data-component="query">
    <br>
<p>The temporary order ID from Paymob. Example: <code>149823756</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>payment_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_id"                data-endpoint="GETapi-checkout-complete"
               value="98765432"
               data-component="query">
    <br>
<p>The payment transaction ID from Paymob. Example: <code>98765432</code></p>
            </div>
                </form>

                    <h2 id="checkout-POSTapi-checkout-complete">Complete checkout (Webhook)</h2>

<p>
</p>

<p>Finalize the checkout process after successful payment.
This endpoint is intended to be called by the Paymob payment gateway webhook.</p>

<span id="example-requests-POSTapi-checkout-complete">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/checkout/complete" \
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
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/checkout/complete';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
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

<span id="example-responses-POSTapi-checkout-complete">
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
<span id="execution-results-POSTapi-checkout-complete" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-checkout-complete"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-checkout-complete"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-checkout-complete" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-checkout-complete">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-checkout-complete" data-method="POST"
      data-path="api/checkout/complete"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-checkout-complete', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-checkout-complete"
                    onclick="tryItOut('POSTapi-checkout-complete');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-checkout-complete"
                    onclick="cancelTryOut('POSTapi-checkout-complete');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-checkout-complete"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
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
                              name="Content-Type"                data-endpoint="POSTapi-checkout-complete"
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
                              name="Accept"                data-endpoint="POSTapi-checkout-complete"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="order_id"                data-endpoint="POSTapi-checkout-complete"
               value="149823756"
               data-component="body">
    <br>
<p>The temporary order ID from Paymob. Example: <code>149823756</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_id"                data-endpoint="POSTapi-checkout-complete"
               value="98765432"
               data-component="body">
    <br>
<p>The payment transaction ID from Paymob. Example: <code>98765432</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>success</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-checkout-complete" style="display: none">
            <input type="radio" name="success"
                   value="true"
                   data-endpoint="POSTapi-checkout-complete"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-checkout-complete" style="display: none">
            <input type="radio" name="success"
                   value="false"
                   data-endpoint="POSTapi-checkout-complete"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Whether the payment was successful. Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="checkout-GETapi-checkout-fail">Handle checkout failure (GET)</h2>

<p>
</p>

<p>Clears all pending checkout data after a failed payment attempt.
Redirects to the payment failed page for browser requests, or returns JSON for API requests.</p>

<span id="example-requests-GETapi-checkout-fail">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/checkout/fail?error=Payment+declined&amp;order_id=149823756&amp;txn_response_code=DECLINED" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/checkout/fail"
);

const params = {
    "error": "Payment declined",
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
            'error' =&gt; 'Payment declined',
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
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Checkout failed&quot;,
    &quot;error&quot;: &quot;Payment declined&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (302, Redirect):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">&quot;Redirects to /payment-failed&quot;</code>
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
               value="Payment declined"
               data-component="query">
    <br>
<p>Optional. Error message from the payment gateway. Example: <code>Payment declined</code></p>
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
<p>Optional. The temporary order ID that failed. Example: <code>149823756</code></p>
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
<p>Optional. Transaction response code from Paymob. Example: <code>DECLINED</code></p>
            </div>
                </form>

                    <h2 id="checkout-POSTapi-checkout-fail">Handle checkout failure (POST)</h2>

<p>
</p>

<p>Clears all pending checkout data after a failed payment attempt.
Redirects to the payment failed page for browser requests, or returns JSON for API requests.</p>

<span id="example-requests-POSTapi-checkout-fail">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/checkout/fail" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"error\": \"Payment declined\",
    \"order_id\": \"149823756\",
    \"txn_response_code\": \"DECLINED\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/checkout/fail"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "error": "Payment declined",
    "order_id": "149823756",
    "txn_response_code": "DECLINED"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/checkout/fail';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'error' =&gt; 'Payment declined',
            'order_id' =&gt; '149823756',
            'txn_response_code' =&gt; 'DECLINED',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-checkout-fail">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Checkout failed&quot;,
    &quot;error&quot;: &quot;Payment declined&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (302, Redirect):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">&quot;Redirects to /payment-failed&quot;</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-checkout-fail" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-checkout-fail"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-checkout-fail"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-checkout-fail" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-checkout-fail">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-checkout-fail" data-method="POST"
      data-path="api/checkout/fail"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-checkout-fail', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-checkout-fail"
                    onclick="tryItOut('POSTapi-checkout-fail');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-checkout-fail"
                    onclick="cancelTryOut('POSTapi-checkout-fail');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-checkout-fail"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
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
                              name="Content-Type"                data-endpoint="POSTapi-checkout-fail"
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
                              name="Accept"                data-endpoint="POSTapi-checkout-fail"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>error</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="error"                data-endpoint="POSTapi-checkout-fail"
               value="Payment declined"
               data-component="body">
    <br>
<p>Optional. Error message from the payment gateway. Example: <code>Payment declined</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="order_id"                data-endpoint="POSTapi-checkout-fail"
               value="149823756"
               data-component="body">
    <br>
<p>Optional. The temporary order ID that failed. Example: <code>149823756</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>txn_response_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="txn_response_code"                data-endpoint="POSTapi-checkout-fail"
               value="DECLINED"
               data-component="body">
    <br>
<p>Optional. Transaction response code from Paymob. Example: <code>DECLINED</code></p>
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

<p>Developer endpoint to simulate a successful payment for testing purposes.
Uses the most recent active pending checkout to create an order.</p>
<p><small class="badge badge-warning">Caution</small> Use only in development.</p>

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
        &quot;status&quot;: &quot;processing&quot;
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
                &quot;payment_method&quot;: &quot;online&quot;,
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
                &quot;payment_method&quot;: &quot;online&quot;,
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
        &quot;payment_method&quot;: &quot;online&quot;,
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

                    <h2 id="orders-GETapi-admin-orders-statistics">Get order statistics</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get aggregated order statistics. This endpoint is typically used by administrators for dashboard displays.</p>

<span id="example-requests-GETapi-admin-orders-statistics">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/orders/statistics" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/orders/statistics"
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
$url = 'http://127.0.0.1:8000/api/admin/orders/statistics';
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

<span id="example-responses-GETapi-admin-orders-statistics">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;total_orders&quot;: 150,
        &quot;pending_orders&quot;: 25,
        &quot;processing_orders&quot;: 30,
        &quot;shipped_orders&quot;: 45,
        &quot;delivered_orders&quot;: 40,
        &quot;cancelled_orders&quot;: 10,
        &quot;total_revenue&quot;: 15000,
        &quot;pending_revenue&quot;: 2500
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-orders-statistics" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-orders-statistics"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-orders-statistics"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-orders-statistics" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-orders-statistics">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-orders-statistics" data-method="GET"
      data-path="api/admin/orders/statistics"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-orders-statistics', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-orders-statistics"
                    onclick="tryItOut('GETapi-admin-orders-statistics');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-orders-statistics"
                    onclick="cancelTryOut('GETapi-admin-orders-statistics');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-orders-statistics"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/orders/statistics</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-orders-statistics"
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
                              name="Content-Type"                data-endpoint="GETapi-admin-orders-statistics"
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
                              name="Accept"                data-endpoint="GETapi-admin-orders-statistics"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
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

                <h1 id="team-members">Team Members</h1>

    <p>APIs for managing and retrieving team member information.</p>
<p>These endpoints provide access to team member data including contact details,
professional titles, social media links, and profile images.</p>

                                <h2 id="team-members-GETapi-admin-team-members">List all team members</h2>

<p>
</p>

<p>Get a paginated list of all team members with optional filtering and sorting.
Returns team member details including contact information, images, and social media links.</p>

<span id="example-requests-GETapi-admin-team-members">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/team-members?search=john&amp;sort_by=fullname&amp;sort_direction=asc&amp;per_page=10" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/team-members"
);

const params = {
    "search": "john",
    "sort_by": "fullname",
    "sort_direction": "asc",
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
$url = 'http://127.0.0.1:8000/api/admin/team-members';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'search' =&gt; 'john',
            'sort_by' =&gt; 'fullname',
            'sort_direction' =&gt; 'asc',
            'per_page' =&gt; '10',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-team-members">
            <blockquote>
            <p>Example response (200, Success with results):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;fullname&quot;: &quot;John Doe&quot;,
            &quot;phone&quot;: &quot;+1 (555) 123-4567&quot;,
            &quot;title&quot;: &quot;Senior Software Engineer&quot;,
            &quot;email&quot;: &quot;john.doe@example.com&quot;,
            &quot;social_media&quot;: [
                &quot;https://twitter.com/johndoe&quot;,
                &quot;https://linkedin.com/in/john-doe-profile&quot;,
                &quot;https://github.com/johndoe&quot;
            ],
            &quot;images&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;john-profile&quot;,
                    &quot;url&quot;: &quot;https://example.com/storage/media/1/john-profile.jpg&quot;,
                    &quot;thumb_url&quot;: &quot;https://example.com/storage/media/1/conversions/john-profile-thumb.jpg&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-15T14:45:00.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;fullname&quot;: &quot;Jane Smith&quot;,
            &quot;phone&quot;: &quot;+1 (555) 987-6543&quot;,
            &quot;title&quot;: &quot;Product Manager&quot;,
            &quot;email&quot;: &quot;jane.smith@example.com&quot;,
            &quot;social_media&quot;: [
                &quot;https://twitter.com/janesmith&quot;,
                &quot;https://linkedin.com/in/janesmith-pm&quot;,
                &quot;https://github.com/janesmith&quot;
            ],
            &quot;images&quot;: [],
            &quot;created_at&quot;: &quot;2024-01-10T08:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-12T16:20:00.000000Z&quot;
        }
    ],
    &quot;pagination&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 3,
        &quot;per_page&quot;: 15,
        &quot;total&quot;: 42
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-team-members" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-team-members"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-team-members"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-team-members" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-team-members">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-team-members" data-method="GET"
      data-path="api/admin/team-members"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-team-members', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-team-members"
                    onclick="tryItOut('GETapi-admin-team-members');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-team-members"
                    onclick="cancelTryOut('GETapi-admin-team-members');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-team-members"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/team-members</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-team-members"
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
                              name="Accept"                data-endpoint="GETapi-admin-team-members"
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
                              name="search"                data-endpoint="GETapi-admin-team-members"
               value="john"
               data-component="query">
    <br>
<p>Search by full name or email address. Example: <code>john</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_by</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_by"                data-endpoint="GETapi-admin-team-members"
               value="fullname"
               data-component="query">
    <br>
<p>Sort field - allowed values: <code>fullname</code>, <code>email</code>, <code>created_at</code>. Example: <code>fullname</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_direction</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_direction"                data-endpoint="GETapi-admin-team-members"
               value="asc"
               data-component="query">
    <br>
<p>Sort direction - allowed values: <code>asc</code>, <code>desc</code>. Default: <code>asc</code>. Example: <code>asc</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-team-members"
               value="10"
               data-component="query">
    <br>
<p>Number of items per page. Default: 15. Example: <code>10</code></p>
            </div>
                </form>

                    <h2 id="team-members-GETapi-admin-team-members--teamMember_id-">Get a single team member</h2>

<p>
</p>

<p>Retrieve detailed information about a specific team member by their ID.
Returns complete team member data including all images and social media links.</p>

<span id="example-requests-GETapi-admin-team-members--teamMember_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/team-members/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/team-members/16"
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
$url = 'http://127.0.0.1:8000/api/admin/team-members/16';
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

<span id="example-responses-GETapi-admin-team-members--teamMember_id-">
            <blockquote>
            <p>Example response (200, Team member found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;fullname&quot;: &quot;John Doe&quot;,
        &quot;phone&quot;: &quot;+1 (555) 123-4567&quot;,
        &quot;title&quot;: &quot;Senior Software Engineer&quot;,
        &quot;email&quot;: &quot;john.doe@example.com&quot;,
        &quot;social_media&quot;: {
            &quot;twitter&quot;: &quot;@johndoe&quot;,
            &quot;linkedin&quot;: &quot;john-doe-profile&quot;,
            &quot;github&quot;: &quot;johndoe&quot;,
            &quot;website&quot;: &quot;https://johndoe.dev&quot;
        },
        &quot;images&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;john-profile-main&quot;,
                &quot;url&quot;: &quot;https://example.com/storage/media/1/john-profile-main.jpg&quot;,
                &quot;thumb_url&quot;: &quot;https://example.com/storage/media/1/conversions/john-profile-main-thumb.jpg&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;john-profile-alt&quot;,
                &quot;url&quot;: &quot;https://example.com/storage/media/2/john-profile-alt.jpg&quot;,
                &quot;thumb_url&quot;: &quot;https://example.com/storage/media/2/conversions/john-profile-alt-thumb.jpg&quot;
            }
        ],
        &quot;created_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T14:45:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Team member not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\TeamMember] 999&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-team-members--teamMember_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-team-members--teamMember_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-team-members--teamMember_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-team-members--teamMember_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-team-members--teamMember_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-team-members--teamMember_id-" data-method="GET"
      data-path="api/admin/team-members/{teamMember_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-team-members--teamMember_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-team-members--teamMember_id-"
                    onclick="tryItOut('GETapi-admin-team-members--teamMember_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-team-members--teamMember_id-"
                    onclick="cancelTryOut('GETapi-admin-team-members--teamMember_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-team-members--teamMember_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/team-members/{teamMember_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-team-members--teamMember_id-"
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
                              name="Accept"                data-endpoint="GETapi-admin-team-members--teamMember_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>teamMember_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="teamMember_id"                data-endpoint="GETapi-admin-team-members--teamMember_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the teamMember. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>teamMember</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="teamMember"                data-endpoint="GETapi-admin-team-members--teamMember_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the team member. Example: <code>1</code></p>
            </div>
                    </form>

    <h3>Response</h3>
    <h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
    <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>success</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Indicates if the request was successful</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>data</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Team member details</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Team member ID</p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>fullname</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Full name of the team member</p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string|null</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Phone number</p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string|null</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Job title or position</p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Email address</p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>social_media</code></b>&nbsp;&nbsp;
<small>object|null</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Social media links</p>
                    </div>
                                                                <div style=" margin-left: 14px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>images</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Array of profile images</p>
            </summary>
                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Image ID</p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Image file name</p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Full-size image URL</p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>thumb_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Thumbnail image URL</p>
                    </div>
                                    </details>
        </div>
                                                                    <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>created_at</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>ISO 8601 datetime string</p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>updated_at</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>ISO 8601 datetime string</p>
                    </div>
                                    </details>
        </div>
                    <h1 id="contact-inquiries">Contact Inquiries</h1>

    <p>APIs for managing contact inquiries and customer testimonials.</p>

                                <h2 id="contact-inquiries-GETapi-contact-inquiries-published">Display a listing of published inquiries (for testimonials).</h2>

<p>
</p>

<p>Get a paginated list of published contact inquiries.
Only inquiries that have been replied to and marked as published are returned.
Sensitive fields like email and phone are excluded from the response.</p>

<span id="example-requests-GETapi-contact-inquiries-published">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/contact-inquiries/published?per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries/published"
);

const params = {
    "per_page": "15",
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
$url = 'http://127.0.0.1:8000/api/contact-inquiries/published';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'per_page' =&gt; '15',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-contact-inquiries-published">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;full_name&quot;: &quot;John Doe&quot;,
            &quot;company&quot;: &quot;Acme Inc&quot;,
            &quot;message&quot;: &quot;Great service! Very satisfied with the quality.&quot;,
            &quot;reply_message&quot;: &quot;Thank you for your feedback! We&#039;re glad you&#039;re happy.&quot;,
            &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 5,
        &quot;per_page&quot;: 10,
        &quot;total&quot;: 50
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-contact-inquiries-published" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-contact-inquiries-published"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-contact-inquiries-published"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-contact-inquiries-published" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-contact-inquiries-published">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-contact-inquiries-published" data-method="GET"
      data-path="api/contact-inquiries/published"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-contact-inquiries-published', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-contact-inquiries-published"
                    onclick="tryItOut('GETapi-contact-inquiries-published');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-contact-inquiries-published"
                    onclick="cancelTryOut('GETapi-contact-inquiries-published');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-contact-inquiries-published"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/contact-inquiries/published</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-contact-inquiries-published"
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
                              name="Accept"                data-endpoint="GETapi-contact-inquiries-published"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-contact-inquiries-published"
               value="15"
               data-component="query">
    <br>
<p>Items per page. Default: 10. Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="contact-inquiries-GETapi-contact-inquiries">Display a listing of contact inquiries.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of all contact inquiries.</p>

<span id="example-requests-GETapi-contact-inquiries">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/contact-inquiries?per_page=10&amp;status=pending" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries"
);

const params = {
    "per_page": "10",
    "status": "pending",
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
$url = 'http://127.0.0.1:8000/api/contact-inquiries';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'per_page' =&gt; '10',
            'status' =&gt; 'pending',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-contact-inquiries">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;full_name&quot;: &quot;John Doe&quot;,
            &quot;email&quot;: &quot;john@example.com&quot;,
            &quot;phone&quot;: &quot;+1234567890&quot;,
            &quot;company&quot;: &quot;Acme Inc&quot;,
            &quot;message&quot;: &quot;Interested in your products&quot;,
            &quot;status&quot;: &quot;pending&quot;,
            &quot;status_label&quot;: &quot;Pending&quot;,
            &quot;status_color&quot;: &quot;yellow&quot;,
            &quot;replied_at&quot;: null,
            &quot;reply_message&quot;: null,
            &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
        }
    ]
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
      data-authed="1"
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
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-contact-inquiries"
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
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-contact-inquiries"
               value="10"
               data-component="query">
    <br>
<p>Items per page. Default: 15. Example: <code>10</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-contact-inquiries"
               value="pending"
               data-component="query">
    <br>
<p>Filter by status (pending, replied, closed). Example: <code>pending</code></p>
            </div>
                </form>

                    <h2 id="contact-inquiries-POSTapi-contact-inquiries">Store a newly created contact inquiry in storage.</h2>

<p>
</p>

<p>Create a new contact inquiry from customer submission.</p>

<span id="example-requests-POSTapi-contact-inquiries">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/contact-inquiries" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"full_name\": \"John Doe\",
    \"email\": \"john@example.com\",
    \"phone\": \"+1234567890\",
    \"company\": \"Acme Inc\",
    \"service_id\": 1,
    \"service\": \"Product Inquiry\",
    \"message\": \"I\'m interested in your products.\"
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
    "full_name": "John Doe",
    "email": "john@example.com",
    "phone": "+1234567890",
    "company": "Acme Inc",
    "service_id": 1,
    "service": "Product Inquiry",
    "message": "I'm interested in your products."
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
            'full_name' =&gt; 'John Doe',
            'email' =&gt; 'john@example.com',
            'phone' =&gt; '+1234567890',
            'company' =&gt; 'Acme Inc',
            'service_id' =&gt; 1,
            'service' =&gt; 'Product Inquiry',
            'message' =&gt; 'I\'m interested in your products.',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-contact-inquiries">
            <blockquote>
            <p>Example response (201, Created):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;full_name&quot;: &quot;John Doe&quot;,
    &quot;email&quot;: &quot;john@example.com&quot;,
    &quot;phone&quot;: &quot;+1234567890&quot;,
    &quot;company&quot;: &quot;Acme Inc&quot;,
    &quot;message&quot;: &quot;I&#039;m interested in your products.&quot;,
    &quot;status&quot;: &quot;pending&quot;,
    &quot;status_label&quot;: &quot;Pending&quot;,
    &quot;status_color&quot;: &quot;yellow&quot;,
    &quot;replied_at&quot;: null,
    &quot;reply_message&quot;: null,
    &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The full name field is required.&quot;,
    &quot;errors&quot;: {
        &quot;full_name&quot;: [
            &quot;The full name field is required.&quot;
        ]
    }
}</code>
 </pre>
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
               value="John Doe"
               data-component="body">
    <br>
<p>The full name of the contact. Example: <code>John Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-contact-inquiries"
               value="john@example.com"
               data-component="body">
    <br>
<p>The email address. Example: <code>john@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-contact-inquiries"
               value="+1234567890"
               data-component="body">
    <br>
<p>optional The phone number. Example: <code>+1234567890</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>company</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="company"                data-endpoint="POSTapi-contact-inquiries"
               value="Acme Inc"
               data-component="body">
    <br>
<p>optional The company name. Example: <code>Acme Inc</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="service_id"                data-endpoint="POSTapi-contact-inquiries"
               value="1"
               data-component="body">
    <br>
<p>optional The service ID if applicable. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service"                data-endpoint="POSTapi-contact-inquiries"
               value="Product Inquiry"
               data-component="body">
    <br>
<p>optional The service name (legacy). Example: <code>Product Inquiry</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>message</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="message"                data-endpoint="POSTapi-contact-inquiries"
               value="I'm interested in your products."
               data-component="body">
    <br>
<p>The inquiry message. Example: <code>I'm interested in your products.</code></p>
        </div>
        </form>

                    <h2 id="contact-inquiries-GETapi-contact-inquiries--inquiry_id-">Display the specified contact inquiry.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get details of a specific contact inquiry.</p>

<span id="example-requests-GETapi-contact-inquiries--inquiry_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/contact-inquiries/16" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries/16"
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
$url = 'http://127.0.0.1:8000/api/contact-inquiries/16';
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

<span id="example-responses-GETapi-contact-inquiries--inquiry_id-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;full_name&quot;: &quot;John Doe&quot;,
    &quot;email&quot;: &quot;john@example.com&quot;,
    &quot;phone&quot;: &quot;+1234567890&quot;,
    &quot;company&quot;: &quot;Acme Inc&quot;,
    &quot;message&quot;: &quot;Interested in your products&quot;,
    &quot;status&quot;: &quot;pending&quot;,
    &quot;status_label&quot;: &quot;Pending&quot;,
    &quot;status_color&quot;: &quot;yellow&quot;,
    &quot;replied_at&quot;: null,
    &quot;reply_message&quot;: null,
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
            <blockquote>
            <p>Example response (404, Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Resource not found.&quot;
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
      data-authed="1"
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
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-contact-inquiries--inquiry_id-"
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
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>inquiry</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inquiry"                data-endpoint="GETapi-contact-inquiries--inquiry_id-"
               value="1"
               data-component="url">
    <br>
<p>The inquiry ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="contact-inquiries-PUTapi-contact-inquiries--inquiry_id-">Update the specified contact inquiry in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-contact-inquiries--inquiry_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/contact-inquiries/16" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"full_name\": \"Jane Doe\",
    \"email\": \"jane@example.com\",
    \"phone\": \"+9876543210\",
    \"company\": \"XYZ Corp\",
    \"service_id\": 2,
    \"service\": \"Support\",
    \"message\": \"Updated message.\",
    \"status\": \"replied\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries/16"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "full_name": "Jane Doe",
    "email": "jane@example.com",
    "phone": "+9876543210",
    "company": "XYZ Corp",
    "service_id": 2,
    "service": "Support",
    "message": "Updated message.",
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
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'full_name' =&gt; 'Jane Doe',
            'email' =&gt; 'jane@example.com',
            'phone' =&gt; '+9876543210',
            'company' =&gt; 'XYZ Corp',
            'service_id' =&gt; 2,
            'service' =&gt; 'Support',
            'message' =&gt; 'Updated message.',
            'status' =&gt; 'replied',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-PUTapi-contact-inquiries--inquiry_id-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;full_name&quot;: &quot;Jane Doe&quot;,
    &quot;email&quot;: &quot;jane@example.com&quot;,
    &quot;phone&quot;: &quot;+9876543210&quot;,
    &quot;company&quot;: &quot;XYZ Corp&quot;,
    &quot;message&quot;: &quot;Updated message.&quot;,
    &quot;status&quot;: &quot;replied&quot;,
    &quot;status_label&quot;: &quot;Replied&quot;,
    &quot;status_color&quot;: &quot;green&quot;,
    &quot;replied_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
    &quot;reply_message&quot;: null,
    &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;
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
    &quot;message&quot;: &quot;Resource not found.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The status must be one of: pending, replied, closed.&quot;,
    &quot;errors&quot;: {
        &quot;status&quot;: [
            &quot;The status must be one of: pending, replied, closed.&quot;
        ]
    }
}</code>
 </pre>
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
      data-authed="1"
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
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
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
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>inquiry</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inquiry"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="1"
               data-component="url">
    <br>
<p>The inquiry ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>full_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="full_name"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="Jane Doe"
               data-component="body">
    <br>
<p>optional The full name. Example: <code>Jane Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="jane@example.com"
               data-component="body">
    <br>
<p>optional The email address. Example: <code>jane@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="+9876543210"
               data-component="body">
    <br>
<p>optional The phone number. Example: <code>+9876543210</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>company</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="company"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="XYZ Corp"
               data-component="body">
    <br>
<p>optional The company name. Example: <code>XYZ Corp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="service_id"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="2"
               data-component="body">
    <br>
<p>nullable optional The service ID. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="Support"
               data-component="body">
    <br>
<p>nullable optional The service name. Example: <code>Support</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>message</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="message"                data-endpoint="PUTapi-contact-inquiries--inquiry_id-"
               value="Updated message."
               data-component="body">
    <br>
<p>optional The inquiry message. Example: <code>Updated message.</code></p>
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
<p>optional The status (pending, replied, closed). Example: <code>replied</code></p>
        </div>
        </form>

                    <h2 id="contact-inquiries-PATCHapi-contact-inquiries--inquiry_id-">Partially update the specified contact inquiry in storage.</h2>

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

                    <h2 id="contact-inquiries-POSTapi-contact-inquiries--inquiry_id--reply">Reply to a contact inquiry.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Send a reply email to the inquiry sender and update the inquiry status.</p>

<span id="example-requests-POSTapi-contact-inquiries--inquiry_id--reply">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/contact-inquiries/16/reply" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reply_message\": \"Thank you for your inquiry. We will get back to you shortly.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries/16/reply"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reply_message": "Thank you for your inquiry. We will get back to you shortly."
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
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'reply_message' =&gt; 'Thank you for your inquiry. We will get back to you shortly.',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-contact-inquiries--inquiry_id--reply">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;full_name&quot;: &quot;John Doe&quot;,
    &quot;email&quot;: &quot;john@example.com&quot;,
    &quot;phone&quot;: &quot;+1234567890&quot;,
    &quot;company&quot;: &quot;Acme Inc&quot;,
    &quot;message&quot;: &quot;Interested in your products&quot;,
    &quot;status&quot;: &quot;replied&quot;,
    &quot;status_label&quot;: &quot;Replied&quot;,
    &quot;status_color&quot;: &quot;green&quot;,
    &quot;replied_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
    &quot;reply_message&quot;: &quot;Thank you for your inquiry. We will get back to you shortly.&quot;,
    &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Already Replied):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This inquiry has already been replied to.&quot;
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
    &quot;message&quot;: &quot;Resource not found.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The reply message field is required.&quot;,
    &quot;errors&quot;: {
        &quot;reply_message&quot;: [
            &quot;The reply message field is required.&quot;
        ]
    }
}</code>
 </pre>
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
      data-authed="1"
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
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-contact-inquiries--inquiry_id--reply"
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
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>inquiry</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inquiry"                data-endpoint="POSTapi-contact-inquiries--inquiry_id--reply"
               value="1"
               data-component="url">
    <br>
<p>The inquiry ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reply_message</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reply_message"                data-endpoint="POSTapi-contact-inquiries--inquiry_id--reply"
               value="Thank you for your inquiry. We will get back to you shortly."
               data-component="body">
    <br>
<p>The reply message to send. Example: <code>Thank you for your inquiry. We will get back to you shortly.</code></p>
        </div>
        </form>

                    <h2 id="contact-inquiries-DELETEapi-contact-inquiries--inquiry_id-">Remove the specified contact inquiry from storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-contact-inquiries--inquiry_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/contact-inquiries/16" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/contact-inquiries/16"
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
$url = 'http://127.0.0.1:8000/api/contact-inquiries/16';
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

<span id="example-responses-DELETEapi-contact-inquiries--inquiry_id-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Inquiry deleted successfully&quot;
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
    &quot;message&quot;: &quot;Resource not found.&quot;
}</code>
 </pre>
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
      data-authed="1"
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
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-contact-inquiries--inquiry_id-"
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
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>inquiry</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inquiry"                data-endpoint="DELETEapi-contact-inquiries--inquiry_id-"
               value="1"
               data-component="url">
    <br>
<p>The inquiry ID. Example: <code>1</code></p>
            </div>
                    </form>

                                <h2 id="contact-inquiries-admin-management">Admin Management</h2>
                                                    <h2 id="contact-inquiries-GETapi-admin-inquiries">Display a listing of all inquiries (admin view).</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of all contact inquiries including unpublished ones.</p>

<span id="example-requests-GETapi-admin-inquiries">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/inquiries?per_page=10&amp;status=pending" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/inquiries"
);

const params = {
    "per_page": "10",
    "status": "pending",
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
$url = 'http://127.0.0.1:8000/api/admin/inquiries';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'per_page' =&gt; '10',
            'status' =&gt; 'pending',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-inquiries">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;full_name&quot;: &quot;John Doe&quot;,
            &quot;email&quot;: &quot;john@example.com&quot;,
            &quot;phone&quot;: &quot;+1234567890&quot;,
            &quot;company&quot;: &quot;Acme Inc&quot;,
            &quot;message&quot;: &quot;Interested in your products&quot;,
            &quot;status&quot;: &quot;pending&quot;,
            &quot;status_label&quot;: &quot;Pending&quot;,
            &quot;status_color&quot;: &quot;yellow&quot;,
            &quot;replied_at&quot;: null,
            &quot;reply_message&quot;: null,
            &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
        }
    ]
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
            <p>Example response (403, Forbidden):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-inquiries" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-inquiries"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-inquiries"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-inquiries" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-inquiries">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-inquiries" data-method="GET"
      data-path="api/admin/inquiries"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-inquiries', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-inquiries"
                    onclick="tryItOut('GETapi-admin-inquiries');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-inquiries"
                    onclick="cancelTryOut('GETapi-admin-inquiries');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-inquiries"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/inquiries</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-inquiries"
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
                              name="Content-Type"                data-endpoint="GETapi-admin-inquiries"
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
                              name="Accept"                data-endpoint="GETapi-admin-inquiries"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-inquiries"
               value="10"
               data-component="query">
    <br>
<p>Items per page. Default: 15. Example: <code>10</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-admin-inquiries"
               value="pending"
               data-component="query">
    <br>
<p>Filter by status (pending, replied, closed). Example: <code>pending</code></p>
            </div>
                </form>

                    <h2 id="contact-inquiries-POSTapi-admin-inquiries--inquiry_id--publish">Publish a contact inquiry.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mark a contact inquiry as published so it appears in public testimonials.
Only inquiries that have been replied to can be published.</p>

<span id="example-requests-POSTapi-admin-inquiries--inquiry_id--publish">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/admin/inquiries/16/publish" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/inquiries/16/publish"
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
$url = 'http://127.0.0.1:8000/api/admin/inquiries/16/publish';
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

<span id="example-responses-POSTapi-admin-inquiries--inquiry_id--publish">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Inquiry published successfully.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;full_name&quot;: &quot;John Doe&quot;,
        &quot;email&quot;: &quot;john@example.com&quot;,
        &quot;phone&quot;: &quot;+1234567890&quot;,
        &quot;company&quot;: &quot;Acme Inc&quot;,
        &quot;message&quot;: &quot;Great service!&quot;,
        &quot;status&quot;: &quot;replied&quot;,
        &quot;status_label&quot;: &quot;Replied&quot;,
        &quot;status_color&quot;: &quot;green&quot;,
        &quot;replied_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
        &quot;reply_message&quot;: &quot;Thank you for your feedback!&quot;,
        &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;
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
            <p>Example response (403, Not Replied):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Only replied inquiries can be published.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Resource not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-inquiries--inquiry_id--publish" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-inquiries--inquiry_id--publish"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-inquiries--inquiry_id--publish"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-inquiries--inquiry_id--publish" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-inquiries--inquiry_id--publish">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-inquiries--inquiry_id--publish" data-method="POST"
      data-path="api/admin/inquiries/{inquiry_id}/publish"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-inquiries--inquiry_id--publish', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-inquiries--inquiry_id--publish"
                    onclick="tryItOut('POSTapi-admin-inquiries--inquiry_id--publish');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-inquiries--inquiry_id--publish"
                    onclick="cancelTryOut('POSTapi-admin-inquiries--inquiry_id--publish');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-inquiries--inquiry_id--publish"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/inquiries/{inquiry_id}/publish</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-inquiries--inquiry_id--publish"
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
                              name="Content-Type"                data-endpoint="POSTapi-admin-inquiries--inquiry_id--publish"
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
                              name="Accept"                data-endpoint="POSTapi-admin-inquiries--inquiry_id--publish"
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
               step="any"               name="inquiry_id"                data-endpoint="POSTapi-admin-inquiries--inquiry_id--publish"
               value="16"
               data-component="url">
    <br>
<p>The ID of the inquiry. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>inquiry</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inquiry"                data-endpoint="POSTapi-admin-inquiries--inquiry_id--publish"
               value="1"
               data-component="url">
    <br>
<p>The inquiry ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="contact-inquiries-POSTapi-admin-inquiries--inquiry_id--unpublish">Unpublish a contact inquiry.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mark a published contact inquiry as unpublished.</p>

<span id="example-requests-POSTapi-admin-inquiries--inquiry_id--unpublish">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/admin/inquiries/16/unpublish" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/inquiries/16/unpublish"
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
$url = 'http://127.0.0.1:8000/api/admin/inquiries/16/unpublish';
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

<span id="example-responses-POSTapi-admin-inquiries--inquiry_id--unpublish">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Inquiry unpublished successfully.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;full_name&quot;: &quot;John Doe&quot;,
        &quot;email&quot;: &quot;john@example.com&quot;,
        &quot;phone&quot;: &quot;+1234567890&quot;,
        &quot;company&quot;: &quot;Acme Inc&quot;,
        &quot;message&quot;: &quot;Great service!&quot;,
        &quot;status&quot;: &quot;replied&quot;,
        &quot;status_label&quot;: &quot;Replied&quot;,
        &quot;status_color&quot;: &quot;green&quot;,
        &quot;replied_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
        &quot;reply_message&quot;: &quot;Thank you for your feedback!&quot;,
        &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T10:35:00.000000Z&quot;
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
            <p>Example response (404, Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Resource not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-inquiries--inquiry_id--unpublish" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-inquiries--inquiry_id--unpublish"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-inquiries--inquiry_id--unpublish"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-inquiries--inquiry_id--unpublish" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-inquiries--inquiry_id--unpublish">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-inquiries--inquiry_id--unpublish" data-method="POST"
      data-path="api/admin/inquiries/{inquiry_id}/unpublish"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-inquiries--inquiry_id--unpublish', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-inquiries--inquiry_id--unpublish"
                    onclick="tryItOut('POSTapi-admin-inquiries--inquiry_id--unpublish');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-inquiries--inquiry_id--unpublish"
                    onclick="cancelTryOut('POSTapi-admin-inquiries--inquiry_id--unpublish');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-inquiries--inquiry_id--unpublish"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/inquiries/{inquiry_id}/unpublish</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-inquiries--inquiry_id--unpublish"
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
                              name="Content-Type"                data-endpoint="POSTapi-admin-inquiries--inquiry_id--unpublish"
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
                              name="Accept"                data-endpoint="POSTapi-admin-inquiries--inquiry_id--unpublish"
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
               step="any"               name="inquiry_id"                data-endpoint="POSTapi-admin-inquiries--inquiry_id--unpublish"
               value="16"
               data-component="url">
    <br>
<p>The ID of the inquiry. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>inquiry</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inquiry"                data-endpoint="POSTapi-admin-inquiries--inquiry_id--unpublish"
               value="1"
               data-component="url">
    <br>
<p>The inquiry ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="customer-addresses">Customer Addresses</h1>

    <p>APIs for managing customer addresses.
All endpoints require authentication.</p>

                                <h2 id="customer-addresses-GETapi-addresses">List all customer addresses</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of all addresses for the authenticated user.
Addresses are ordered by default status (default first) then by creation date.</p>

<span id="example-requests-GETapi-addresses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/addresses" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/addresses"
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
$url = 'http://127.0.0.1:8000/api/addresses';
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

<span id="example-responses-GETapi-addresses">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;user_id&quot;: 1,
            &quot;label&quot;: &quot;Home&quot;,
            &quot;name&quot;: &quot;John Doe&quot;,
            &quot;phone&quot;: &quot;+201234567890&quot;,
            &quot;address&quot;: &quot;123 Main St, Cairo, Egypt&quot;,
            &quot;street&quot;: &quot;123 Main St&quot;,
            &quot;building_number&quot;: &quot;15&quot;,
            &quot;floor&quot;: &quot;3&quot;,
            &quot;apartment&quot;: &quot;5A&quot;,
            &quot;zone&quot;: &quot;Maadi&quot;,
            &quot;city&quot;: &quot;Cairo&quot;,
            &quot;zip_code&quot;: &quot;12345&quot;,
            &quot;country&quot;: &quot;Egypt&quot;,
            &quot;state&quot;: &quot;Cairo Governorate&quot;,
            &quot;is_default&quot;: true,
            &quot;is_billing&quot;: true,
            &quot;is_shipping&quot;: true,
            &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;user_id&quot;: 1,
            &quot;label&quot;: &quot;Work&quot;,
            &quot;name&quot;: &quot;John Doe&quot;,
            &quot;phone&quot;: &quot;+201234567891&quot;,
            &quot;address&quot;: &quot;456 Business Ave, Cairo, Egypt&quot;,
            &quot;street&quot;: &quot;456 Business Ave&quot;,
            &quot;building_number&quot;: &quot;20&quot;,
            &quot;floor&quot;: &quot;5&quot;,
            &quot;apartment&quot;: &quot;10B&quot;,
            &quot;zone&quot;: &quot;New Cairo&quot;,
            &quot;city&quot;: &quot;Cairo&quot;,
            &quot;zip_code&quot;: &quot;12346&quot;,
            &quot;country&quot;: &quot;Egypt&quot;,
            &quot;state&quot;: &quot;Cairo Governorate&quot;,
            &quot;is_default&quot;: false,
            &quot;is_billing&quot;: false,
            &quot;is_shipping&quot;: true,
            &quot;created_at&quot;: &quot;2024-01-16T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-16T10:00:00.000000Z&quot;
        }
    ]
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
      data-authed="1"
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
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-addresses"
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

                    <h2 id="customer-addresses-POSTapi-addresses">Create a new customer address</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new address for the authenticated user.
If is_default is set to true, all other addresses will be unset as default.</p>

<span id="example-requests-POSTapi-addresses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://127.0.0.1:8000/api/addresses" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"label\": \"Home\",
    \"name\": \"John Doe\",
    \"phone\": \"+201234567890\",
    \"address\": \"123 Main St, Cairo, Egypt\",
    \"street\": \"123 Main St\",
    \"building_number\": \"15\",
    \"floor\": \"3\",
    \"apartment\": \"5A\",
    \"zone\": \"Maadi\",
    \"city\": \"Cairo\",
    \"zip_code\": \"12345\",
    \"country\": \"Egypt\",
    \"state\": \"Cairo Governorate\",
    \"is_default\": true,
    \"is_billing\": true,
    \"is_shipping\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/addresses"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "label": "Home",
    "name": "John Doe",
    "phone": "+201234567890",
    "address": "123 Main St, Cairo, Egypt",
    "street": "123 Main St",
    "building_number": "15",
    "floor": "3",
    "apartment": "5A",
    "zone": "Maadi",
    "city": "Cairo",
    "zip_code": "12345",
    "country": "Egypt",
    "state": "Cairo Governorate",
    "is_default": true,
    "is_billing": true,
    "is_shipping": true
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
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'label' =&gt; 'Home',
            'name' =&gt; 'John Doe',
            'phone' =&gt; '+201234567890',
            'address' =&gt; '123 Main St, Cairo, Egypt',
            'street' =&gt; '123 Main St',
            'building_number' =&gt; '15',
            'floor' =&gt; '3',
            'apartment' =&gt; '5A',
            'zone' =&gt; 'Maadi',
            'city' =&gt; 'Cairo',
            'zip_code' =&gt; '12345',
            'country' =&gt; 'Egypt',
            'state' =&gt; 'Cairo Governorate',
            'is_default' =&gt; true,
            'is_billing' =&gt; true,
            'is_shipping' =&gt; true,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTapi-addresses">
            <blockquote>
            <p>Example response (201, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Address created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 1,
        &quot;label&quot;: &quot;Home&quot;,
        &quot;name&quot;: &quot;John Doe&quot;,
        &quot;phone&quot;: &quot;+201234567890&quot;,
        &quot;address&quot;: &quot;123 Main St, Cairo, Egypt&quot;,
        &quot;street&quot;: &quot;123 Main St&quot;,
        &quot;building_number&quot;: &quot;15&quot;,
        &quot;floor&quot;: &quot;3&quot;,
        &quot;apartment&quot;: &quot;5A&quot;,
        &quot;zone&quot;: &quot;Maadi&quot;,
        &quot;city&quot;: &quot;Cairo&quot;,
        &quot;zip_code&quot;: &quot;12345&quot;,
        &quot;country&quot;: &quot;Egypt&quot;,
        &quot;state&quot;: &quot;Cairo Governorate&quot;,
        &quot;is_default&quot;: true,
        &quot;is_billing&quot;: true,
        &quot;is_shipping&quot;: true,
        &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
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
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;name&quot;: [
            &quot;The name field is required.&quot;
        ],
        &quot;city&quot;: [
            &quot;The city field is required.&quot;
        ]
    }
}</code>
 </pre>
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
      data-authed="1"
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
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-addresses"
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
               value="Home"
               data-component="body">
    <br>
<p>optional A custom label for the address (e.g., &quot;Home&quot;, &quot;Work&quot;). Example: <code>Home</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-addresses"
               value="John Doe"
               data-component="body">
    <br>
<p>The full name of the recipient. Example: <code>John Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-addresses"
               value="+201234567890"
               data-component="body">
    <br>
<p>The phone number. Example: <code>+201234567890</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-addresses"
               value="123 Main St, Cairo, Egypt"
               data-component="body">
    <br>
<p>The full address text. Example: <code>123 Main St, Cairo, Egypt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>street</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="street"                data-endpoint="POSTapi-addresses"
               value="123 Main St"
               data-component="body">
    <br>
<p>optional The street name. Example: <code>123 Main St</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>building_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="building_number"                data-endpoint="POSTapi-addresses"
               value="15"
               data-component="body">
    <br>
<p>optional The building number. Example: <code>15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>floor</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="floor"                data-endpoint="POSTapi-addresses"
               value="3"
               data-component="body">
    <br>
<p>optional The floor number. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>apartment</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="apartment"                data-endpoint="POSTapi-addresses"
               value="5A"
               data-component="body">
    <br>
<p>optional The apartment number. Example: <code>5A</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>zone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="zone"                data-endpoint="POSTapi-addresses"
               value="Maadi"
               data-component="body">
    <br>
<p>optional The zone/area. Example: <code>Maadi</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="POSTapi-addresses"
               value="Cairo"
               data-component="body">
    <br>
<p>The city name. Example: <code>Cairo</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>zip_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="zip_code"                data-endpoint="POSTapi-addresses"
               value="12345"
               data-component="body">
    <br>
<p>The postal/ZIP code. Example: <code>12345</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="country"                data-endpoint="POSTapi-addresses"
               value="Egypt"
               data-component="body">
    <br>
<p>The country name. Example: <code>Egypt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>state</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="state"                data-endpoint="POSTapi-addresses"
               value="Cairo Governorate"
               data-component="body">
    <br>
<p>optional The state/province. Example: <code>Cairo Governorate</code></p>
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
<p>optional Whether this should be the default address. Default: false. Example: <code>true</code></p>
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
<p>optional Whether this can be used for billing. Default: false. Example: <code>true</code></p>
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
<p>optional Whether this can be used for shipping. Default: false. Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="customer-addresses-GETapi-addresses--address_id-">Get a specific customer address</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve details of a specific address belonging to the authenticated user.</p>

<span id="example-requests-GETapi-addresses--address_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/addresses/3" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/addresses/3"
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
$url = 'http://127.0.0.1:8000/api/addresses/3';
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

<span id="example-responses-GETapi-addresses--address_id-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 1,
        &quot;label&quot;: &quot;Home&quot;,
        &quot;name&quot;: &quot;John Doe&quot;,
        &quot;phone&quot;: &quot;+201234567890&quot;,
        &quot;address&quot;: &quot;123 Main St, Cairo, Egypt&quot;,
        &quot;street&quot;: &quot;123 Main St&quot;,
        &quot;building_number&quot;: &quot;15&quot;,
        &quot;floor&quot;: &quot;3&quot;,
        &quot;apartment&quot;: &quot;5A&quot;,
        &quot;zone&quot;: &quot;Maadi&quot;,
        &quot;city&quot;: &quot;Cairo&quot;,
        &quot;zip_code&quot;: &quot;12345&quot;,
        &quot;country&quot;: &quot;Egypt&quot;,
        &quot;state&quot;: &quot;Cairo Governorate&quot;,
        &quot;is_default&quot;: true,
        &quot;is_billing&quot;: true,
        &quot;is_shipping&quot;: true,
        &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
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
            <p>Example response (404, Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Address not found&quot;
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
      data-authed="1"
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
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-addresses--address_id-"
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
               value="3"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>3</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address"                data-endpoint="GETapi-addresses--address_id-"
               value="1"
               data-component="url">
    <br>
<p>The address ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="customer-addresses-PUTapi-addresses--address_id-">Update a customer address</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update an existing address belonging to the authenticated user.
If is_default is set to true, all other addresses will be unset as default.</p>

<span id="example-requests-PUTapi-addresses--address_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/addresses/3" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"label\": \"Home\",
    \"name\": \"John Doe\",
    \"phone\": \"+201234567890\",
    \"address\": \"123 Main St, Cairo, Egypt\",
    \"street\": \"123 Main St\",
    \"building_number\": \"15\",
    \"floor\": \"3\",
    \"apartment\": \"5A\",
    \"zone\": \"Maadi\",
    \"city\": \"Cairo\",
    \"zip_code\": \"12345\",
    \"country\": \"Egypt\",
    \"state\": \"Cairo Governorate\",
    \"is_default\": true,
    \"is_billing\": true,
    \"is_shipping\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/addresses/3"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "label": "Home",
    "name": "John Doe",
    "phone": "+201234567890",
    "address": "123 Main St, Cairo, Egypt",
    "street": "123 Main St",
    "building_number": "15",
    "floor": "3",
    "apartment": "5A",
    "zone": "Maadi",
    "city": "Cairo",
    "zip_code": "12345",
    "country": "Egypt",
    "state": "Cairo Governorate",
    "is_default": true,
    "is_billing": true,
    "is_shipping": true
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/addresses/3';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'label' =&gt; 'Home',
            'name' =&gt; 'John Doe',
            'phone' =&gt; '+201234567890',
            'address' =&gt; '123 Main St, Cairo, Egypt',
            'street' =&gt; '123 Main St',
            'building_number' =&gt; '15',
            'floor' =&gt; '3',
            'apartment' =&gt; '5A',
            'zone' =&gt; 'Maadi',
            'city' =&gt; 'Cairo',
            'zip_code' =&gt; '12345',
            'country' =&gt; 'Egypt',
            'state' =&gt; 'Cairo Governorate',
            'is_default' =&gt; true,
            'is_billing' =&gt; true,
            'is_shipping' =&gt; true,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-PUTapi-addresses--address_id-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Address updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 1,
        &quot;label&quot;: &quot;Home Updated&quot;,
        &quot;name&quot;: &quot;John Doe&quot;,
        &quot;phone&quot;: &quot;+201234567890&quot;,
        &quot;address&quot;: &quot;123 Main St, Cairo, Egypt&quot;,
        &quot;street&quot;: &quot;123 Main St&quot;,
        &quot;building_number&quot;: &quot;15&quot;,
        &quot;floor&quot;: &quot;3&quot;,
        &quot;apartment&quot;: &quot;5A&quot;,
        &quot;zone&quot;: &quot;Maadi&quot;,
        &quot;city&quot;: &quot;Cairo&quot;,
        &quot;zip_code&quot;: &quot;12345&quot;,
        &quot;country&quot;: &quot;Egypt&quot;,
        &quot;state&quot;: &quot;Cairo Governorate&quot;,
        &quot;is_default&quot;: true,
        &quot;is_billing&quot;: true,
        &quot;is_shipping&quot;: true,
        &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T11:00:00.000000Z&quot;
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
            <p>Example response (404, Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Address not found&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;name&quot;: [
            &quot;The name field is required.&quot;
        ]
    }
}</code>
 </pre>
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
      data-authed="1"
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
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-addresses--address_id-"
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
               value="3"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>3</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address"                data-endpoint="PUTapi-addresses--address_id-"
               value="1"
               data-component="url">
    <br>
<p>The address ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>label</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="label"                data-endpoint="PUTapi-addresses--address_id-"
               value="Home"
               data-component="body">
    <br>
<p>optional A custom label for the address (e.g., &quot;Home&quot;, &quot;Work&quot;). Example: <code>Home</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-addresses--address_id-"
               value="John Doe"
               data-component="body">
    <br>
<p>The full name of the recipient. Example: <code>John Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-addresses--address_id-"
               value="+201234567890"
               data-component="body">
    <br>
<p>The phone number. Example: <code>+201234567890</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-addresses--address_id-"
               value="123 Main St, Cairo, Egypt"
               data-component="body">
    <br>
<p>The full address text. Example: <code>123 Main St, Cairo, Egypt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>street</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="street"                data-endpoint="PUTapi-addresses--address_id-"
               value="123 Main St"
               data-component="body">
    <br>
<p>optional The street name. Example: <code>123 Main St</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>building_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="building_number"                data-endpoint="PUTapi-addresses--address_id-"
               value="15"
               data-component="body">
    <br>
<p>optional The building number. Example: <code>15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>floor</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="floor"                data-endpoint="PUTapi-addresses--address_id-"
               value="3"
               data-component="body">
    <br>
<p>optional The floor number. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>apartment</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="apartment"                data-endpoint="PUTapi-addresses--address_id-"
               value="5A"
               data-component="body">
    <br>
<p>optional The apartment number. Example: <code>5A</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>zone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="zone"                data-endpoint="PUTapi-addresses--address_id-"
               value="Maadi"
               data-component="body">
    <br>
<p>optional The zone/area. Example: <code>Maadi</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="PUTapi-addresses--address_id-"
               value="Cairo"
               data-component="body">
    <br>
<p>The city name. Example: <code>Cairo</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>zip_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="zip_code"                data-endpoint="PUTapi-addresses--address_id-"
               value="12345"
               data-component="body">
    <br>
<p>The postal/ZIP code. Example: <code>12345</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="country"                data-endpoint="PUTapi-addresses--address_id-"
               value="Egypt"
               data-component="body">
    <br>
<p>The country name. Example: <code>Egypt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>state</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="state"                data-endpoint="PUTapi-addresses--address_id-"
               value="Cairo Governorate"
               data-component="body">
    <br>
<p>optional The state/province. Example: <code>Cairo Governorate</code></p>
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
<p>optional Whether this should be the default address. Example: <code>true</code></p>
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
<p>optional Whether this can be used for billing. Example: <code>true</code></p>
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
<p>optional Whether this can be used for shipping. Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="customer-addresses-DELETEapi-addresses--address_id-">Delete a customer address</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Delete an existing address belonging to the authenticated user.</p>

<span id="example-requests-DELETEapi-addresses--address_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://127.0.0.1:8000/api/addresses/3" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/addresses/3"
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
$url = 'http://127.0.0.1:8000/api/addresses/3';
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

<span id="example-responses-DELETEapi-addresses--address_id-">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Address deleted successfully&quot;
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
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Address not found&quot;
}</code>
 </pre>
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
      data-authed="1"
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
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-addresses--address_id-"
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
               value="3"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>3</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address"                data-endpoint="DELETEapi-addresses--address_id-"
               value="1"
               data-component="url">
    <br>
<p>The address ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="customer-addresses-PATCHapi-addresses--address_id--default">Set address as default</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Set a specific address as the default address for the authenticated user.
All other addresses will be unset as default.</p>

<span id="example-requests-PATCHapi-addresses--address_id--default">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://127.0.0.1:8000/api/addresses/3/default" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/addresses/3/default"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/addresses/3/default';
$response = $client-&gt;patch(
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

<span id="example-responses-PATCHapi-addresses--address_id--default">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Address set as default successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 1,
        &quot;label&quot;: &quot;Home&quot;,
        &quot;name&quot;: &quot;John Doe&quot;,
        &quot;phone&quot;: &quot;+201234567890&quot;,
        &quot;address&quot;: &quot;123 Main St, Cairo, Egypt&quot;,
        &quot;street&quot;: &quot;123 Main St&quot;,
        &quot;building_number&quot;: &quot;15&quot;,
        &quot;floor&quot;: &quot;3&quot;,
        &quot;apartment&quot;: &quot;5A&quot;,
        &quot;zone&quot;: &quot;Maadi&quot;,
        &quot;city&quot;: &quot;Cairo&quot;,
        &quot;zip_code&quot;: &quot;12345&quot;,
        &quot;country&quot;: &quot;Egypt&quot;,
        &quot;state&quot;: &quot;Cairo Governorate&quot;,
        &quot;is_default&quot;: true,
        &quot;is_billing&quot;: true,
        &quot;is_shipping&quot;: true,
        &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T11:00:00.000000Z&quot;
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
            <p>Example response (404, Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Address not found&quot;
}</code>
 </pre>
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
      data-authed="1"
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
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHapi-addresses--address_id--default"
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
               value="3"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>3</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address"                data-endpoint="PATCHapi-addresses--address_id--default"
               value="1"
               data-component="url">
    <br>
<p>The address ID. Example: <code>1</code></p>
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
x-session-token: W5jHx24kZJcgvfsn7Urjyx5Ujepo0yINSmqspoNj
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
access-control-expose-headers: X-Session-Token
set-cookie: al-atheer-ecommerce-session=eyJpdiI6InZ4TzIvQ2NCcUNRZnlCZXVhb1V6MkE9PSIsInZhbHVlIjoiWnpyV3EyYjdsbWpxK0xrWG1qb3B1SHZ0aUtZNzZTVGZpS1Y0d1VCaTFIcWdDdnBMNEhpU0E2YW1iSGxidDgwa0dmc29Wb0FnaHhCNnQyZ2VDc3Z6Y0dqMi9JMnNuajRXMm9hbzFGWlNyM042SjlVWW84N2tkbXlZVmFmRUI1ZHkiLCJtYWMiOiJkOWIwNDdlMmNjNjhhZGZhMWQxYmU3NmVkYmU4MWYwZGVmNDUyZjQ5NjI0NWVkN2QwNmE1YmExOGExZjYxN2RmIiwidGFnIjoiIn0%3D; expires=Sun, 29 Mar 2026 14:15:13 GMT; Max-Age=7200; path=/; secure; httponly; samesite=none
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

                    <h2 id="endpoints-GETapi-admin-dashboard-stats">Get dashboard statistics</h2>

<p>
</p>



<span id="example-requests-GETapi-admin-dashboard-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/dashboard/stats" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/dashboard/stats"
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
$url = 'http://127.0.0.1:8000/api/admin/dashboard/stats';
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

<span id="example-responses-GETapi-admin-dashboard-stats">
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
access-control-expose-headers: X-Session-Token
set-cookie: al-atheer-ecommerce-session=eyJpdiI6IjZKNy9SbXFieHR4Zmx6ZThWVWFSSmc9PSIsInZhbHVlIjoic3ZnT0JtQ1ZKNWhpRFBEM2JsOVhZS2xmeklhUHJVcDZoOHlZUUdsa05MRFhCNmZlcWRqandBdm5VcEFmTmlsdU5mZW02NHUrWGc4QThnL25tcUt6dG9CUFpnWkVJMEQ0bGxlN25JRGMwNFVFajNBZ2NLbTZUL0FFMzV5T25ZM0kiLCJtYWMiOiIyZWM3MTI1MWM3ZjRmNWViNTQ4MWVlYWMwZDVhZGJlMmM5MWQ5OTEzNTJkNjE0YTA4YWJlMDAxYzk5YjhkNDdjIiwidGFnIjoiIn0%3D; expires=Sun, 29 Mar 2026 14:15:13 GMT; Max-Age=7200; path=/; secure; httponly; samesite=none
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-dashboard-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-dashboard-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-dashboard-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-dashboard-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-dashboard-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-dashboard-stats" data-method="GET"
      data-path="api/admin/dashboard/stats"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-dashboard-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-dashboard-stats"
                    onclick="tryItOut('GETapi-admin-dashboard-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-dashboard-stats"
                    onclick="cancelTryOut('GETapi-admin-dashboard-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-dashboard-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/dashboard/stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-dashboard-stats"
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
                              name="Accept"                data-endpoint="GETapi-admin-dashboard-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-admin-dashboard-products">Get recent products</h2>

<p>
</p>



<span id="example-requests-GETapi-admin-dashboard-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/dashboard/products" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/dashboard/products"
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
$url = 'http://127.0.0.1:8000/api/admin/dashboard/products';
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

<span id="example-responses-GETapi-admin-dashboard-products">
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
access-control-expose-headers: X-Session-Token
set-cookie: al-atheer-ecommerce-session=eyJpdiI6IjRTM2xxemhEWGVkejJ2NFRQbHlROXc9PSIsInZhbHVlIjoiTlJmeHM5TlowSmJ1c3A2dWtNTno5ZnBLZjVyMXY3ejhLYTVTdnZqTmZmMVNNMXFVdGFXdmtXT2pzcDAxbHBaN3FWM3d4UWVmRURreUFvc3g0eG9meWxNdUdZc1UrQmM0T2htS1gvdHZGZGltTmo4VGZiR0hEdHlZL05oMjBPV0MiLCJtYWMiOiJkNGQxNmFjMTE1YWVjNTNmZjZmOTBmNzAyNjA4NDNkZDI0M2Q0MGJmMmRjNDg3ODhmMTNlODY0ZjE1NDQ0YjAyIiwidGFnIjoiIn0%3D; expires=Sun, 29 Mar 2026 14:15:13 GMT; Max-Age=7200; path=/; secure; httponly; samesite=none
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-dashboard-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-dashboard-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-dashboard-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-dashboard-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-dashboard-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-dashboard-products" data-method="GET"
      data-path="api/admin/dashboard/products"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-dashboard-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-dashboard-products"
                    onclick="tryItOut('GETapi-admin-dashboard-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-dashboard-products"
                    onclick="cancelTryOut('GETapi-admin-dashboard-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-dashboard-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/dashboard/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-dashboard-products"
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
                              name="Accept"                data-endpoint="GETapi-admin-dashboard-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-admin-dashboard-categories">Get all categories</h2>

<p>
</p>



<span id="example-requests-GETapi-admin-dashboard-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/dashboard/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/dashboard/categories"
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
$url = 'http://127.0.0.1:8000/api/admin/dashboard/categories';
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

<span id="example-responses-GETapi-admin-dashboard-categories">
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
access-control-expose-headers: X-Session-Token
set-cookie: al-atheer-ecommerce-session=eyJpdiI6IlE5MTlkOWU4THdPSXJuUkxoQ2ViZ0E9PSIsInZhbHVlIjoiam1BUHVPNXF6TjIyVFF1VkFvdEk5QkhOdHlBdDNYR0lnaWxsMy9sSnRHMXJxZXFrRmdvS1N0RkVTZ0ZIUzh0ajR5aGlzUjd0YUU2MDR1SXRMTEl5U2RqeWRUQjUvSjdFY1JWelpacVpqcFZUaGN3eGhLWTRIdlF2QzVSUW85T3QiLCJtYWMiOiJmNmY1NjY4ZmEzN2MxN2QyZDkzMDQ4YzcxZmE3MWU3MDg1ZGU5ZGUzZjBjYjFhY2YzZTljOWJkNDZlN2U4NTQ1IiwidGFnIjoiIn0%3D; expires=Sun, 29 Mar 2026 14:15:13 GMT; Max-Age=7200; path=/; secure; httponly; samesite=none
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-dashboard-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-dashboard-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-dashboard-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-dashboard-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-dashboard-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-dashboard-categories" data-method="GET"
      data-path="api/admin/dashboard/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-dashboard-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-dashboard-categories"
                    onclick="tryItOut('GETapi-admin-dashboard-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-dashboard-categories"
                    onclick="cancelTryOut('GETapi-admin-dashboard-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-dashboard-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/dashboard/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-dashboard-categories"
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
                              name="Accept"                data-endpoint="GETapi-admin-dashboard-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-admin-dashboard-revenue">Get revenue chart data</h2>

<p>
</p>



<span id="example-requests-GETapi-admin-dashboard-revenue">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/dashboard/revenue" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/dashboard/revenue"
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
$url = 'http://127.0.0.1:8000/api/admin/dashboard/revenue';
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

<span id="example-responses-GETapi-admin-dashboard-revenue">
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
access-control-expose-headers: X-Session-Token
set-cookie: al-atheer-ecommerce-session=eyJpdiI6IlRyek45U2NVckp0ZXRjK3M3OHN5UlE9PSIsInZhbHVlIjoiMjBTYkh2TExtWXNIc0hGSU5GejFPNFozNCtuRGs0enlaWXRrcG1QeW4xa3RSNFo2blBSU3ppZXhiMmdGeEFLc3NkWmNHOXBaZXhFa0hvNy9ybWZ0MlBGalByZHg4NHdGZTRNWHpVZmRlRWZadzJjYmRKY0dSSFhNc2VTUGZkYloiLCJtYWMiOiI1N2Q4YzgxMDc1YzFiNzQ5OGIzNzdkM2UzOGY0ZGFlYmI4YjRiZmY4ZmYwYTlkMmVhNjJkOWExMDRhZWNiMTNiIiwidGFnIjoiIn0%3D; expires=Sun, 29 Mar 2026 14:15:13 GMT; Max-Age=7200; path=/; secure; httponly; samesite=none
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-dashboard-revenue" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-dashboard-revenue"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-dashboard-revenue"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-dashboard-revenue" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-dashboard-revenue">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-dashboard-revenue" data-method="GET"
      data-path="api/admin/dashboard/revenue"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-dashboard-revenue', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-dashboard-revenue"
                    onclick="tryItOut('GETapi-admin-dashboard-revenue');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-dashboard-revenue"
                    onclick="cancelTryOut('GETapi-admin-dashboard-revenue');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-dashboard-revenue"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/dashboard/revenue</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-dashboard-revenue"
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
                              name="Accept"                data-endpoint="GETapi-admin-dashboard-revenue"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-admin-dashboard-best-sellers">Get best selling products</h2>

<p>
</p>



<span id="example-requests-GETapi-admin-dashboard-best-sellers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/admin/dashboard/best-sellers" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/admin/dashboard/best-sellers"
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
$url = 'http://127.0.0.1:8000/api/admin/dashboard/best-sellers';
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

<span id="example-responses-GETapi-admin-dashboard-best-sellers">
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
access-control-expose-headers: X-Session-Token
set-cookie: al-atheer-ecommerce-session=eyJpdiI6IkZqdzRscGlpREVtSXNBRUt5dTk3amc9PSIsInZhbHVlIjoiK1pBOTdtOUU3eCtXRHFubDBmczBZS0FLbTl3czk3cjQrdHRJQ0J5eWpNWVhuRGh6V0VqMlFseW1VMVh1bkxKVkhPRjRrSUZpUXhLd3BFblZmOWVJS29QVFlKRDhWUjZFTXRSWXIwc2ZTQWNlRmJaWEIyZE9RS29VeUdPWG9pSzUiLCJtYWMiOiIzOGY4NTdhNzUxYWQyYzAyNDZiMzRiMmQ3YmY4OTgwMWEyYTFhM2UxMDM2MzI1NmI2MmEzZTdlYjZjNGZhMzg3IiwidGFnIjoiIn0%3D; expires=Sun, 29 Mar 2026 14:15:13 GMT; Max-Age=7200; path=/; secure; httponly; samesite=none
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-dashboard-best-sellers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-dashboard-best-sellers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-dashboard-best-sellers"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-dashboard-best-sellers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-dashboard-best-sellers">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-dashboard-best-sellers" data-method="GET"
      data-path="api/admin/dashboard/best-sellers"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-dashboard-best-sellers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-dashboard-best-sellers"
                    onclick="tryItOut('GETapi-admin-dashboard-best-sellers');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-dashboard-best-sellers"
                    onclick="cancelTryOut('GETapi-admin-dashboard-best-sellers');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-dashboard-best-sellers"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/dashboard/best-sellers</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-dashboard-best-sellers"
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
                              name="Accept"                data-endpoint="GETapi-admin-dashboard-best-sellers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-supplier-dashboard-stats">GET api/supplier/dashboard/stats</h2>

<p>
</p>



<span id="example-requests-GETapi-supplier-dashboard-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/supplier/dashboard/stats" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/supplier/dashboard/stats"
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
$url = 'http://127.0.0.1:8000/api/supplier/dashboard/stats';
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

<span id="example-responses-GETapi-supplier-dashboard-stats">
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
access-control-expose-headers: X-Session-Token
set-cookie: al-atheer-ecommerce-session=eyJpdiI6IlNLcjVJTjdxZlZIdTBDT1l5N2NxdkE9PSIsInZhbHVlIjoiT1VxSWI0NTF3S2JpckNXR09YOHNIclRiR1lZSmlsY1Q2Vm1BNWFhUUdhT2ZQdTZkdS8zaytYWlAvSHlTUnlHdWJiQ3VaN20xc0dTVzBCcTFublRqY1lKNzdVSWdkbWg0UUErR2QzTnFCMnZWT1hhSUNVaHh3c3JlWEMrNXVaa0IiLCJtYWMiOiIxZmU2MzhkYjA4ZDRkYmEyYWFiOTliMjE2NzA3ZGU5ODMwNDgxMWFiMWEyOTY1NjM4N2NlNzg3OTdlZjY4NDQ4IiwidGFnIjoiIn0%3D; expires=Sun, 29 Mar 2026 14:15:13 GMT; Max-Age=7200; path=/; secure; httponly; samesite=none
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-supplier-dashboard-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-supplier-dashboard-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-supplier-dashboard-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-supplier-dashboard-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-supplier-dashboard-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-supplier-dashboard-stats" data-method="GET"
      data-path="api/supplier/dashboard/stats"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-supplier-dashboard-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-supplier-dashboard-stats"
                    onclick="tryItOut('GETapi-supplier-dashboard-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-supplier-dashboard-stats"
                    onclick="cancelTryOut('GETapi-supplier-dashboard-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-supplier-dashboard-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/supplier/dashboard/stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-supplier-dashboard-stats"
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
                              name="Accept"                data-endpoint="GETapi-supplier-dashboard-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-supplier-orders">GET api/supplier/orders</h2>

<p>
</p>



<span id="example-requests-GETapi-supplier-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://127.0.0.1:8000/api/supplier/orders" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/supplier/orders"
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
$url = 'http://127.0.0.1:8000/api/supplier/orders';
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

<span id="example-responses-GETapi-supplier-orders">
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
access-control-expose-headers: X-Session-Token
set-cookie: al-atheer-ecommerce-session=eyJpdiI6IkFoRHV5cTFsWUZRQkx1Mzl4ODR4Z1E9PSIsInZhbHVlIjoiVzNhdFpERXU2SHZ2OU5nY3d6U1BsdUJtM1E4VVNPdnhsV1pEWEpxbkRWSVhhMkZQWHRxMXI0bnI1VU1uRkZieVowOXdYcnZpV3J4a2c5ODM3WHhsY3F1QXhUTHo1REdNSGJybXRBQ1NqdE82QmZrUURMbU5jOGZaWHk2eGI0dGMiLCJtYWMiOiIxNWQzZmVhYjMyMWU1NzFlYTQ5YmFmZjY4ZGRmYTI0MDk1NjRkMGFjMDVlMzY2MTI0ZWU1NzE0MmI0ZGNlOWQ2IiwidGFnIjoiIn0%3D; expires=Sun, 29 Mar 2026 14:15:13 GMT; Max-Age=7200; path=/; secure; httponly; samesite=none
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-supplier-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-supplier-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-supplier-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-supplier-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-supplier-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-supplier-orders" data-method="GET"
      data-path="api/supplier/orders"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-supplier-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-supplier-orders"
                    onclick="tryItOut('GETapi-supplier-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-supplier-orders"
                    onclick="cancelTryOut('GETapi-supplier-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-supplier-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/supplier/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-supplier-orders"
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
                              name="Accept"                data-endpoint="GETapi-supplier-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-PATCHapi-supplier-orders--order_id--status">PATCH api/supplier/orders/{order_id}/status</h2>

<p>
</p>



<span id="example-requests-PATCHapi-supplier-orders--order_id--status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://127.0.0.1:8000/api/supplier/orders/16/status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"delivered\",
    \"status_ar\": \"architecto\",
    \"payment_status\": \"pending\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/supplier/orders/16/status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "delivered",
    "status_ar": "architecto",
    "payment_status": "pending"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/supplier/orders/16/status';
$response = $client-&gt;patch(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'status' =&gt; 'delivered',
            'status_ar' =&gt; 'architecto',
            'payment_status' =&gt; 'pending',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-PATCHapi-supplier-orders--order_id--status">
</span>
<span id="execution-results-PATCHapi-supplier-orders--order_id--status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-supplier-orders--order_id--status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-supplier-orders--order_id--status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-supplier-orders--order_id--status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-supplier-orders--order_id--status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-supplier-orders--order_id--status" data-method="PATCH"
      data-path="api/supplier/orders/{order_id}/status"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-supplier-orders--order_id--status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-supplier-orders--order_id--status"
                    onclick="tryItOut('PATCHapi-supplier-orders--order_id--status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-supplier-orders--order_id--status"
                    onclick="cancelTryOut('PATCHapi-supplier-orders--order_id--status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-supplier-orders--order_id--status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/supplier/orders/{order_id}/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-supplier-orders--order_id--status"
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
                              name="Accept"                data-endpoint="PATCHapi-supplier-orders--order_id--status"
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
               step="any"               name="order_id"                data-endpoint="PATCHapi-supplier-orders--order_id--status"
               value="16"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PATCHapi-supplier-orders--order_id--status"
               value="delivered"
               data-component="body">
    <br>
<p>Example: <code>delivered</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>pending</code></li> <li><code>processing</code></li> <li><code>shipped</code></li> <li><code>delivered</code></li> <li><code>cancelled</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status_ar"                data-endpoint="PATCHapi-supplier-orders--order_id--status"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_status"                data-endpoint="PATCHapi-supplier-orders--order_id--status"
               value="pending"
               data-component="body">
    <br>
<p>Example: <code>pending</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>pending</code></li> <li><code>paid</code></li> <li><code>failed</code></li> <li><code>refunded</code></li></ul>
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
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: http://localhost:3000/checkout_confirmation?payment_status=failed
content-type: text/html; charset=utf-8
x-session-token: qGH81yYy02OHwJsCK70oQwlxjOiYtar2EjLonHmz
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
access-control-expose-headers: X-Session-Token
set-cookie: al-atheer-ecommerce-session=eyJpdiI6InY0WEEyeDZaNEF6bFFKdE1VenJmUVE9PSIsInZhbHVlIjoieEpMdVZXYTNsQStiQlZYSDJScjZ4VVZGN0lhU0xsSHR0UmJsRG5iaHFycGtaek82R0llV0hHZ2Mwbnd4My9yTENoK2FCMFZ4L21sT04xR2NmakFoVVlvOGpjaU8xbUhTeTZEbXo3ejJTcElhckR3VzZxcDArVXpXWUZrQnkyTEUiLCJtYWMiOiIxMDc0NmY1YzA5YjQ4NmU0ZDcwYjZhZDFmNjRjZjZlN2ZhZDBlNDNhYWZmNDIxNzNmOWU3OTFhNjEzNzIyYTA5IiwidGFnIjoiIn0%3D; expires=Sun, 29 Mar 2026 14:15:13 GMT; Max-Age=7200; path=/; secure; httponly; samesite=none
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url=&#039;http://localhost:3000/checkout_confirmation?payment_status=failed&#039;&quot; /&gt;

        &lt;title&gt;Redirecting to http://localhost:3000/checkout_confirmation?payment_status=failed&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;http://localhost:3000/checkout_confirmation?payment_status=failed&quot;&gt;http://localhost:3000/checkout_confirmation?payment_status=failed&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
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
x-session-token: UBBrpD5BXOrnEPbkk6a3brYSDdvKlxE2h3jh6Ljh
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
access-control-expose-headers: X-Session-Token
set-cookie: al-atheer-ecommerce-session=eyJpdiI6IjlsSVo5ajlJSUpOVXdRTXBDS01xd0E9PSIsInZhbHVlIjoiRDBLVDk0azBWYk5rUlo5UUZlOGQ5MnFwTHVCd3JKd3BRc0xhclNyUW15V2hDc3QzWGlXRnFXaTB5aGVCZUlJUllPK3FGRmUrb0Z3d0NvQmlOL2V6TkRhLy8zRlBZekJpbUdaTTk3MnJSVUJWb0gxNjdUcTMwdmJYZmxFYWNRZkUiLCJtYWMiOiI5NzEzMjFmOTQ3YjBmMTA3MzdiZDAxM2RmNjczNDUzMThhNWU4OThhNDI0NWUwMGI2OWY5MTQzZGU2ODYwNTFjIiwidGFnIjoiIn0%3D; expires=Sun, 29 Mar 2026 14:15:14 GMT; Max-Age=7200; path=/; secure; httponly; samesite=none
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
    \"scheduledDate\": \"2052-04-21\",
    \"businessLocationId\": \"architecto\",
    \"contactPerson\": {
        \"name\": \"architecto\",
        \"phone\": \"architecto\",
        \"secPhone\": \"architecto\",
        \"email\": \"zbailey@example.net\"
    },
    \"notes\": \"architecto\",
    \"noOfPackages\": 22,
    \"packageType\": \"Normal\",
    \"repeatedData\": {
        \"repeatedType\": \"Weekly\",
        \"days\": [
            \"Monday\"
        ],
        \"startDate\": \"2026-03-29T12:15:14\",
        \"endDate\": \"2052-04-21\"
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
    "scheduledDate": "2052-04-21",
    "businessLocationId": "architecto",
    "contactPerson": {
        "name": "architecto",
        "phone": "architecto",
        "secPhone": "architecto",
        "email": "zbailey@example.net"
    },
    "notes": "architecto",
    "noOfPackages": 22,
    "packageType": "Normal",
    "repeatedData": {
        "repeatedType": "Weekly",
        "days": [
            "Monday"
        ],
        "startDate": "2026-03-29T12:15:14",
        "endDate": "2052-04-21"
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
            'scheduledDate' =&gt; '2052-04-21',
            'businessLocationId' =&gt; 'architecto',
            'contactPerson' =&gt; [
                'name' =&gt; 'architecto',
                'phone' =&gt; 'architecto',
                'secPhone' =&gt; 'architecto',
                'email' =&gt; 'zbailey@example.net',
            ],
            'notes' =&gt; 'architecto',
            'noOfPackages' =&gt; 22,
            'packageType' =&gt; 'Normal',
            'repeatedData' =&gt; [
                'repeatedType' =&gt; 'Weekly',
                'days' =&gt; [
                    'Monday',
                ],
                'startDate' =&gt; '2026-03-29T12:15:14',
                'endDate' =&gt; '2052-04-21',
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
               value="2052-04-21"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after <code>today</code>. Example: <code>2052-04-21</code></p>
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
               value="Normal"
               data-component="body">
    <br>
<p>Example: <code>Normal</code></p>
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
               value="2026-03-29T12:15:14"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-03-29T12:15:14</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>endDate</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="repeatedData.endDate"                data-endpoint="POSTapi-pickups"
               value="2052-04-21"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after <code>repeatedData.startDate</code>. Example: <code>2052-04-21</code></p>
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
    \"MAIL_FROM_NAME\": \"architecto\",
    \"FRONTEND_URL\": \"http:\\/\\/www.bailey.biz\\/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html\"
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
    "MAIL_FROM_NAME": "architecto",
    "FRONTEND_URL": "http:\/\/www.bailey.biz\/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html"
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
            'FRONTEND_URL' =&gt; 'http://www.bailey.biz/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html',
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
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>FRONTEND_URL</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="FRONTEND_URL"                data-endpoint="POSTapi-settings-env"
               value="http://www.bailey.biz/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html"
               data-component="body">
    <br>
<p>Example: <code>http://www.bailey.biz/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html</code></p>
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
x-session-token: uD0PF0hwvUehHft8UdEGhusFFi3E55XJQmEMbkY7
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
access-control-expose-headers: X-Session-Token
set-cookie: al-atheer-ecommerce-session=eyJpdiI6InlxMVJQTDQ4MVlCNGQ4dXdlbzhVT1E9PSIsInZhbHVlIjoiRlVwdVpVYUV5SVFtYkJpK3BicXRVQXFVb095NmVZWFlmLzVteEhmS29RSFBqVVVldUd3RERwdU5YVDd5RTd4S3BNVUdCWU1xeHJzRVZQelV3SThhbmgzMEVTbDRMc2VneWtnZFczZ3RMMUFaMVI5UzdvN3pUUklERVljRHBzb3EiLCJtYWMiOiJjOGQxNTNlM2ZhOTcxYzZjZDgwZGYwNTQzOTQ3ZTBiNjg2MmY5ODIzOTUyYjA5NTIzYTRlN2YxMjRmYzAzNDY3IiwidGFnIjoiIn0%3D; expires=Sun, 29 Mar 2026 14:15:14 GMT; Max-Age=7200; path=/; secure; httponly; samesite=none
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: {
        &quot;file_path&quot;: &quot;C:\\projects\\ecommerce-api\\.env&quot;,
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
        &quot;MAIL_FROM_NAME&quot;: &quot;Al-Atheer Ecommerce&quot;,
        &quot;FRONTEND_URL&quot;: &quot;http://localhost:3000&quot;
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

                <h1 id="user-management">User Management</h1>

    <p>APIs for managing authenticated user data.</p>

                                <h2 id="user-management-GETapi-user">Get authenticated user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve the currently authenticated user's information including their addresses.</p>

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
    &quot;phone&quot;: &quot;+201234567890&quot;,
    &quot;email_verified_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
    &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
    &quot;addresses&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;user_id&quot;: 1,
            &quot;label&quot;: &quot;Home&quot;,
            &quot;name&quot;: &quot;John Doe&quot;,
            &quot;phone&quot;: &quot;+201234567890&quot;,
            &quot;address&quot;: &quot;123 Main St, Cairo, Egypt&quot;,
            &quot;city&quot;: &quot;Cairo&quot;,
            &quot;country&quot;: &quot;Egypt&quot;,
            &quot;is_default&quot;: true,
            &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
        }
    ]
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

                    <h2 id="user-management-PUTapi-user">Update authenticated user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update the authenticated user's profile information.</p>

<span id="example-requests-PUTapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://127.0.0.1:8000/api/user" \
    --header "Authorization: Bearer {YOUR_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"John Doe Updated\",
    \"email\": \"john.updated@example.com\",
    \"phone\": \"+201234567891\",
    \"password\": \"newpassword123\",
    \"password_confirmation\": \"newpassword123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://127.0.0.1:8000/api/user"
);

const headers = {
    "Authorization": "Bearer {YOUR_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "John Doe Updated",
    "email": "john.updated@example.com",
    "phone": "+201234567891",
    "password": "newpassword123",
    "password_confirmation": "newpassword123"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://127.0.0.1:8000/api/user';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'John Doe Updated',
            'email' =&gt; 'john.updated@example.com',
            'phone' =&gt; '+201234567891',
            'password' =&gt; 'newpassword123',
            'password_confirmation' =&gt; 'newpassword123',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-PUTapi-user">
            <blockquote>
            <p>Example response (200, Success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;name&quot;: &quot;John Doe Updated&quot;,
    &quot;email&quot;: &quot;john.updated@example.com&quot;,
    &quot;phone&quot;: &quot;+201234567891&quot;,
    &quot;email_verified_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
    &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2024-01-15T11:00:00.000000Z&quot;,
    &quot;addresses&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;user_id&quot;: 1,
            &quot;label&quot;: &quot;Home&quot;,
            &quot;name&quot;: &quot;John Doe Updated&quot;,
            &quot;phone&quot;: &quot;+201234567891&quot;,
            &quot;address&quot;: &quot;123 Main St, Cairo, Egypt&quot;,
            &quot;city&quot;: &quot;Cairo&quot;,
            &quot;country&quot;: &quot;Egypt&quot;,
            &quot;is_default&quot;: true,
            &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
        }
    ]
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
            <p>Example response (422, Validation Error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The email has already been taken.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-user" data-method="PUT"
      data-path="api/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-user"
                    onclick="tryItOut('PUTapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-user"
                    onclick="cancelTryOut('PUTapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-user"
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
                              name="Content-Type"                data-endpoint="PUTapi-user"
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
                              name="Accept"                data-endpoint="PUTapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-user"
               value="John Doe Updated"
               data-component="body">
    <br>
<p>optional The user's full name. Example: <code>John Doe Updated</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-user"
               value="john.updated@example.com"
               data-component="body">
    <br>
<p>optional The user's email address (must be unique). Example: <code>john.updated@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-user"
               value="+201234567891"
               data-component="body">
    <br>
<p>optional The user's phone number. Example: <code>+201234567891</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="PUTapi-user"
               value="newpassword123"
               data-component="body">
    <br>
<p>optional The new password (minimum 8 characters). Example: <code>newpassword123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="PUTapi-user"
               value="newpassword123"
               data-component="body">
    <br>
<p>optional Password confirmation (must match password). Example: <code>newpassword123</code></p>
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
