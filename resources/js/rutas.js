
import Outer from './components/outer.vue';
import HomeComponent from './components/Home.vue';
import CreateComponent from './components/Create.vue';
import IndexComponent from './components/inicio.vue';
// import EditComponent from './components/EditComponent.vue';

 import Auth from "./components/auth/auth.vue";
 import Index from './components/auth/index.vue';
 import CreateDocente from "./components/auth/create_docente.vue"
 import CreateCuenta from "./components/auth/create_cuentas.vue"





 import AuthAdmin from "./components/authAdmin/authadmin.vue"
 import IndexAdmin from "./components/authAdmin/indexAdmin.vue"

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
    meta: {auth: 1},
    children: [
      {path: '/index',name: 'index',component: Index},
      {path: '/creardocente',name: 'creardocente',component: CreateDocente},
      {path: '/crearcuenta',name: 'crearcuenta',component: CreateCuenta},
    ]
 },
 {
    path: '/admin',
    component: AuthAdmin,
    name: 'Administration',
    redirect:'admin',
    iconCls: 'el-icon-message',
    meta: {auth: 2},
    children: [
      {path: '/admin',name: 'admin',component: IndexAdmin},
      {path: '/admincreardocente',name: 'admincreardocente',component: CreateDocente},
      // {path: '/crearcuenta',name: 'crearcuenta',component: CreateCuenta},
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