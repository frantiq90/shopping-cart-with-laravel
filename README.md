# Laravel Shopping Cart Application

Written with PHP, MySQL and Laravel Framework.
It shows how to use Laravel Session, relations, Eloquent, Stripe(Cart Charges), how to build a shopping basket, add the items, remove them.
Complete backend for online shop. 
What needs to be added:
- dedicated request validators,
- more payments options,
- admin backend,
- more user details connected to order, maybe autocompletion,
- front-end theme
- general refactor (code from controllers can be pushed to the models)

If you want to use it please remember this is Laravel 5.4 Framework, and be aware you have to update Stripe API's public key in "public/js/checkout.js" and  private key in "app/ProductController.php".
Also you need to run php artisan migrate nad php artisan db:seed and create your own .env file before.
# Feel free to use the code 
MIT license.
