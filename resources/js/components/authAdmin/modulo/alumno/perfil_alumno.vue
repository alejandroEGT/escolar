<template>
	<div>
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-8">
						curso {{ p_curso.descripcion+' - '+p_curso.nivel_educativo+' '+p_curso.promocion }}
					</div>
					<div class="col-md-4">
						<select v-model="alumno" @change="cambio" class="form-control form-control-sm float-right">
							<option>Seleccione otro alumno</option>
							<option v-for="a in alumnos" :value="a.id">{{ a.nombre+' '+a.apellido_paterno+' '+a.apellido_materno }}</option>
						</select>
					</div>
				</div>


			</div>
			<div class="card-body">
					
				<div class="row">
					<div class="col-md-2">
						<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRV9Iu0xCTWQ_U8galoOwXt6T8NrG5Ge3ZFbTGyN57mYmgz-86k">
					</div>
					<div class="col-md-5">
						<h3>{{ p_alumno.nombre+' '+p_alumno.apellido_paterno+' '+p_alumno.apellido_materno }}</h3>
						<h5 style="color:#707B7C">{{ p_alumno.nacimiento }}</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				alumno: this.$route.params.alumno,
				curso: this.$route.params.curso,
				p_curso:{},
				alumnos:{},
				p_alumno:{}

			}
		},
		created(){
			this.traer_curso();
			this.traer_alumnos_select();
			this.cargar_alumno(this.alumno);
		},
		methods:{
			traer_curso(){
				axios.get('api/auth/admin/first_curso/'+this.curso).then((res)=>{
					this.p_curso = res.data;
				});
			},
			traer_alumnos_select(){
				axios.get('api/auth/admin/cursos_alumnos_select/'+this.curso).then((res)=>{
					this.alumnos = res.data;
				});
			},
			cargar_alumno($alumno){
				axios.get('api/auth/admin/first_cursos_alumnos_select/'+this.alumno+'/'+this.curso).then((res)=>{
					this.p_alumno = res.data;
				});
			},
			cambio(){
				console.log(this.alumno);
				axios.get('api/auth/admin/first_cursos_alumnos_select/'+this.alumno+'/'+this.curso).then((res)=>{
					this.p_alumno = res.data;
				});
			}
		}
	}
</script>