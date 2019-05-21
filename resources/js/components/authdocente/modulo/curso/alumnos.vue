<template>
	<div>
		<div class="card">
			<div class="card-header">Notas</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<small><strong>Docente:</strong> {{ user.nombres+' '+user.apellido_paterno+' '+user.apellido_materno }}</small>
					</div>
					<div class="col-md-3">
						<small><strong>Curso:</strong> {{ cur.descripcion }}</small>
					</div>
					<div class="col-md-3">
						<small><strong>Asignatura:</strong> {{ asig.descripcion }}</small>
					</div>
				</div>
			
			</div>
		</div>


		<div class="card">
			<div class="card-header">Alumnos</div>

			<div class="card-body">
				<div class="table-response">
					<table class="table">
						<tr>
							<td>Apellidos</td>
							<td>Nombres</td>
							<td></td>
							<td></td>
						</tr>
						<tr v-for="a in listar">
							<td>{{ a.apellido_paterno+' '+a.apellido_paterno }}</td>
							<td>{{ a.nombre }}</td>
							<td><md-button class="md-raised md-primary">Observacion</md-button></td>
							<td><md-button class="md-raised md-primary">Acumulados</md-button></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				user:{},
				curso: this.$route.params.curso,
				asignatura: this.$route.params.asignatura,
				cur:{},
				asig:{},
				listar:[]
			}
		},
		created(){
			this.user = this.$auth.user();
			this.datos_basicos();
			this.listar_alumnos();

		},
		methods:{
			datos_basicos(){
				axios.get('api/auth/docente/datos_basicos/'+this.curso+'/'+this.asignatura).then((res)=>{
					this.cur = res.data.curso;
					this.asig = res.data.asignatura;
				});
			},
			listar_alumnos(){
				axios.get('api/auth/docente/alumnos/'+this.curso+'/'+this.asignatura).then((res)=>{
					this.listar = res.data;
				});
			}
		}
	}
</script>