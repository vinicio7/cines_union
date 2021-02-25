<template>
    <div class="container container-Data" >
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-left: 500px;background-color: transparent;padding: 0px">
            <div class="modal-dialog modal-center" role="document" align="center" style="margin-top: 0px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update == 0">Crear usuario</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update != 0">Actualizar usuario</h5>
                        <br>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Cine</label>
                                    <input v-model="cinema_id" type="text" class="form-control">
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tipo</label>
                                    <input v-model="type" type="text" class="form-control">
                                </div>  
                                <div class="col-md-6">
                                    <label>Nombre</label>
                                     <input v-model="name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Usuario</label>
                                    <input v-model="user" type="text" class="form-control">
                                </div>  
                                <div class="col-md-6">
                                    <label>Contraseña</label>
                                     <input v-model="password" type="password" class="form-control">
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
          + Crear usuario
        </button>
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <data-table
                    :columns="columns"
                    url="/api/users"room ref="myTable" cinema_id="myTable" class="datatable">
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
                user_id:"",
                cinema_id:"",
                type:"",
                status:0,
                update:0, 
                arrayData:[],
                columns: [
                    {
                        label: 'Id',
                        name: 'user_id',
                        orderable: true,
                    },
                    {
                        label: 'Cine',
                        name: 'cinema.name',
                        orderable: true,
                    },
                    {
                        label: 'Tipo',
                        name: 'type',
                        orderable: true,
                    },
                    {
                        label: 'Nombre',
                        name: 'name',
                        orderable: true,
                    },
                    {
                        label: 'Usuario',
                        name: 'user',
                        orderable: true,
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
                let url = '/api/users'; 
                axios.post(url,{ 
                    'cinema_id': this.cinema_id,
                    'type': this.type,
                    'name': this.name,
                    'user': this.user,
                    'password': this.password,
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
                axios.put('/api/users/'+me.user_id,{
                    'cinema_id': me.cinema_id,
                    'type': me.type,
                    'status': me.status,
                    'name': me.name,
                    'user': me.user,
                    'password': me.password,
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
                this.update = data.user_id
                let me =this;
                let url = '/api/users/'+this.update;
                axios.get(url).then(function (response) {
                    me.user_id= response.data.records.user_id;
                    me.cinema_id= response.data.records.cinema_id;
                    me.type= response.data.records.type;
                    me.status= response.data.records.status;
                    me.name= response.data.records.name;
                    me.user= response.data.records.user;
                    //me.password= response.data.records.password;
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            deleteData(data){
                let me =this;
                let Data_id = data.user_id
                if (confirm('¿Seguro que deseas eliminar este registro?')) {
                    axios.delete('/api/users/'+Data_id
                    ).then(function (response) {
                        me.getData();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clearFields(){
                this.user_id = "";
                this.cinema_id = "";
                this.type = "";
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