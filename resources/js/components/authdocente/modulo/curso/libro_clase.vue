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
				<br>
				<div class="row">
					<div class="col-md-6">
						<select v-model="seccion" @change="libro_notas" class="form-control form-control-sm" v-if="cur.formato_id == 1">
							<option value="0">Filtrar notas por criterio..</option>
							<option value="1">1er Semestre</option>
							<option value="2">2do Semestre</option>
						</select>

						<select v-model="seccion" @change="libro_notas" class="form-control form-control-sm" v-if="cur.formato_id == 2">
							<option value="0">Filtrar notas por criterio..</option>
							<option value="1" >1er trimestre</option>
							<option value="2" >2do trimestre</option>
							<option value="3" >3ro trimestre</option>
						</select>
					</div>
					<div class="col-md-2">
						<button v-if="filtro_seccion == true" @click="exportar_nota_por_asignatura" class="btn btn-primary btn-sm"><small><i class="fas fa-file-csv fa-2x"></i> Exportar a excel</small></button>
					</div>
				</div>
			</div>
		</div>



		<div class="table-responsive">
					<center v-if="filtro_seccion == false"> <i class="fas fa-search"></i> Primero filtrar por criterio..</center>
					  <table class="table" v-if="filtro_seccion == true">
					    <thead>
					    	<tr style="background:#3F8DF7; color:white">
					    		<td>Apellidos</td>
					    		<td>Nombre</td>
					    		<td>Nota1</td>
					    		<td>Nota2</td>
					    		<td>Nota3</td>
					    		<td>Nota4</td>
					    		<td>Nota5</td>
					    		<td>Nota6</td>
					    		<td>Nota7</td>
					    		<td>Nota8</td>
					    		<td>Nota9</td>
					    		<td>Nota10</td>
					    		<td>TOTAL</td>
					    	</tr>
					    </thead>
					    <tbody style="">
					    	
						    	<tr v-for="l in l_notas" >
						    		<td><small>{{ l.apellido_paterno+' '+l.apellido_materno }}</small></td>
						    		<td><small>{{ l.nombre }}</small></td>
						    		<td><input @keyup.enter="registrar_nota($event,'n1',l.id)" class="form-control form-control-sm" type="" :value="l.nota1"></td>
						    		<td><input @keyup.enter="registrar_nota($event,'n2',l.id)" class="form-control form-control-sm" type="" :value="l.nota2"></td>
						    		<td><input @keyup.enter="registrar_nota($event,'n3',l.id)" class="form-control form-control-sm" type="" :value="l.nota3"></td>
						    		<td><input @keyup.enter="registrar_nota($event,'n4',l.id)" class="form-control form-control-sm" type="" :value="l.nota4"></td>
						    		<td><input @keyup.enter="registrar_nota($event,'n5',l.id)" class="form-control form-control-sm" type="" :value="l.nota5"></td>
						    		<td><input @keyup.enter="registrar_nota($event,'n6',l.id)" class="form-control form-control-sm" type="" :value="l.nota6"></td>
						    		<td><input @keyup.enter="registrar_nota($event,'n7',l.id)" class="form-control form-control-sm" type="" :value="l.nota7"></td>
						    		<td><input @keyup.enter="registrar_nota($event,'n8',l.id)" class="form-control form-control-sm" type="" :value="l.nota8"></td>
						    		<td><input @keyup.enter="registrar_nota($event,'n9',l.id)" class="form-control form-control-sm" type="" :value="l.nota9"></td>
						    		<td><input @keyup.enter="registrar_nota($event,'n10',l.id)" class="form-control form-control-sm" type="" :value="l.nota10"></td>
						    		<td>
						    			<strong v-if="l.total < 40">{{l.total}}</strong>
						    			<strong v-if="l.total > 40">{{l.total}}</strong>
						    		</td>
						    	</tr>
						    
					    </tbody>
					</table>
		</div>
	</div>
</template>

<script>
import { saveAs } from 'file-saver';
	export default{
		data(){
			return{
				user:{},
				curso: this.$route.params.curso,
				asignatura: this.$route.params.asignatura,
				cur:{},
				asig:{},
				seccion:'0',
				l_notas:{},
				filtro_seccion : false
			}
		},
		created(){
			this.user = this.$auth.user();
			this.datos_basicos();
			// this.libro_notas();
		},
		methods:{
			datos_basicos(){
				axios.get('api/auth/docente/datos_basicos/'+this.curso+'/'+this.asignatura).then((res)=>{
					this.cur = res.data.curso;
					this.asig = res.data.asignatura;
				});
			},
			libro_notas(){
				axios.get('api/auth/docente/libro_nota/'+this.curso+'/'+this.asignatura+'/'+this.seccion).then((res)=>{
						this.l_notas = res.data;
						this.filtro_seccion = true;
						if(this.seccion == "0"){
							this.filtro_seccion = false;
						}
				});
			},
			registrar_nota($this, n, alumno){
				const form={
					nota_nombre : n,
					nota_valor : $this.target.value,
					alumno: alumno,
					curso : this.curso,
					asignatura: this.asignatura,
					seccion: this.seccion
				}
				
				axios.post('api/auth/docente/registrar_nota', form).then((res)=>{
					this.$notify({
							  group: ''+res.data.tipo+'',
							  title: 'Alerta',
							  text: ''+res.data.mensaje+'',
					});	
					this.libro_notas();
				})
			},
			exportar_nota_por_asignatura(){
				let options = {
					responseType: 'blob',
				    headers: {
				      
				      'Acept': 'application/vnd.ms-excel'
				    }
				  }
				axios.get('api/auth/docente/exportar_nota_por_asignatura/'+this.curso+'/'+this.asignatura+'/'+this.seccion,
					options
				).then((res)=>{
					//console.log(res.headers['content-disposition']);
					console.log(this.cur.descripcion)
					  const url = window.URL.createObjectURL(new Blob([res.data]));
					 //  var blob = new Blob([res.data]);
						// saveAs(blob, "hello world.xlsx");
					   const link = document.createElement('a');
					   link.href = url;
					   link.setAttribute('download', this.cur.descripcion+'_'+this.asig.descripcion+'.xlsx'); //or any other extension
					   document.body.appendChild(link);
					   link.click();
				})


				
			}
		}
	}
</script>
<style type="text/css">


/*thead, tbody { display: block; width: 300px}
tbody {
    height: 315px;
    overflow-y: auto;
    overflow-x: hidden;
}*/
/*thead {
    height: 37px;
    width: 130%;
    overflow-y: auto;
    overflow-x: hidden;
}*/
	
</style>