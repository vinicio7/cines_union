<template>
    <div class="container container-Data" >
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-left: 500px;background-color: transparent;padding: 0px">
            <div class="modal-dialog modal-center" role="document" align="center" style="margin-top: 0px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update == 0">Crear asiento</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update != 0">Actualizar asiento</h5>
                        <br>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Sala</label>
                                    <input v-model="room_id" type="text" class="form-control">
                                </div>  
                                <div class="col-md-6">
                                    <label>Numero de asiento</label>
                                     <input v-model="seat_number" type="text" class="form-control">
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
          + Crear asiento
        </button>
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <data-table
                    :columns="columns"
                    url="/api/seats"room ref="myTable" room_id="myTable" class="datatable">
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
                seat_id:"",
                room_id:"",
                seat_number:"",
                status:0,
                update:0, 
                arrayData:[],
                columns: [
                    {
                        label: 'Id',
                        name: 'seat_id',
                        orderable: true,
                    },
                    {
                        label: 'Sala',
                        name: 'room_id',
                        orderable: true,
                    },
                    {
                        label: 'Numero de asiento',
                        name: 'seat_number',
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
                let url = '/api/seats'; 
                axios.post(url,{ 
                    'room_id': this.room_id,
                    'seat_number': this.seat_number,
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
                axios.put('/api/seats/'+me.seat_id,{
                    'room_id': me.room_id,
                    'seat_number': me.seat_number,
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
                this.update = data.seat_id
                let me =this;
                let url = '/api/seats/'+this.update;
                axios.get(url).then(function (response) {
                    me.seat_id= response.data.records.seat_id;
                    me.room_id= response.data.records.room_id;
                    me.seat_number= response.data.records.seat_number;
                    me.status= response.data.records.status;
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            deleteData(data){
                let me =this;
                let Data_id = data.seat_id
                if (confirm('¿Seguro que deseas eliminar este registro?')) {
                    axios.delete('/api/seats/'+Data_id
                    ).then(function (response) {
                        me.getData();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clearFields(){
                this.seat_id = "";
                this.room_id = "";
                this.seat_number = "";
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