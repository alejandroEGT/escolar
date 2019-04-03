
import Outer from './components/outer.vue';
import HomeComponent from './components/Home.vue';
import CreateComponent from './components/Create.vue';
import IndexComponent from './components/inicio.vue';
// import EditComponent from './components/EditComponent.vue';

 import Auth from "./components/auth/auth.vue";
 import Index from './components/auth/index.vue';
 import CreateDocente from "./components/auth/create_docente.vue"
 import CreateCuenta from "./components/auth/create_cuentas.vue"
 import ListarDocente from "./components/auth/listar_docente.vue"
 import ListarCuenta from "./components/auth/listar_cuentas.vue"




//Administrador establecimiento
 import AuthAdmin from "./components/authAdmin/authadmin.vue"
 import IndexAdmin from "./components/authAdmin/indexAdmin.vue"
 import CreateCurso from "./components/authAdmin/modulo/create_cursos.vue"
 import CrearDocente2 from "./components/authAdmin/modulo/create_docente.vue"
 import ListarDocente2 from "./components/authAdmin/modulo/listar_docente.vue"
 import CrearAlumno from "./components/authAdmin/modulo/create_alumno.vue"
 import Listaralumno from "./components/authAdmin/modulo/listar_alumno.vue"

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
 
 {//CUENTA DE SUPER ADMIN
    path: '/home',
    component: Auth,
    name: 'Administration',
    redirect:'index',
    iconCls: 'el-icon-message',
    meta: {auth: 1},
    children: [
      {path: '/index',name: 'index',component: Index},
      {path: '/creardocente',name: 'creardocente',component: CreateDocente},
      {path: '/listardocente',name: 'listardocente',component: ListarDocente},
      {path: '/crearcuenta',name: 'crearcuenta',component: CreateCuenta},
      {path: '/listarcuenta',name: 'listarcuenta',component: ListarCuenta},
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
      {path: '/admincreardocente',name: 'admincreardocente',component: CrearDocente2},
      {path: '/admincrearcurso',name: 'crearcurso',component: CreateCurso},
      {path: '/adminlistardocente',name: 'adminlistardocente',component: ListarDocente2},
      {path: '/admincrearalumno',name: 'admincrearalumno',component: CrearAlumno},
      {path: '/adminlistaralumno',name: 'adminlistaralumno',component: Listaralumno},
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