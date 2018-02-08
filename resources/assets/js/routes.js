import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./Views/Home/HomeView')
    }
    ];

export default new VueRouter({
    routes,
    mode:'history',
    linkActiveClass: 'is-active'
});