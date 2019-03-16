
import Outer from './components/outer.vue';
import HomeComponent from './components/Home.vue';
import CreateComponent from './components/Create.vue';
import IndexComponent from './components/inicio.vue';
// import EditComponent from './components/EditComponent.vue';

 import Auth from "./components/auth/auth.vue";
 import Index from './components/auth/index.vue';
 import CreateDocente from "./components/auth/create_docente.vue"

const routes = [
  {
    path: '/',
      component: Outer,
      name:'Admin',
      redirect:'home',
      iconCls:'el-icon-message',
      meta:{auth:false},

      children:[
        {
            name: 'home',
            path: '/',
            component: IndexComponent
        },
        {
            name: 'login',
            path: '/login',
            component: HomeComponent
        },
        {
            name: 'create',
            path: '/create',
            component: CreateComponent
        },
         
          //{path: '/terminos',name: 'terminos',component: Terminos,meta: { auth: false }},
      ] 
  },
 
 {
    path: '/home',
    component: Auth,
    name: 'Administration',
    redirect:'index',
    iconCls: 'el-icon-message',
    meta: {auth: true},
    children: [
      {path: '/index',name: 'index',component: Index},
      {path: '/creardocente',name: 'creardocente',component: CreateDocente},
    ]
},
  // {
  //     name: 'posts',
  //     path: '/posts',
  //     component: IndexComponent
  // },
  // {
  //     name: 'edit',
  //     path: '/edit/:id',
  //     component: EditComponent
  // }
];

export default routes;