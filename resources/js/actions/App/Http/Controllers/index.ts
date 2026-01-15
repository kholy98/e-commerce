import ProductController from './ProductController'
import CartController from './CartController'
import CheckoutController from './CheckoutController'
import OrderController from './OrderController'
import PaymentController from './PaymentController'
import ShipmentController from './ShipmentController'
import BostaWebhookController from './BostaWebhookController'
import ConfigController from './ConfigController'
import Settings from './Settings'
const Controllers = {
    ProductController: Object.assign(ProductController, ProductController),
CartController: Object.assign(CartController, CartController),
CheckoutController: Object.assign(CheckoutController, CheckoutController),
OrderController: Object.assign(OrderController, OrderController),
PaymentController: Object.assign(PaymentController, PaymentController),
ShipmentController: Object.assign(ShipmentController, ShipmentController),
BostaWebhookController: Object.assign(BostaWebhookController, BostaWebhookController),
ConfigController: Object.assign(ConfigController, ConfigController),
Settings: Object.assign(Settings, Settings),
}

export default Controllers