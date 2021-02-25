<template>
    <div class="container container-Data" >
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-left: 500px;background-color: transparent;padding: 0px">
            <div class="modal-dialog modal-center" role="document" align="center" style="margin-top: 0px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update == 0">Crear cine</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update != 0">Actualizar cine</h5>
                        <br>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Nombre</label>
                                    <input v-model="name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Telefono</label>
                                    <input v-model="phone" type="text" class="form-control">
                                </div>  
                                <div class="col-md-6">
                                    <label>Direccion</label>
                                     <input v-model="adress" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Latitud</label>
                                    <input v-model="latitude" type="text" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Longitud</label>
                                    <input v-model="longitude" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Departamento</label>
                                    <input v-model="departament_id" type="number" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Municipio</label>
                                    <input v-model="municipality_id" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Logo</label> 
                                    <input type="file" @change="previewFiles()" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button v-if="update == 0" @click="saveData()" class="btn btn-success">Añadir</button>
                        <button v-if="update != 0" @click="updateData()" class="btn btn-warning">Actualizar</button>
                        <button v-if="update != 0" @click="clearFields()" class="btn">Atrás</button>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="background-color: #28292d;border-color: #77a62e;">
          + Crear cine
        </button>
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <data-table
                    :columns="columns"
                    url="/api/cinemas" ref="myTable" name="myTable" class="datatable">
                </data-table>
            </div>
        </div>
    </div>
</template>
<script>
    import ImageComponent from './ImageComponent.vue';
    import EditButton from './EditButton.vue';
    import DeleteButton from './DeleteButton.vue';
    import $ from 'jquery';
    export default {
        data() {
            return {
                cinema_id:"",
                name:"",
                logo:"",
                adress:"",
                phone:"",
                latitude:0,
                longitude:0,
                departament_id:0,
                municipality_id:0,
                status:0,
                update:0, 
                arrayData:[],
                columns: [
                    {
                        label: 'Id',
                        name: 'cinema_id',
                        orderable: true,
                    },
                    {
                        label: 'Nombre',
                        name: 'name',
                        orderable: true,
                    },
                    {
                        label: 'Logo',
                        name: 'logo',
                        orderable: false,
                        component: ImageComponent,
                    },
                    {
                        label: 'Telefono',
                        name: 'phone',
                        orderable: true,
                    },
                    {
                        label: 'Direccion',
                        name: 'adress',
                        orderable: true,
                    },
                    {
                        label: 'Departamento',
                        name: 'departament_id',
                        orderable: true,
                    },
                    {
                        label: 'Municipio',
                        name: 'municipality_id',
                        orderable: true,
                    },
                    {
                        label: 'Latitud',
                        name: 'latitude',
                        orderable: false,
                    },
                    {
                        label: 'Longitud',
                        name: 'longitude',
                        orderable: false,
                    },
                    {
                        label: 'Estado',
                        name: 'status',
                        orderable: false,
                    },
                    {
                        label: 'Editar',
                        name: 'Editar',
                        orderable: false,
                        classes: { 
                            'btn': true,
                            'btn-primary': true,
                            'btn-sm': true,
                        },
                        event: "click",
                        handler: this.loadFieldsUpdate,
                        component: EditButton, 
                    },
                    {
                        label: 'Eliminar',
                        name: 'Eliminar',
                        orderable: false,
                        classes: { 
                            'btn': true,
                            'btn-danger': true,
                            'btn-sm': true,
                        },
                        event: "click",
                        handler: this.deleteData,
                        component: DeleteButton, 
                    },
                ]
            }
        },
        components: {
            EditButton,
            DeleteButton,
            ImageComponent
        },
        methods:{
            getData(){
                this.$refs.myTable.getData();
            },
            saveData(){
                let me =this;
                let url = '/api/cinemas' 
                axios.post(url,{ 
                    'name': this.name,
                    'logo': this.logo,
                    'phone': this.phone,
                    'adress': this.adress,
                    'latitude': this.latitude,
                    'longitude': this.longitude,
                    'departament_id': this.departament_id,
                    'municipality_id': this.municipality_id,
                    'status': this.status,
                }).then(function (response) {
                    console.log(response);
                    if (response.data.result == false) {
                        alert(response.data.message);
                    }else{
                        me.getData();
                        me.clearFields();
                        $('#exampleModal').modal('hide');
                    }
                })
                .catch(function (error) {
                    alert(error);
                    console.log(error);
                });   

            },
            updateData(){
                let me = this;
                axios.put('/api/cinemas/'+me.cinema_id,{
                    'name': me.name,
                    'logo': me.logo,
                    'phone': me.phone,
                    'adress': me.adress,
                    'departament_id': me.departament_id,
                    'municipality_id': me.municipality_id,
                    'latitude': me.latitude,
                    'longitude': me.longitude,
                    'status': me.status,
                }).then(function (response) {
                    $('#exampleModal').modal('hide');
                   me.getData();
                   me.clearFields();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(data){ 
                $('#exampleModal').modal('show');
                this.update = data.cinema_id
                let me =this;
                let url = '/api/cinemas/'+this.update;
                axios.get(url).then(function (response) {
                    me.cinema_id= response.data.records.cinema_id;
                    me.name= response.data.records.name;
                    me.logo= response.data.records.logo;
                    me.phone= response.data.records.phone;
                    me.adress= response.data.records.adress;
                    me.latitude= response.data.records.latitude;
                    me.longitude= response.data.records.longitude;
                    me.status= response.data.records.status;
                    me.departament_id= response.data.records.departament_id;
                    me.municipality_id= response.data.records.municipality_id;

                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            deleteData(data){
                let me =this;
                let Data_id = data.cinema_id
                if (confirm('¿Seguro que deseas eliminar este registro?')) {
                    axios.delete('/api/cinemas/'+Data_id
                    ).then(function (response) {
                        me.getData();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clearFields(){
                this.cinema_id = "";
                this.name = "";
                this.logo = "";
                this.phone = "";
                this.adress = "";
                this.departament_id = "";
                this.municipality_id = "";
                this.latitude = "";
                this.longitude = "";
                this.status = "";
                this.update = 0;
                $('#exampleModal').modal('hide');
            }
        },
        previewFiles(files){
          console.log(files)
        },
        mounted() {
            console.log("Test");
           this.getData();
        }
    }
</script>