import ProductController from './ProductController'
import CategoryController from './CategoryController'
import ContactUsController from './ContactUsController'
import CartController from './CartController'
import CheckoutController from './CheckoutController'
import OrderController from './OrderController'
import WishlistController from './WishlistController'
import DashboardController from './DashboardController'
import TeamMemberApiController from './TeamMemberApiController'
import ContactInquiryController from './ContactInquiryController'
import PaymentController from './PaymentController'
import ShipmentController from './ShipmentController'
import BostaWebhookController from './BostaWebhookController'
import ConfigController from './ConfigController'
import AdminProductController from './AdminProductController'
import AdminCategoryController from './AdminCategoryController'
import TeamMemberController from './TeamMemberController'
import ContactInquiryAdminController from './ContactInquiryAdminController'
import Admin from './Admin'
import Settings from './Settings'
const Controllers = {
    ProductController: Object.assign(ProductController, ProductController),
CategoryController: Object.assign(CategoryController, CategoryController),
ContactUsController: Object.assign(ContactUsController, ContactUsController),
CartController: Object.assign(CartController, CartController),
CheckoutController: Object.assign(CheckoutController, CheckoutController),
OrderController: Object.assign(OrderController, OrderController),
WishlistController: Object.assign(WishlistController, WishlistController),
DashboardController: Object.assign(DashboardController, DashboardController),
TeamMemberApiController: Object.assign(TeamMemberApiController, TeamMemberApiController),
ContactInquiryController: Object.assign(ContactInquiryController, ContactInquiryController),
PaymentController: Object.assign(PaymentController, PaymentController),
ShipmentController: Object.assign(ShipmentController, ShipmentController),
BostaWebhookController: Object.assign(BostaWebhookController, BostaWebhookController),
ConfigController: Object.assign(ConfigController, ConfigController),
AdminProductController: Object.assign(AdminProductController, AdminProductController),
AdminCategoryController: Object.assign(AdminCategoryController, AdminCategoryController),
TeamMemberController: Object.assign(TeamMemberController, TeamMemberController),
ContactInquiryAdminController: Object.assign(ContactInquiryAdminController, ContactInquiryAdminController),
Admin: Object.assign(Admin, Admin),
Settings: Object.assign(Settings, Settings),
}

export default Controllers