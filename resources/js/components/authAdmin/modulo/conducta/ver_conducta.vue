<template>
	<div class="animated fadeIn">
		<div class="card">
			<div class="card-header">
				Conducta
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<tr style="background:#3F8DF7; color:white">
							<td>Descripcion</td>
							<td>Nivel Educativo</td>
							<td>Activo</td>
						</tr>
						<tr v-for="l in listar">
							<td>{{ l.descripcion }}</td>
							<td>
								<div v-for="x in l.nivel" >
									{{ x.nivel }}
								</div>
							</td>
							<td>
								{{ l.activo }}
							</td>
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
				listar:{}
			}
		},
		created(){
			this.listar_tabla();
		},
		methods:{
			listar_tabla(){
				axios.get('api/auth/admin/ver_comportamiento').then((res)=>{
					this.listar = res.data;
				});
			}
		}
	}
</script>