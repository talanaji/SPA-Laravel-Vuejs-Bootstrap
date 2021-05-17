
import Login from './components/Login.vue'
import Regsiter from './components/Register.vue'
import Post from './components/Post.vue'
const routes = [
    {
        path: '/login', component: Login
    },
    {
        path: '/register', component: Regsiter
    },
    {
        path: '/post', component: Post
    },
]
export default routes