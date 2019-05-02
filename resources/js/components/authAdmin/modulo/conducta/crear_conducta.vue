<template>	
	<div class="animated fadeIn">
		<div class="card">
			<div class="card-header">
				Crear Conducta
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<div class="card" style="">
						  <div class="card-header">
						    Niveles
						  </div>
							 <ul class="list-group list-group-flush" v-for="(l,i) in ch_list">
							    <li class="list-group-item">
							    

										<div class="custom-control custom-checkbox">
										  <input name="chk" :id="'check'+i" type="checkbox" class="custom-control-input" :value="l.id">
										  <label class="custom-control-label" :for="'check'+i">
										  {{ l.descripcion }}</label>
										</div>
								</li>
							    
							  </ul>
					    </div>
						
					</div>
					<div class="col-md-3">
						<textarea v-model="descripcion" class="form-control" placeholder="Ingrese una comportamiento o conducta a evaluar..."></textarea> 

						<md-button @click="register" class="md-raised md-primary">Agregar Conducta</md-button>
					</div>
		
					<div class="col-md-3">
						
						        
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
				descripcion:'',
				ch_list:[
					{id:'1', descripcion:'E. BÁSICA'},
					{id:'2', descripcion:'E. MEDIA'},
					{id:'3', descripcion:'PRE-BÁSICA'}
					// {id:'3', descripcion:'Primaria'},
					// {id:'4', descripcion:'Secundaria'},
				]
			}
		},
		created(){
			// this.listar_niveles();
		},
		methods:{
			register(){
				var yourArray = new Array();
				$("input:checkbox[name=chk]:checked").each(function(){
					    yourArray.push($(this).val());
				});
				const data = {
				  descripcion: this.descripcion,
				  nivel: yourArray
				};

				axios.post('api/auth/admin/crear_comportamiento', data).then((res)=>{
					
				});
			},
			listar_niveles(){
				axios.get('api/').then((res)=>{
					this.ch_list = res.data;
				});
			}
		}
	}
</script>