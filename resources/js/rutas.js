
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
 import AdminCurso from "./components/authAdmin/modulo/curso/curso.vue"
 import AdminPerfil from "./components/authAdmin/modulo/perfil/perfil.vue"
 import Adminagregarasignatura from "./components/authAdmin/modulo/agregar_asignatura.vue"
 import Permisos from "./components/authAdmin/modulo/permisos.vue"
 import CreaConducta from "./components/authAdmin/modulo/conducta/crear_conducta.vue"
 import VerConducta from "./components/authAdmin/modulo/conducta/ver_conducta.vue"
 import AdminReporte from "./components/authAdmin/modulo/reporte/reporte.vue"

 //Docente establecimiento
 import AuthDocente from "./components/authdocente/authdocente.vue"
 import IndexDocente from "./components/authdocente/indexDocente.vue"
 import DocenteCursos from "./components/authdocente/modulo/ver_cursos.vue"
 import DocenteLibro from "./components/authdocente/modulo/curso/libro_clase.vue"
 import Historia from "./components/authdocente/modulo/historia/historia.vue"
 import Chat from "./components/authdocente/modulo/mensajeria/chat.vue"
 import Boxchat from "./components/authdocente/modulo/mensajeria/cuerpo_chat.vue"
 import Jcurso from "./components/authdocente/modulo/curso/jcurso.vue"
 import Actividad from "./components/authdocente/modulo/historia/historia_general.vue"
 import DocenteMensaje from "./components/authdocente/modulo/mensajeria/mensaje.vue"


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
      {path:':id/curso', name: 'curso', component:AdminCurso},
      {path: '/adminperfil',name: 'adminperfil',component: AdminPerfil},
      {path: '/adminagregarasignatura',name: 'adminagregarasignatura',component: Adminagregarasignatura},
      {path: '/adminpermiso',name:'adminpermiso', component:Permisos},
      {path: '/creaconducta',name:'creaconducta', component:CreaConducta},
      {path: '/verconducta',name:'verconducta', component:VerConducta},
      {path: '/adminreporte',name:'adminreporte', component:AdminReporte}
    ]
 },
 {
    path: '/docente',
    component: AuthDocente,
    name: 'Docente',
    redirect:'docente',
    iconCls: 'el-icon-message',
    meta: {auth: 3},
    children: [
      {path: '/docente',name: 'docente',component: IndexDocente},
      {path: '/docentecurso',name: 'docentecurso',component: DocenteCursos},
      {path: '/docentelibro/:curso/:asignatura',name: 'docentelibro',component: DocenteLibro},
      {path: '/docentehistoria/:curso/:asignatura',name: 'docentehistoria',component: Historia},
      {path: '/docentechat',name: 'docentechat',component: Chat},
      {path: '/docenteboxchat/:user',name: 'docenteboxchat',component: Boxchat},
      {path:'/docentejcurso/:curso/:texto', name: 'jcurso', component:Jcurso},
      {path: '/docentecrearalumno/',name: 'docentecrearalumno',component: CrearAlumno},
      {path: '/docenteactividades',name: 'docenteactividades',component: Actividad},
      {path: '/docentemensaje/:curso/:asignatura',name: 'docentemensaje',component: DocenteMensaje},
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