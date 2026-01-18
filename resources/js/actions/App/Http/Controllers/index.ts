import ProductController from './ProductController'
import CategoryController from './CategoryController'
import CartController from './CartController'
import CheckoutController from './CheckoutController'
import OrderController from './OrderController'
import DashboardController from './DashboardController'
import PaymentController from './PaymentController'
import ShipmentController from './ShipmentController'
import BostaWebhookController from './BostaWebhookController'
import ConfigController from './ConfigController'
import AdminProductController from './AdminProductController'
import AdminCategoryController from './AdminCategoryController'
import TeamMemberController from './TeamMemberController'
import Settings from './Settings'
const Controllers = {
    ProductController: Object.assign(ProductController, ProductController),
CategoryController: Object.assign(CategoryController, CategoryController),
CartController: Object.assign(CartController, CartController),
CheckoutController: Object.assign(CheckoutController, CheckoutController),
OrderController: Object.assign(OrderController, OrderController),
DashboardController: Object.assign(DashboardController, DashboardController),
PaymentController: Object.assign(PaymentController, PaymentController),
ShipmentController: Object.assign(ShipmentController, ShipmentController),
BostaWebhookController: Object.assign(BostaWebhookController, BostaWebhookController),
ConfigController: Object.assign(ConfigController, ConfigController),
AdminProductController: Object.assign(AdminProductController, AdminProductController),
AdminCategoryController: Object.assign(AdminCategoryController, AdminCategoryController),
TeamMemberController: Object.assign(TeamMemberController, TeamMemberController),
Settings: Object.assign(Settings, Settings),
}

export default Controllers