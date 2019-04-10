<template>
	<div class="animated fadeIn">
		<div class="container">
			
			 <div class="card">
				<div class="card-header">
	  				<h5><i class="fas fa-clipboard-list"></i> Lista Cursos</h5>
	  			</div>
			  <div class="card-body">

			  		<div class="table-responsive">

					      	
						  <table class="table">
						    <thead>
						    	<tr style="background:#3F8DF7; color:white">
						    		<td>Descripción</td>
						    		<td>Promoción</td>
						    		<td>Formato</td>
						    		<!-- <td>Email</td>
						    		<td>Contacto</td>
						    		<td>Activo</td> -->
						    	</tr>
						    </thead>
						    <tbody>
						    	<tr v-for="listado in listar_cursos">
						    		<td>
						    			<md-chip class="md-primary" md-clickable @click="url_curso(listado.id)">
						    				{{listado.descripcion}}
						    			</md-chip>
						    		</td>
						    		<td>{{listado.promocion}}</td>
						    		<td v-if="listado.formato_id  == 1">Semestral</td>
						    		<td v-if="listado.formato_id  == 2">Trimestral</td>
						    		<!-- <td>{{ listado.email }}</td>
						    		<td>{{ listado.contacto }}</td>
						    		<td>{{ listado.activo }}</td> -->
						    	</tr>
						    </tbody>
						  </table>
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
				listar_cursos:{}
			}
		},
		created(){
			this.cursos()
		},
		methods:{
			cursos(){
				axios.get('api/auth/docente/mis_cursos').then((res)=>{
					this.listar_cursos = res.data;
				});
			}
		}	
	}
</script>