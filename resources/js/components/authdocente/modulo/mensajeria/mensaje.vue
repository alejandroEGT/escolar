<template>
	<div class="card">
		<div class="card-header"><i class="fas fa-envelope"></i> Comunicado</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table">
					<tr>
						<td><strong>Alumno</strong></td>
						<td><strong>Apoderado</strong></td>
						<td><strong>Opcion</strong></td>
					</tr>
					<tr v-for="l in listado" >
						<td><i class="fas fa-user-graduate"></i> {{ l.nombre +' '+l.apellido_paterno+' '+l.apellido_materno }}</td>
						<td>
							<div v-for="x in l.apoderado">
								<i class="fas fa-user"></i> {{ x.nombres +' '+x.apellido_paterno+' '+x.apellido_materno }}
							</div>
						</td>
						<td>
							<md-button class="md-raised md-primary">Redactar Comunicado</md-button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				url : this.$route.params,
				listado:{}
			}
		},
		created(){
			this.listar()
		},
		methods:{
			listar(){
				axios.get('api/auth/docente/listar_alumnos_y_apoderados/'+this.url.curso+'/'+this.url.asignatura).then((res)=>{
					this.listado = res.data;
				});
			}
		}
	}
</script>