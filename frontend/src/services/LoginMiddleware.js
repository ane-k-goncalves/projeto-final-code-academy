import Cookie from 'js-cookie';

export default {
    auth(to, from, next) {
        const token = Cookie.get('token');

        if (!token) {
            if (to.path !== '/login') {
              next('/login');
            } else {
              next();
            }
          } else {
            if (to.path === '/login') {
              next('/dashboard');
            } else {
              next();
            }
          }
    },
   
}