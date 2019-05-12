<template>
	<div class="animated fadeIn">
		<div class="card">
		<div class="card-header">Actividades en general</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
    				<table class="table">
    					<tr>
    						<td style="width:20%;"><i class="far fa-calendar-alt"></i> Fecha</td>
    						<td><i class="fas fa-thumbtack"></i> Actividad</td>
    					</tr>

    					<tr v-for="l in listar_act">
    						<td>
    							<h5>{{ l.cabeza.fecha }}</h5>
    							<div class="progress">
								  <div class="progress-bar" role="progressbar" :style="'width:'+l.porcentaje+'%'" aria-valuenow="75" aria-valuemin="0" aria-valuemax="3"><small>{{l.n}}/{{l.n + l.s}}</small></div>

								</div>
    						</td>
    						<td style="border-left: 1px solid #3498DB">
    							<div v-for="x in l.cuerpo" >
    								<h6>
    									<button v-if="x.activo == 'S'" class="btn btn-link" @click="desactivar(x.recordatorio_id)">
    									<i  style="color:#2ECC71;"  class="fas fa-circle"></i>
										</button>
										<button v-if="x.activo == 'N'" class="btn btn-link" @click="activar(x.recordatorio_id)">
    									<i style="color:#B2BABB;"  class="fas fa-circle"></i>
    								    </button>
    									{{x.titulo}} <small style="color:#616A6B">({{ x.cuando }})</small></h6>
						        <p>{{ x.descripcion }}</p><hr>
    							</div>
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
				listar_act:[]
			}
		},
		created(){
			this.listar();
		},
		methods:{
			listar(){
				axios.get('api/auth/docente/actividad_general').then((res)=>{
					
					this.listar_act = res.data;
				});
			},
			activar($record){
			axios.get('api/auth/docente/activiar_record/'+$record).then((res)=>{
					//this.listar_act = res.data;
					this.listar();
				});
			},
			desactivar($record){
				axios.get('api/auth/docente/desactiviar_record/'+$record).then((res)=>{
						this.listar();
						//this.listar_act = res.data;
					});
			}
		},
		
	}
</script>