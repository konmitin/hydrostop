import { createRouter, createWebHistory } from 'vue-router';
import Admin from './../Admin.vue';
import Index from './../pages/Index.vue';
import Auth from './../pages/Auth.vue';
import Users from './../pages/Users.vue';
import Branch from '../pages/Branch.vue';
import Branches from './../pages/Branches.vue';
import Profile from './../pages/Profile.vue';
import User from './../pages/User.vue';
import Settings from './../pages/Settings.vue';
import Products from '../pages/Products.vue';
import Product from '../pages/Product.vue';
import Category from '../pages/Category.vue';
import Categories from '../pages/Categories.vue';
import Properties from '../pages/Properties.vue';
import Orders from '../pages/Orders.vue';
import Company from '../pages/Company.vue';
import Order from '../pages/Order.vue';
import Clients from '../pages/Clients.vue';
import Client from '../pages/Client.vue';
import Calls from '../pages/Calls.vue';
import Sertificates from '../pages/Sertificates.vue';
import Sertificate from '../pages/Sertificate.vue';
import Call from '../pages/Call.vue';

const routes = [
    // {
    //     path: "/h-admin",
    //     component: Index
    // },
    { path: '/:pathMatch(.*)*', component: Auth, name: 'NotFound' },
    {
        path: "/h-admin/auth",
        component: Auth
    },
    {
        path: "/h-admin/orders/:id",
        component: Order
    },
    {
        path: "/h-admin/orders",
        component: Orders
    },
    {
        path: "/h-admin/calls/:id",
        component: Call
    },
    {
        path: "/h-admin/calls",
        component: Calls
    },
    {
        path: "/h-admin/clients/:id",
        component: Client
    },
    {
        path: "/h-admin/clients",
        component: Clients
    },
    {
        name: 'profile',
        path: "/h-admin/profile",
        component: Profile
    },
    {
        path: "/h-admin/products",
        component: Products
    },
    {
        path: "/h-admin/products/:id",
        component: Product
    },
    {
        path: "/h-admin/properties",
        component: Properties
    },
    {
        path: "/h-admin/categories",
        component: Categories
    },
    {
        path: "/h-admin/categories/:id",
        component: Category
    },
    {
        path: "/h-admin/users/:id",
        component: User
    },
    {
        path: "/h-admin/users",
        component: Users
    },
    {
        path: "/h-admin/branches/:id",
        component: Branch
    },
    {
        path: "/h-admin/branches",
        component: Branches
    },
    {
        path: "/h-admin/company",
        component: Company
    },
    {
        path: "/h-admin/sertificates/:id",
        component: Sertificate
    },
    {
        path: "/h-admin/sertificates",
        component: Sertificates
    },
    {
        path: "/h-admin/settings",
        component: Settings
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;